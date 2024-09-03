@php
    $tags = getPopularTags();
@endphp


{{--<header class="start-0 end-0 top-0 bg-white dark:border-gray-700 dark:bg-gray-900 w-full header border-effect"
        id="header">
    <div class="container mx-auto">
        <div class="w-full flex items-center h-[90px] px-3 sm:px-2 justify-between">
            <div class="w-auto sm:w-1/2 text-3xl font-bold hidden md:block">
                <a href="{{route('user.panel.home')}}"
                   class="decoration-0 text-gray-600 inline-flex items-center justify-between relative">
                    <img src="{{asset('/images/logo-dark.png')}}"
                         alt="logo-dark">
                    <span class="text-[12px] sm:text-[24px] font-extrabold text-slate-500 ms-2">DailyDevBLog</span>
                </a>
            </div>
            <a href="javascript:void(0)" class="inline-block md:hidden sm:px-2" @click="toggleMenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="35px" height="35px" viewBox="0 0 24 24" fill="none">
                    <g id="Menu / Hamburger_MD">
                        <path id="Vector" d="M5 17H19M5 12H19M5 7H19" stroke="currentColor"
                              class="stroke-black dark:stroke-gray-400" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </g>
                </svg>
            </a>
            <div class="hidden md:block">
                <ul class="flex items-center">
                    <li class="me-3">
                        <a href="{{route('user.panel.home')}}"
                           class="p-3 block transition duration-500 hover:border-b-cyan-400 hover:text-cyan-400 {{Request::route()->getName() == 'user.panel.home' ? 'text-cyan-400' : ''}}">Home</a>
                    </li>
                    <li class="me-3">
                        <a href="{{route('user.panel.post')}}"
                           class="p-3 block transition duration-500 hover:border-b-cyan-400 hover:text-cyan-400 {{Request::route()->getName() == 'user.panel.post' ? 'text-cyan-400' : ''}}">Blogs</a>
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
                            <form @submit.prevent="searchData">
                                <div class="relative">
                                    <input type="text" placeholder="Search"
                                           class="py-3 px-5 rounded-2xl outline-0 w-full border text-black" v-model="formData.keyword">
                                    <button type="submit" class="absolute top-0 bottom-0 end-0 pe-3 flex items-center h-full">
                                        <img src="{{asset('/images/header/search.svg')}}" class="w-[24px] h-[24px]"
                                             alt="search">
                                    </button>
                                </div>
                            </form>
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
                        class="hidden absolute right-0 z-10 mt-4 w-[150px] origin-top-right p-0 bg-white dark:bg-[#1a202c] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded-2xl overflow-hidden"
                        id="dropdown">
                        <div role="none">
                            <a href="#"
                               class="flex justify-start p-3 transition duration-500 dark:hover:bg-[#2b3548] hover:bg-gray-300 group"
                               role="menuitem" tabindex="-1" id="menu-item-0" onclick="lightMode()">
                                <img src="{{asset('/images/header/light.svg')}}" class="w-[24px] h-[24px]" alt="light">
                                <span class="ms-3 dark:text-white text-cyan-500 group-hover:text-cyan-500 duration-500">Light </span>
                            </a>
                            <a href="#"
                               class="flex justify-start p-3 transition duration-500 dark:hover:bg-[#2b3548] hover:bg-gray-300 group"
                               role="menuitem" tabindex="-1" id="menu-item-1" onclick="darkMode()">
                                <img src="{{asset('/images/header/dark.svg')}}" class="w-[24px] h-[24px]" alt="dark">
                                <span class="ms-3 dark:text-white text-cyan-500 group-hover:text-cyan-500 duration-500">Dark </span>
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
                            class="hidden absolute right-0 z-10 mt-4 w-[150px] origin-top-right p-0 bg-white dark:bg-[#1a202c] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded-md overflow-hidden"
                            id="user-dropdown">
                            <div role="none">
                                <a href="{{route('user.panel.profile')}}"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 dark:text-white  dark:hover:text-cyan-400 hover:bg-gray-300 dark:hover:bg-[#2b3548]">
                                    Profile Settings
                                </a>
                                <a href="{{route('user.panel.my.post')}}"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500  dark:text-white dark:hover:text-cyan-400 hover:bg-gray-300 dark:hover:bg-[#2b3548]">
                                    My Blogs
                                </a>
                                <a href="javascript:void(0)" @click="logout"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 dark:text-white  dark:hover:text-cyan-400 hover:bg-gray-300 dark:hover:bg-[#2b3548]"
                                   v-if="!logoutLoading">
                                    Logout
                                </a>
                                <a href="javascript:void(0)"
                                   class="flex justify-start p-3 transition duration-500 text-cyan-500 bg-gray-300"
                                   v-if="logoutLoading">
                                    <svg class="h-5 mx-auto w-5 animate-spin text-white"
                                         xmlns="http://www.w3.org/2000/svg"
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
    <div class="fixed top-0 right-0 h-screen w-full p-5 bg-white dark:bg-[#1a202c] duration-500 block md:hidden"
         :class="{'left-0 z-[9999]': menuShow, 'left-[-100%] -z-[10]': !menuShow}">
        <div class="flex items-center justify-between">
            <div class="w-auto sm:w-1/2 text-3xl font-bold">
                <a href="{{route('user.panel.home')}}"
                   class="decoration-0 text-gray-600 inline-flex items-center justify-between relative">
                    <img src="{{asset('/images/logo-dark.png')}}"
                         alt="logo-dark">
                    <span class="text-[12px] sm:text-[24px] font-extrabold text-slate-500 ms-2">DailyDevBLog</span>
                </a>
            </div>
            <a href="javascript:void(0)" class="inline-block md:hidden sm:px-2" @click="toggleMenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                          fill="#000000" class="fill-black dark:fill-gray-400"/>
                </svg>
            </a>
        </div>
        <ul class="mt-[60px]">
            <li>
                <a href="{{route('user.panel.home')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Home</a>
            </li>
            <li>
                <a href="{{route('user.panel.post')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Blogs</a>
            </li>
            <li>
                <a href="{{route('user.panel.categories')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Categories</a>
            </li>
            <li>
                <a href="{{route('user.panel.profile')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Profile
                    Settings</a>
            </li>
        </ul>
    </div>
</header>--}}
<header
    class="sticky top-0 left-0 w-full z-[9999]"
    id="header">
    <div class="fixed-container">
        <div
            class="bg-white dark:bg-[#222222] text-secondary dark:text-white shadow !p-[5px] rounded-[100px] flex items-center justify-between">
            <a href="{{route('user.panel.home')}}" class="hidden md:block">
                <img src="{{asset('/images/logo.svg')}}" alt="logo">
            </a>
            <ul class="items-center center hidden md:flex">
                <li>
                    <a href="{{route('user.panel.home')}}"
                       class="text-second hover:text-second dark:text-second dark:hover:text-second duration-500 text-[13px] leading-[19.5px] block">Featured</a>
                </li>
                <li>
                    <a href="{{route('user.panel.home')}}"
                       class="dark:text-white hover:text-second dark:hover:text-second duration-500 text-[13px] mx-8 block">Latest</a>
                </li>
                <li>
                    <a href="{{route('user.panel.home')}}"
                       class="dark:text-white hover:text-second dark:hover:text-second duration-500 text-[13px] block">Most
                        Viewed</a>
                </li>
            </ul>
            <a href="javascript:void(0)" class="inline-block md:hidden sm:px-2" @click="toggleMenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="35px" height="35px" viewBox="0 0 24 24" fill="none">
                    <g id="Menu / Hamburger_MD">
                        <path id="Vector" d="M5 17H19M5 12H19M5 7H19" stroke="currentColor"
                              class="stroke-black dark:stroke-gray-400" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </g>
                </svg>
            </a>
            <div class="flex items-center">
                <div class="relative inline-block text-left" id="search-dropdown-menu">
                    <div id="searchBtn" class="flex">
                        <button type="button" class="outline-0 border-0" @click="searchDropdown">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect x="30" y="30" width="30" height="30" rx="15" transform="rotate(180 30 30)"
                                      fill="#556080"/>
                                <path
                                    d="M26 15C26 20.5228 21.5228 25 16 25C10.4772 25 6 20.5228 6 15C6 9.47715 10.4772 5 16 5C21.5228 5 26 9.47715 26 15Z"
                                    fill="url(#pattern0_8_81)"/>
                                <defs>
                                    <pattern id="pattern0_8_81" patternContentUnits="objectBoundingBox" width="1"
                                             height="1">
                                        <use xlink:href="#image0_8_81" transform="scale(0.0078125)"/>
                                    </pattern>
                                    <image id="image0_8_81" width="128" height="128"
                                           xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAutQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CUv0wAAAAPl0Uk5TAAIkSGySqrrFz9HKu7JxUCU0cu7/67N4Ky+K4tqJKQZh08BXBQtw491eA1jk10wtv6saAfn8hmJTRDk2VWax/vAU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"/>
                                </defs>
                            </svg>
                        </button>
                    </div>
                    <div
                        class="hidden absolute -right-[130px] sm:right-0 z-10 mt-5 w-[340px] sm:w-[340px] p-0 bg-white rounded-[100px] overflow-hidden"
                        id="search-dropdown">
                        <form @submit.prevent="searchData" class="p-0 border-0 shadow-none">
                            <input type="text" placeholder="Type to search article..."
                                   class="py-3 px-5 outline-0 text-[13px] w-full bg-[#ffffff] dark:bg-[#222222] placeholder-[#C0C0C0]"
                                   v-model="formData.keyword">
                        </form>
                    </div>
                </div>
                <a href="javascript:void(0)" class="mx-[5px] hidden dark:block" onclick="lightMode()">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect x="30" y="30" width="30" height="30" rx="15" transform="rotate(180 30 30)"
                              fill="#556080"/>
                        <path
                            d="M25 15C25 20.5228 20.5228 25 15 25C9.47715 25 5 20.5228 5 15C5 9.47715 9.47715 5 15 5C20.5228 5 25 9.47715 25 15Z"
                            fill="url(#pattern0_8_76)"/>
                        <defs>
                            <pattern id="pattern0_8_76" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_8_76" transform="scale(0.0078125)"/>
                            </pattern>
                            <image id="image0_8_76" width="128" height="128"
                                   xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAADOwAAAzsBi8SqNgAAAkxQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////jdOBtwAAAMR0Uk5TAAMjSnGYsL3K2OXz/PDi1MW3qZqMfm9hUy4rbKvV+f/+EGeo6T4UggcG+tEqDnnqtAwTg++PAhWN9PvuRDLJ9TgPk/1J4F0Bc3QSszYdXIfmTGi/O0H4tibxCNCtV8Yk8sgRT5/sBT2lblLNSMfDWK45atLCVZbf1+0Zdj+dZcTrBDVDRWAze4kiz1ndhJkpDejOCrnWQmmV3LoxIXqjR6f3ZBcviHUnqp4fFihafaAagec0pAsJViBehZFQwH9iLK9rOmfEvpwAAAWKSURBVHicxZt7bNNVFMd/h4yIuKiLKYy1JA3MqTBCGEgNBh2wMOjYIASSZqYgYYRssAmrm3NzmW7TSaJBRQU1PCYqCuJjKmaIjqDRgEFUEBWnKEEprIypm4mOUdlLfm1/j3POPY3fv9re37nnk7S999xzzwGNKTDTGeI8HOcpfZ4Mp/vz2pNxBhjiBug2Gzzn+oE6Hw0grev8SPPR8NXwHdU/BeCWC+2pXRbjiXCM7J4AMAGgw/KBJDjC8I8FyABos35iBBzi+McBeAB+s37CGfyJ5R4FMDU06rTNI45hnzD9IwCmwy92j7hhP9e/LcAMgFa7OZzD97H92wFkDj1hP0XaXr5/a4BsOGX1xx/QuPcV/FsCeFErS1dIxb8VwLwDSYgJgpnNcQLI6v4ZYd+e+Y6Sf3OAvFbE169pE5vU/JsCJLjCGPMeuyWKCzD/S5T1pFNfxAfAMRxnnfGmqn9jgIWHccZTdiv7NwRIHm+7+vbr1tfjArAYDuJsb3tN3b8BgA8+RZqO/jgeAPmA3dqnvyTgPxZgaArWtNsmSuIB+A9gLe98UcJ/NMBSaMFaTn4jDgBTx3+ENQxnbYkDwJgetKHMTzAKwJOA31uyNscBoOADtN1seF4eYGUzagvu09xNMv71ANmnO/F23o3yAEXvEewmvCsPsIowp+fot+IAqynRZd4GIf86gJK3CWYjPhcHuPEfitmCJ8UB1pDCu4XrpQG8x0jpqsxGaYBSWnw5Br1pYgGWobfBXl1zXMr/IIDvM5LVpLekASbTztiJ30gDBGgRfvBvYQDPWfw+2KvFjwkDlO2kWYl/BeXEM45vnTBAxQ6aVX6DLEDly0Qr6XVgOTnReNcjogBV5BDbXy8KUE0+ZS2tFQWo2UY1U8xORgM8uJVqlk4JYG0BvPRlxZFbIwhQyzhlFVQLAtS/QLcbS4ofbACSr6LbXfhDEOBhzjlzZaUcQOEehuGw7+UAGjgn3UWPywE8yjrpFt33PwP8elEMgPUVaKs+VLur0QGwfoSXj9NlUgCsv6GmFW+WyBFwF6JeiaRpuEtxr5btPioDwNmM+lQSkAFgbMf9ct+uHhoyA5IB3VMqA0APyQZ0vm6tCAA9KB1Ux0NrJADoYfl/Sm/j1a5EAtAPJldUWCEAQD6a6XWTSv0E93Cql+fcfnUA6vE8QqX7VEoIeAmKSAWgWBWAmqKJUtlz/E2Bl6SKVvkhduaUl6aLUf7oIjUAYqIyVk5/oRIAMVVrpPvPss6rzGS1kYKzOLElM11vqMq2B/gAxAsLE1XBCjYA7crGdLo5UwqYALRLK3OFR/aQaouY13ZWmpb1F3Jpzm5mX1xay7W8cpRtjS9sgdZ6/tWtnWrXl4LffDjbDyscZas1/uU1QqmHn2161WhgR0dSQ8fl8eNnIgFI1/dIucbmfB388cQT2076rnOGhzxdDNCyZ6A2fkmdFgVAKWBQl3vtghgASgmHsp6ar8UAUIpYVLWh5ogBAKGMR1V1SzQDAEohk5rSLzYbAhBKuZTkaxssg1IoZlOQx587+FKhnE9Bujo0hYJGvp6Zd+W1SkknV5c25VgC4ItaeQo1LtK9UyrrZSnFtUv/Vq2wmaFQSmQzllppN10zOqMOgYrF7VRNS46u/1Et76fJkRwT9qk2OJDkqsiN+Uy5xYOgSz0GlcjqTS5odW73Gnwq0OaDU/vOuYafCzQ6oZSXM8d4QKLVy14wMcMseSDS7GanxHG7TMdk2v0slXZvtUU+Wajh0Vyzt6ZadsKKtXway10VsEkhyjW9Gih/ZovtnY5g22+UwnfcXYy4WJRsfNbr95nX4/oPyLkxy9bvfoWaoBGdumUl58yb352+wF4op9zisLOD+o7/m2fdcLBk+1frEmDjK9R5/gUAwF2Q/LxTtQAAAABJRU5ErkJggg=="/>
                        </defs>
                    </svg>
                </a>
                <a href="javascript:void(0)" class="mx-[5px] block dark:hidden" onclick="darkMode()">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect x="30" y="30" width="30" height="30" rx="15" transform="rotate(180 30 30)"
                              fill="#556080"/>
                        <path
                            d="M25 15C25 20.5228 20.5228 25 15 25C9.47715 25 5 20.5228 5 15C5 9.47715 9.47715 5 15 5C20.5228 5 25 9.47715 25 15Z"
                            fill="url(#pattern0_17_40)"/>
                        <defs>
                            <pattern id="pattern0_17_40" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_17_40" transform="scale(0.0078125)"/>
                            </pattern>
                            <image id="image0_17_40" width="128" height="128"
                                   xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAADsQAAA7EB9YPtSQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAABWqSURBVHic7Z15mBxVtcB/p6rXzBKyAFEI6IcQhA9JZhJAxI8AyeTBIyQsGcgEUVSWh4IBIijhyaiAC/tjS9APFMnihBcSokgWH0Ef+0yCCwjxPZ8QkLAkyKy9VNV5f/QEMtPV1V09vRRkft+XL/PVvXXv6b6nq+4999xzYJhhhhlmmGGGGWaYYYbZvZBqC1ANdOW0WYTjizAiewHgpN4i3XehnLZhdZVFqzi7nQLoqhnnEq67Fxn00VUh3fVlmb32vupIVh2MagtQcczoDVmDDyCSKdvN2P0UwAiPLqrsI8rupwBi5H7teZV9RNn9FGCYAQwrwG5OqNoC7ETbptYSid6JGZ0BhHCsF1DrbJm9bmu1ZRsKurZpL5Lh+xBzMgpociNJ+3xp3vBetWWDgCwDdcnx+1Nf+0fMaP2AAjudxO49sJRKoL88SkEzyz61MxfFzKwCEOTMp0v2neiS4/dnZP3LGOHogAI72UNf7yHSvOHVUvVVLMF4BdTFV2cNPoAZjmKGN5S0LycNjvXB4EPmb8fKlJWS+vi6rMEHMKM1xKIPl7az4qi6AmjbnAhm/PCcFcz4QfrQ9C9UUKSSoA9N/wJm/KCcFczYZ1Sr/wSuugIQT4RcDTPvIxCO36EaAFkLRBWDcPwOzzesGMKKOVX/TFUXQGau6cVOdXtWMqL1rG66tUIiDZ3VTTdiuLzSdsVJdUrzCtuzTgWougIAYCduy12WhK7XILH937Rt0p4VlKoodE3jCBLbz6Dv7cy8IhdW4vbKSZWbQCiAzF57NVZy+4CLtgXdr0H36+CkQAlhmyuqJGLhdHElynhSXdC1FRLbwXEG1rETO2T22qurI+BAAqEAADiJc1HN/J3YDj1bwU4NqqTH6tLDj6m4bAWiy6aMR1iwyxVIvgfdr0Kq84PL6b7zKi+dO4FRAJm9bg3Jf26i85XMl7ZTGQZjhJdUVjI/ODcCI7IuqwN970DPNkh2PiWnbVhZedncCYwCAND91hmonWPk+1HdT5dPurhCEhWMLptyNDDHs5LV+y5975xSGYkKI1AKIOf88f9A/jNvRTV+pG1zIhUQqSC0FQP0NvJZVkW+Iy0d71RGqsIIlAIAYH5yHpDIUyuO9befVEKcgpjQ8BXQyZ51lBd5TxdXSKKCCZwCSPOKFEr+GbJwti6bMr6ILrxsDt72CBd09efqQL6Xv6JeJhd0lNjWPHQCpwAA0tJxE7AtTzUDNP/rYjDKE0WV5aIvcQ0wLk+t1TJv01rfbVeAQCpABpmL93QQ0Cm6/MgmX82qLgT6XEr6+ssKb2p54wEoX89TLYWYV/hpt5IEVgFkbvtGDH0mb0XH8vVelXmbOlAaQFYCb2b+yUqUBpm3qcOXkMr3gezdvgEd6q1y1rNbfLVbQQLjEOKKET0dK/kqIrkV1WB/v81KS8dLwOlDEa2ff81Tvg0rfF0J+ikbgX0CAEjzU6+D8XPPSlXaUu3fyvX+9SML5exnOr3rVJchK4A+NjWkra3lU6Qt7ecj9HrUyDdZLAsiKLA+dwU6eLn9Z+XqX1unhvSxqbGhtlP0wOmS4/fXh09up29siiNesHXNrE5dNePaoQo0GGnFwtILcgsil5W6z4JxtBV3m0UfcL604riUDQldNeNaXTO7iyPGpukd06erT96kq5qKWQ4DRfoE6vppI0nEX8eM1WQV2ol3cfq+KrNKa+/WZQ3nodyCyM4+ezBYIGd2LCplP77lWtp4DCK37GII+i9wrpS5m9tL2s9DTScSiv4cM5a9JW4nOzHfHC8n+X/dFKcAK5tWEBt5hmelVNfTvLfjZPnis9s96/ntu21OhOhfRsmsP79ZynaHirYdWguH9JXayUN/1ngAI0cvJ7qHt6Ux1X2fzP7Nl/22X5wCrJm5DTO2t2elnm1g9e5A5Br2rl0kx2308I4YZjD62NQYb3beh8qZiCnU51ns2Ik3ZOaaj/vtp7g5gIi3iSbVBVYvwGhUb+eNrj/rksknFdXXbogubfgmb3a9i8pZgKB2ZjvZ+66ilvTF2QFsuwMjxxrYcSCxY+A1YQKiv9ZlDQ9jcrk0b/qfovotEl085mDUmQocDnKQ49ifsixrjGVZccuyxHEcRMQWkS7DMN4QkT+IIUtGzE8+0j/br4ycKyadgGXcD3w8q9dUJ0RGghl2v9lx/lRMn8W9Ah45cU+c2KsYoexlSOIdSHrORVKI3ooVvq6ca2S9Z4+JKOeg0gzs41XXcRxSqRSpVArb/uAVbhhim0boTyJyY+2CVNkcUbRtyjgc50EcPuc5ImYEavfNvu6kEqj9KZn5q9f99l20EUVXNY3HDG/I+L73N+NYGT+4wn4020AW8nL7z0q1XFJFWDzqZOAq4Khi2rAsi0QiQTo9cOPOMIyeUDh0e82+qaulmZJM9LQNE3vyYtQ519PauSu1Hwdz5+9OId23BU1PK/b01JCtaPrQ9LMJxe/EjNbT+zaku/xK0IGtF/i2ww+W4+4xRyB6Z959+QKxLIve3t4BTwQAwzR6w6Y5v+by9JD8EXR5wzyQe1AXFzIvjDDUjQc71Y2duGSoEU1KYkZVxWB10430bT8DKMYokUCd46Vl81O++7553zg1PT9GuYgymLaTiSS9fdmGyFAo/KKQPq7um7zlt01ddsRXwP5pUQKJWMRG382sdfNFhv7kLMkXJoIjs9ddRi0Ho3wP9+1WL2KI4fvgh941dgI1PU/3b8mWxRwdjUWpr6/HMAY2b1npQ2zHeLXn5uhM/63aNxcljMrvqNGPyex1l5Ri8KFMp4O17fB9sM0fgJztow9lXF2kUHuBLh5zJOr8GhhTtKA+UFW6u7uxrIHiiYiGI+Grai9L/bCgdn566GhqYn6NY//AkGY5s92/w0oeyvKrkeY/vC5zN50DeiywqeAb3367oM0NvWfUiajzGBUafAARoba2lnB44DJMVSWVTP2g+6bIjwpqaFQszw7iAHpBvy5zO/Ypx+BDmbeDZe6m3/NyxxSU88g4X3jV7pDmF/L65Oldo4/CYQUQL42UhSMi1NTUEAplm09SqdQV3TdHvpW3jdM73gB6vGupg3I/L3eMlLmb7ixW3kIouz+AtOJIS8dPsUMHATcCg4/7ACQwmJ+vLb1r7AQM/Q2QvQlVIXY+CQbPCQDSqfT1XTdFCnA00Utzr5TlOczoftLS8UVppezm84o7U+iSiQci5jUIM4EI6DowWmVu+2bP++77RIzke08CkyojqTe2bdPV1YUOOsFkGEY6JPH9aq/o8fRT0F9OnouttwJ7YaAgf8exLpCW53P7GJSBqgcoKBRdNOoO4GvVlmNXEokEfX3ZC55QOPxS/YL0p6sgkm8C7RK2E100cjJwYbXlGEwsFiNkZs8HrHT64O6botVzVPFB4BUg43tn3g2Y1ZbFjfgI97moZaWv1TYCc3wtF4FXAO7eY2apzLvlIBQKZS0NARzHiXdvDd9YBZF8EXwFMOTb1RYhH7GYu/nCsuyvZg6OBpdAC6f37DGRInf1KkkoFMIMZb+h1HHi3XXhwASDcCPQCoByTrVFKJRI2P11r45+o8Ki+CLgCiDN1RahUCIRdwWwbXuCLiaHG0/1CawC6OIxB5PHkydIGIaBabi8BlSNni4zsIocWAXo9+H7UBEKu7tYqpilOIdYFoKrAJA7fGxAMU13U4Vj24H9LJ5ewbpqxrkY0Rsww6Ozsml0bfUbXLkb5QlUFxbo/jXBT+NBwG2DCEBVvc9Q7Ky3ZPIRGPp94GigtvCO+93EBjTmKHZqO6nEpXLG+gdy3ppTmFVNMwnX3UsoOsY9lYpvh5RahBkY8ntd2nhwAfU/6beDapPrCaCqebeutW3SIRj6ONCEn8EHXMdCDCEUG8uIkb/QVdNznsnI/Qowo/d4BnEu3ls+jkghZ+a9Y+0GEMnxfamq8Y/WPM6ftnE9UNxpX8+xEJBYTgdWj8AL/UkVczIUlzT9XAGVfP4Kqo94bK7GybsvcHTRHWuesQiFc8YwCvIk8COFxip3wsgPuRXASeVxdx6K7kgh/m2+Q7ZVG/UY45SZ17vnyaI7znemxErndE7JfaedPD9nvF4YiitJodG4ApFUyQ+DvYN2IiLOuG/m8QM0navIHyDTHc+xUNBEzv2InAogs9etId31ZazkdtRx+WS+nwDdKGtx9PP9QZry8Xe/HVQb23E/MSYiec9JSPPmF3HkWGAdvp9+LmOhjmIl3qH3vS/I7PWP5OzXX0eVQxeNupsAegF5kUwm6e3NPkVkhs2/jVxgH1AFkfIS3Emg8ny1RfCLbbk/AQzDDOxnCbACmBurLYJfLNt9nie2/VCFRSmYwCqAXPTOy8Br1ZajUBzHyTpJDJkJYE2P3VYFkQoisAqQQQP7xQ0mlXI77wKmYf5FWl0PwwSCYCuAwS+qLUKhpNLuYyyG3FFhUXwR2FXATnTRqCeBz1ZbDi+stEVXd3ZgDMMw+kZe4dRUMs6QX4L9BABQrq+2CPlIJN3tN2bI/EmQBx8+DApw4bu/Bn222mLkwrKsrHhCkPn119amF7jcEigCrwAiKI5eBKUJzFRq3Aw/AKZpXikXELgUMYMJvAIAyEXvdaBS1nPyxZBIJFyXfqFQ6C91C9KBSA2bj4onjNAlEw/EML+LcjJCFFiHo6153cTSO64gMuoYoKEigubBtm3Xk8GGYaSMcPQ48mz+6bJJk8G4BmhCSSKswbFbZd7zfy2TyK5UbBWgDxxZj2n9O3AJ2c4RSZRp0tLx355tLKo/EMyngdHlkrMQVJXOzk6cQTmBRUQj0fBpNZemVnnev6zh8yDryU44kQL+Azv0/Uolmij7K0BbMXRp41cxrS3AAtw9Y6KZkOveyIWdf0WMk8gbYqV87AwWNXjwAcKRyJX5Bj+D3Ip7tpEIsADT2qJLGytyrrCsT4B+Tb+Vwh7bipmoLyhO0KLR/9KfMs5fkMUhoijdXdmRwgAi4cgPaxek8h5k1SWHjcKI7MhXr59NoPNl7qbf+5W1UMqiYdp2+D66rOF+kMfx887ec8+CHCLkwh2PosZxQMXSsKrjPviZx370ikIGH4CU6ccu0ADyuC6bvFzbGvfzcV/BlPQJoGsaR9DNxcDV+HbqlN/K3PZpvvrLzAl+SZnjBtm27frYNwwjGQ6Fz6i5PPkrP+3psoZnQab4FKMP5Qbq+JHM7PDKoeSLkjwBVDF0VdPNdPMS8EP8e/T2gZ03xNpg5MLOvxIdeTTIbZTJTpBIJOjsyp7whcKhFwzT2dfv4AOg+g38u3/FEb5DDy/pqqabVUsU5XWoDZQkWDScL2d1FB5Q0k2OxSMbUONOShRPIGewaMPoDYfMi2suT987lPZ1eWMDcA9Ko68bI3UQ37P6waK1remTxMOPBilcPIAuGnUSykKkOD/7nOHiTaMnZIburhmf+lbJwsW3YjBh8pdAryN//mEQyRwBk53mGwW7bwt2hcPF68qmvYjGX0EiLgkjtkPS06G3Mgkj7hr1GUTPQWQO4DmBypMw4g8SkptrLy1jwogHjqwnlF6Iyny8DpBER0LMJTquYyWw7U/IrId9J9IqTgFWnbiWSK170mbHgZ6t4Oohq9VJGbOo/kA0NBXRiSATHMc+wLLSY620PcKy+1PGGGKJSJchxjYR2SwqS0Zcnny0oilj2ho+hc1NIKdkFYoJdftm/nfD6lknpzwyw2+fRWYNm7UdM5LbGpfuht4B50peQOVSaWmvaBTMDyu6dPJ0RG8BDn3/4oi9IewRIddKvCWnrCnoFPKuFDmTVG/FCddCaATADkQuZlzdxOHBLxxpaV/PuLqJiFwM7CAU9x58IP8BQXeKUwDHyp8VM1zzNCnzIDmr/Y5S5gzU+ybuofd/pmrBonOhaxpLapWU4zZaclb7HaTMgwjXPZP3Bie1sah+irlJN5ywN4m6VzDC2fZsO7EDq/crcupvC7CJ++hz2eSpoHcBnwZskPWoLJCW514oZT/+5Wo8EuQW0KPILH9+i6PfHmoOpKx+Hm46GaL3EYqNzSq0Ut0kevaV5g2+j9MVvwx8cPqBhMNLCMUbEcPATnZiJ2+X2WuvLrbNnH0taWjEkCfI3kDpRPXz0rLpj6XusyC5lk86HDWeIjt3QR/CMUO1bbj2uWrGtZixSzAjdeAoVt/zpPUUOf03RbnQB98ptBWDgxufzWkwUd0gLZumV1isTNfLGlcCp7oWCh281HFEOTKIl5LgewRNmPwlT2uZyHHaNqdagaSPyVmiNGaMPMEm0AqgDxxZ328l86hELy+uqJbnbR7F0+synyG4VNwlzBcZ61g+E+nDfh+zunTKoYhzHR+EZXkSNRYWMaF8FGjxKB9HKL0QuNJnuxUjsHMAXd54AMoLuHvO7CSFmIfJWc9uKbjdTCi2x8kOyJTAkWNlXnvBLujlkrGSBPgVILfg/cWCym2+v1hDr8U9Glesv6xg5KyO/wXyef9GUOsGP+1WkkAqgC6bdAKq+TJyvkUoz/zAHa9jZv6PoI2IfQ94w7uSnKJLGnzb6StB4BRAH5saQoy8DqIgV0lzRzFxhLycVXyHppNZT3ShfCdvRUNu0cWNgYsaHjgFYFvXRSiH5am1mZfbh+QIUVK2dNwL+lyeWp+mLnghbwKlANr22dFQyK/JmR8kA0tGFnM++TxhhO/q0sZsU24VCZQCEN3jEUJx73zAqsvlzM2/q5BEBSNzn3sSxDugRWjEKEbsuaZCIhVEYBQgE5y69khqPgY143ZxexpAH6q+nUcrhm0uwO3QihgQH5v5XJG6o3TltNMqL5w7gVEAjNgH7/TQiIz3S3QkA00V8mOZt/mVistWIHL2M6+B7JIqTjKfoXY/iOxiEAzHcwZvrjSBUAB9qOl6QtGBj34xMv5v9eMznrDCVmr1x1USsXAyMm4lUpdx4IyNgcF5BMzYaF01w5fNoVwEQgEIxS/OWSahjBt0bMyDpTwQUS5kZkcv8TEPEt8TDA9Luxm7pHJS5SYYCmBGvNffTrKTWesCH23jfWatW4Cd8j4gYUbq9LGpxeUHKCHBUAC1PZZPCum+r4sEZ9mXDxEcrN6vea8KHWXqxqqHjwuGAljJ3O5Tdt8WOXX9hyZc3E7k1PW/wO7LvU+R7t0cBKUOhgKkUy046WTWdTvdh532dWA0L0Y4827e1b9ezMw1o8SWWjs9Ddvlc1mpf2KY2b7/VSAw28G64YS96Y7cjxlqANLYqd8R+ef5clJpTw/pI3O8M+yctKLEJ6ZP3ge1H0DCh6GaRlOPkEx+Q5o3BiIhRmAUoFJUWgGCTjBeAcNUjWEF2M3Z/RTANf1NAWUfUXY/BbBT24sq+4iy+ylAKnGpu4FG+8t2L3arGe9OdNX0k5DYT97PqGmlt6GJ87yyaw0zzDDDDDPMMMMMM8www3w0+H+hOdDFtrFraQAAAABJRU5ErkJggg=="/>
                        </defs>
                    </svg>
                </a>

                @if( \Illuminate\Support\Facades\Auth::user() )

                    <div class="relative inline-block text-left" id="user-menu">
                        <div id="userToggle">
                            <a href="javascript:void(0)" @click="userDropdown">
                                <template v-if="profileData?.avatar === null">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                         xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <circle cx="15" cy="15" r="15" fill="url(#pattern0_8_53)"/>
                                        <defs>
                                            <pattern id="pattern0_8_53" patternContentUnits="objectBoundingBox" width="1"
                                                     height="1">
                                                <use xlink:href="#image0_8_53" transform="scale(0.0078125)"/>
                                            </pattern>
                                            <image id="image0_8_53" width="128" height="128"
                                                   xlink:href="data:image/png;base64,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"/>
                                        </defs>
                                    </svg>
                                </template>
                                <template v-if="profileData?.avatar !== null">
                                    <img :src="'/storage/media/'+profileData?.avatar"
                                         class="w-[30px] h-[30px] rounded-full"
                                         alt="profile-avtar" id="header_avatar">
                                </template>
                            </a>
                            <div
                                class="hidden absolute border-0 right-0 z-10 mt-4 w-[200px] shadow-lg bg-white dark:bg-[#222222] rounded-[15px] overflow-hidden"
                                id="user-dropdown">
                                <div role="none">
                                    <div class="flex justify-start items-center pt-[8px] pb-[8px] ps-[12px]">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" v-if="!profileData?.avatar">
                                            <circle cx="15" cy="15" r="15" fill="url(#pattern0_8_53)"/>
                                            <defs>
                                                <pattern id="pattern0_8_53" patternContentUnits="objectBoundingBox"
                                                         width="1" height="1">
                                                    <use xlink:href="#image0_8_53" transform="scale(0.0078125)"/>
                                                </pattern>
                                                <image id="image0_8_53" width="128" height="128"
                                                       xlink:href="data:image/png;base64,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"/>
                                            </defs>
                                        </svg>
                                        <img :src="'/storage/media/'+profileData?.avatar"
                                             class="w-[30px] h-[30px] rounded-full"
                                             alt="profile-avtar" v-if="profileData?.avatar !== null" id="header_avatar">
                                        <span class="ms-[8px]">
                                        <span
                                            class="block text-[#333333] font-[500] text-[15px] dark:text-[#ffffff] leading-[12px]">
                                            @{{ profileData?.name }}
                                        </span>
                                        <span
                                            class="block font-[400] text-[10px] text-[#55608080] dark:text-[#ECEBF780]"> @{{ profileData?.email }} </span>
                                    </span>
                                    </div>
                                    <div class="px-[3px] py-[3px]">
                                        <div class="bg-[#F4F4F6] dark:bg-[#333333] rounded-[12px] px-[9px] py-[10px]">
                                            <a href="{{route('user.panel.profile')}}"
                                               class="flex justify-start items-center decoration-0 w-full font-[500] text-[12px] text-[#000000] dark:text-[#ECEBF7] px-[10px] py-[7px] duration-300 hover:bg-white dark:hover:bg-[#222222] rounded-[12px] leading-[18px]">
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="dark:hidden">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_602)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_602"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_602" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_602" width="128" height="128"
                                                               xlink:href="data:image/png;base64,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"/>
                                                    </defs>
                                                </svg>
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="hidden dark:inline">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_635)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_635"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_635" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_635" width="128" height="128"
                                                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAADigAAA4oBp4z1HwAAAl5QTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////M7q5XgAAAMp0Uk5TABJVc42mwNnzHm2+/P8ReswIde4CX+I+0mv7BZgTvyTd5BCVUDIYBLvphTUBlPSBDGn+mTj1U8YwUc0X2OYaZ/c2C1tirrEnCvaXnwPrVi35DUi2eHtdREMqx7oZmzNNXDyKHdTcdIzFLEDLyvgJqqdKeb39TB/yUmR+qeXWTo6QQo/vsJJeZUEbsiUxuOC037dLiPBXopZG0BTJByneqGM6HOjIteEWL4AiziPEkfGT7dOhixXCfHG8Pc/j1fo3LuduBlmtIaWk24cLVqkAAAkhSURBVHicvZt5QBbVFsDvzTTNyEjMDH0F+oHVR4KWW0ksKmhfEiqKigqikKSgviTTZ0ZkmpXlkgWpoOK+K65pkPYsXyWZtrm12vKsrHy9fPnshsuce2e+mblnvpnp/HXufIe5v4/vnjPnnnuGkgCFXhbCLkug9wnorxpcnFqUCwi//UUA11J6XveDOoz94j5AMKW/G35Yj7HT7gKEUGr+j27A2PcuAjSlv0ptGrLvXANoRs8grILYN+4AhNKfkZaN2EkXAFpQ/PoKZl86DnAz/UHnKmtCTundojH73GGA8JP1NFdCrqgNRj9+T0Kur41Bf2iX/u+hJxwFiKTqX7V57eSHhbG3FuIrlUUo+8RJgKjPxFEYpe/5mUQz9qk4vuWQgwAxx4SBh545omsVEcSOCsNWNY4B3Pm14P+t6b8MDduzj/kg6KZ3nALo8CHXG4S/ZWLZ8YQQqW/b7xBAJ2G5RdF/mtrezYSf3vumIwCRTQ6CHk33SKxjGV+fbU7JPQEBcO8BUNvRKql5PHsX9LavOwCQcI5/pfa7peaEJPJFGl33NfsAXflS6vgqYn5CuvFl2mGXfYDusJKConagAJIOgdd22mkbIJm+oahdtqLmJ6TnXkW7h223C9AK8puws/oB0F8i6kNQbnrMzBADcB/43dlzyPkJqVtf0WK32ATw0WpFjd+EBugF3hrHKu0BpIAfJdL1aIBUBv6asNEeQG/wvO5r0fMT0gdWf7d19gB4FEhaYwGgLzisLBLIANLAjXqssgDQb5uiJa+2B9Dy34rWc6UFgHRY/DcctwfAw6pvuQWAAbD2ZeFbBjBwM1ha2fleC+WC+5fZAxgEzp9SYQEgA5yv11J7AIM3KFrqYgsAQyBmPLDEHgD3gt6LLAAMBe+36wWZEH4Q2Q0XnkX1KbcHkAXhJ22hBYBh8L37ltkDyIbw03++BYDhEDT6LbAH4DsA2c312A1v7Vb6R0ULamvzaUhGrFC0AaVogBwIWumvSEylALkQSAa9jAZ4EJx/YIldgJE8/gyeh5w/j/t+xkt2AchDEICGVh82MwTxxkHIGPKizFgO0Ow/oCKTMp6QkWukBTM5AB1VrqjpDWYj5s//DdZt5lxpDRuxNyzgESj7BQTAGO75w2ZJrREAY4UINGKm1Hyc4HjDn3cCwJvEA0AufUZiPZ5xx8vZIV+1mAJFIeX+F9ZzuqnthK28UpXHZshvjirRPDqX657kp0wsJ24XylSjpiHujauS9RE3uflvGm36EzqJXoLbSOAAYj8QDykKzh/Se8L4ouqIi77e7bJqjgUAIS+5KGPoE34mjzG1j8oyEWsAZIrG/xpn0mW8AhU5kC7U1LLHFeFujK6WN/pDe6WQ0pq2B0mbAzHMf7lfgT1bwJ8XTJuKt2WTHsWaWjgxmfBrOdIys6F5sAgQgEw/jUsI8oIn4G9qBeBpWoyym8wecQPgmffPYMqUFyQx6I7xTgM8e/p/suxOlNyrgh92EiDL+7iF2S/J44clWxI8QOoX2AKhWiL+hihrIQD6d5gS0PyEFO2XV1WkANE3fXvU6DMWcz6NrK5TY3gTz41f+59uWQOYXn+yztXE+O9Yszkdfrr0UPRdt3/0N7RplZ6TFJ+VxARzAG9umf/Xn3bMs0vvx03terSVfwT2ZJWY5mWmAKGT/CJKQSgtNj6ZDp3MTvolwk9PNTvKNgNISPmH5sqzO47I0kxvRJI2Ajy50eTcxASglI5TXyh66zVMd0RIQkeN28xkOQEAFO47qBrX+6lkOGL6CzI/9zp1n0mbzob5sSHAgk9VP2a78GrkcfhFCY878a44LgjLtgjQoqhAHNbJQaT4KiksVfX6zJpi0NJgABDpU5VDZtdgdqVqyY/JF4c5lfqHmAYAU8WUxtNSUuszkLTjYhCZMMkCQPloYXCuuezgyUhafVVXGM3JRAMsWi9E1eIqyaGLiaTEC4E8MXUoEmAxzeODl/5r7MNyKb16JB/MY0NwAEsf5HoJHWBjfkKWs1w+eHkQCuAxoaoQNjHd1vyErHhK6CwZ67+j8wcIfo5HAM+Vxu0aWGn/f+4Ls/7u1wzlD7BSCLijzWoBWJk4h+vz+0sBVs3jMXTYblxh0Fy8ibzK1S6vnwxgBt98LFwgO/rGSXL2MNAnF0oAhJJYYkZfR+YnZE0FjyvawpkWYG0mqIt6OzQ/Iet4CCrvYwoglKYXn7ITgdRS2oSHIE35WgOwYTCostMmS8LPvsiSB0wAkn2Q1ha848wKvHzjOyG9mVapurEaQOiYQRX58CKUGtXn6WqAUVDoH1MjOeuxKL4YqKENnSt+oALwfAuqtPnEqvBmGHKjmKeoAHgeVFGI64fES+SMDEVV5UYqgE3wuFx2v8PzE7J5oKIt7WUAQGPgf4NpxLMovCnQUyOco4gAPBGQN0BZF6ElS0wLRIBKSH78HhlOCH/MLffpA7wCe0F5E1wAwoPMzBG6AAkfK8fEufH3uQCwpUqpswW15ttlAaA/NMut7OnC/IRshXRI6MgRALZBsiL+Rg4KX2OreugB8O7p1cmuAGxPUzSh61oAKIPN5PSHXAF4EepVs7P0AHZABra2uysAOyEZWpOkB/AqpGBlTiWDalkD33tdNz2AXamKlmW9GoCRfCger++qBxCnbAgK9WqTTkixUmZpV60DkPC2om1IdAlgN6SDd0Ek4gCFkK2GCj36jkprqFiOhJITB+D9Z1H7XALoDO7PO+M4QMhZRd94AlsQtCbzw1Mua6w+VDyFRRgGFzfFuwJQBZlQCK8ZCAC8+aeR+oUZp6Q5nKYKLUkCAN/HeyJWEOcl/QhkfELdQQCo5olo0fPoV7XQ0mIsL2FvjtMDILfwA/DKbMf3BQv4M77xZ/y6CLBHzIPyD2VoixmBy6qKKDG6b4nVB9g7WN0DUCHrmMHK+AzVsPGSLvoA5I0e5K+QbfcIAxWAt8SdVEgt23PF0pd6d5zwofydUrvS8DbVCZKmQrLveB5xV+a17Kwaa4tU2R/h3tILVKJu1TS5+tUJ8we4kxBekp3LtcmWTrG6d6ZOUdsRWVru/7qFXrk+JDpzpuGBdcDiGVf+ns6xo8GZUURWfOzeUU5lRq3ndtlTVabfhPAnXiBqnySjLUYAAAAASUVORK5CYII="/>
                                                    </defs>
                                                </svg>

                                                <span class="ms-[10px]">
                                                Profile
                                            </span>
                                            </a>
                                            <a href="javascript:void(0)"
                                               class="flex justify-start items-center decoration-0 w-full font-[500] text-[12px] text-[#000000] dark:text-[#ECEBF7] px-[10px] py-[7px] duration-300 hover:bg-white dark:hover:bg-[#222222] rounded-[12px] leading-[18px]">
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="dark:hidden">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_599)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_599"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_599" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_599" width="128" height="128"
                                                               xlink:href="data:image/png;base64,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"/>
                                                    </defs>
                                                </svg>
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="hidden dark:inline">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_632)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_632"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_632" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_632" width="128" height="128"
                                                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAADsQAAA7EB9YPtSQAAAe9QTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////HabMXAAAAKV0Uk5TAAYqRE9VATyNz/v/zjsJbNzbawhX5OMRr60QJ94lLurpI+fmIdLu0bWq79CV9JA9Az6SOP2bGZw0xPdcXvjBP0VGqG2mDva+9Q3+NkuOx8mMu3d6uOA68Rwe8PwFf+Lyru1YnVqsvH3hL/puMI+jeRUTLSw3VNkPeKQycIi0VoUdH9/dfItOOcDCDKelR8NgGhufM5ORQLbNB+Xo2lNSamnMikNC3cOO+gAABI1JREFUeJztm3lIFUEcx2dMk5KEsouOV1ZQStGr6GWgiZZKmWhYZmVIKUmYJa9DK6SDtKy8wgjKouiGsoPuLLMDsouSUIrIDq2ki4osK3v52N3X23Vn9jk701Oa7z9zvMd8P7uzO7sz+xsInCzIAThAqwaAVuk0sFhFAtCehrvI4PLLreFHywA8IfxJxVxS0/G8bwFAV1hP1d4qj4+qh6QG0AN+oW5vlSd85RBAb/iRiT8Abp1eOgBggO8Y+QPQ7fcLTQBvWMfMH4Ce8IkGgGcP+37qTWEcaHR7blfs/0ZxMyjbH1ptyw5ocr+v094qI2y0PLWVBt/DAoyCVVLWF96i4C7IBB9KWR/XmziAsRViZji8Qc3eKn8oHfmoqxiAwDtixmK6QtUfgKByyWrQAzRAcLmYcf9A2R+A8dKpH1uCBAiRzrv/eer+AIy7K6QB8CwKwNVdSAPr7jIACLeUCZmgUyiAiMtCOv4kA38AIsVzH3IcBTDlgpCGFTMBiD4npBOPoACmnRHSISx6AICY00LauQYFMF3snIhDTABmiD0beQAFMEvsnHrcSxy5YEchjdqPAvAQ069M/NXbdwAgDsKj6Eanwou1bAHaD2j+GiNTzDdHLxkygLmHtdo1VGn9QxdAgubxTdZEZAwgu63oAyQe1Gp35g6mAEaT/W2ropgSjatUJwCI84B70Y1O9jznqD8pAD1xAA7AATgAB+AApADza5QLO46p2ihfiyAF6BK7h8i/aZLrvZUCwILfpP4AxJ+SLcuRAaTsIvYHoPG7foCFO3UAJGzRD7CoSAeAfKJPBpB6jHzpttuUPP0AwLzNhdAfJuXIyqTjgHFCAYl9amWtYqG1zY6EHIADcAAOwAGcDmBsVwFItKiEzsPIfLoGkCm5vpACQNonzBKVhjq6yL4DkwFI3zmIlLJBP8By2XtlC0XjpVT6kkUk2fcpQgC/LmXE/j6hWfoBQLKFdGrkE5YpK5OOA4aRj4j8B/tmySva7EjIATgAB+AAHOC/B8DHD2AUbdjymQKAZvwARuZsWTAtq/gBjBav1Q+g/fkeo6Hl9qU2CqAdP4BRB9kqK6P4AYxCq2WzQybxAxhN8i2UR7C2/oHI6aFcUjDb0tVMANZsFNJ+lSiAtdlCyjicLz0DBSAFNCYSLc9rat16IUUHNP6jkM4VK1EAWeJcMjBgOQP/JZWaQa22sN6MdAYA2eKDKSB4GQoAbFotZvwuUfdfmS9m1iyxr5YDjHgsZixjSin752RIVr8a0AAgV7pDRlquU/XPK5aC2xXdqwAIr7MFJ8YOS6VmXwBtV3WUXwoOABSm2bIBEXA7lQ0O84q6X7OVBipWXZUAXj2f2ZUib5v1LNJZtTB39Am7Yg5MwgOAQZY3Oi1xynu9SlGjss3H5S0z//yqXGWVyiaavl/objP7q4LM6mZ1art4eoU7GqXaMhn6XGxeqb6NaGcZ2VwIp9mmuWrViH1MXpvNqA2CZCpwbUhS/QG94TFquJeZzobH+DGwFvl4xVrElW6Yo3ur1+60oH2Y3+kcow5xAA7gdIA/FV+YkHL7yw0AAAAASUVORK5CYII="/>
                                                    </defs>
                                                </svg>
                                                <span class="ms-[10px]">
                                                My Logs
                                            </span>
                                            </a>
                                            <a href="javascript:void(0)"
                                               class="flex justify-start items-center decoration-0 w-full font-[500] text-[12px] text-[#000000] dark:text-[#ECEBF7] px-[10px] py-[7px] duration-300 hover:bg-white dark:hover:bg-[#222222] rounded-[12px] leading-[18px]">
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="dark:hidden">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_605)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_605"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_605" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_605" width="128" height="128"
                                                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAACXBIWXMAAAOwAAADsAEnxA+tAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAABSNJREFUeJztm0toHVUYx3/NraWvlFjs1WBRq1ariFVXQhWNiAsRhZYiKga66cq2CxFdCD7AvYogiHYhiii6cGGMRt1YbIMWtT6o9QEWLA1WoVKrpHm4OEm5DsmceZyZc+98/x98ELgz53zfmV/muzN3BoQQQgghhBC2WFLDHG1gI7AOOKeG+ZrAJHAcOAycjJxLIVrAMDAOTAOzikIxCYwBd+Zb/rhcCnxJ/MVrWowAa3MchyhsBk4Qf7GaGkeAwcxHo2bawK/EX6Smx35gWcZj4qUVaiDgWWAo4HhiYdYDfwIHQgwW6irgIuBnYGmg8UQ6vwMXAmfKDtRXPhcAtqKDXyfrgFtCDBTqoG3xfD4NfAicCjSfBYaA81I+vxn4qKZcvHxG+heXx+Ol1rPcSPqavhJiklAtoN/z+Q+B5rGEb818a56JUAKIHkUCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGEcCGGdp7AQicslcLAf+AL4DTkfMJwrWBFgL7AJ2ABcnPpsEPgaeB0Zrzqvn+QaYTYnt8VI7y3ZggvQ85+Nd4Pw4aZ7lXNJzfCvEJBa+AywHnsMtWDvjPncDh4A7qkqqW2i6AFcA+4HdBfZtAyPAk0ArYE5dRZMF2AaMA9eVGKMFPAGMAYMhkuo2mijA/Cn/bWAg0JhDwFc0sCU0TYArgQMUO+X7aGRLaJIADwJfAJtz7DMBfArMZNx+viWMEv8qoauIeRk4f8rPcnnXGZ0tYgg4lnP/CaptCbVcBoYilgCbgK89cyfjH2DPAmO1gQ9yjjVFdS1BAngYBk555k3GYeDalDFbuAM6lXPcTwh/lSABFmEF8JJnvoXiVWB1xjm6oSVIgAW4CneHLs+BOQ3sLDBX7JYgARIUOeV/D1xTYs6YLUECzLEaeM0z/mKn/JUl5u0kRkuQAMDVwLeesZPxF3B/wfnSqLslmBdgGPjbM24yDgKXl6jDR50twawA/cDrnvEWO+WvKF9KJupoCSYFuB444hkrGSeBewPVkYeqW4I5AYqc8j8HLgtYR176gEeppiWYEaAfeMOzfzJmcPf/l4UvpRBVtAQTAtwA/OjZNxkngLsqqqMMoVtC4wXYCfzr2S8Z48CGCusoS8iW0FMC+G7P3tex7QDwjmf7ZEwDz9A7j7HfDhwnX43HgFs7xrjAs/2b1ZeRnX2kJzsCrAFuAn7xbJuMqn93r4pB3H92kZawAXjBs+2LtVWSgb1k+y/OsxizuBc1evlhzBbwNMVq98VDNdbh5QHCFjeFe/SqKc/eFWkJaTEDbKy1Ag+rcN/OQxT3G//vhU2hSEtYLMZqzj0Tuylf2CjZ397pRVrAU5RrCZO4y+euow94j2JFnQEeo1lPKadRpiXsipBvZlYC75OvoKPAlhjJRiZvS5gCHo6SaU76gEdwP9KkFTQNvIy74WGVFu4JZd/3p4NU9E+ypIpB5xjAvZ+3DfeS5nrcI10/4czfO/e3cD9j3wPchnu7aRXu/schXFvdFy81IYQQQgghhBBCCCGEEEL0Mv8BfaBvQW9cLvwAAAAASUVORK5CYII="/>
                                                    </defs>
                                                </svg>
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="hidden dark:inline">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_629)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_629"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_629" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_629" width="128" height="128"
                                                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAADsQAAA7EB9YPtSQAAAc5QTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////WJDepQAAAJp0Uk5TABY7UFVPNw8DXsn9//q7SiLPthIv7NoZ4ccGm3Ae++oFRKv8quuBxnw4ndMRIEBINQp/4PnpsRcIkUYmgFPvvifQXfPowqwQQeYo0fdvufTYLgmaogwp0vZm1iykKtTyWvXNJA2lMfFXyyMCd6f+MttM+CFZrYUEGKnEDjzelJeevYJsWyUL5W64tXhtt+JzdZxj3MiGWMHMh+9zNSQAAANSSURBVHic7dtdSBRRFADge6RstwhFi2nLHyoi7Q+kICkECculvwcjK9IXkUg2ichIFHEVMQVLirLoh4QIHwQTIsIHgwjEsIws1KJSMZOC/iTKKNzWZuXO7NyZO7tzdzfinJc7Z+7snM97ZnbnYQQS4QAEIOCfBYA3xFUB+BkQwCa0vI/w1TwgFn4JrS5HNHw0CVgAP0JQn5C58N4UAKRvIalPyHx4ZwawhN0sERH71gQgET6FDBAPw3xAwpeQ1Sdk4RAfsOyDPEqf48QVhnF5XPySD1g5Jo8Jg+Lqk9RReUzq5wNWj8jj5G+BgDXD8rjoFQIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEDA/wZYO/3O15NIAeKT4YV3SHmT+DQigFlpAzObq+Bh2AHp8EyRpc7uCjNgc7/6hTvJ8WgynIAM6PXftX6Q8a5ciADq5Z8JozaIBWRCD3O/QRuEArYoL/l06FKcIipV524QCFAv/ybocMIDmuu1QRxgO9ynSSbcnj7Frnt0l04bhAHs2zppkgW3/o62DeOKG4B5NwgC5ECHInNCK93ktEEMIBfu0GQntChPw2mDEIBq+XfDTdUkpw0CAHvntCsy52vNb7BhG6wD8qGNJnugWfMx4zZYBtj3t9IkF64x6hu2wSKgUHXBOafaiE7otsEa4FD7dzp9EC7plSf6bbAEUC1/PjQZ1CfEBXdZbbAAKLRfp3MFPSPa19P9gtmG4AFH4Sqdsuc18soTdhuCBhxwXKYzU0WnTdRntiEQwD7f9+3hBpK97iLd73FBvan63li6vJsmGWN9pPS8vF18ig8oOyeP0UUAihXnPfeqQ0p5rEgcG+edkTePV/EB7gbfhkc5d6LJ4JGTEbayeu2pCTlZwQfU1Gk/J8X0Gz10M0PVBl8USOV8QG2j5l9cylv6Ai1P/NogR9SE5ijGOtXV+O2oKPUEUd/bhqQx9emh4KwZgCu5WpnGFQ9fCKo+0bTBXaI9hHWlpOVV0qS6ZCrY8kTdBunIMcYRLABxrRjwPe94aq88t1Df24at3b5LKreZ+ZcwAYRk73BXDd2ohF72L38gkZPVmQUTMaP+V5YxIHyBAAQgAAEIiDjgD1Wqgp/PIrHgAAAAAElFTkSuQmCC"/>
                                                    </defs>
                                                </svg>
                                                <span class="ms-[10px]">
                                                Saved
                                            </span>
                                            </a>
                                            <a href="javascript:void(0)"
                                               class="flex justify-start items-center decoration-0 w-full font-[500] text-[12px] text-[#000000] dark:text-[#ECEBF7] px-[10px] py-[7px] duration-300 hover:bg-white dark:hover:bg-[#222222] rounded-[12px] leading-[18px]">
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="dark:hidden">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_608)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_608"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_608" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_608" width="128" height="128"
                                                               xlink:href="data:image/png;base64,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"/>
                                                    </defs>
                                                </svg>
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="hidden dark:inline">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_626)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_626"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_626" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_626" width="128" height="128"
                                                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAADsQAAA7EB9YPtSQAAArtQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////+RhsnAAAAOl0Uk5TACiFyej9/8iEFainMufmMSvt7AfQzgZtaQHc2iknZZKRvGZnuzs8ERKcmwLk4wkYXlwIQaHhSAMd8QTz5RxAI8KIIdWl0yDBImgNcPBKTe9v8jX1+57018Cayvw0CtlTWNi3tPcaqzo99kNF4vqkE6YQ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"/>
                                                    </defs>
                                                </svg>
                                                <span class="ms-[10px]">
                                                Settings
                                            </span>
                                            </a>
                                            <a href="javascript:void(0)" v-if="!logoutLoading"
                                               class="flex justify-start items-center decoration-0 w-full font-[500] text-[12px] text-[#000000] dark:text-[#ECEBF7] bg-[#FF000D19] dark:bg-[#FF000D66] px-[10px] py-[7px] duration-300 rounded-[12px] leading-[18px]"
                                               @click="logout">
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="dark:hidden">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_610)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_610"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_610" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_610" width="128" height="128"
                                                               xlink:href="data:image/png;base64,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"/>
                                                    </defs>
                                                </svg>
                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" class="hidden dark:inline">
                                                    <rect width="15" height="15" fill="url(#pattern0_110_623)"/>
                                                    <defs>
                                                        <pattern id="pattern0_110_623"
                                                                 patternContentUnits="objectBoundingBox" width="1"
                                                                 height="1">
                                                            <use xlink:href="#image0_110_623" transform="scale(0.0078125)"/>
                                                        </pattern>
                                                        <image id="image0_110_623" width="128" height="128"
                                                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAADsQAAA7EB9YPtSQAAAmFQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////h26z6gAAAMt0Uk5TABVirNLp//vkypxNCR2f/PF8C3P35kIHoGoBpGd6+T0n3rFtKpcUBCBv5QLuBck4yNZHGIbwgdmzJoKvCvYDBowPOt8Wmv1lI9wxwc4+4iF38ogNGqL+XjXGOeeqgPQIQdG+LuoRK7rTN0/bdp1/MsJZUsey+GgoQMRaPDQpNo1y43swlMy0aRdES4eFri3gGbC7U/rhIs3algxMo5tgGyxd7RCSmbb1pltkuevLeKfzed24vWbUkRPsVqkfYX5JHKXFQ0gkJaEvg+j1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"/>
                                                    </defs>
                                                </svg>
                                                <span class="ms-[10px]">
                                                Logout
                                            </span>
                                            </a>
                                            <div class="bg-[#FF000D19] dark:bg-[#FF000D66] rounded-[12px] w-full h-[32px] flex justify-center items-center" v-if="logoutLoading">
                                                <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                    <a href="{{route('user.panel.user_login')}}">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                            <circle cx="15" cy="15" r="15" fill="url(#pattern0_8_53)"/>
                            <defs>
                                <pattern id="pattern0_8_53" patternContentUnits="objectBoundingBox" width="1"
                                         height="1">
                                    <use xlink:href="#image0_8_53" transform="scale(0.0078125)"/>
                                </pattern>
                                <image id="image0_8_53" width="128" height="128"
                                       xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>
                    </a>
                @endif

            </div>
        </div>
    </div>
    <div class="fixed top-0 right-0 h-screen w-full p-5 bg-[#ECEBF7] dark:bg-[#333333] duration-500 block md:hidden"
         :class="{'left-0 z-[9999]': menuShow, 'left-[-100%] -z-[10]': !menuShow}">
        <div class="flex items-center justify-between">
            <div class="w-auto sm:w-1/2 text-3xl font-bold">
                <a href="{{route('user.panel.home')}}"
                   class="decoration-0 text-gray-600 inline-flex items-center justify-between relative">
                    <img src="{{asset('/images/logo.svg')}}" alt="logo">
                </a>
            </div>
            <a href="javascript:void(0)" class="inline-block md:hidden sm:px-2" @click="toggleMenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                          fill="#000000" class="fill-black dark:fill-gray-400"/>
                </svg>
            </a>
        </div>
        <ul class="mt-[60px]">
            <li>
                <a href="{{route('user.panel.home')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Home</a>
            </li>
            <li>
                <a href="{{route('user.panel.post')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Blogs</a>
            </li>
            <li>
                <a href="{{route('user.panel.categories')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Categories</a>
            </li>
            <li>
                <a href="{{route('user.panel.profile')}}"
                   class="px-3 text-gray-600 dark:text-gray-400 font-medium mt-3 hover:text-cyan-400 dark:hover:text-cyan-400 duration-500 block mb-3">Profile
                    Settings</a>
            </li>
        </ul>
    </div>
</header>

<script src="{{asset('js/header.js')}}"></script>
