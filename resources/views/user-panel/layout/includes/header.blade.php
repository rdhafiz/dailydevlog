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
        <div class="bg-white dark:bg-[#222222] text-secondary dark:text-white shadow !p-[5px] rounded-[100px] flex items-center justify-between">
            <a href="{{route('user.panel.home')}}" class="hidden md:block">
                <img src="{{asset('/images/logo.svg')}}" alt="logo">
            </a>
            <ul class="items-center center hidden md:flex">
                <li>
                    <a href="{{route('user.panel.home')}}" class="dark:text-second hover:text-second dark:hover:text-second duration-500 text-[13px] leading-[19.5px] block">Featured</a>
                </li>
                <li>
                    <a href="{{route('user.panel.home')}}"
                       class="dark:text-white hover:text-second dark:hover:text-second duration-500 text-[13px] mx-8 block">Latest</a>
                </li>
                <li>
                    <a href="{{route('user.panel.home')}}" class="dark:text-white hover:text-second dark:hover:text-second duration-500 text-[13px] block">Most
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
                        <button type="button" class="outline-0 border-0">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect x="30" y="30" width="30" height="30" rx="15" transform="rotate(180 30 30)" fill="#556080"/>
                                <path
                                    d="M26 15C26 20.5228 21.5228 25 16 25C10.4772 25 6 20.5228 6 15C6 9.47715 10.4772 5 16 5C21.5228 5 26 9.47715 26 15Z"
                                    fill="url(#pattern0_8_81)"/>
                                <defs>
                                    <pattern id="pattern0_8_81" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_8_81" transform="scale(0.0078125)"/>
                                    </pattern>
                                    <image id="image0_8_81" width="128" height="128"
                                           xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IB2cksfwAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAutQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CUv0wAAAAPl0Uk5TAAIkSGySqrrFz9HKu7JxUCU0cu7/67N4Ky+K4tqJKQZh08BXBQtw491eA1jk10wtv6saAfn8hmJTRDk2VWax/vAUtNlLDhWa5ZwJMOyOpvcgQeeAD/jxFkqUrMiubUaQ++8//aIYQ5bWM8b2PRzmb/oyIZ3oIhLgCtuZ6aAENdwRvB4QwqR3uV/BsPR1Ge3HtWSRm4zhY486T+qeO3aBl/UM0B9Fi1JpW4UsMfMTCHTyn04bo9hCZ85qKLeNJzzUg0lza5W+zQ0j38wmOF1auHp+fVFuQJiILq1Ur4QHYNIdoVaotsSnXJMqyXxZe715y0fVf96pF2hlfQd/pQAACvVJREFUeJztm3tcTdkewNeiufJIkRmPMSqT18kITUYiSoU8Sppb3o08P8mdSJMoqZEQ1yM0xBWJLhkleZTHlNeYieGK8Ug1M1z53D4xQzJe97f22nu3z7O9jk7zz1l/7PXbe6+19vesx+/3W4+D0V8csBHACGAEMAIYAYwAshNKQ01TjB83IAC2wC//ppqSgDxsEID2GL/Q8soU418MDGCF8R86E7TE+K7hALpgXFlnEW0wvmEgADuZjdweXzMEgD3+TXYxH+HL9Q3gUNq5TOmBTXG397gx+KYxLrO593Gx0tueFTfrF8BVuVbtbypwnlICzxJb/KP0gSPOrUeAkXclna8/PlulKZHi1kh8rva22vNQvQGMrbouyi4YH9Ca3dOsUpLyxZF6Avi472lBdMs3K+dFf3zZAWd7oyyfjABcLUC5dsI5QuLReEe9AAzsliWIPngbFysGqtSDzfVW3luoONLq38JTf5xUDwBjTYTf71ZMu3pIpl+6hrym1Q5cx3QYiNOEHB/+850BQu+f4qXns9aSaD7+rkxLbrcycw5h7hlBYwXi1e8IEI6389KL4AS4ejVtlyG8m3H70aBzyuN/VkF1EXmT1px/UD0v4Z0AHJoLen02joNrNN5UmzY4BqHxeSo5QnA0XOPwOv4+dPE7AcSv5QXHR/DLHO50Lat9t2ARXBISVYvoaZIPV6/BQt23KFNNwQDQypsfU+E7oSaiqlOJ/BXGpaSRI7/PQFaVpmplePcIg6tfbjN6O/oqi11QBsATjlNhcR7oVa/CJkRecgY03HrSHpbB+ME2TaXEzIXLGtOl9G54mqY0sgA2R9M48ikIUd+8AdH5NmdlrJ/qLCZuDlySf+a/vHyWngAxHSK52K4KLJHDbNLkeMV08qRR1Cb1vNKwMgguifwA8CuQ76EoAewIp/HqL4TSTB+QWoiybhxWRzneB54Ac9Xv9I6hH0oBUivjuTj+QQxCKdehPgPvEgPXbtX8ugvqGTQZUgbQRgjKlO0nSgFaN6Ix4fe4AZ5w4r1YuE1Lua4ho1poWfoWoT3/oDfdz+oBoHhNfQCz1qABRl8AacMEuCQ8lNmpN46H1jc7TGnu6QEwhfdokgLAA+oD+sAnBe7cn5TKLWpeFEIZwfRm89/ZAZYkc1Gbz2HIm4EGwD3BKu7Hs2WWBLpiIkKZb2n6zpeYAQ5uoE29bSxUgAWYnPdBAUQc+p/s76OU/0AVZAVxsqlcj7oWIHsaF9lEj0YoJxDGxCjoVB3+lP99qgxyp1BZbhvUAmyJ4qIaUHkeXcEC7x4BM45hOdoyagrBOUUId60UYdgAjk3ioj3DEPqsBJTBIeiTfX5l+T5C3cBJfs+cExUFjAB+5bS3p3silAcDap87+EKFckcAH0im9HmcGLngLRuA0x0umnCuCFnNXYnQOqiQ/AC276PqahgHudSlzRjKBrA3hIs8wfs8Bf0nsaUvQkvrsEBqwdtyFUKnP+dkmSZRBOD74IEhVCUv+RIhCxPG78PPHwyVeIITD7qwAXzwhovI4I/cShVJ4VhmgNa3EepH1TBnUhkA+EHwNSiy3qBEosCqnPVhBvDYK/ou4eFsAIuor0W6ztCrCHUBY7Tua2aARo/AevzEiVnObABhO7moEziU86AjvnoMjrn2Sam2QKzgtGxOzB7ABnCAGpHDTlTM6Y/Q9yOZAchXQ3dzov1JNoCdYUoARB91rGEGyO2H0Jz9nGgmT4mJAIu/4SLSBL6gRT+8Kg5olvDlEpgo7hNZWAB4pXPUkf7yhOl61cBeD9GxeSovtwiwizqexz4FQwaTrBXJRbkri7Vm0xYcYGJTNIwTX+he4FQDIAYIwom+MAckEzKzgzPKmL+P8nsjdJUaAaISWAB4K3qqF0JtX7N/mQ+nPwGXahEnNq5gA7g+hIsGwCAuHqw3AOnD58dwonkJG0BAPhcFgSWOqGGZXUpDk/u1uV/J21AQAfwf0i43fiPthXqFAoU4Ct9aF7EBCIqXmEO+OdhD1WvRGNbonk5rALhB7Tfx5UIuMrpifIhfXo7QJ//lZJl9UAJgR3M4R4AyXrVKL4DCHtANq6l8tjsrgEczuu5LPIGZB/X5/qj3V4t+5LJgmZkkU7Nb1ICvJTML0xZ6AExdA47YjoucPDKVHeA2b8DH7BBtOlOwdlmL0CB+24AYM1YAL3e6PsFNre84MQNctEWo5BhdqFocKjeXdIHijB+NyWDq21LWqoQkBP8AVtDEgt5c6qwPgH8buij7g8ddTQuSusOk7uDGeA6nlRi0r7yO5BoB0L8W0phYJDRMniYTApnVo+n8ngmZ2OoDUHaG+mWuhQ+hP09gGQlFvsDr/pKqc4YKUFmovOZG49R1eQjFTHWUXcyC7dBqIfv4+ejlTrIzqgB4LeUd4SsfwWVNkjynBqGfkhKgyvL5nZO8PvK/r7pYzS+TgDImQswMe1mFXHOCKse9+cUE58Nv9AcQTBJCE9fD5eBvsXUXYZesgKp3uGbO3//5O9y9fCVztVYVwGsh74vbdeLmFz3a1qUPjmzfSsqZmcnfK54Vkcl+at+hshDUtmzsQ4VlYTJTB420V+ccb1TC8akQWW0K5B8sKwdL6hMIXr3p3F0yENQ3rbLjBGdgwDhSNpqWrnU82qWUenKUN4QkKce3IGT7He077c2f16lMNGzbHZ0sSH7L2nLxzAUrNK2WJfaz5N+bCrt6rq1Ie9Qu7dyY9S07gLhqDx06xYkue/ddf6pK2VN1i7M8wlUQ8lg/R5jB2DQhi9TmvSUzGt+t7ACo0lcswewXYZLgFWZybMNnP9egNh3PnhwScpxvX8XczeIpB9flXQm1z8raom571NEImjevB9XUOoULb+nYEI5KT6mdwabkkl9bsSe+9n1iMThJ7c384xgBUPp9ya+ozrTQ7B2ExPaX7PI3GUM2k+dnSI/ckDUjxXnb1IHmqnnrAEAVTaUW3fmCTb+NKhkzlpyOzpI8yJtPtpwtmku/vyASVNS3M0BqNEDL4QKtRzi65DsoP7BsVtBvk+/uIlQ5JTXng5vL4pXeTppmz1miLOkSsaXVCWhCO06xJHo7atzG0XGIxX25/CWatCx+Lz8mzFp8OKpFEvSSFsI0a3/JdDYA1OVZhzJZn48szxN1XnSumOfxKyROlEiw6zJiHBMAeCjZhad1JiAh2e5AlOR28lFe2OQPl4Dm0n7i4jeBDQC0unmO7iTLnEtUftaDXly0Ihk0QOyli8ovr01U+UV1H2bzKn1hqW2qmOh8M0LN4ESsJ2cJLuyCsR+3Q82lCdz2hBEAQqZ193E/qj21Dwibo/Gwwu7nkeiKK/R5rwHrNLz2aSPNJftAY4hT5lrXyUlrwtBX5hku5/cNttTeO06Fj62B36/I0qy/0lya6QHAFFK2QPsrVmjbNrpnUktguDOliqMOWt91bCyaKIMBlHyhyx36tanBAdQOuyiFTx0F+2gwgJATOs9i2gr6wXB9oEKhq2yymGFgADTtDx1q/NlzwwOgy6HaV7vdhANwBj3aXeCr9VXPMw0BIB5nUA+BwvqHgQ+3T9V2xnLBooYBwPd7aX5B532GB0C2FU00PbZLFBY/DP7/gpLDmrY/yd5SAwEgq+fq6xXOW9s2HADyqlE7eT5ityg2xF88FKGLlB+clKz8NMh/TPDyKxKtnDJceiaygf7k0s79Fu/Yuk6tmix902D/somNjZhXttOi7SFmt9zAwQhgBDACGAGMAEaA/wPLSBSuDmCyqgAAAABJRU5ErkJggg=="/>
                                </defs>
                            </svg>
                        </button>
                    </div>
                    <div
                        class="hidden absolute -right-[130px] sm:right-0 z-10 mt-4 w-[320px] sm:w-[340px] origin-top-right p-0 bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none rounded-2xl overflow-hidden dark:bg-[#222222] dark:border dark:border-gray-70"
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
                <a href="javascript:void(0)" class="mx-[5px] hidden dark:block" onclick="lightMode()">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect x="30" y="30" width="30" height="30" rx="15" transform="rotate(180 30 30)" fill="#556080"/>
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
                        <rect x="30" y="30" width="30" height="30" rx="15" transform="rotate(180 30 30)" fill="#556080"/>
                        <path
                            d="M25 15C25 20.5228 20.5228 25 15 25C9.47715 25 5 20.5228 5 15C5 9.47715 9.47715 5 15 5C20.5228 5 25 9.47715 25 15Z"
                            fill="url(#pattern0_17_40)"/>
                        <defs>
                            <pattern id="pattern0_17_40" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_17_40" transform="scale(0.0078125)"/>
                            </pattern>
                            <image id="image0_17_40" width="128" height="128"
                                   xlink:href="data:image/png;base64,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"/>
                        </defs>
                    </svg>
                </a>

                <div class="relative inline-block text-left" id="user-menu">
                    <div id="userToggle">
                        <a href="javascript:void(0)">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"  v-if="!profileData?.avatar">
                                <circle cx="15" cy="15" r="15" fill="url(#pattern0_8_53)"/>
                                <defs>
                                    <pattern id="pattern0_8_53" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_8_53" transform="scale(0.0078125)"/>
                                    </pattern>
                                    <image id="image0_8_53" width="128" height="128"
                                           xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAjqAAAI6gBvapofgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAABGISURBVHic7Z15eBRVusbfr7rT2RNISEJCIBBXdgRkEVllERG9Ah11EAgu+IyO43PHuXcuilKMI3NxZnyeO3qfOzIaA4p60yAuoHJFiYRNJAgEElxYhZC1IWTvpb77BwkkIUsvVXWqsX9/Jd1V9b3d9XbVqXPO9x3CNYYsy1LBafSV3NSfJNwI5j4AejHQC0A3ALEAYgBEt9jNCaAGjFoQagCUATjHhFIw/QQFP1EI/ziwN47Lsqzo/qE0hEQL8Jc5j8qpJhcmABgFwigwhgEI1yQYowbAAZawH4zdBOTasuUSTWLpRMAZYOZTfw+NrDo/BRLPIuAOADcLlnSUgC8Y9Alq+WubTXYI1uMVAWGASbJsTjxJMxXmB4kwC5cu4UbkIgGfKAqtq0jnL3Jl2SVaUFcY2gBzM1+8wUTux5nxEIAk0Xq8pAzAGolNr//vmuePiRbTEUY0AM1bJE8jwtMA7gQgiRbkJwoIW4jwSk6WvFW0mLYYyQCUkSnfy8AyACNEi9EExj4m/Hl9trwRAIuWAxjEAPMWydOJsArAMNFadCIfoKW27OVfiBYi1AD3PyIPUtz4K4AZInUIZIsi4YkNWfJxUQKEGMBqfSWcIi/+gYGlACwiNBiIegJe5lqsFPEIqbsBMhbJE5iwBkBfvWMbnENQ8JhtrbxXz6C6GWCSLJt7nMQLBDwLwKRX3ABDAfBqTXTcHz579beNegTUxQDWhXIfENaBcLse8a4B9sNtmmd7+/kTWgfS/Bl7Xqb8ACQcCp58rxgOk/vbjMUrNG8ca3kFoIxMeTkDyzWMca3DDLw8qC+e1WoUUhMDWK2yhSPwJhEe0uL4v0A+QW3M/Tbb7+rVPrDqBrjn4VXRoUp9Di514wZRj+0WJ2avWydfVPOgqhrggYflFLeCzfjl9OjpTb7ZgjvfWy1XqHVA1QzQdPLzAKSrdcwg7UAogts8zbZ22Vl1DqcCDy6Re7gc+BrAADWOpzKOELN0OiYmqiKhR2xjdFSkEhZmprCwUFN0dKQJAKqra90NDY3uhgYXV9fUSuUVVaFVF2sTXC53bxizp/K424yJH7whn/H3QH4bYP58OcYRgq9gnBG8uthuUYdvGXJd/ZhbB6YmJXVPM0mS2ZcDuRXFVXLOfmr3vsIzBw/9GFlVVTcAQITKen3lkMWJ8f62CfwywOwlckSYA58DGO/PcdTAYgkpmjZlRMUdk4bfajabwrSI4XS667duy8//Mjc/weFw3aRFDK9gbO0emnzX6tWPO309hM8GkGVZOnISHwOY5esx1MBiMX+/4Fcz6oYOSr9Fz7jfHTz23Tvvb4lyOt036Bm3LURYm/OWnAkf5xf43Cef0G+SDOAxX/dXgfpxYwftePrJucOSk+J66R08uWdc8tTJI2Kqqmp2nCmu6AnAp9uMCgwdMGySVHggd5svO/t0BZi3cMVMkngTBE3XIokqnlhy75mbru9tiMfNoqOnj/zjzY+TmTlOlAYGZazPXm7zdj+vDfBAptzXDeQDEPJhTZJ0bum/zXcmJnTrIyJ+R5SUnT/157+8E86MREESzkPBMNta+bQ3O3n1C87MlMPcDBsEnXww1/z2ibmVRjv5ANAzsXva00/OPU+gWkESuoOwzmrN8eq27pUB6oCXQRjpnS71mD1r3IF+fXsOEhW/K9L7ptw0c8aoA8IEEG7nyKJl3uzisQHuz5THMPCk96rUITo6Yt+0KSMMP6Q8Y+qt42Kiw78TFZ+Yl1kflj3+njwywJIlr4cowGpPt9cAXrL47khBsb2CiPDwwlnitBLMUJA986m/h3qyuUcn1O4s+T2AwX4J84OY6Ij8tD5J/UXF95b0fsk3irwKALgusub87zzZsEsDWB+Rryfm5/3X5DtTJo/QZX6cmkwcP0z1sXtvIOZl1oVyl43lrq8Abvw3tEq39gzHuNEDhgqM7xPjbhsyGAyRyaERJGFlVxt1aoCmOWnTVZPkA2Fhlh9CQy1RIjX4QkSYJdoSFiI0KZSBX2Uskid0tk1nBiBm7tJBWtMzsXulaA2+khgfq9rEDR8hBv6GTjr8OjRAxqIVcwAM10KVNyQkxgVsSZbEhDjx9QEII62LVtzV0dsdGoDB/6GNIu8IDws1RAKrL0REGEQ7ddyIb9cA1swV00T2+LUkLNQcsPUBQsMtxjAAMNq6WJ7S3hsdfLns0TOkHjQ0OAP2FtBY7zBEDYAmnm7vxasMcP+iF6+D4JZ/S1wu8bdRX1EUt2gJV2Dc3XRuW3GVAVhy/7q914MEPJKb3FdN4Gl1oifJsrmpIFOQaxACFrQdLm5lgMSTmI7Aq8YVxHNSKKpoassXWhmAgfn66gmiNwrzgy3/v2yApuHD2borCqIrBNxrtcqXk10uGyC65vwktC6gHOTapBtF4/L4wGUDsMJ3i9ETRHeUK7kcV9oAZJxn/yDawpeKbANoMsCch15KBnCjMEVB9GZQ0zm/ZADJ7JwoVk8QnSHJ7LodaL4FEMYKlRNEf5hHAU0GIDZMancrTCbp9MwZo0UvCOEzd04fc5PJJP0sWkd7EGE0AEhNXYOGyLFrAy9ZfLc9Niayp2ghvtItNjLp0cWzLsAglcFbwbgFAElK5PfpAAw35z4qKuxA/5vTjGhMrxh4c9/BkeFhh0TruApClHWh3FsyQWx+e0cMGZheJVqDWgwenH5BtIb2IBP1l8C4XrSQ9kjqGW/E2jw+kdwzzpCfRWHcKDEZs6pXqDlwp4K1xWKxGPKzSMSpEhOSRQsJIgZmpErECNhWdhC/6SUBwipaBBFPNwnGXYQxiPbESjBO4cMg+hM0wC8ci4Tg+j2/ZEwSAANlL1yh3hG4GUFtcTlcxhsLuIRkWAOcO2cPqGXYO6O4tNKoFU7cEiC0ikWHHD5yTFjVTbUpOHysm2gNHVAjAVB1CRK1qKtvHFJ49KTxRtG85MjRkwU1tQ1GLXFTIwGwi1bREauzNsdXXawrE63DVy5cqC57463N3UXr6ARjG0BRlF7L/5TlKi27cEq0Fm8pKDxxUF65xuV2K6mitXRCmQRGuWgVnaEonLLp812ar6CpForC7ufkN777Z9amoYrCKaL1dEGxxMBJ0Sq64ofvf04QrcFTDhz66UB1Tb2ui1f4wVlJAp0UraIr6hsd/atr60VX3PKIz7d+2yBag6cQ05mAuAIAkLbnHSwULaIrGhodtSUllQEzj1EBjkqKiYtEC/GEvB2HjNyaBgBs+mx3Pgw4wbYjzCYukjZkyScAGH4CZl1D4+Dic5VCK292hqKwe+euw/1E6/CCqvez5GIJl+asHxStxhNsG3P9XihRK3btPrLPrSi9RevwGMJ+4Ep2sMjS5h5z7HjxyOraOsOVjmVm5cNPdxi1u7ddmLEXuJwaRnli5XhMZM6Grw3XPfxlbv4eR6NT/EKS3nHFAE6F82DE9KV2OFhwbGR1db1huoddLsWx+bNv0kTr8BIOMYfsBJoMsPFtuQxAQDwNgDk6a+2nhtG6zvbFHrei6L5wpZ8cfO+N50qBFhVCCPg/cXq849iJ4ttOnSr9XrSOs8WVJ/LzfxgtWoe3EF0511cyVhT6WIga3wh57fWNbpei+Lxosr8ws/LqPzbUAPBocSYjwcCW5r8vG6AsnfNg4JHBtjQ6nANybF/tEhX/vZwvd9TVNQpbSMsPysvTsL35n8sGyJVlFxE2idHkG3u+LRp19mzFcb3jFhw+cWDP3qLb9I6rBgx8mCvLl2eBtU5aJLytuyL/CH/lNZvCzLpNIK2vbbjwxprNvUDCVgv3CwK1WmC6lQEG9MFXAAxZ0qQjnE7X9W5m3Sa2nq+qtTNzwAxPt4JxBrX9v2r5UisDyLKsEOMdfVUF0Q0JWTZbhrv1S21wmc2vw6BTxYP4heKWzFltX7zKAB+8uewUgI90kRREPwgfNZ3bVrRbuYIY/6W9oiB6Qor0t/Zeb9cAOWvk7QACZYAoSNfszVnzws723uikdg29qJWaIPpCwIqO3uvQALbs5V8AaNc1BkMxEelWhImJjbIWoGcwduRky5929HanXxxDWqq+InWRiM4RkW4p7pHhoQEz5w8AmKRnO3u/UwOsz34hjwBbZ9uIJiom4pye8WJjoxIIdF7PmD5D2Lg++4VO23JdXjolMj8DoE41USozdeJwXUcEiYjS+6UU6BnTR+rhMj3T1UZdGuD9t5b9DMYqdTSpi8lsOjF+3BDd1zjOsE5OAxszrb4ZBq2yvf18lyl1njWe6vCfYBz2W5WKEKj2md9kuE0mKUTv2MmJ3dMmThgmbCjaA45GgT360XrUeCoszHX3Hz5lP4EXwwDLykqSdPbXj95bkp6eLGwtgQE3p6WdPlORW15+vq8oDR3gVki6573s5R5lVHvcei46sO3soKGTwkAY77s2P2G40tKSdi791wdTk5Pj+wjT0cTIW27sGx8fu6/o6OkGRVEMkbnEwF82ZC9f4+n2Xj0+Jdw36evIC5gKQPcEiOioiP1PPTGnbub0UbeEWMxhesfviF4pPVKm3zEyNioyfM+PP511CjUCYx/VYUFhYa7Hg3led2pYF7zYDyb3dwBivd3XF8LCLIcXPTTdNfDmfoZPulQUVrZtP/jtp5/vTnC6XHpXYa9SJAzfkCV7NUPKp16teYvlu4nxETRsD5hN0ql/mT2+ePy4wWOIKKB63wQYgRmYtz5b/sDbHX3+YjMy5WcZeMnX/TuCCPbRI/sXZMybPMZsMgXcjNuWMLOSt7Pgm4827UzS1AiM5bY18h992dWfXxZlZMrvMvCAH8doSe3gQf32PPTgjFvDQ0OuqQLWWl4RmJCz/i35AfiY2eVXH3qf8XM2WRz1YwE/Vh1huFJ7J27//dP3x44bM2hwiDmwf/XtQUSU3rdn6rQpI2NDQ0P3Hj9e7FCpsZhHtTHzCgu3+Nwb6ve99Z6HV0WHKvXbAO/XHoyOiti/5JHZ0Wm9Ew25cJVWqHRrKAhxhE58992lfo1LqNK4um+BnGiW8CUIgzzZPpBa9lrix63hRwATbNlyib8aVGtdWxevTAA7tgIY0tE2JpN08r7Z488FYsteS7y8InwPxXyHbe2ys2rEVvUkWBevTAAcW5pWpbwShKhy8oRhR2bfddtYEX33gYKisHvb9v17Nn++N9nVvhEKzOaQac2ZvWqg+q9w/nw5xmHGBhCmAkBKSo8dv3n8vgFRkWHXTPFnrXErimvjx3m78nYWDGXm5g63vBBH6L3+3vPbosll2GqVLVKU9M8Z025Nnzl91O1axPglUFlZVfzyK++fb2h0FEYAC7OzZdVrEGp2H2ZmqcRuXwbGchhgBDFAYafT9aes1/9HlmVZk/xHzRti58rLJ4Ok9wAkaR3rGqMSCi1MTozrcEKnGujSEj9TWZlqYuQAGKtHvMCH8sksWXt266Z5kWxdLs2p8fFn7PFxk3Bploqhp1IJxg3CX+3x3W/T4+QDOl0BWlJqtw9RFH4TgO5z+QwN4xCIH0vu0WOvnmGFdMYws7nUbn+SGS8hgGrrakQDGKvsPeJWDiTSfaEsob1xZWVlN7gl00oAc0VrEQAT8KGkuP89MTHxJ1EiDPGll9jtg1nh5wFYRWvRA2LsVJiWpiTGCU/ANYQBmimpqJjCoJcAjBGtRSN2g5XnkhMStokW0oyhDNBMcXn5CEmSljBjAYBw0Xr8xAHgIwm8OqlHj62ixbTFkAZoprS0NEkxhWQC/AQA4dPAvaQE4DVuotdS4+MNW+be0AZohplNpZWVExnSHIDvA2DU1biKAf6QgA+S4uO/JiLD93kEhAFawsxSmd0+WgHmgjEdwECIG2tQABSC8JkEbEyMi/uGiAJq0euAM0Bb7HZ7bAPzWFIwFoRxAEYDiNIoXDUD3xBjF0vYHUa0Oy4uzvDL7XRGwBugPcrLy1OcJlM6Kcp1YEon4usYlAxQLMCRuNSwjMEVo9QAqAZQB1AtgIsE5SwzHQfxcVak4yHkPpaQkFAs6CNpxv8D3IfQ+KSmDEQAAAAASUVORK5CYII="/>
                                </defs>
                            </svg>
                            <img :src="'/storage/media/'+profileData.avatar"
                                 class="w-[45px] h-[45px] rounded-full"
                                 alt="profile-avtar" v-if="profileData?.avatar" id="header_avatar">
                        </a>
                    </div>
                </div>
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
