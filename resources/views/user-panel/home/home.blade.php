@extends('user-panel.layout.layout')
@section('content')

    <div id="home">

        <div class="w-full" v-if="tableData.length === 0 && !loading">
            <div class="w-full overflow-hidden rounded-3xl h-[100vh] flex justify-center items-center border-2 border-cyan-500 flex-col">
                <div class="text-sm mb-3 text-cyan-600 dark:text-gray-700 font-medium">
                    Do not have any data
                </div>
                <div class="font-medium text-cyan-600 dark:text-gray-700">Click “New +” to create new post.</div>
            </div>
        </div>

        <div class="flex flex-wrap" v-if="tableData.length > 0 && !loading">
            <div class="w-full sm:w-full md:w-1/2 lg:w-1/3 p-2" v-for="(each) in tableData">
                <div class="border dark:border-gray-500 p-5 rounded-2xl group bg-gray-100 dark:bg-gray-800">
                    <img :src="'/storage/media/'+each?.featured_image" class="bg-cover w-full rounded-2xl object-cover h-[350px]"
                         alt="blog">
                    <div
                        class="flex justify-between items-center mt-5 text-gray-600 dark:text-gray-400 text-sm font-medium">
                        <div>
                            #Business #Food #Interior
                        </div>
                        <div>
                            views @{{ each.views_count }}
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

    </div>

    <script src="{{asset('/js/home.js')}}"></script>

@endsection
