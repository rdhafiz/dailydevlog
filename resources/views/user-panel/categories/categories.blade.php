@extends('user-panel.layout.layout')
@section('content')

    <div id="categories">
        <section class="w-full">

            <div class="w-full flex justify-between flex-wrap sm:flex-nowrap items-center px-3 gap-2 sm:gap-5">
                <div class="w-full lg:w-1/3 py-2 sm:py-3">
                    <!-- Search input -->
                    <input type="text" name="keyword"
                           class="p-3 bg-transparent border-0 outline-0 border-b-cyan-400 border-b-2 w-full" required
                           autocomplete="off" placeholder="Search Here" v-model="formData.keyword"
                           @keyup="searchData()">
                </div>
                <div class="from-group w-full lg:w-1/3">
                    <select name="order"
                            class="p-3 bg-transparent border-0 outline-0 border-b-cyan-400 border-b-2 w-full lg:w-1/2"
                            v-model="formData.sort_mode" @change="searchData()">
                        <option :value="''" class="text-black">Order</option>
                        <option :value="'asc'" class="text-black">Ascending</option>
                        <option :value="'desc'" class="text-black">Descending</option>
                    </select>
                </div>
                <div class="w-full lg:w-1/3 flex justify-end py-3">

                    <!-- New -->
                    <a :href="'/categories/new'" class="outline-0 border-0 btn-theme w-[120px] rounded-lg">
                        New Category
                    </a>

                </div>
            </div>

            <div class="px-3" v-if="loading">
                <div class="w-full min-h-[500px] flex justify-center items-center">
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

            <div class="px-3 mt-5" v-if="tableData.length === 0 && !loading">
                <div
                    class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                    <div class="text-sm mb-3 text-cyan-600 dark:text-gray-500 font-medium">
                        Do not have any category
                    </div>
                    <div class="font-medium text-cyan-600 dark:text-gray-500">Click “New” to create a category.</div>
                </div>
            </div>

            <div class="px-3 min-h-[500px]" v-if="tableData.length > 0 && !loading">
                <div class="w-full mt-10 max-[768px]:overflow-x-scroll">
                    <div
                        class="group bg-gray-100 rounded-2xl dark:bg-gray-800 w-full py-3 px-4 rounded-lg mb-3 flex items-center justify-between min-w-[744px]"
                        v-for="(each, index) in tableData">
                        <div class="grow-0">
                            <img :src="'/storage/media/'+each?.icon"
                                 class="wounded-t-2xl  object-cover w-[100px] min-w-[100px] h-[60px]"
                                 alt="blog" v-if="each?.icon">
                            <img :src="'/images/default.png/'"
                                 class="rounded-t-2xl object-cover w-[100px] min-w-[100px] h-[60px]"
                                 alt="blog" v-if="!each?.icon">
                        </div>
                        <div class="grow text-start mx-8">
                            <div
                                class="font-bold text-lg dark:text-cyan-600 duration-500 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-cyan-400 text-truncate-line-2">
                                @{{ each.name }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1 grow-0">
                            <a :href="'/categories/'+each.id"
                               class="h-8 w-8 flex items-center justify-center rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-600 duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"
                                     fill="none">
                                    <g id="Edit / Edit_Pencil_01">
                                        <path id="Vector"
                                              d="M12 8.00012L4 16.0001V20.0001L8 20.0001L16 12.0001M12 8.00012L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L16 12.0001M12 8.00012L16 12.0001"
                                              stroke="#000000" class="stroke-gray-600 dark:stroke-gray-400" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </g>
                                </svg>
                            </a>
                            <button type="button" @click="deleteCategory(each, index)" v-if="each.deleteLoading == false"
                                    class="h-8 w-8 flex items-center justify-center rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-600 duration-500">
                                <svg viewBox="0 0 24 24" class="w-[20px] h-[20px]" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                       stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M10 11V17" class="stroke-gray-600 dark:stroke-gray-400"
                                              stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M14 11V17" class="stroke-gray-600 dark:stroke-gray-400"
                                              stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M4 7H20" class="stroke-gray-600 dark:stroke-gray-400" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path
                                            d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                            class="stroke-gray-600 dark:stroke-gray-400" stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                            class="stroke-gray-600 dark:stroke-gray-400" stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </button>
                            <button type="button" disabled v-if="each.deleteLoading == true"
                                    class="h-8 w-8 flex items-center justify-center">
                                <svg class="h-4 mx-auto w-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="#fff"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75 fill-black dark:fill-white" fill="#fff"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pagination Start -->

                <div class="mt-5 flex justify-center items-center"
                     v-if="tableData.length > 0 && loading === false && last_page > 1">
                    <div class="flex justify-center items-center gap-x-1">
                        <div @click="PrevPage()">
                            <a href="javascript:void(0)"
                               class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"
                                     fill="none"
                                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round"
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

            <div class="fixed top-0 end-0 p-10 z-50" v-if="msg">
                <div class="px-10 py-5 text-end bg-gradient-to-r from-cyan-500 to-cyan-700 rounded-2xl">
                    @{{msg}}
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('/js/categories.js')}}"></script>

@endsection
