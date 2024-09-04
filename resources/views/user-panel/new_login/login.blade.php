@extends('user-panel.layout.layout')
@section('content')

    <div id="login">
        <section class="w-full flex justify-center items-center px-4">
            <div class="w-full sm:w-[450px] h-auto rounded-[16px] bg-white dark:bg-[#222222] p-[35px] mt-[36px]">
                <div class="dark:text-white text-center font-bold text-[24px] leading-[36px]">
                    Author Login
                </div>
                <div class="flex justify-center mb-[61px]">
                    <div class="font-[400] sm:w-[230px] text-[14px] text-center leading-[21px]">
                        Enter your details to get sign in
                        to your account
                    </div>
                </div>
                <div class="sm:flex justify-center">
                    <form @submit.prevent="login()">

                        {{-- Email --}}
                        <div class="mb-[12px]">
                            <input type="email" name="email" placeholder="Email Address *" v-model="loginParam.email"
                                   class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                            <div class="text-[12px] font-[600] text-red mt-2" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-[12px]">
                            <input type="password" name="password" placeholder="Password *" v-model="loginParam.password"
                                   class="w-full sm:w-[330px] border border-[#0000003F] bg-[#ECEBF7] dark:bg-[#333333] placeholder-[#A0A0A0] dark:placeholder-[#ECEBF780] h-[45px] px-[20px] rounded-[50px] d-flex justify-start items-center outline-0 text-[14px]">
                            <div class="text-[12px] font-[600] text-red mt-2" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                        </div>

                        <div class="mb-[12px]">
                            <label
                                for="check-vertical-list-group"
                                class="flex w-full cursor-pointer items-center px-3 py-2">
                                <div class="inline-flex items-center">
                                    <label class="flex items-center cursor-pointer relative"
                                           for="check-vertical-list-group">
                                        <input type="checkbox" v-model="loginParam.remember"
                                               class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-[#0000003F] bg-[#ECEBF7] checked:bg-slate-800 checked:border-slate-800"
                                               id="check-vertical-list-group"/>
                                        <span
                                            class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"
                                               stroke="currentColor" stroke-width="1">
                                            <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd"></path>
                                          </svg>
                                        </span>
                                    </label>
                                    <label class="cursor-pointer font-[400] text-[14px] leading-[21px] ml-2"
                                           for="check-vertical-list-group">
                                    <span class="text-[#556080] dark:text-white">
                                        Remember Me
                                    </span>
                                    </label>
                                </div>
                            </label>
                        </div>

                        <div class="w-full mb-[12px]">
                            <button type="submit" v-if="!loading"
                                    class="btn h-[45px] w-full flex justify-center items-center border border-[#0000003F] rounded-[50px] bg-gradient-to-r from-15% from-[#85A41C] via-50% via-[#AED725] to-85% to-[#85A41C]">
                            <span class="font-[500] dark:text-black light:text-black text-[14px]">
                                LOGIN NOW
                            </span>
                            </button>
                            <button type="button" disabled v-if="loading"
                                    class="btn h-[45px] w-full flex justify-center items-center border border-[#0000003F] rounded-[50px] bg-gradient-to-r from-15% from-[#85A41C] via-50% via-[#AED725] to-85% to-[#85A41C]">
                            <span class="font-[500] dark:text-black light:text-black text-[14px]">
                                <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                            </button>
                        </div>
                        <div class="text-center pb-[8px] leading-[18px] text-[12px] font-[300]">
                            <a href="{{route('user.panel.forgot.password')}}" class="decoration-0 text-[#0C75ED]">
                                Forgot Password?
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('/js/login.js')}}"></script>

@endsection
