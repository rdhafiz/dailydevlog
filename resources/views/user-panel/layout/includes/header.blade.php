<header class="border-b text-[16px] border-light-border dark:border-dark-border p-4 " >
    <div class="wrapper flex justify-between items-center max-w-[1400px] mx-auto">
        <!-- Logo -->
        <div class="logo text-[25px]">
            Daily Dev Blog
        </div>
        <!-- Menu -->
        <ul class="list-none p-0 m-0 flex justify-center place-items-center">
            <li class="p-2">
                <a href="javascript:void(0)" class="text-[18px]">Home</a>
            </li>
            <li class="p-2">
                <a href="javascript:void(0)" class="text-[18px]">Blogs</a>
            </li>
            <li class="p-2">
                <a href="javascript:void(0)" class="text-[18px]">Contact Us</a>
            </li>
        </ul>

        <!-- Userinfo / Authentication buttons -->
        <ul class="list-none p-0 m-0 flex justify-center place-items-center">
            <li class="me-3" >
               <button onclick="toggleTheme(event)"  class="bg-transparent text-white font-bold  rounded-full p-1"> <img id="themeChangeIcon" src="{{asset('/icons/sun.svg')}}" alt=""></button>
            </li>
            <li >
                <button class="button-primary text-white font-bold  rounded-full">
                    Login
                </button>
            </li>
        </ul>
    </div>
</header>
