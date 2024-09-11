@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    @php
        use Illuminate\Support\Facades\Auth;
        $user = Auth::user();
        $userName = $user['name'];
        $userAvatar = $user['avatar'];
    @endphp

    <div id="profile">
        <section class="fixed-container mt-[85px]">
            <div class="flex flex-wrap">

                <div class="w-full lg:w-1/3 px-3 mb-5">

                    <div class="px-5 py-10 w-full border border-cyan-100 dark:border-cyan-900 bg-gray-100 dark:bg-gray-800 rounded-3xl flex justify-center items-center flex-col">
                        {{-- Show avatar --}}
                        @if($user['avatar'])
                            <form action="{{ route('API.USER.UPDATE.AVATAR') }}" id="update-avatar" method="post" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div id="changeAvatar">
                                    <label for="upload-profile-avatar">
                                        <div class="rounded-full w-[200px] lg:w-[250px] h-[200px] bg-cover object-cover lg:h-[250px] overflow-hidden group relative">
                                            <img src="{{ asset('storage/media/'.$user['avatar']) }}" class="w-[200px] lg:w-[250px] h-[200px] bg-cover object-cover lg:h-[250px] rounded-full" alt="profile-avatar">
                                            <div class="font-[500] absolute top-0 bottom-0 start-0 end-0 flex justify-center items-center w-[200px] lg:w-[250px] h-[200px] lg:h-[250px] opacity-0 duration-500 hover:opacity-100 bg-[#00000040] h-full cursor-pointer">
                                                Change
                                            </div>
                                        </div>
                                        <input id="upload-profile-avatar" type="file" name="avatar" hidden="hidden">
                                    </label>
                                </div>
                            </form>
                        @else
                            {{-- Upload avatar --}}
                            <form action="{{ route('API.USER.UPDATE.AVATAR') }}" id="update-avatar" method="post" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <label for="upload-profile-avatar" class="cursor-pointer w-[200px] lg:w-[250px] h-[200px] lg:h-[250px] text-white dark:bg-cyan-600 bg-gray-400 rounded-full text-5xl lg:text-7xl flex justify-center items-center" id="changeAvatar">
                                    <span id="profile-initials"></span>
                                    <input id="upload-profile-avatar" type="file" name="avatar" hidden="hidden">
                                </label>
                            </form>
                        @endif
                        {{-- Upload loading --}}
                        <div id="changeAvatarLoader" class="hidden">
                            <div class="w-[200px] lg:w-[250px] h-[200px] lg:h-[250px] dark:bg-cyan-600 bg-gray-400 rounded-full text-5xl lg:text-7xl flex justify-center items-center">
                                <svg class="h-5 mx-auto w-5 animate-spin text-white"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-center pt-5 pb-2">
                            {{ $user['name'] }}
                        </div>
                        <div class="font-medium text-center text-sm pb-2">
                            {{ $user['email'] }}
                        </div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ $user['bio'] }}
                        </div>
                    </div>
                    
                </div>

                <div class="w-full lg:w-2/3 px-3">

                    <div class="p-10 w-full border border-cyan-100 dark:border-cyan-900 bg-gray-100 dark:bg-gray-800 rounded-3xl mb-5">
                        <form id="profile-update" method="post" action="{{ route('API.USER.UPDATE.PROFILE') }}">
                            @csrf
                            <section class="w-full mb-7">
                                <div class="decoration-0 text-gray-600 font-semibold dark:text-cyan-400">
                                    Edit Profile
                                </div>
                                <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
                            </section>
                            <div class="mb-5">
                                <label for="user-name" class="block font-semibold"> Name </label>
                                <input id="user-name" type="text" name="name" value="{{$user['name']}}" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter your name" autocomplete="off">
                                @error('name')
                                    <div class="text-[12px] font-[600] text-red mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="user-email" class="block font-semibold"> Email </label>
                                <input id="user-email" type="email" name="email" value="{{$user['email']}}" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter your email" autocomplete="off">
                                @error('email')
                                    <div class="text-[12px] font-[600] text-red mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="user-bio" class="block font-semibold"> Bio </label>
                                <textarea name="bio" id="user-bio" class="resize-0 py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter your bio" autocomplete="off"> {{$user['bio']}} </textarea>
                                @error('bio')
                                    <div class="text-[12px] font-[600] text-red mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="user-website" class="block font-semibold"> Website </label>
                                <input id="user-website" type="text" name="website" value="{{$user['website']}}" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter website url" autocomplete="off">
                                @error('website')
                                    <div class="text-[12px] font-[600] text-red mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="flex justify-start items-center">
                                <span id="profileUpdateBtn">
                                    <button type="submit" class="btn-theme rounded-md w-[120px]"> Submit </button>
                                </span>
                                <span id="profileUpdateLoading" class="hidden">
                                    <button type="button" class="btn-theme rounded-md w-[120px] justify-center items-center h-[45px] text-white" disabled>
                                        <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="p-10 w-full border border-cyan-100 dark:border-cyan-900 bg-gray-100 dark:bg-gray-800 rounded-3xl">
                        <form id="change-password" method="post" action="{{ route('API.USER.CHANGE.PASSWORD') }}">
                            @csrf
                            <section class="w-full mb-7">
                                <div class="decoration-0 text-gray-600 font-semibold dark:text-cyan-400">
                                    Change Password
                                </div>
                                <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
                            </section>
                            <div class="mb-5">
                                <label for="user_current_password" class="block font-semibold">
                                    Current password
                                 </label>
                                <input id="user_current_password" type="password" name="current_password" value="{{old('current_password')}}" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter your current password" autocomplete="off">
                                @error('current_password')
                                    <div class="text-[12px] font-[600] text-red mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="user_password" class="block font-semibold"> Password </label>
                                <input id="user_password" type="password" name="password" value="{{old('password')}}" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter your password" autocomplete="off">
                                @error('password')
                                    <div class="text-[12px] font-[600] text-red mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="user_password_confirmation" class="block font-semibold"> 
                                    Password confirmation
                                </label>
                                <input id="user_password_confirmation" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter your password confirmation" autocomplete="off">
                                @error('password_confirmation')
                                    <div class="text-[12px] font-[600] text-red mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex justify-start items-center">
                                <span id="changePasswordBtn">
                                    <button type="submit" class="btn-theme rounded-md w-[120px]"> Submit </button>
                                </span>
                                <span id="changePasswordLoader" class="hidden">
                                    <button type="button" class="btn-theme rounded-md flex w-[120px] justify-center items-center h-[45px] text-white" disabled>
                                        <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </section>

    </div>

    <script> 
        window.userInfo = {
            name: '{{$userName}}',
            avatar: '{{$userAvatar}}',
        }
    </script>

    <script src="{{asset('/js/profile.js')}}"></script>

@endsection
