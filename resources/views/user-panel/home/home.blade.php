@extends('user-panel.layout.layout')
@section('content')
    @php
        $date = function ($publishDate){
            $date = new DateTime($publishDate);
           $formattedDate = $date->format('F j, Y');
           return $formattedDate;
        }
    @endphp
    <div id="home">
        {{-- <div class="w-full px-4 mt-5" v-if="tableData.length === 0 && !loading">
             <div
                 class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                 <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">No featured blog has found.</div>
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

         <div class="mt-5" v-if="tableData.length > 0 && !loading">
             <div class="flex mb-3 items-center">
                 <div
                     class="w-full text-3xl lg:text-4xl px-3 font-bold !leading-normal bg-gradient-to-r from-cyan-400 to-green-400 text-transparent bg-clip-text">
                     Featured
                 </div>

                 <a href="javascript:void(0)" class="text-cyan-400 w-[120px] font-medium" @click="searchData">
                     View More
                 </a>
             </div>
             <div class="flex flex-wrap">
                 <div class="w-full p-3 flex" :class="{'lg:w-1/2 xl:w-2/3': index == 1, 'lg:w-1/2 xl:w-1/3': index == 2}"
                      v-for="(each, index) in tableData">
                     <div class="group bg-gray-100 rounded-2xl dark:bg-gray-800 w-full flex flex-col">
                         <a :href="'/blog-details/'+each.id" class="rounded-t-2xl overflow-hidden block"
                              :class="{'h-[340px]': index == 0, 'h-[250px]': index == 1 || index == 2}">
                             <img :src="'/storage/media/'+each?.featured_image"
                                  class="w-full rounded-t-2xl object-cover h-full scale-[1] group-hover:scale-[1.2] duration-500"
                                  alt="blog" v-if="each?.featured_image">
                             <img :src="'/images/default.png/'"
                                  class="w-full rounded-t-2xlobject-cover h-full scale-[1] group-hover:scale-[1.2] duration-500"
                                  alt="blog" v-if="!each?.featured_image">
                         </a>
                         <div class="px-4 flex flex-col justify-between grow">
                             <div
                                 class="flex justify-between items-center gap-2 mb-1 text-gray-600 dark:text-gray-400 text-sm font-medium mt-3">
                                 <div class="w-[calc(100%-60px)]" v-if="each?.tags?.length > 0">
                                     <div class="text-truncate w-[95%]">
                                         <template v-for="(tag, index) in each?.tags">#@{{ tag }}&nbsp;</template>
                                     </div>
                                 </div>
                                 <div
                                     class="dark:text-gray-500 font-semibold text-gray-400 text-[12px] w-[60px] text-end grow-0">
                                     @{{ each.views_count }} views
                                 </div>
                             </div>
                             <a :href="'/blog-details/'+each.id"
                                 class="text-[18px] block cursor-pointer font-bold transition-all leading-[1.2] duration-500 dark:text-cyan-600 dark:group-hover:text-cyan-400 text-gray-600 group-hover:text-cyan-400 my-2 text-truncate-line-2">
                                 @{{ each.title }}
                             </a>
                             <div
                                 class="text-gray-600 dark:text-gray-400 text-truncate-line-3">
                                 @{{ each.short_description }}
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
         </div>--}}

        <div class="mt-[85px]">
            <div class="text-center text-secondary dark:text-white text-[30px] font-bold mb-[15px] leading-[45px]">
                Featured Articles
            </div>
            @if(count($featured_posts) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 min-[917px]:grid-cols-3 gap-[15px]">
                    @foreach($featured_posts as $index => $p)
                        <div
                            class="{{$index === 0 ? 'sm:col-span-2 block sm:grid sm:grid-cols-2 sm:gap-[15px]' : 'col-span-1 lg:col-span-1 flex flex-col'}} group rounded-2xl bg-white dark:bg-[#222222] shadow-lg sm:h-[289px]">
                            <a href=""
                               class="{{$index === 0 ? 'sm:col-span-1 h-[120px] sm:h-[289px] w-full' : 'h-[120px]'}} block rounded-2xl overflow-hidden min-h-[120px]">
                                @if($p['featured_image'])
                                    <img src="{{asset('/storage/media/' .$p['featured_image'])}}"
                                         class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                         alt="blog image">
                                @else
                                    <img src="{{asset('/images/default.png')}}"
                                         class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                         alt="blog image">
                                @endif
                            </a>
                            <div
                                class="grow flex flex-col gap-0 justify-between overflow-auto {{$index === 0 ? 'sm:col-span-1 text-center sm:text-left pr-[6px] pt-[15px] pb-2' : 'px-2 pt-2 pb-1 text-center'}}">
                                <div class="overflow-auto">
                                    <a href=""
                                       class="text-secondary dark:text-white block font-bold text-lg leading-[24px] dark:hover:text-second hover:text-second duration-500 text-truncate-line-2">
                                        {{$p['title']}}
                                    </a>
                                    <div
                                        class="flex flex-wrap items-center {{$index === 0 ? 'justify-center sm:justify-start' : 'justify-center'}} gap-[3px] pt-1 pb-[12px] text-xs">
                                        @foreach(collect(explode(",", $p['tags']))->take(4) as $i => $tag)
                                            <div
                                                class="{{$i === 0 ? 'bg-primary' : '' }} {{$i === 1 ? 'bg-first' : '' }} {{$i === 2 ? 'bg-dark3' : '' }} {{$i === 3 ? 'bg-red' : '' }}  {{$i === 1 ? 'text-secondary' : 'text-white' }} rounded-2xl text-[7px] leading-[14px] h-[14px] text-center w-[50px] capitalize">{{$tag}}</div>
                                        @endforeach
                                    </div>
                                    <div
                                        class="text-[9px] leading-[13.5px] text-black dark:!text-light2 {{$index === 0 ? 'text-truncate-line-9 whitespace-pre-line' : 'text-truncate-line-4'}}">
                                        <p>{{$p['short_description']}}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center {{$index === 0 ? 'justify-center sm:justify-start' : 'justify-center'}} text-secondary dark:!text-light2 text-[8px] leading-[12px] mt-[12px] gap-3">
                                    <span>{{$date($p['publish_date'])}}</span>
                                    <span>•</span>
                                    <span>3m Read</span>
                                    <span>•</span>
                                    <span>{{$p['views_count']}} Views</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>


                <div class="mt-[18px]">
                    <img src="{{asset('/images/ad-light.svg')}}" class="w-full block dark:hidden" alt="google ads">
                    <img src="{{asset('/images/ad.svg')}}" class="w-full hidden dark:block" alt="google ads">
                </div>
            @else
                <div
                    class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                    <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">No featured blog has found.</div>
                </div>
            @endif
        </div>
        <div class="mt-5">
            <div class="text-center text-secondary dark:text-white text-[30px] font-bold mb-[15px] leading-[45px]">
                Latest Articles
            </div>
            @if(count($latest_posts) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 min-[917px]:grid-cols-3 gap-[15px]">
                    @foreach($latest_posts as $index => $p)
                        <div
                            class="{{$index === 0 ? 'sm:col-span-2 block sm:grid sm:grid-cols-2 sm:gap-[15px]' : 'col-span-1 lg:col-span-1 flex flex-col'}} group rounded-2xl bg-white dark:bg-[#222222] shadow-lg sm:h-[289px]">
                            <a href=""
                               class="{{$index === 0 ? 'sm:col-span-1 h-[120px] sm:h-[289px] w-full' : 'h-[120px]'}} block rounded-2xl overflow-hidden min-h-[120px]">
                                @if($p['featured_image'])
                                    <img src="{{asset('/storage/media/' .$p['featured_image'])}}"
                                         class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                         alt="blog image">
                                @else
                                    <img src="{{asset('/images/default.png')}}"
                                         class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                         alt="blog image">
                                @endif
                            </a>
                            <div
                                class="grow flex flex-col gap-0 justify-between overflow-auto {{$index === 0 ? 'sm:col-span-1 text-center sm:text-left pr-[6px] pt-[15px] pb-2' : 'px-2 pt-2 pb-1 text-center'}}">
                                <div class="overflow-auto">
                                    <a href=""
                                       class="text-secondary dark:text-white block font-bold text-lg leading-[24px] dark:hover:text-second hover:text-second duration-500 text-truncate-line-2">
                                        {{$p['title']}}
                                    </a>
                                    <div
                                        class="flex flex-wrap items-center {{$index === 0 ? 'justify-center sm:justify-start' : 'justify-center'}} gap-[3px] pt-1 pb-[12px] text-xs">
                                        @foreach(collect(explode(",", $p['tags']))->take(4) as $i => $tag)
                                            <div
                                                class="{{$i === 0 ? 'bg-primary' : '' }} {{$i === 1 ? 'bg-first' : '' }} {{$i === 2 ? 'bg-dark3' : '' }} {{$i === 3 ? 'bg-red' : '' }}  {{$i === 1 ? 'text-secondary' : 'text-white' }} rounded-2xl text-[7px] leading-[14px] h-[14px] text-center w-[50px] capitalize">{{$tag}}</div>
                                        @endforeach
                                    </div>
                                    <div
                                        class="text-[9px] leading-[13.5px] text-black dark:!text-light2 {{$index === 0 ? 'text-truncate-line-9 whitespace-pre-line' : 'text-truncate-line-4'}}">
                                        <p>{{$p['short_description']}}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center {{$index === 0 ? 'justify-center sm:justify-start' : 'justify-center'}} text-secondary dark:!text-light2 text-[8px] leading-[12px] mt-[12px] gap-3">
                                    <span>{{$date($p['publish_date'])}}</span>
                                    <span>•</span>
                                    <span>3m Read</span>
                                    <span>•</span>
                                    <span>{{$p['views_count']}} Views</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>


                <div class="mt-[18px]">
                    <img src="{{asset('/images/ad-light.svg')}}" class="w-full block dark:hidden" alt="google ads">
                    <img src="{{asset('/images/ad.svg')}}" class="w-full hidden dark:block" alt="google ads">
                </div>
            @else
                <div
                    class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                    <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">No blog has found.</div>
                </div>
            @endif
        </div>
        <div class="mt-5">
            <div class="text-center text-secondary dark:text-white text-[30px] font-bold mb-[15px] leading-[45px]">Most
                Viewed
            </div>
            @if(count($most_viewed_posts) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 min-[917px]:grid-cols-3 gap-[15px]">
                    @foreach($most_viewed_posts as $index => $p)
                        <div
                            class="{{$index === 0 ? 'sm:col-span-2 block sm:grid sm:grid-cols-2 sm:gap-[15px]' : 'col-span-1 lg:col-span-1 flex flex-col'}} group rounded-2xl bg-white dark:bg-[#222222] shadow-lg sm:h-[289px]">
                            <a href=""
                               class="{{$index === 0 ? 'sm:col-span-1 h-[120px] sm:h-[289px] w-full' : 'h-[120px]'}} block rounded-2xl overflow-hidden min-h-[120px]">
                                @if($p['featured_image'])
                                    <img src="{{asset('/storage/media/' .$p['featured_image'])}}"
                                         class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                         alt="blog image">
                                @else
                                    <img src="{{asset('/images/default.png')}}"
                                         class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                         alt="blog image">
                                @endif
                            </a>
                            <div
                                class="grow flex flex-col gap-0 justify-between overflow-auto {{$index === 0 ? 'sm:col-span-1 text-center sm:text-left pr-[6px] pt-[15px] pb-2' : 'px-2 pt-2 pb-1 text-center'}}">
                                <div class="overflow-auto">
                                    <a href=""
                                       class="text-secondary dark:text-white block font-bold text-lg leading-[24px] dark:hover:text-second hover:text-second duration-500 text-truncate-line-2">
                                        {{$p['title']}}
                                    </a>
                                    <div
                                        class="flex flex-wrap items-center {{$index === 0 ? 'justify-center sm:justify-start' : 'justify-center'}} gap-[3px] pt-1 pb-[12px] text-xs">
                                        @foreach(collect(explode(",", $p['tags']))->take(4) as $i => $tag)
                                            <div
                                                class="{{$i === 0 ? 'bg-primary' : '' }} {{$i === 1 ? 'bg-first' : '' }} {{$i === 2 ? 'bg-dark3' : '' }} {{$i === 3 ? 'bg-red' : '' }}  {{$i === 1 ? 'text-secondary' : 'text-white' }} rounded-2xl text-[7px] leading-[14px] h-[14px] text-center w-[50px] capitalize">{{$tag}}</div>
                                        @endforeach
                                    </div>
                                    <div
                                        class="text-[9px] leading-[13.5px] text-black dark:!text-light2 {{$index === 0 ? 'text-truncate-line-9 whitespace-pre-line' : 'text-truncate-line-4'}}">
                                        <p>{{$p['short_description']}}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center {{$index === 0 ? 'justify-center sm:justify-start' : 'justify-center'}} text-secondary dark:!text-light2 text-[8px] leading-[12px] mt-[12px] gap-3">
                                    <span>{{$date($p['publish_date'])}}</span>
                                    <span>•</span>
                                    <span>3m Read</span>
                                    <span>•</span>
                                    <span>{{$p['views_count']}} Views</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                    <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">No blog has found.</div>
                </div>
            @endif
        </div>
    </div>

    <script src="{{asset('/js/home.js')}}"></script>

@endsection
