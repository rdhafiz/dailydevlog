@extends('user-panel.layout.layout')
@section('content')

    <div id="post">
        <section class="w-full">

            <div class="flex flex-wrap justify-between items-center px-3">
                <div class="w-full lg:w-1/3 py-3">
                    <!-- Search input -->
                    <input type="text" name="keyword" class="p-3 bg-transparent border-0 outline-0 border-b-cyan-400 border-b-2 w-full" required autocomplete="off" placeholder="Search Here" v-model="formData.keyword" @keyup="searchData()">
                </div>
                <div class="w-full lg:w-2/3 flex justify-end py-3">

                    <!-- New -->
                    <a :href="'/post/new'" class="outline-0 border-0 btn-theme w-[90px] rounded-lg">
                        New
                    </a>

                </div>
            </div>

            <div class="px-3" v-if="loading">
                <div class="w-full h-[100vh] flex justify-center items-center">
                    <span>
                        <svg class="h-[60px] mx-auto w-[60px] animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="px-3 mt-5" v-if="tableData.length === 0 && !loading">
                <div class="w-full overflow-hidden rounded-3xl h-[100vh] flex justify-center items-center border-2 border-cyan-500 flex-col">
                    <div class="text-sm mb-3 text-cyan-600 dark:text-gray-500 font-medium">
                        Do not have any data
                    </div>
                    <div class="font-medium text-cyan-600 dark:text-gray-500">Click “New +” to create new post.</div>
                </div>
            </div>

            <div class="px-3" v-if="tableData.length > 0 && !loading">
                <div class="w-full mt-10 border border-cyan-400 max-[1520px]:overflow-x-scroll">
                    <table class="w-[1510px]">

                        <!-- header -->
                        <thead class="w-full border-b-2 border-b-cyan-400 dark:bg-gray-800">
                            <tr>
                                <th class="w-[250px] p-3"> Title </th>
                                <th class="w-[250px] p-3"> Status </th>
                                <th class="w-[250px] p-3"> Views count </th>
                                <th class="w-[250px] p-3"> featured </th>
                                <th class="w-[250px] p-3"> comments access </th>
                                <th class="w-[250px] p-3"> Action </th>
                            </tr>
                        </thead>

                        <!-- list -->
                        <tbody>
                            <tr class="text-center" v-for="(each) in tableData">
                                <td class="w-[250px] p-3 text-start "> @{{each.title}} </td>
                                <td class="w-[250px] p-3"> @{{each.status}} </td>
                                <td class="w-[250px] p-3"> @{{each.views_count}} </td>
                                <td class="w-[250px] p-3"> @{{each.is_featured}} </td>
                                <td class="w-[250px] p-3"> @{{each.allow_comments}} </td>
                                <td class="w-[250px] p-3">
                                    <div class="relative inline-block text-left" id="action-menu">
                                        <div id="actionToggle" class="cursor-pointer" @click="actionDropdown(each.id)">
                                            <svg class="fill-black dark:fill-white w-[25px]" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path class="cls-1" d="M8,6.5A1.5,1.5,0,1,1,6.5,8,1.5,1.5,0,0,1,8,6.5ZM.5,8A1.5,1.5,0,1,0,2,6.5,1.5,1.5,0,0,0,.5,8Zm12,0A1.5,1.5,0,1,0,14,6.5,1.5,1.5,0,0,0,12.5,8Z"></path>
                                                </g>
                                            </svg>
                                        </div>
                                    <div class="hidden absolute right-0 z-10 mt-4 w-[150px] origin-top-right p-0 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded-md overflow-hidden"
                                        :id="'action-dropdown'+each.id">
                                            <div role="none">
                                                <a :href="'/post/'+each.id" class="cursor-pointer flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300">
                                                    Edit
                                                </a>
                                                <button type="button" @click="deletePost(each.id)" class="w-full cursor-pointer flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <!-- Pagination Start -->
                <div class="mt-5 flex justify-center items-center" v-if="tableData.length > 0 && loading === false">
                    <div class="flex justify-center items-center">
                        <div @click="PrevPage()">
                            <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-left undefined">
                                    <path
                                        d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>
                                </svg>
                            </a>
                        </div>
                        <div v-if="buttons.length <= 6">
                            <div v-for="(page, index) in buttons"
                                 :class="{'active': current_page == page}">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(page)" href="javascript:void(0)"
                                   v-text="page"></a>
                            </div>
                        </div>
                        <div v-if="buttons.length > 6">
                            <div  :class="{'active': current_page == 1}">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(1)"
                                   href="javascript:void(0)">1</a>
                            </div>

                            <div v-if="current_page > 3" >
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(current_page - 2)"
                                   href="javascript:void(0)">...</a>
                            </div>

                            <div v-if="current_page == buttons.length"
                                 :class="{'active': current_page == (current_page - 2)}">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(current_page - 2)"
                                   href="javascript:void(0)" v-text="current_page - 2"></a>
                            </div>

                            <div v-if="current_page > 2"
                                 :class="{'active': current_page == (current_page - 1)}">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(current_page - 1)"
                                   href="javascript:void(0)" v-text="current_page - 1"></a>
                            </div>

                            <div v-if="current_page != 1 && current_page != buttons.length" active">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(current_page)" href="javascript:void(0)"
                                   v-text="current_page"></a>
                            </div>

                            <div v-if="current_page < buttons.length - 1"
                                 :class="{'active': current_page == (current_page + 1)}">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(current_page + 1)"
                                   href="javascript:void(0)" v-text="current_page + 1"></a>
                            </div>

                            <div v-if="current_page == 1"
                                 :class="{'active': current_page == (current_page + 2)}">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(current_page + 2)"
                                   href="javascript:void(0)" v-text="current_page + 2"></a>
                            </div>

                            <div v-if="current_page < buttons.length - 2" >
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(current_page + 2)"
                                   href="javascript:void(0)">...</a>
                            </div>

                            <div  :class="{'active': current_page == (current_page - buttons.length)}">
                                <a class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center" @click="pageChange(buttons.length)"
                                   href="javascript:void(0)" v-text="buttons.length"></a>
                            </div>
                        </div>
                        <div  @click="NextPage()">
                            <a class="page-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined">
                                    <path
                                        d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>
                <!-- Pagination End -->

            </div>

        </section>
    </div>

    <script src="{{asset('/js/post.js')}}"></script>

@endsection
