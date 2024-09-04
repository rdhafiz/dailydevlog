@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    <div id="login" class="py-10">
        <section class="flex justify-center items-center p-3 md:p-5">
            <div class="border p-5 md:p-10  bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-[565px] rounded-md">
                <form class="w-full" @submit.prevent="login()">
                    <div class="text-2xl font-semibold mb-2"> Welcome to Daily Dev Blog! 👋🏻 </div>
                    <div class="mb-5 text-sm"> Please sign-in to your account and start the adventure </div>
                    <div class="mb-5">
                        <label for="email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                        <input id="email" type="text" name="email" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" v-model="loginParam.email" placeholder="Enter your email">
                        <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block dark:text-cyan-600 font-semibold"> Password </label>
                        <input id="password" type="password" name="password" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" v-model="loginParam.password" placeholder="Enter your password">
                        <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                    </div>
                    <div class="flex justify-between items-center font-medium flex-wrap mb-5">
                        <div class="mb-3">
                            <label for="remember-me" class="flex justify-start items-center cursor-pointer">
                                <input id="remember-me" v-model="loginParam.remember" type="checkbox" class="me-2 form-checkbox">
                                Remember me
                            </label>
                        </div>
                        <div class="mb-3">
                            <a href="{{route('user.panel.forget.password')}}" class="decoration-0 text-red-500">
                                Forgot password?
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-start items-center">
                        <button type="submit" id="login-button" class="btn-theme rounded-md w-[120px]" v-if="!loading">
                            Login
                        </button>
                        <button type="button" class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white" disabled v-if="loading">
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

    <script src="{{asset('/js/login.js')}}"></script>

@endsection
