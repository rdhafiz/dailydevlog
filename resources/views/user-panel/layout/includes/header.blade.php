<header class="start-0 sticky end-0 top-0 bg-white dark:border-gray-700 dark:bg-gray-900 w-full header border-effect"
        id="header">
    <div class="container mx-auto">
        <div class="w-full flex items-center h-[90px] px-3 sm:px-2 justify-between">
            <div class="w-auto sm:w-1/2 text-3xl font-bold">
                <a href="{{route('user.panel.home')}}" class="decoration-0 text-gray-600 inline-block">
                    <img src="{{asset('/images/logo-dark.svg')}}" class="w-[75px] sm:w-auto md:w-[120px]"
                         alt="logo-dark">
                </a>
            </div>
            <div class="w-auto sm:w-1/2 flex justify-end items-center gap-x-1 md:gap-x-3">
                <div class="relative inline-block text-left" id="search-dropdown-menu">
                    <div id="searchBtn" class="flex">
                        <button type="button" class="outline-0 border-0" @click="searchDropdown">
                            <img src="{{asset('/images/header/search.svg')}}" class="w-[24px] h-[24px]" alt="search">
                        </button>
                    </div>
                    <div
                        class="hidden absolute -right-[223px] md:right-0 z-10 mt-4 w-[340px] origin-top-right p-0 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded-2xl overflow-hidden dark:bg-gray-900 dark:border dark:border-gray-70"
                        id="search-dropdown">
                        <div role="none" class="p-4">
                            <div class="relative">
                                <input type="text" placeholder="Search"
                                       class="py-3 px-5 rounded-2xl outline-0 w-full border text-black">
                                <div class="absolute top-0 bottom-0 end-0 pe-3 flex items-center h-full">
                                    <img src="{{asset('/images/header/search.svg')}}" class="w-[24px] h-[24px]"
                                         alt="search">
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-cyan-600">
                                Popular topic
                            </div>
                            <div class="mt-2 text-sm flex justify-start items-center gap-x-2 flex-wrap">
                                <a href="javascript:void(0)"
                                   class="decoration-0 text-cyan-600 d-flex justify-start items-center"># Lifestyle</a>
                                <a href="javascript:void(0)"
                                   class="decoration-0 text-cyan-600 d-flex justify-start items-center"># Travel</a>
                                <a href="javascript:void(0)"
                                   class="decoration-0 text-cyan-600 d-flex justify-start items-center"># Space</a>
                                <a href="javascript:void(0)"
                                   class="decoration-0 text-cyan-600 d-flex justify-start items-center"># Business</a>
                                <a href="javascript:void(0)"
                                   class="decoration-0 text-cyan-600 d-flex justify-start items-center"># Food</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative inline-block text-left" id="dropdown-menu">
                    <div id="themeSwitch">
                        <button type="button" class="px-3 py-2 inline-flex gap-2" @click="modeDropdown">
                            <img src="{{asset('/images/header/light.svg')}}" class="w-[24px] h-[24px]" alt="light">
                            <img src="{{asset('/images/header/caret-down.svg')}}" class="w-[18px] h-[18px]" alt="caret">
                        </button>
                    </div>
                    <div
                        class="hidden absolute right-0 z-10 mt-4 w-[150px] origin-top-right p-0 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded-2xl overflow-hidden"
                        id="dropdown">
                        <div role="none">
                            <a href="#" class="flex justify-start p-3 transition duration-500 hover:bg-gray-300"
                               role="menuitem" tabindex="-1" id="menu-item-0" onclick="lightMode()">
                                <img src="{{asset('/images/header/light.svg')}}" class="w-[24px] h-[24px]" alt="light">
                                <span class="ms-3 text-cyan-500">Light </span>
                            </a>
                            <a href="#" class="flex justify-start p-3 transition duration-500 hover:bg-gray-300"
                               role="menuitem" tabindex="-1" id="menu-item-1" onclick="darkMode()">
                                <img src="{{asset('/images/header/dark.svg')}}" class="w-[24px] h-[24px]" alt="dark">
                                <span class="ms-3 text-cyan-500">Dark </span>
                            </a>
                        </div>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="relative inline-block text-left" id="user-menu">
                        <div id="userToggle">
                            <a href="javascript:void(0)" @click="userDropdown">
                                <span
                                    class="w-[45px] h-[45px] text-white dark:bg-cyan-600 bg-gray-400 rounded-full flex justify-center items-center cursor-pointer"
                                    v-if="!profileData?.avatar">
                                    @{{nameControl()}}
                                </span>
                                <img :src="'/storage/media/'+profileData.avatar"
                                     class="w-[45px] h-[45px] rounded-full"
                                     alt="profile-avtar" v-if="profileData?.avatar" id="header_avatar">
                            </a>
                        </div>
                        <div
                            class="hidden absolute right-0 z-10 mt-4 w-[150px] origin-top-right p-0 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded-md overflow-hidden"
                            id="user-dropdown">
                            <div role="none">
                                <a href="{{route('user.panel.profile')}}"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300">
                                    Profile
                                </a>
                                <a href="{{route('user.panel.post')}}"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300">
                                    Blogs
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="btn-theme rounded-2xl px-5" v-if="!logoutLoading"
                       @click="logout">
                        Logout
                    </a>
                    <a href="javascript:void(0)" class="btn-theme rounded-2xl px-5 w-[90px]" disabled
                       v-if="logoutLoading">
                        <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{route('user.panel.login')}}" class="btn-theme rounded-2xl px-5">
                        Login
                    </a>
                @endif

            </div>
        </div>
    </div>
</header>

<script src="{{asset('js/header.js')}}"></script>
