<header class="start-0 sticky end-0 top-0 bg-white dark:border-gray-700 dark:bg-gray-900 w-full header border-effect"
        id="header">
    <div class="container mx-auto">
        <div class="w-full flex items-center h-[90px] px-3 sm:px-2 justify-between">
            <div class="w-auto sm:w-1/2 text-3xl font-bold">
                <a href="{{route('user.panel.home')}}" class="decoration-0 text-gray-600 inline-flex items-center justify-between relative">
                    <img src="{{asset('/images/logo-dark.png')}}"
                         alt="logo-dark">
                    <span class="text-[12px] sm:text-[24px] font-extrabold text-slate-500 ms-2">DailyDevBLog</span>
                </a>
            </div>
            <div class="hidden md:block">
                <ul class="flex items-center">
                    <li class="me-3">
                        <a href="{{route('user.panel.home')}}" class="p-3 block transition duration-500 hover:border-b-cyan-400 hover:text-cyan-400 {{Request::route()->getName() == 'user.panel.home' ? 'text-cyan-400' : ''}}">Home</a>
                    </li>
                    <li class="me-3">
                        <a href="{{route('user.panel.post')}}" class="p-3 block transition duration-500 hover:border-b-cyan-400 hover:text-cyan-400 {{Request::route()->getName() == 'user.panel.post' ? 'text-cyan-400' : ''}}">Blogs</a>
                    </li>
                </ul>
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
                            <a href="#" class="flex justify-start p-3 transition duration-500 hover:bg-gray-300 dark:hover:text-white"
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
                <a href="javascript:void(0)" class="inline-block md:hidden sm:px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35px" height="35px" viewBox="0 0 24 24" fill="none">
                        <g id="Menu / Hamburger_MD">
                            <path id="Vector" d="M5 17H19M5 12H19M5 7H19" stroke="currentColor" class="stroke-black dark:stroke-gray-400"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                    </svg>
                </a>
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
                                    Profile Settings
                                </a>
                                <a href="{{route('user.panel.post')}}"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300">
                                    My Blogs
                                </a>
                                <a href="javascript:void(0)" @click="logout"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300" v-if="!logoutLoading">
                                    Logout
                                </a>
                                <a href="javascript:void(0)"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 bg-gray-300" v-if="logoutLoading">
                                    <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="#06B6D4"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="#06B6D4"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{route('user.panel.login')}}" class="btn-theme rounded-2xl px-5">
                        Login
                    </a>
                @endif

            </div>
        </div>
    </div>
    <div class="fixed top-0 bottom-0 left-[-100%] right-0 h-full w-full bg-cyan-400 overflow-scroll p-5">
        <div>menu</div>
    </div>
</header>

<script src="{{asset('js/header.js')}}"></script>
