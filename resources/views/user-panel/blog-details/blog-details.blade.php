@extends('user-panel.layout.layout')
@section('content')

    <div id="single-details">
{{--        <section class="w-full px-5 md:px-[120px]">
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
        </section>--}}

        <section class="w-full lg:py-10 px-5 lg:px-[120px]">
            <div
                class="w-full text-3xl md:text-5xl font-bold !leading-normal bg-gradient-to-r from-cyan-400 to-green-400 text-transparent bg-clip-text mb-5">
                {{$post['title']}}
            </div>
            @if($post['featured_image'] !== null)
                <img src="{{asset('/storage/media/').'/'.$post['featured_image']}}" class="w-full h-350px lg:h-[550px] object-contain lg:object-cover rounded-2xl"
                     alt="blog-details">
            @else
                <img :src="'/images/default.png'" class="w-full h-[350px] lg:h-[550px] object-contain lg:object-cover rounded-2xl"
                     alt="blog-details">
            @endif
            <div class="flex justify-center">
                <div class="w-full">
                    <div class="flex justify-between items-center mt-10 w-full flex-wrap gap-5">
                        <div class="flex items-center justify-start">
                            <img v-if="postParam?.author?.avatar !== null" :src="'/storage/media/'+postParam?.author?.avatar" class="w-[45px] h-[45px] rounded-full object-cover bg-cover" alt="avatar">
                            <div v-if="postParam?.author?.avatar === null" class="w-[45px] h-[45px] rounded-full flex justify-center items-center text-white bg-cyan-600">
                                @{{ nameControl(@json($post['author']['name'])) }}
                            </div>
                            <div class="ms-3">
                                <div class="font-bold text-gray-600 dark:text-cyan-600">
                                    {{$post['author']['name']}}
                                </div>
                                <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                    {{$post['author']['created_at_format']}}
                                </div>
                                <div class="text-sm dark:text-gray-500 font-semibold text-gray-400 text-sm">
                                    {{$post['views_count']}} views
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-x-2">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                Share
                            </div>
                            <a href="javascript:void(0)" @click="share('facebook')" class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/facebook.svg')}}" class="w-[18px]" alt="facebook">
                            </a>
                            <a href="javascript:void(0)" @click="share('twitter')" class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/twitter.svg')}}" class="w-[18px]" alt="twitter">
                            </a>
                            <a href="javascript:void(0)" @click="share('linkedin')" class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
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
                            @foreach(explode(",", $post['tags']) as $tag)
                            <span>#{{$tag}}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="my-5 font-semibold text-gray-400 text-2xl lg:text-4xl">
                        Leave a comment
                    </div>
                    <div class="fb-comments w-full bg-gray-100 dark:text-white" :data-href="encodeURI(window.location.href)" data-width="100%" data-numposts="5"></div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('/js/single-details.js')}}"></script>
@endsection
