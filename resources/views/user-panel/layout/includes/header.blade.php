<header class="container mx-auto">
    <div class="flex items-center h-[90px] px-3 sm:px-0">
        <div class="w-full lg:w-1/5 text-3xl font-bold flex justify-between items-center">
            <a href="javascript:void(0)" class="decoration-0 text-gray-600">
                <img src="{{asset('/images/logo-dark.svg')}}" class="w-[120px]" alt="logo-dark">
            </a>
            <button type="button" class="outline-0 border-0 bg-transparent visible lg:hidden" onclick="sidebar()">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M5 7H19" stroke="#000000" stroke-width="3" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                        <path d="M10 12L19 12" stroke="#000000" stroke-width="3" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                        <path d="M5 17L19 17" stroke="#000000" stroke-width="3" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </g>
                </svg>
            </button>
        </div>
        <div
            class="fixed lg:static -right-full -right-[360px] top-0 bottom-0 shadow lg:shadow-none bg-white lg:bg-transparent w-full sm:w-[360px] lg:w-3/5 block lg:flex lg:justify-center lg:items-center gap-x-7 font-medium p-3 lg:p-0">
            <a href="javascript:void(0)" class="decoration-0 text-gray-600 block lg:inline-block p-3 lg:p-1">
                Home
            </a>
            <a href="javascript:void(0)" class="decoration-0 text-gray-600 block lg:inline-block p-3 lg:p-1">
                About Me
            </a>
            <a href="javascript:void(0)" class="decoration-0 text-gray-600 block lg:inline-block p-3 lg:p-1">
                Category
            </a>
            <a href="javascript:void(0)" class="decoration-0 text-gray-600 block lg:inline-block p-3 lg:p-1">
                Single Post
            </a>
            <a href="javascript:void(0)" class="decoration-0 text-gray-600 block lg:inline-block p-3 lg:p-1">
                Pages
            </a>
            <a href="javascript:void(0)" class="decoration-0 text-gray-600 block lg:inline-block p-3 lg:p-1">
                Contact
            </a>
        </div>
        <div class="hidden w-1/5 lg:flex justify-center items-center gap-x-10">
            <button type="button" class="outline-0 border-0">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                            stroke="#344161" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </button>
            <button type="button" class="outline-0 border-0 transition duration-500 ease-in-out bg-gradient-to-r from-blue-500 to-cyan-400 hover:from-cyan-400 hover:to-blue-500 px-7 py-3 text-white rounded-2xl">
                Subscribe
            </button>
        </div>
    </div>
</header>
