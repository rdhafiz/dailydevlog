@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    <div id="reset">
        <section class="w-full flex justify-center items-center px-4">
            <div class="w-[450px] h-auto min-h-[455px] rounded-[16px] bg-white dark:bg-[#222222] p-[35px] mt-[36px]">
                <div class="dark:text-white text-center font-bold text-[24px] leading-[36px]">
                    Reset Password
                </div>
                <div class="flex justify-center mb-[61px]">
                    <div class="font-[400] sm:w-[240px] text-[14px] text-center leading-[21px]">
                        Please check your email, after complete this form
                    </div>
                </div>
                <div class="sm:flex justify-center">
                    <form id="reset-form" action="{{ route('API.USER.RESET') }}" method="POST">

                        @csrf

                        @if (session('email'))
                            <div class="mb-[15px]">
                                <input type="email" name="email" placeholder="Email Address *"
                                       value="{{ session('email') }}"
                                       class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                                @error('email')
                                <div class="text-[12px] font-[600] text-red mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @else
                            {{-- Email --}}
                            <div class="mb-[15px]">
                                <input type="email" name="email" placeholder="Email Address *"
                                       value="{{ old('email') }}"
                                       class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                                @error('email')
                                <div class="text-[12px] font-[600] text-red mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @endif

                        {{-- Reset Code --}}
                        <div class="mb-[15px]">
                            <input type="text" name="code" placeholder="Reset Code *"
                                   value="{{ old('code') }}"
                                   class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                            @error('code')
                            <div class="text-[12px] font-[600] text-red mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-[15px]">
                            <input type="password" name="password" placeholder="Password *"
                                   class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                            @error('password')
                            <div class="text-[12px] font-[600] text-red mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="mb-[15px]">
                            <input type="password" name="password_confirmation" placeholder="Password Confirmation *"
                                   class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                            @error('password_confirmation')
                            <div class="text-[12px] font-[600] text-red mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="w-full mb-[15px]">
                            <button type="submit"
                                    class="btn h-[45px] w-full flex justify-center items-center border border-[#0000003F] rounded-[50px] bg-gradient-to-r from-15% from-[#85A41C] via-50% via-[#AED725] to-85% to-[#85A41C]"
                                    id="submitBtn">
                                    <span class="font-[500] dark:text-black light:text-black text-[14px]">
                                        Submit
                                    </span>
                            </button>
                            <button type="button" disabled
                                    id="loader"
                                    class="btn h-[45px] w-full flex justify-center items-center border border-[#0000003F] rounded-[50px] bg-gradient-to-r from-15% from-[#85A41C] via-50% via-[#AED725] to-85% to-[#85A41C] hidden">
                                    <span class="font-[500] dark:text-black light:text-black text-[14px]">
                                        <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </span>
                            </button>
                        </div>
                        <div
                            class="text-center pb-[8px] leading-[18px] light:text-[#556080] font-[300] dark:text-[#ECEBF7] text-[12px]">
                            Remember Password?
                            <a href="{{ route('user.panel.login') }}" class="decoration-0 text-[#0C75ED]">
                                Login Now!
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('/js/reset.js')}}"></script>

@endsection
