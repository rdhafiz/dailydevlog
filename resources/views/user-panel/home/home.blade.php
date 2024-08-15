@extends('user-panel.layout.layout')
@section('content')

    <div id="home">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-between px-3 gap-2 sm:gap-5">
            <div class="w-full sm:w-1/2 lg:w-1/3 py-2 sm:py-3">
                <!-- Search input -->
                <input type="text" name="keyword"
                       class="p-3 bg-transparent border-0 outline-0 border-b-cyan-400 border-b-2 w-full" required
                       autocomplete="off" placeholder="Search Here" v-model="formData.keyword"
                       @keyup="searchData()">
            </div>

            <div class="from-group w-full sm:w-1/2 lg:w-1/3">
                <select name="order" class="p-3 bg-transparent border-0 outline-0 border-b-cyan-400 border-b-2 w-full" v-model="formData.sort_mode" @change="searchData()">
                    <option :value="''" class="text-black">Order</option>
                    <option :value="'asc'" class="text-black">Ascending</option>
                    <option :value="'desc'" class="text-black">Descending</option>
                </select>
            </div>
        </div>
        <div class="w-full px-4 mt-5" v-if="tableData.length === 0 && !loading">
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

        <div class="flex flex-wrap mt-5" v-if="tableData.length > 0 && !loading">
            <div class="w-full sm:w-full lg:w-1/2 2xl:w-1/4 p-3 flex" v-for="(each) in tableData">
                <div class="group bg-gray-100 rounded-2xl dark:bg-gray-800 w-full">
                    <div class="h-[250px] rounded-t-2xl overflow-hidden">
                        <img :src="'/storage/media/'+each?.featured_image"
                             class="w-full rounded-t-2xl object-cover h-[250px] scale-[1] group-hover:scale-[1.2] duration-500"
                             alt="blog" v-if="each?.featured_image">
                        <img :src="'/images/default.png/'"
                             class="w-full rounded-t-2xlobject-cover h-[300px] scale-[1] group-hover:scale-[1.2] duration-500"
                             alt="blog" v-if="!each?.featured_image">
                    </div>
                    <div class="px-4">

                        <div
                            class="flex justify-between items-center gap-2 mb-1 text-gray-600 dark:text-gray-400 text-sm font-medium mt-3">
                            <div class="w-[calc(100%-60px)]" v-if="each?.tags?.length > 0">
                                <div class="text-truncate w-[95%]">
                                    <template v-for="(tag, index) in each?.tags">#@{{ tag }}&nbsp;</template>
                                </div>
                            </div>
                            <div class="dark:text-gray-500 font-semibold text-gray-400 text-[12px] w-[60px] text-end grow-0">
                                @{{ each.views_count }} views
                            </div>
                        </div>
                        <div
                            class="text-[18px] font-bold transition-all h-[44px] leading-[1.2] duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-cyan-400 mt-2 mb-1 text-truncate-line-2">
                            @{{ each.title }}
                        </div>

                        <div class="flex justify-between items-center mt-2 mb-2">
                            <div class="flex items-center justify-start">
                                <div
                                    class="w-[30px] h-[30px] flex justify-center items-center bg-cyan-300 rounded-full font-bold dark:bg-cyan-500"
                                    v-if="each?.author?.avatar === null">
                                    @{{ nameControl(each?.author?.name) }}
                                </div>
                                <img :src="'/storage/media/'+each?.author?.avatar"
                                     class="w-[30px] h-[30px] bg-cover object-cover rounded-full"
                                     v-if="each?.author?.avatar !== null" alt="avatar">
                                <div class="ms-3">
                                    <div class="font-bold text-gray-600 dark:text-cyan-600 text-[14px]">
                                        @{{ each?.author?.name }}
                                    </div>
                                    <div class="dark:text-gray-500 font-semibold text-gray-400 text-[11px]">
                                        @{{ each?.created_at_format }}
                                    </div>
                                </div>
                            </div>
                            <a :href="'/blog-details/'+each.id" class="decoration-0">
                                <div
                                    class="relative w-[100px] h-[40px] text-gray-400 hover:text-blue-400 dark:text-blue-400 dark:hover:text-cyan-400 flex items-center read-more">
                                    <div
                                        class="w-[30px] h-[30px] bg-white rounded-full dark:bg-gray-900 child duration-500"></div>
                                    <div
                                        class="absolute top-0 bottom-0 start-0 w-full h-full transition-all duration-500 flex justify-start ps-4 items-center text-[14px]">
                                        Read More
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 flex justify-center items-center"
             v-if="tableData.length > 0 && loading === false && last_page > 1">
            <div class="flex justify-center items-center gap-x-1">
                <div @click="PrevPage()">
                    <a href="javascript:void(0)"
                       class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20" fill="none"
                             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                             class="acorn-icons acorn-icons-chevron-left undefined">
                            <path
                                d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>
                        </svg>
                    </a>
                </div>
                <div v-if="buttons.length <= 6" class="flex justify-center items-center gap-x-1">
                    <div v-for="(page, index) in buttons">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="{'bg-cyan-400': page === current_page}"
                           @click="pageChange(page)" v-text="page"></a>
                    </div>
                </div>
                <div v-if="buttons.length > 6" class="flex justify-center items-center gap-x-1">
                    <div>
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="formData.page === 0 || formData.page === 1 ? 'bg-cyan-400' : ''"
                           @click="pageChange(1)">1</a>
                    </div>
                    <div v-if="current_page > 3">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           @click="pageChange(current_page - 2)">...</a>
                    </div>
                    <div v-if="current_page == buttons.length">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="formData.page === current_page - 2 ? 'bg-cyan-400' : ''"
                           @click="pageChange(current_page - 2)" v-text="current_page - 2"></a>
                    </div>
                    <div v-if="current_page > 2">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="formData.page === current_page - 1 ? 'bg-cyan-400' : ''"
                           @click="pageChange(current_page - 1)" v-text="current_page - 1"></a>
                    </div>
                    <div v-if="current_page != 1 && current_page != buttons.length">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="formData.page === current_page ? 'bg-cyan-400' : ''"
                           @click="pageChange(current_page)" v-text="current_page"></a>
                    </div>
                    <div v-if="current_page < buttons.length - 1">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="formData.page === current_page + 1 ? 'bg-cyan-400' : ''"
                           @click="pageChange(current_page + 1)" v-text="current_page + 1"></a>
                    </div>
                    <div v-if="current_page == 1">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="formData.page === current_page + 2 ? 'bg-cyan-400' : ''"
                           @click="pageChange(current_page + 2)" v-text="current_page + 2"></a>
                    </div>
                    <div v-if="current_page < buttons.length - 2">
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           @click="pageChange(current_page + 2)">...</a>
                    </div>
                    <div>
                        <a href="javascript:void(0)"
                           class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                           :class="{'bg-cyan-400': formData.page === last_page }"
                           @click="pageChange(buttons.length)" v-text="buttons.length"></a>
                    </div>
                </div>
                <div @click="NextPage()">
                    <a href="javascript:void(0)"
                       class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
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
