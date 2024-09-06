<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Repository\UserAuthRepository;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function Login(Request $request)
    {
        try {
            $input = $request->input();
            $validator = Validator::make($input, [
                'email' => 'required',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $userInfo = User::where('email', $input['email'])->first();

            if ($userInfo != null) {
                if (Hash::check($input['password'], $userInfo->password)) {
                    $credential = [
                        'email' => $userInfo->email,
                        'password' => $input['password']
                    ];
                    $remember = isset($input['remember']) && $input['remember'] == 1 ? true : false;
                    if (Auth::attempt($credential, $remember)) {
                        $userInfo->last_login_at = Carbon::now();
                        $userInfo->save();
                        return redirect()->route('user.panel.post')->with('success', 'Login Successful!');
                    } else {
                        return redirect()->back()->withErrors(['email' => 'Invalid credentials! Try again.'])->withInput();
                    }
                } else {
                    return redirect()->back()->withErrors(['password' => 'Invalid credentials! Try again.'])->withInput();
                }
            }

            $userModel = User::whereNull('email_verified_at')->where('email', $input['email'])->first();

            if ($userModel == null) {
                return redirect()->back()->withErrors(['email' => 'User not found. Please double-check your credentials.'])->withInput();
            }

            Mail::send('emails.verify', ['user' => $userModel], function ($message) use ($userModel) {
                $message->to($userModel->email, $userModel->name)->subject('Activate your account');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return redirect()->back()->withErrors(['email' => 'Your account has not been verified yet. Please check your email to verify your account.'])->withInput();

        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred during login. Please try again later.'])->withInput();
        }
    }
    public function Registration(Request $request)
    {
        $rv = UserAuthRepository::Registration($request);
        return response()->json($rv, 200);
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect(route('user.panel.login'));
    }
    public function Forgot(Request $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->all();

            // Validate input
            $validator = Validator::make($input, [
                'email' => 'required|email'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Check if user exists
            $userInfo = User::where('email', $input['email'])->first();
            if ($userInfo === null) {
                return redirect()->back()->withErrors([
                    'email' => ['Email not found. Please double-check your email address.']
                ])->withInput();
            }

            // Generate reset code
            $reset_code = rand(100000, 999999);
            $userInfo->reset_code = $reset_code;
            $userInfo->save();

            // Send email
            Mail::send('emails.forgot', ['userInfo' => $userInfo], function ($message) use ($userInfo) {
                $message->to($userInfo->email, $userInfo->name)
                    ->subject(env('MAIL_FROM_NAME') . ': Password reset code');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            // Commit transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('user.panel.reset.password')->with('status', 'A reset code has been sent to your email. Please check your email.')
                ->with('email', $input['email']);

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();

            // Redirect with error message
            return redirect()->back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function Reset(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'code' => 'required',
                'password' => 'required|confirmed'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Find the user
            $userInfo = User::where([
                'email' => $request->input('email'),
                'reset_code' => $request->input('code')
            ])->first();

            if ($userInfo === null) {
                return redirect()->back()->withErrors([
                    'code' => ['Invalid request. Please check your reset code.']
                ])->withInput();
            }

            // Check if the new password is the same as the current password
            if (Hash::check($request->input('password'), $userInfo->password)) {
                return redirect()->back()->withErrors([
                    'password' => ['Repetition of password is not allowed. Try another password please.']
                ])->withInput();
            }

            // Update the user's password
            $userInfo->password = Hash::make($request->input('password'));
            $userInfo->reset_code = null; // Clear the reset code
            $userInfo->save();

            // Commit transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('user.panel.login')->with('status', 'The password has been reset successfully.');

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();

            // Redirect with error message
            return redirect()->back()->withErrors([
                'error' => 'An error occurred while resetting the password: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function GetProfile(Request $request)
    {
        try {
            $user = Auth::user();
            $profile = User::where('id', $user['id'])->first();
            return ['profile', 'user' => $profile];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }
    public function UpdateProfile(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->input();
            $validator = Validator::make($input, [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'website' => 'nullable|url',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user_id = Auth::id();
            $user = User::find($user_id);
            if ($user == null) {
                return redirect()->back()->with('error', 'Invalid Request!');
            }
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->avatar = $input['avatar'] ?? null;
            $user->bio = $input['bio'] ?? null;
            $user->website = $input['website'] ?? null;
            $user->updated_at = Carbon::now('UTC');
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'The profile has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    public function ChangePassword(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $validator = Validator::make($input, [
                'current_password' => 'required|min:8',
                'password' => 'required|min:8|confirmed',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user_id = Auth::id();
            $user = User::find($user_id);
            if ($user == null) {
                return redirect()->back()->with('error', 'Invalid Request!');
            }
            if (!Hash::check($input['current_password'], $user->password)) {
                return redirect()->back()->with('error', 'Please enter the current correct password.');
            }
            if (Hash::check($input['password'], $user->password)) {
                return redirect()->back()->with('error', 'Your new password must be different from your previous password.');
            }
            $user->password = bcrypt($input['password']);
            $user->updated_at = Carbon::now('UTC');
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'The password has been changed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function UpdateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'nullable|file|mimes:jpg,png,jpeg,gif|max:2048',
            ]);

            $user = User::find(Auth::id());

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->storeAs('media', $avatarName, 'public');
                $user->avatar = $avatarName;
                $user->save();
            }

            return redirect()->back()->with('success', 'Avatar has been changed successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
