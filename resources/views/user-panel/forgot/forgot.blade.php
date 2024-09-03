@extends('user-panel.layout.layout')
@section('content')

    <section class="w-full flex justify-center items-center px-4">
        <div class="w-[450px] h-auto min-h-[455px] rounded-[16px] bg-white dark:bg-[#222222] p-[35px] mt-[36px]">
            <div class="dark:text-white text-center font-bold text-[24px] leading-[36px]">
                Forgot Password?
            </div>
            <div class="flex justify-center mb-[61px]">
                <div class="font-[400] sm:w-[240px] text-[14px] text-center leading-[21px]">
                    Enter your email and we'll send
                    you instructions to reset your password
                </div>
            </div>
            <div class="sm:flex justify-center">
                <form>

                    {{-- Email --}}
                    <div class="mb-[15px]">
                        <input type="email" name="email" placeholder="Email Address *"
                               class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                    </div>

                    <div class="w-full mb-[15px]">
                        <button type="submit"
                                class="btn h-[45px] w-full flex justify-center items-center border border-[#0000003F] rounded-[50px] bg-gradient-to-r from-15% from-[#85A41C] via-50% via-[#AED725] to-85% to-[#85A41C]">
                            <span class="font-[500] dark:text-black light:text-black text-[14px]">
                                Send Request
                            </span>
                        </button>
                    </div>
                    <div
                        class="text-center pb-[8px] leading-[18px] light:text-[#556080] font-[300] dark:text-[#ECEBF7] text-[12px]">
                        Remember Password?
                        <a href="{{route('user.panel.log_in')}}" class="decoration-0 text-[#0C75ED]">
                            Login Now!
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
