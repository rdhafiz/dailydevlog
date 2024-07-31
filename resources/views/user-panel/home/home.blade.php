@extends('user-panel.layout.layout')
@section('content')

    <div id="home">

        <div class="w-full px-4" v-if="tableData.length === 0 && !loading">
            <div
                class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">Do not have any blog.</div>
            </div>
        </div>

        <div class="px-3" v-if="loading">
            <div class="w-full h-[100vh] flex justify-center items-center">
                    <span>
                        <svg class="h-[60px] mx-auto w-[60px] animate-spin text-white"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
            </div>
        </div>

        <div class="flex flex-wrap" v-if="tableData.length > 0 && !loading">
            <div class="w-full sm:w-full md:w-1/2 lg:w-1/3 p-2 flex" v-for="(each) in tableData">
                <div class="border dark:border-gray-500 p-5 rounded-2xl group bg-gray-100 dark:bg-gray-800 w-full">
                    <img :src="'/storage/media/'+each?.featured_image" class="w-full rounded-2xl object-cover h-[350px]"
                         alt="blog" v-if="each?.featured_image">
                    <img :src="'/images/default.png/'" class="w-full rounded-2xl object-cover h-[350px]"
                         alt="blog" v-if="!each?.featured_image">
                    <div
                        class="flex justify-between items-center mt-5 text-gray-600 dark:text-gray-400 text-sm font-medium">
                        <div class="flex items-center gap-2" v-if="each?.categories?.length > 0">
                            <span v-for="(category, index) in each?.categories">#@{{ category.name }}</span>
                        </div>
                        <div>
                            @{{ each.views_count }} views
                        </div>
                    </div>
                    <div
                        class="text-2xl md:text-3xl lg:text-4xl font-bold transition-all duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-blue-400 my-4">
                        @{{ each.title }}
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center justify-start">
                            <div class="w-[45px] h-[45px] flex justify-center items-center bg-cyan-300 rounded-full font-bold dark:bg-cyan-500" v-if="each?.author?.avatar === null">
                                @{{ nameControl(each?.author?.name) }}
                            </div>
                            <img :src="'/storage/media/'+each?.author?.avatar" class="w-[45px] h-[45px] bg-cover object-cover rounded-full" v-if="each?.author?.avatar !== null" alt="avatar">
                            <div class="ms-3">
                                <div class="font-bold text-gray-600 dark:text-cyan-600">
                                    @{{ each?.author?.name }}
                                </div>
                                <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                    @{{ each?.created_at_format }}
                                </div>
                            </div>
                        </div>
                        <a :href="'/blog-details/'+each.id" class="decoration-0">
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

        <div class="mt-5 flex justify-center items-center" v-if="tableData.length > 0 && loading === false && last_page > 1">
            <div class="flex justify-center items-center gap-x-1">
                <div @click="PrevPage()">
                    <a href="javascript:void(0)" class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-left undefined">
                            <path d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>
                        </svg>
                    </a>
                </div>
                <div v-if="buttons.length <= 6" class="flex justify-center items-center gap-x-1">
                    <div v-for="(page, index) in buttons">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(page)" v-text="page"></a>
                    </div>
                </div>
                <div v-if="buttons.length > 6" class="flex justify-center items-center gap-x-1">
                    <div>
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(1)">1</a>
                    </div>
                    <div v-if="current_page > 3">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(current_page - 2)">...</a>
                    </div>
                    <div v-if="current_page == buttons.length">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(current_page - 2)" v-text="current_page - 2"></a>
                    </div>
                    <div v-if="current_page > 2">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(current_page - 1)" v-text="current_page - 1"></a>
                    </div>
                    <div v-if="current_page != 1 && current_page != buttons.length">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(current_page)" v-text="current_page"></a>
                    </div>
                    <div v-if="current_page < buttons.length - 1">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(current_page + 1)" v-text="current_page + 1"></a>
                    </div>
                    <div v-if="current_page == 1">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(current_page + 2)" v-text="current_page + 2"></a>
                    </div>
                    <div v-if="current_page < buttons.length - 2">
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(current_page + 2)">...</a>
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" @click="pageChange(buttons.length)" v-text="buttons.length"></a>
                    </div>
                </div>
                <div @click="NextPage()">
                    <a href="javascript:void(0)" class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"
                             fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                             stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined">
                            <path
                                d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <script src="{{asset('/js/home.js')}}"></script>

@endsection
