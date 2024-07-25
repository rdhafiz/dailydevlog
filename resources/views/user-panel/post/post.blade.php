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

            <div class="px-3" v-if="tableData.length === 0 && !loading">
                <div class="w-full h-[100vh] flex justify-center items-center text-gray-400">
                    Do not have any data
                </div>
            </div>

            <div class="px-3" v-if="tableData.length > 0 && !loading">
                <div class="w-full mt-10 border border-cyan-400 max-[1520px]:overflow-x-scroll">
                    <table class="w-[1510px]">

                        <!-- header -->
                        <thead class="w-full border-b-2 border-b-cyan-400">
                            <tr>
                                <th class="w-[250px] py-3"> Image </th>
                                <th class="w-[250px] py-3"> Title </th>
                                <th class="w-[250px] py-3"> Slug </th>
                                <th class="w-[250px] py-3"> Content </th>
                                <th class="w-[250px] py-3"> Status </th>
                                <th class="w-[250px] py-3"> Views count </th>
                                <th class="w-[250px] py-3"> featured </th>
                                <th class="w-[250px] py-3"> comments access </th>
                                <th class="w-[250px] py-3"> Action </th>
                            </tr>
                        </thead>

                        <!-- list -->
                        <tbody>
                            <tr class="text-center" v-for="(each) in tableData">
                                <td class="w-[250px] py-3"> <span v-if="each.featured_image === null"> No Image </span> <span v-if="each.featured_image !== null"> exist image </span> </td>
                                <td class="w-[250px] py-3 text-start "> @{{each.title}} </td>
                                <td class="w-[250px] py-3"> @{{each.slug}} </td>
                                <td class="w-[250px] py-3 text-start "> @{{each.content}} </td>
                                <td class="w-[250px] py-3"> @{{each.status}} </td>
                                <td class="w-[250px] py-3"> @{{each.views_count}} </td>
                                <td class="w-[250px] py-3"> @{{each.is_featured}} </td>
                                <td class="w-[250px] py-3"> @{{each.allow_comments}} </td>
                                <td class="w-[250px] py-3"> 
                                <div class="relative inline-block text-left" id="action-menu">
                                    <div id="actionToggle" @click="actionDropdown">
                                        action
                                    </div>
                                <div class="hidden absolute right-0 z-10 mt-4 w-[150px] origin-top-right p-0 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded-md overflow-hidden"
                                    id="action-dropdown">
                                        <div role="none">
                                            <a :href="'/post/'+each.id" class="cursor-pointer flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300">
                                                Edit
                                            </a>
                                            <button type="button" @click="deletePost(each.id)" class="w-full cursor-pointer flex justify-start p-3 transition duration-500 text-cyan-500 hover:bg-gray-300">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>    
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>


                        <!-- pagination -->
                        <div class="mt-5">
                            <ul class="flex justify-center items-center">
                                <li>
                                    <button type="button" class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center">
                                        1
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center">
                                        2
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center">
                                        3
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center">
                                        4
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="p-3 border border-cyan-400 outline-0 w-[45px] h-[45px] flex justify-center items-center">
                                        5
                                    </button>
                                </li>
                            </ul>
                        </div>

            </div>

        </section>
    </div>

    <script src="{{asset('/js/post.js')}}"></script>

@endsection