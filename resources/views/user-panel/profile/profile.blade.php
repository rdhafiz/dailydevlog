@extends('user-panel.layout.layout')
@section('content')

    <div id="profile">
        <section class="px-2">
            <div class="flex flex-wrap">
                <div class="w-full lg:w-1/3 px-3">
                    <div
                        class="px-5 py-10 w-full border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl flex justify-center items-center flex-col">
                        <div
                            class="w-[200px] lg:w-[250px] h-[200px] lg:h-[250px] dark:bg-cyan-600 bg-gray-400 rounded-full text-5xl lg:text-7xl flex justify-center items-center">
                            @{{nameControl()}}
                        </div>
                        <div class="text-3xl font-bold text-center py-5">
                            @{{profileData?.name}}
                        </div>
                    </div>
                    <div
                        class="p-5 w-full border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl mt-5">
                        <a href="javascript:void(0)" @click="logout" v-if="!logoutLoading"
                           class="decoration-0 text-gray-700 hover:text-cyan-800 dark:text-white dark:hover:text-cyan-300 duration-500 block font-semibold p-3">
                            Logout
                        </a>
                        <button type="button" class="btn-theme rounded-md w-full flex justify-center items-center h-[45px] text-white" disabled v-if="logoutLoading">
                            <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-full lg:w-2/3 px-3">
                    <div
                        class="p-10 w-full border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl mb-5">

                        <form @submit.prevent="profileUpdate">
                            <div class="mb-7 text-2xl md:text-4xl font-bold"> Edit Profile</div>
                            <div class="mb-5">
                                <label for="name" class="block font-semibold"> Name </label>
                                <input id="name" type="text" name="name" v-model="profileParam.name"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your name">
                                <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.name !== undefined" v-text="error.name[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="username" class="block font-semibold"> Username </label>
                                <input id="username" type="text" name="username" v-model="profileParam.username"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your username">
                                <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.username !== undefined" v-text="error.username[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block font-semibold"> Email </label>
                                <input id="email" type="email" name="email" v-model="profileParam.email"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your email">
                                <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <div class="flex justify-start items-center">
                                <button type="submit" class="btn-theme rounded-md w-[120px]" v-if="!profileUpdateLoading">
                                    Submit
                                </button>
                                <button type="button" class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white" disabled v-if="profileUpdateLoading">
                                    <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>

                    </div>

                    <div
                        class="p-10 w-full border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl">

                        <form @submit.prevent="changePassword()">
                            <div class="mb-7 text-2xl md:text-4xl font-bold"> Change Password</div>
                            <div class="mb-5">
                                <label for="current_password" class="block font-semibold"> Current password </label>
                                <input id="current_password" type="password" name="current_password" v-model="passwordParam.current_password"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your current password">
                                <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.current_password !== undefined" v-text="error.current_password[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="block font-semibold"> Password </label>
                                <input id="password" type="password" name="password" v-model="passwordParam.password"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your password">
                                <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="password_confirmation" class="block font-semibold"> Password confirmation </label>
                                <input id="password_confirmation" type="password" name="password_confirmation" v-model="passwordParam.password_confirmation"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your password confirmation">
                                <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                            </div>
                            <div class="flex justify-start items-center">
                                <button type="submit" class="btn-theme rounded-md w-[120px]" v-if="!changePasswordLoading">
                                    Submit
                                </button>
                                <button type="button" class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white" disabled v-if="changePasswordLoading">
                                    <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <div class="fixed top-0 end-0 p-10 z-50" v-if="msg" id="msg">
            <div class="px-10 py-5 text-end bg-gradient-to-r from-green-900 to-green-500 rounded-2xl">
                @{{msg}}
            </div>
        </div>

    </div>

    <script src="{{asset('/js/profile.js')}}"></script>

@endsection
