@extends('user-panel.layout.layout')
@section('content')

    <div id="single-details">
        <section class="w-full px-5 md:px-[120px]">
            <div class="flex justify-start items-center gap-x-2 flex-wrap">
                <a href="javascript:void(0)"
                   class="decoration-0 text-gray-400 dark:text-cyan-600 flex justify-center items-center">
                    <div
                        class="w-[35px] h-[35px] p-0 rounded-full bg-gradient-to-r from-blue-600 to-green-300 flex justify-center items-center me-2">
                        <img src="{{asset('/images/blog-details/home.svg')}}" class="w-[18px]" alt="home">
                    </div>
                    Home
                </a>
                <img src="{{asset('/images/blog-details/chevron-dot-right.svg')}}" class="w-[22px] h-[22px]"
                     alt="chevron-dot-right.svg">
                <a href="javascript:void(0)" class="decoration-0 text-gray-400 dark:text-cyan-600">
                    Movie
                </a>
                <img src="{{asset('/images/blog-details/chevron-dot-right.svg')}}" class="w-[22px] h-[22px]"
                     alt="chevron-dot-right.svg">
                <a href="javascript:void(0)" class="decoration-0 text-gray-600 font-semibold dark:text-cyan-400">
                    @{{ this.postParam?.title }}
                </a>
            </div>
            <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
        </section>

        <section class="w-full py-10 px-5 md:px-[120px]">
            <div class="text-center flex justify-center mb-5">
                <div
                    class="w-full lg:w-2/4 text-5xl font-bold leading-normal bg-gradient-to-r from-blue-600 to-green-400 inline-block text-transparent bg-clip-text">
                    @{{ this.postParam?.title }}
                </div>
            </div>
            <img :src="'/storage/media/'+this.postParam?.featured_image" v-if="this.postParam.featured_image !== null" class="w-full h-[350px] lg:h-[550px] bg-cover object-cover rounded-2xl"
                 alt="blog-details">
            <div class="flex justify-center">
                <div class="w-full lg:w-2/3">
                    <div class="flex justify-between items-center mt-10 w-full flex-wrap gap-5">
                        <div class="flex items-center justify-start">
                            <img v-if="this.postParam?.author?.avatar !== null" :src="'/storage/media/'+this.postParam?.author?.avatar" class="w-[45px] h-[45px] rounded-full object-cover bg-cover" alt="avatar">
                            <div v-if="this.postParam?.author?.avatar === null" class="w-[45px] h-[45px] rounded-full flex justify-center items-center bg-cyan-600">
                                @{{ nameControl(this.postParam?.author?.name) }}
                            </div>
                            <div class="ms-3">
                                <div class="font-bold text-gray-600 dark:text-cyan-600">
                                    @{{ this.postParam?.author?.name }}
                                </div>
                                <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                    @{{ this.postParam?.created_at_format }}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-x-5">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                Share
                            </div>
                            <img src="{{asset('/images/blog-details/facebook.svg')}}" class="w-[18px]" alt="facebook">
                            <img src="{{asset('/images/blog-details/twitter.svg')}}" class="w-[18px]" alt="twitter">
                            <img src="{{asset('/images/blog-details/linkedin.svg')}}" class="w-[18px]" alt="linkedin">
                        </div>
                    </div>
                    <div class="my-10 font-semibold text-cyan-700">
                        @{{ this.postParam?.content }}
                    </div>
                    <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
                    <div class="flex justify-start flex-wrap gap-3">
                        <span v-for="each in this.postParam.categories">
                            <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                                @{{ each.name }}
                            </button>
                        </span>
                    </div>
                    <div class="my-10 font-semibold text-gray-400 text-4xl">
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
