@extends('user-panel.layout.layout')
@section('content')

    <div id="profile">
        <section class="px-2">
            <div class="flex flex-wrap">
                <div class="w-full lg:w-1/3 px-3">

                    <div
                        class="px-5 py-10 w-full border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl flex justify-center items-center flex-col">

                        <label for="upload-profile-avatar" v-if="profileParam.avatar === null && !uploadLoading"
                               class="cursor-pointer w-[200px] lg:w-[250px] h-[200px] lg:h-[250px] text-white dark:bg-cyan-600 bg-gray-400 rounded-full text-5xl lg:text-7xl flex justify-center items-center">
                            @{{nameControl()}}
                            <input id="upload-profile-avatar" type="file" name="avatar" hidden="hidden"
                                   @change="uploadFile($event)">
                        </label>

                        <div v-if="uploadLoading" class="w-[200px] lg:w-[250px] h-[200px] lg:h-[250px] dark:bg-cyan-600 bg-gray-400 rounded-full text-5xl lg:text-7xl flex justify-center items-center">
                            <svg class="h-5 mx-auto w-5 animate-spin text-white"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>

                        <div v-if="profileParam.avatar !== null & !uploadLoading"
                             class="relative rounded-full w-[200px] lg:w-[250px] h-[200px] bg-cover object-cover lg:h-[250px] overflow-hidden group">
                            <img :src="'/storage/media/'+profileParam.avatar"
                                 class="w-[200px] lg:w-[250px] h-[200px] bg-cover object-cover lg:h-[250px] rounded-full"
                                 alt="profile-avtar">
                            <div class="absolute top-0 end-0 bottom-0 start-0 flex justify-center items-center rounded-full w-full h-full duration-500 group-hover:bg-black group-hover:bg-opacity-30">
                                <span class="duration-500 opacity-0 group-hover:opacity-100">
                                                                    <button type="button"
                                                                            class="outline-0 border-0 flex justify-center items-center duration-500 bg-red-400 hover:bg-red-600 rounded-full w-[45px] h-[45px]"
                                                                            @click="deleteAvatar($event)">
                                    <svg viewBox="0 0 24 24" class="w-[24px] h-[24px]" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M10 11V17" class="stroke-gray-100" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M14 11V17" class="stroke-gray-100" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M4 7H20" class="stroke-gray-100" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path
                                                d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                                class="stroke-gray-100" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                class="stroke-gray-100" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </button>
                                </span>
                            </div>
                        </div>

                        <div class="text-3xl font-bold text-center py-5">
                            @{{profileData?.name}}
                        </div>

                    </div>
                    <div
                        class="p-5 w-full border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl mt-5 mb-5">
                        <a href="javascript:void(0)" @click="logout" v-if="!logoutLoading"
                           class="decoration-0 text-gray-700 hover:text-cyan-800 dark:text-white dark:hover:text-cyan-300 duration-500 block font-semibold p-3">
                            Logout
                        </a>
                        <button type="button"
                                class="btn-theme rounded-md w-full flex justify-center items-center h-[45px] text-white"
                                disabled v-if="logoutLoading">
                            <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
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
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.name !== undefined" v-text="error.name[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block font-semibold"> Email </label>
                                <input id="email" type="email" name="email" v-model="profileParam.email"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your email">
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="bio" class="block font-semibold"> Bio </label>
                                <textarea name="bio" id="bio"
                                          class="resize-0 py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                          placeholder="Enter your bio" v-model="profileParam.bio"></textarea>
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.bio !== undefined" v-text="error.bio[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="website" class="block font-semibold"> Website </label>
                                <input id="website" type="text" name="website" v-model="profileParam.website"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter website url">
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.website !== undefined"
                                     v-text="error.website[0]"></div>
                            </div>
                            <div class="flex justify-start items-center">
                                <button type="submit" class="btn-theme rounded-md w-[120px]"
                                        v-if="!profileUpdateLoading">
                                    Submit
                                </button>
                                <button type="button"
                                        class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white"
                                        disabled v-if="profileUpdateLoading">
                                    <svg class="h-5 mx-auto w-5 animate-spin text-white"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
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
                                <input id="current_password" type="password" name="current_password"
                                       v-model="passwordParam.current_password"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your current password">
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.current_password !== undefined"
                                     v-text="error.current_password[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="block font-semibold"> Password </label>
                                <input id="password" type="password" name="password" v-model="passwordParam.password"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your password">
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.password !== undefined"
                                     v-text="error.password[0]"></div>
                            </div>
                            <div class="mb-5">
                                <label for="password_confirmation" class="block font-semibold"> Password
                                    confirmation </label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                       v-model="passwordParam.password_confirmation"
                                       class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                       placeholder="Enter your password confirmation">
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.password_confirmation !== undefined"
                                     v-text="error.password_confirmation[0]"></div>
                            </div>
                            <div class="flex justify-start items-center">
                                <button type="submit" class="btn-theme rounded-md w-[120px]"
                                        v-if="!changePasswordLoading">
                                    Submit
                                </button>
                                <button type="button"
                                        class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white"
                                        disabled v-if="changePasswordLoading">
                                    <svg class="h-5 mx-auto w-5 animate-spin text-white"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
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
