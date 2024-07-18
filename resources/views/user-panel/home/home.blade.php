@extends('user-panel.layout.layout')
@section('content')

    <div class="flex flex-wrap">
        <div class="w-full sm:w-full md:w-1/2 p-2">
            <div class="border dark:border-gray-500 p-5 rounded-2xl group bg-gray-100 dark:bg-gray-800">
                <img src="{{asset('/images/home/blog.jpg')}}" class="object-cover bg-cover w-full rounded-2xl"
                     alt="blog">
                <div
                    class="flex justify-between items-center mt-5 text-gray-600 dark:text-gray-400 text-sm font-medium">
                    <div>
                        #Business #Food #Interior
                    </div>
                    <div>
                        1 min to read
                    </div>
                </div>
                <div
                    class="text-2xl md:text-3xl lg:text-4xl font-bold transition-all duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-blue-400 my-4">
                    Five places must visit in turkey to relax in the winter season
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center justify-start">
                        <img src="{{asset('/images/home/avatar.png')}}" class="w-[45px] h-[45px]" alt="avatar">
                        <div class="ms-3">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                William
                            </div>
                            <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                Feb 12, 2023
                            </div>
                        </div>
                    </div>
                    <a href="{{route('user.panel.blog.details')}}" class="decoration-0">
                        <div class="relative w-[100px] h-[55px] text-gray-400 hover:text-blue-400 dark:text-blue-400 dark:hover:text-cyan-400">
                            <div class="w-[55px] h-[55px] bg-white rounded-full dark:bg-gray-900"></div>
                            <div
                                class="absolute top-0 bottom-0 start-0 w-full h-full transition-all duration-500 flex justify-start ps-4 items-center">
                                Read More
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-full md:w-1/2 p-2">
            <div class="border dark:border-gray-500 p-5 rounded-2xl group bg-gray-100 dark:bg-gray-800">
                <img src="{{asset('/images/home/blog.jpg')}}" class="object-cover bg-cover w-full rounded-2xl"
                     alt="blog">
                <div
                    class="flex justify-between items-center mt-5 text-gray-600 dark:text-gray-400 text-sm font-medium">
                    <div>
                        #Business #Food #Interior
                    </div>
                    <div>
                        1 min to read
                    </div>
                </div>
                <div
                    class="text-2xl md:text-3xl lg:text-4xl font-bold transition-all duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-blue-400 my-4">
                    Five places must visit in turkey to relax in the winter season
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center justify-start">
                        <img src="{{asset('/images/home/avatar.png')}}" class="w-[45px] h-[45px]" alt="avatar">
                        <div class="ms-3">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                William
                            </div>
                            <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                Feb 12, 2023
                            </div>
                        </div>
                    </div>
                    <a href="{{route('user.panel.blog.details')}}" class="decoration-0">
                        <div class="relative w-[100px] h-[55px] text-gray-400 hover:text-blue-400 dark:text-blue-400 dark:hover:text-cyan-400">
                            <div class="w-[55px] h-[55px] bg-white rounded-full dark:bg-gray-900"></div>
                            <div
                                class="absolute top-0 bottom-0 start-0 w-full h-full transition-all duration-500 flex justify-start ps-4 items-center">
                                Read More
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap">
        <div class="w-full sm:w-full md:w-1/2 lg:w-1/3 p-2">
            <div class="border dark:border-gray-500 p-5 rounded-2xl group bg-gray-100 dark:bg-gray-800">
                <img src="{{asset('/images/home/blog.jpg')}}" class="object-cover bg-cover w-full rounded-2xl"
                     alt="blog">
                <div
                    class="flex justify-between items-center mt-5 text-gray-600 dark:text-gray-400 text-sm font-medium">
                    <div>
                        #Business #Food #Interior
                    </div>
                    <div>
                        1 min to read
                    </div>
                </div>
                <div
                    class="text-2xl md:text-3xl lg:text-4xl font-bold transition-all duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-blue-400 my-4">
                    Five places must visit in turkey to relax in the winter season
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center justify-start">
                        <img src="{{asset('/images/home/avatar.png')}}" class="w-[45px] h-[45px]" alt="avatar">
                        <div class="ms-3">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                William
                            </div>
                            <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                Feb 12, 2023
                            </div>
                        </div>
                    </div>
                    <a href="{{route('user.panel.blog.details')}}" class="decoration-0">
                        <div class="relative w-[100px] h-[55px] text-gray-400 hover:text-blue-400 dark:text-blue-400 dark:hover:text-cyan-400">
                            <div class="w-[55px] h-[55px] bg-white rounded-full dark:bg-gray-900"></div>
                            <div
                                class="absolute top-0 bottom-0 start-0 w-full h-full transition-all duration-500 flex justify-start ps-4 items-center">
                                Read More
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-full md:w-1/2 lg:w-1/3 p-2">
            <div class="border dark:border-gray-500 p-5 rounded-2xl group bg-gray-100 dark:bg-gray-800">
                <img src="{{asset('/images/home/blog.jpg')}}" class="object-cover bg-cover w-full rounded-2xl"
                     alt="blog">
                <div
                    class="flex justify-between items-center mt-5 text-gray-600 dark:text-gray-400 text-sm font-medium">
                    <div>
                        #Business #Food #Interior
                    </div>
                    <div>
                        1 min to read
                    </div>
                </div>
                <div
                    class="text-2xl md:text-3xl lg:text-4xl font-bold transition-all duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-blue-400 my-4">
                    Five places must visit in turkey to relax in the winter season
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center justify-start">
                        <img src="{{asset('/images/home/avatar.png')}}" class="w-[45px] h-[45px]" alt="avatar">
                        <div class="ms-3">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                William
                            </div>
                            <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                Feb 12, 2023
                            </div>
                        </div>
                    </div>
                    <a href="{{route('user.panel.blog.details')}}" class="decoration-0">
                        <div class="relative w-[100px] h-[55px] text-gray-400 hover:text-blue-400 dark:text-blue-400 dark:hover:text-cyan-400">
                            <div class="w-[55px] h-[55px] bg-white rounded-full dark:bg-gray-900"></div>
                            <div
                                class="absolute top-0 bottom-0 start-0 w-full h-full transition-all duration-500 flex justify-start ps-4 items-center">
                                Read More
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-full md:w-1/2 lg:w-1/3 p-2">
            <div class="border dark:border-gray-500 p-5 rounded-2xl group bg-gray-100 dark:bg-gray-800">
                <img src="{{asset('/images/home/blog.jpg')}}" class="object-cover bg-cover w-full rounded-2xl"
                     alt="blog">
                <div
                    class="flex justify-between items-center mt-5 text-gray-600 dark:text-gray-400 text-sm font-medium">
                    <div>
                        #Business #Food #Interior
                    </div>
                    <div>
                        1 min to read
                    </div>
                </div>
                <div
                    class="text-2xl md:text-3xl lg:text-4xl font-bold transition-all duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-blue-400 my-4">
                    Five places must visit in turkey to relax in the winter season
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center justify-start">
                        <img src="{{asset('/images/home/avatar.png')}}" class="w-[45px] h-[45px]" alt="avatar">
                        <div class="ms-3">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                William
                            </div>
                            <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                Feb 12, 2023
                            </div>
                        </div>
                    </div>
                    <a href="{{route('user.panel.blog.details')}}" class="decoration-0">
                        <div class="relative w-[100px] h-[55px] text-gray-400 hover:text-blue-400 dark:text-blue-400 dark:hover:text-cyan-400">
                            <div class="w-[55px] h-[55px] bg-white rounded-full dark:bg-gray-900"></div>
                            <div
                                class="absolute top-0 bottom-0 start-0 w-full h-full transition-all duration-500 flex justify-start ps-4 items-center">
                                Read More
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4 flex justify-center items-center">
        <a href="javascript:void(0)" class="btn-theme px-10 rounded-2xl">
            <span class="flex justify-center items-center">
                Show more post
                <span class="ms-2">
                   <img src="{{asset('/images/home/arrow-right.svg')}}" class="w-[18px] h-[18px]" alt="arrow-right">
                </span>
            </span>
        </a>
    </div>

@endsection
