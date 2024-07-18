@extends('user-panel.layout.layout')
@section('content')

    <div id="forgot">
        <section class="h-full md:h-dvh flex justify-center items-center p-3 md:p-5">
            <div
                class="border p-5 md:p-10 bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-[565px] rounded-md">

                <form @submit.prevent="forgot()" class="w-full forgetContent" v-if="tab === 'forgot'">
                    <div class=" text-2xl font-semibold mb-2"> Forgot Password 🔒</div>
                    <div class="mb-5 text-sm"> Enter your email and we'll send you instructions to reset your password</div>
                    <div class="mb-5">
                        <label for="forget-email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                        <input id="forget-email" type="email" name="email"
                               class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent"
                               v-model="forgetParam.email" placeholder="Enter your email">
                        <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                    </div>
                    <div class="flex justify-start items-center">
                        <button type="submit" class="btn-theme rounded-md w-[120px]" v-if="!forgotLoading">
                            Submit
                        </button>
                        <button type="button" class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white" disabled v-if="forgotLoading">
                            <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <form @submit.prevent="reset()" class="w-full" v-if="tab === 'reset'">
                    <div class="text-2xl font-semibold mb-2"> Reset your account</div>
                    <div class="mb-5 text-sm"> After fill form to click in reset button</div>
                    <div class="mb-5">
                        <label for="email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                        <input id="email" type="email" name="email"
                               class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent"
                               v-model="resetParam.email" disabled placeholder="Enter your email">
                        <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                    </div>
                    <div class="mb-5">
                        <label for="code" class="block dark:text-cyan-600 font-semibold"> Reset code </label>
                        <input id="code" type="text" name="code"
                               class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent"
                               v-model="resetParam.code" placeholder="Enter your reset code">
                        <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.code !== undefined" v-text="error.code[0]"></div>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block dark:text-cyan-600 font-semibold"> Password </label>
                        <input id="password" type="password" name="password"
                               class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent"
                               v-model="resetParam.password" placeholder="Enter your password">
                        <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                    </div>
                    <div class="mb-5">
                        <label for="password_confirmation" class="block dark:text-cyan-600 font-semibold"> Password
                            confirmation </label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent"
                               v-model="resetParam.password_confirmation" placeholder="Enter your password confirmation">
                        <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                    </div>
                    <div class="flex justify-start items-center">
                        <button type="submit" class="btn-theme rounded-md w-[120px]" v-if="!resetLoading">
                            Submit
                        </button>
                        <button type="button" class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white" disabled v-if="resetLoading">
                            <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </div>

    <script src="{{asset('/js/forgot.js')}}"></script>

@endsection
