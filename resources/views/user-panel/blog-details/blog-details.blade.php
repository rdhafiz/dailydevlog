@extends('user-panel.layout.layout')
@section('content')
    @php
        $date = new DateTime($post['published_at']);
        $formattedDate = $date->format('F j, Y');
    @endphp

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
                class="w-full text-3xl md:text-5xl font-bold !leading-normal bg-gradient-to-r from-cyan-400 to-green-400 text-transparent bg-clip-text">
                {{$post['title']}}
            </div>
            <div class="dark:text-gray-500 text-gray-400 mb-5">{{$formattedDate}}</div>
            @if($post['featured_image'] !== null)
                <img src="{{asset('/storage/media/').'/'.$post['featured_image']}}"
                     class="w-full h-350px lg:h-[550px] object-contain lg:object-cover rounded-2xl"
                     alt="blog-details">
            @else
                <img :src="'/images/default.png'"
                     class="w-full h-[350px] lg:h-[550px] object-contain lg:object-cover rounded-2xl"
                     alt="blog-details">
            @endif
            <div class="flex justify-center">
                <div class="w-full">
                    <div class="flex justify-between items-center mt-10 w-full flex-wrap gap-5">
                        <div class="flex items-center justify-start">
                            <img v-if="postParam?.author?.avatar !== null"
                                 :src="'/storage/media/'+postParam?.author?.avatar"
                                 class="w-[45px] h-[45px] rounded-full object-cover bg-cover" alt="avatar">
                            <div v-if="postParam?.author?.avatar === null"
                                 class="w-[45px] h-[45px] rounded-full flex justify-center items-center text-white bg-cyan-600">
                                @{{ nameControl(@json($post['author']['name'])) }}
                            </div>
                            <div class="ms-3">
                                <div class="font-bold text-gray-600 dark:text-cyan-600">
                                    {{$post['author']['name']}}
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
                            <a href="javascript:void(0)" @click="share('facebook')"
                               class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/facebook.svg')}}" class="w-[18px]"
                                     alt="facebook">
                            </a>
                            <a href="javascript:void(0)" @click="share('twitter')"
                               class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/twitter.svg')}}" class="w-[18px]" alt="twitter">
                            </a>
                            <a href="javascript:void(0)" @click="share('linkedin')"
                               class="h-8 w-8 rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-800 duration-500 flex items-center justify-center">
                                <img src="{{asset('/images/blog-details/linkedin.svg')}}" class="w-[18px]"
                                     alt="linkedin">
                            </a>
                        </div>
                    </div>
                    <div class="w-full my-10 font-semibold text-cyan-700">
                        <div id="content_description" class="w-full text-black dark:text-white content_description"
                             v-html="postParam?.content"></div>
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

                    @if(count($related_posts) > 0)
                        <div class="my-5 font-semibold text-gray-400 text-2xl lg:text-4xl">Related Blogs</div>
                        <div class="flex flex-wrap items-center">
                            @foreach($related_posts as $p)
                                <div class="w-full sm:w-full lg:w-1/2 2xl:w-1/3 p-3 flex">
                                    <div class="group bg-gray-100 rounded-2xl dark:bg-gray-800 w-full flex flex-col">
                                        <a href="'/blog-details/'.{{$p['id']}}"
                                           class="h-[250px] rounded-t-2xl overflow-hidden block">
                                            @if($p['featured_image'])
                                                <img src="{{asset('/storage/media/'.$p['featured_image'])}}"
                                                     class="w-full rounded-t-2xl object-cover h-[250px] scale-[1] group-hover:scale-[1.2] duration-500"
                                                     alt="blog">
                                            @else
                                                <img src="{{asset('/images/default.png')}}"
                                                     class="w-full rounded-t-2xl object-cover h-[300px] scale-[1] group-hover:scale-[1.2] duration-500"
                                                     alt="blog">
                                            @endif
                                        </a>
                                        <div class="px-4 grow flex flex-col justify-between">
                                            <div
                                                class="flex justify-between items-center gap-2 mb-1 text-gray-600 dark:text-gray-400 text-sm font-medium mt-3">

                                                @if(explode(",", $p['tags']) > 0)
                                                    <div class="w-[calc(100%-60px)]">
                                                        <div class="text-truncate w-[95%]">
                                                            @foreach(explode(",", $p['tags']) as $tag)
                                                                <span>#{{$tag}}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                <div
                                                    class="dark:text-gray-500 font-semibold text-gray-400 text-[12px] w-[60px] text-end grow-0">
                                                    {{ $p['views_count'] }} views
                                                </div>
                                            </div>
                                            <a href="/blog-details/{{$p['id']}}"
                                               class="text-[18px] block cursor-pointer font-bold transition-all leading-[1.2] duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-cyan-400 mt-2 mb-1 text-truncate-line-2">
                                                {{ $p['title'] }}
                                            </a>
                                            <div
                                                class="text-gray-600 dark:text-gray-400 text-truncate-line-3">
                                                {{ $p['short_description'] }}
                                            </div>

                                            <div class="flex justify-between items-center mt-2 mb-2">
                                                <div class="flex items-center justify-start">
                                                    @if($p['author']['avatar'] != null)
                                                        <img src="{{asset('/storage/media/'.$p['author']['avatar'])}}"
                                                             class="w-[30px] h-[30px] bg-cover object-cover rounded-full"
                                                             alt="avatar">
                                                    @else
                                                        <div
                                                            class="w-[30px] h-[30px] flex justify-center items-center bg-cyan-300 rounded-full font-bold dark:bg-cyan-500">
                                                            @{{ nameControl(@json($p['author']['name'])) }}
                                                        </div>
                                                    @endif
                                                    <div class="ms-3">
                                                        <div
                                                            class="font-bold text-gray-600 dark:text-cyan-600 text-[14px]">
                                                            {{ $p['author']['name'] }}
                                                        </div>
                                                        <div
                                                            class="dark:text-gray-500 font-semibold text-gray-400 text-[11px]">
                                                            {{ $p['created_at_format'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="/blog-details/{{$p['id']}}" class="decoration-0">
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
                            @endforeach
                        </div>
                    @endif

                    <div class="my-5 font-semibold text-gray-400 text-2xl lg:text-4xl">
                        Leave a comment
                    </div>
                    <div class="fb-comments w-full bg-gray-100 dark:text-white"
                         :data-href="encodeURI(window.location.href)" data-width="100%" data-numposts="5"></div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('/js/single-details.js')}}"></script>
@endsection
