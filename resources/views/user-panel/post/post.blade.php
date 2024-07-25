@extends('user-panel.layout.layout')
@section('content')

    <div id="post">
        <section class="w-full">

            <div class="flex flex-wrap justify-between items-center px-3">
                <div class="w-full lg:w-1/3 py-3">
                    <!-- Search input -->
                    <input type="text" name="keyword"
                           class="p-3 bg-transparent border-0 outline-0 border-b-cyan-400 border-b-2 w-full" required
                           autocomplete="off" placeholder="Search Here" v-model="formData.keyword"
                           @keyup="searchData()">
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
                    class="w-full overflow-hidden rounded-3xl h-[100vh] flex justify-center items-center border-2 border-cyan-500 flex-col">
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
                                <th class="w-[250px] p-3 text-start">
                                    Title
                                </th>
                                <th class="w-[250px] p-3 text-start">
                                    Status
                                </th>
                                <th class="w-[250px] p-3 text-start">
                                    Views count
                                </th>
                                <th class="w-[250px] p-3 text-start">
                                    featured
                                </th>
                                <th class="w-[250px] p-3 text-start">
                                    comments access
                                </th>
                                <th class="w-[250px] p-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <!-- list -->
                        <tbody>
                            <tr class="text-center" v-for="(each) in tableData">
                                <td class="w-[250px] p-3 text-start">
                                    @{{each.title}}
                                </td>
                                <td class="w-[250px] p-3 text-start">
                                    @{{each.status}}
                                </td>
                                <td class="w-[250px] p-3 text-start">
                                    @{{each.views_count}}
                                </td>
                                <td class="w-[250px] p-3 text-start">
                                    @{{each.is_featured}}
                                </td>
                                <td class="w-[250px] p-3 text-start">
                                    @{{each.allow_comments}}
                                </td>
                                <td class="w-[250px] p-3">
                                    <div class="flex justify-center gap-x-5 items-center">
                                        <a :href="'/blog-details/'+each.id" class="duration-500 bg-emerald-400 hover:bg-emerald-600 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                                            <svg viewBox="0 0 24 24" class="w-[20px] h-[20px]" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                   stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M6.30147 15.5771C4.77832 14.2684 3.6904 12.7726 3.18002 12C3.6904 11.2274 4.77832 9.73158 6.30147 8.42294C7.87402 7.07185 9.81574 6 12 6C14.1843 6 16.1261 7.07185 17.6986 8.42294C19.2218 9.73158 20.3097 11.2274 20.8201 12C20.3097 12.7726 19.2218 14.2684 17.6986 15.5771C16.1261 16.9282 14.1843 18 12 18C9.81574 18 7.87402 16.9282 6.30147 15.5771ZM12 4C9.14754 4 6.75717 5.39462 4.99812 6.90595C3.23268 8.42276 2.00757 10.1376 1.46387 10.9698C1.05306 11.5985 1.05306 12.4015 1.46387 13.0302C2.00757 13.8624 3.23268 15.5772 4.99812 17.0941C6.75717 18.6054 9.14754 20 12 20C14.8525 20 17.2429 18.6054 19.002 17.0941C20.7674 15.5772 21.9925 13.8624 22.5362 13.0302C22.947 12.4015 22.947 11.5985 22.5362 10.9698C21.9925 10.1376 20.7674 8.42276 19.002 6.90595C17.2429 5.39462 14.8525 4 12 4ZM10 12C10 10.8954 10.8955 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8955 14 10 13.1046 10 12ZM12 8C9.7909 8 8.00004 9.79086 8.00004 12C8.00004 14.2091 9.7909 16 12 16C14.2092 16 16 14.2091 16 12C16 9.79086 14.2092 8 12 8Z"
                                                          class="stroke-white"></path>
                                                </g>
                                            </svg>
                                        </a>
                                        <a :href="'/post/'+each.id" class="duration-500 bg-cyan-600 hover:bg-cyan-800 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                                            <svg viewBox="0 0 24 24" class="w-[20px] h-[20px]" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                   stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M11 4H7.2C6.0799 4 5.51984 4 5.09202 4.21799C4.71569 4.40974 4.40973 4.7157 4.21799 5.09202C4 5.51985 4 6.0799 4 7.2V16.8C4 17.9201 4 18.4802 4.21799 18.908C4.40973 19.2843 4.71569 19.5903 5.09202 19.782C5.51984 20 6.0799 20 7.2 20H16.8C17.9201 20 18.4802 20 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V12.5M15.5 5.5L18.3284 8.32843M10.7627 10.2373L17.411 3.58902C18.192 2.80797 19.4584 2.80797 20.2394 3.58902C21.0205 4.37007 21.0205 5.6364 20.2394 6.41745L13.3774 13.2794C12.6158 14.0411 12.235 14.4219 11.8012 14.7247C11.4162 14.9936 11.0009 15.2162 10.564 15.3882C10.0717 15.582 9.54378 15.6885 8.48793 15.9016L8 16L8.04745 15.6678C8.21536 14.4925 8.29932 13.9048 8.49029 13.3561C8.65975 12.8692 8.89125 12.4063 9.17906 11.9786C9.50341 11.4966 9.92319 11.0768 10.7627 10.2373Z"
                                                        class="stroke-white" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </a>
                                        <button type="button"
                                                class="outline-0 border-0 flex justify-center items-center duration-500 bg-red-500 hover:bg-red-800 w-[35px] h-[35px] rounded-lg"
                                                @click="deletePost(each.id)">
                                            <svg viewBox="0 0 24 24" class="w-[20px] h-[20px]" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                   stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M10 11V17" class="stroke-white" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14 11V17" class="stroke-white" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4 7H20" class="stroke-white" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path
                                                        d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                                        class="stroke-white" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                        class="stroke-white" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <!-- Pagination Start -->
                <div class="mt-5 flex justify-center items-center" v-if="tableData.length > 0 && loading === false">
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
        </section>
    </div>

    <script src="{{asset('/js/post.js')}}"></script>

@endsection
