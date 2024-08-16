@extends('user-panel.layout.layout')
@section('content')

    <div id="single-details">
        <section class="w-full px-5 md:px-[120px]">
            <div class="flex justify-start items-center gap-x-2 flex-wrap">
                <a href="{{route('user.panel.home')}}"
                   class="decoration-0 text-gray-400 dark:text-cyan-600 flex justify-center items-center">
                    Home
                </a>
                <img src="{{asset('/images/blog-details/chevron-dot-right.svg')}}" class="w-[22px] h-[22px]"
                     alt="chevron-dot-right.svg">
                <a href="javascript:void(0)" class="decoration-0 text-gray-600 font-semibold dark:text-cyan-400">
                    @{{ postParam?.title }}
                </a>
            </div>
            <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
        </section>

        <section class="w-full py-10 px-5 md:px-[120px]">
            <div
                class="w-full text-xl md:text-3xl font-bold leading-normal bg-gradient-to-r from-cyan-400 to-green-400 text-transparent bg-clip-text mb-5">
                @{{ postParam?.title }}
            </div>
            <img :src="'/storage/media/'+postParam?.featured_image" v-if="postParam.featured_image !== null" class="w-full h-[350px] lg:h-[550px] bg-cover object-cover rounded-2xl"
                 alt="blog-details">
            <img :src="'/images/default.png'" v-if="postParam.featured_image == null" class="w-full h-[350px] lg:h-[550px] bg-cover object-cover rounded-2xl"
                 alt="blog-details">
            <div class="flex justify-center">
                <div class="w-full">
                    <div class="flex justify-between items-center mt-10 w-full flex-wrap gap-5">
                        <div class="flex items-center justify-start">
                            <img v-if="postParam?.author?.avatar !== null" :src="'/storage/media/'+postParam?.author?.avatar" class="w-[45px] h-[45px] rounded-full object-cover bg-cover" alt="avatar">
                            <div v-if="postParam?.author?.avatar === null" class="w-[45px] h-[45px] rounded-full flex justify-center items-center text-white bg-cyan-600">
                                @{{ nameControl(postParam?.author?.name) }}
                            </div>
                            <div class="ms-3">
                                <div class="font-bold text-gray-600 dark:text-cyan-600">
                                    @{{ postParam?.author?.name }}
                                </div>
                                <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                    @{{ postParam?.created_at_format }}
                                </div>
                                <div class="text-sm dark:text-gray-500 font-semibold text-gray-400 text-sm">
                                    @{{ postParam?.views_count }} views
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-x-2">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                Share
                            </div>
                            <a href="https://www.facebook.com" target="_blank" class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/facebook.svg')}}" class="w-[18px]" alt="facebook">
                            </a>
                            <a href="https://x.com" target="_blank" class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/twitter.svg')}}" class="w-[18px]" alt="twitter">
                            </a>
                            <a href="https://www.linkedin.com" target="_blank" class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/linkedin.svg')}}" class="w-[18px]" alt="linkedin">
                            </a>
                        </div>
                    </div>
                    <div class="w-full my-10 font-semibold text-cyan-700">
                        <div id="content_description" class="w-full text-black dark:text-white content_description" v-html="postParam?.content"></div>
                    </div>
                    <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
                    <div
                        class="text-gray-600 dark:text-gray-400 text-sm font-medium">
                        <div class="flex items-center gap-2 me-3 grow"
                             v-if="postParam?.tags?.length > 0">
                            <span v-for="(tag, index) in postParam?.tags">#@{{ tag }}</span>
                        </div>
                    </div>
                    <div class="my-5 font-semibold text-gray-400 text-4xl">
                        Leave a comment
                    </div>
                    <a href="javascript:void(0)" class="text-gray-400 decoration-0">
                        You must be <a href="{{route('user.panel.login')}}" class="text-cyan-400"> logged in </a> to post a comment.
                    </a>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('/js/single-details.js')}}"></script>
@endsection
