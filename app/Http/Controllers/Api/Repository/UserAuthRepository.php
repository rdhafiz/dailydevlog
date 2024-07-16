<?php

namespace App\Http\Controllers\Api\Repository;



use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserAuthRepository
{
    public static function Login($request)
    {
        try {
            $input = $request->input();
            $validator = Validator::make($input, [
                'username' => 'required',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }
            $userInfo = User::where(function ($q) use ($input) {
                $q->where('email', $input['username']);
                $q->orWhere('username', $input['username']);
            })->first();


            if ($userInfo != null) {
//                if ($userInfo->status == 0) {
//                    return ['status' => 500, 'error' => ['username' => ['Sorry, this account is temporarily unavailable.']]];
//                }
                if (Hash::check($input['password'], $userInfo['password'])) {
                    $credential = [
                        'email' => $userInfo->email,
                        'password' => $input['password']
                    ];
                    $remember = isset($input['remember']) && $input['remember'] == 1 ? true : false;
                    if (Auth::attempt($credential, $remember)) {
                        return ['status' => 200, 'msg' => 'Login Successful!'];
                    } else {
                        $credential = [
                            'username' => $userInfo->username,
                            'password' => $input['password']
                        ];
                        if (Auth::attempt($credential, $remember)) {
                            return ['status' => 200, 'msg' => 'Login Successful!'];
                        } else {
                            return ['status' => 500, 'error' => ['email' => 'Invalid credentials! Try again.']];
                        }
                    }
                } else {
                    return ['status' => 500, 'error' => ['password' => ['Invalid credentials! Try again.']]];
                }

            }

            if ($userInfo == null) {
                $userModel = User::whereNull('email_verified_at')->where(function ($q) use ($input) {
                    $q->where('email', $input['username']);
                    $q->orWhere('username', $input['username']);
                })->first();
                if ($userModel == null) {
                    return ['status' => 500, 'error' => ['username' => ['User not found. Please double-check your credentials.']]];
                }

                Mail::send('emails.verify', ['user' => $userModel], function ($message) use ($userModel) {
                    $message->to($userModel->email, $userModel->name)->subject('Activate your glow account');
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                });
                return ['status' => 500, 'error' => ['username' => ['Your account has not been verified yet. Please check your email to verify your account.']]];
            }
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];

        }
    }

    public static function Logout($request)
    {
        try {
            Auth::logout();
            return ['status' => 200, 'msg' => 'You have successfully logged out.'];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

    public static function Forgot($request)
    {
        try {
            DB::beginTransaction();
            $input = $request->input();
            $validator = Validator::make($input, [
                'email' => 'required|email'
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }
            $userInfo = User::where('email', $input['email'])->first();
            if ($userInfo == null) {
                return ['status' => 500, 'error' => ['email' => ['Email not found. Please double-check your email address.']]];
            }
            $reset_code = rand(100000, 999999);
            $userInfo->reset_code = $reset_code;
            $userInfo->save();
            Mail::send('emails.forgot', ['userInfo' => $userInfo], function ($message) use ($userInfo) {
                $message->to($userInfo['email'], $userInfo['name'])->subject(env('MAIL_FROM_NAME') . ':Password reset code');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            DB::commit();
            return ['status' => 200, 'msg' => 'A reset code has been sent to your email. Please check your email'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

    public static function Reset($request)
    {
        try {
            DB::beginTransaction();
            $input = $request->input();
            $validator = Validator::make($input, [
                'email' => 'required|email',
                'code' => 'required',
                'password' => 'required|confirmed'
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }
            $userInfo = User::where(['email' => $input['email'], 'reset_code' => $input['code']])->first();
            if ($userInfo == null) {
                return ['status' => 500, 'error' => ['code' => ['Invalid request. Please check your reset code.']]];
            }
            if (Hash::check($input['password'], $userInfo['password'])) {
                return ['status' => 500, 'error' => ['password' => ['Repetition of password is not allowed. Try another password please']]];
            }
            $userInfo->password = bcrypt($input['password']);
            $userInfo->reset_code = null;
            $userInfo->save();
            DB::commit();
            return ['status' => 200, 'msg' => 'The password has been reset successfully.'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }
}
