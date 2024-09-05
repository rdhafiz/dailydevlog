@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    @php
        $date = function ($publishDate){
            $date = new DateTime($publishDate);
           return $date->format('M d Y');
        }
    @endphp

    <div class="fixed-container mt-[50px]">

        @if(count($blogs) > 0)

            <div class="grid grid-cols-1 sm:grid-cols-2 min-[917px]:grid-cols-3 gap-[15px]">
                @foreach($blogs as $index => $p)
                    <div
                        class="{{$index === 0 ? 'sm:col-span-2 block sm:grid sm:grid-cols-2 sm:gap-[15px]' : 'col-span-1 lg:col-span-1 flex flex-col'}} group rounded-2xl bg-white dark:bg-[#222222] shadow-lg sm:h-[316px]">
                        <a href="{{route('user.panel.blog.details', ['id' => $p['id']])}}"
                           class="{{$index === 0 ? 'sm:col-span-1 h-[125px] sm:w-[316px] sm:h-[316px] w-full' : 'h-[125px]'}} block rounded-2xl overflow-hidden min-h-[125px]">
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
                                <a href="{{route('user.panel.blog.details', ['id' => $p['id']])}}"
                                   class="text-secondary dark:text-white block font-bold dark:hover:text-second hover:text-second duration-500 {{$index === 0 ? 'text-truncate-line-3 text-[20px] leading-[30px]' : 'text-truncate-line-2 text-[17px] leading-[25.5px]'}}">
                                    {{$p['title']}}
                                </a>
                                <div
                                    class="flex flex-wrap items-center {{$index === 0 ? ' mb-[10px] gap-[9px] justify-center sm:justify-start' : 'gap-[8px] justify-center'}} pt-1 pb-[12px]">
                                    @foreach(collect(explode(",", $p['tags']))->take(4) as $i => $tag)
                                        <div
                                            class="{{$i === 0 ? 'bg-primary' : '' }} {{$i === 1 ? 'bg-first !text-[#333333]' : '' }} {{$i === 2 ? 'bg-dark3' : '' }} {{$i === 3 ? 'bg-red' : '' }}  {{$i === 1 ? 'text-secondary' : 'text-white' }} rounded-2xl leading-[14px] font-[400] text-center {{$index === 0 ? 'w-[65px] h-[20px] text-[12px]' : 'w-[50px] h-[16px] text-[11px]'}} flex justify-center items-center capitalize">{{$tag}}</div>
                                    @endforeach
                                </div>
                                <div
                                    class="font-[400] leading-[21px] text-black dark:!text-light2 {{$index === 0 ? 'text-[14px] text-truncate-line-5' : 'text-[13px] text-truncate-line-3'}}">
                                    <p>{{$p['short_description']}}</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center {{$index === 0 ? 'justify-center sm:justify-start' : 'justify-center'}} font-[400] text-secondary dark:!text-light2 text-[13px] leading-[19.5px] pb-[2px] gap-1">
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

            <div class="mt-[85px]">
                {{ $blogs->links('vendor.pagination.custom') }}
            </div>

        @else
            <div
                class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">No blog has found.</div>
            </div>
        @endif

    </div>

{{--    <div id="post">--}}
{{--        <div class="fixed-container mt-[85px]">--}}
{{--            <div class="w-full px-4" v-if="tableData.length === 0 && !loading">--}}
{{--                <div--}}
{{--                    class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">--}}
{{--                    <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">Do not have any blog.</div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="px-3" v-if="loading">--}}
{{--                <div class="w-full h-[100vh] flex justify-center items-center">--}}
{{--                    <span>--}}
{{--                        <svg class="h-[60px] mx-auto w-[60px] animate-spin text-white"--}}
{{--                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">--}}
{{--                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"--}}
{{--                                    stroke-width="4"></circle>--}}
{{--                            <path class="opacity-75" fill="currentColor"--}}
{{--                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>--}}
{{--                        </svg>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="" v-if="tableData.length > 0 && !loading">--}}
{{--                <div class="grid grid-cols-1 sm:grid-cols-2 min-[917px]:grid-cols-3 gap-[15px]">--}}
{{--                    <template v-for="(each, index) in tableData">--}}
{{--                        <div class="group rounded-2xl bg-white dark:bg-[#222222] shadow-lg sm:h-[289px]" :class="{ 'sm:col-span-2 block sm:grid sm:grid-cols-2 sm:gap-[15px]' : index === 0, 'col-span-1 lg:col-span-1 flex flex-col' : index > 0 }">--}}
{{--                            <a href="javascript:void(0)" class="block rounded-2xl overflow-hidden min-h-[120px]" :class="{ 'sm:col-span-1 h-[120px] sm:h-[289px] w-full' : index === 0, 'h-[120px]' : index > 0 }">--}}
{{--                                <img :src="'/storage/media/'+ each.featured_image"--}}
{{--                                     class="!h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"--}}
{{--                                     alt="blog image" v-if="each.featured_image">--}}
{{--                                <img src="{{asset('/images/default.png')}}" class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"--}}
{{--                                     alt="blog image" v-if="!each.featured_image">--}}
{{--                            </a>--}}
{{--                            <div class="grow flex flex-col gap-0 justify-between overflow-auto" :class="{ 'sm:col-span-1 text-center sm:text-left pr-[6px] pt-[15px] pb-2' : index === 0, 'px-2 pt-2 pb-1 text-center' : index > 0 }">--}}
{{--                                <div class="overflow-auto">--}}
{{--                                    <a href="javascript:void(0)" class="text-secondary dark:text-white block font-bold text-[16px] leading-[24px] dark:hover:text-second hover:text-second duration-500 text-truncate-line-2">--}}
{{--                                        @{{ each.title }}--}}
{{--                                    </a>--}}
{{--                                    <div class="flex flex-wrap items-center gap-[3px] pt-1 pb-[12px]" :class="{ 'justify-center sm:justify-start' : index === 0, 'justify-center' : index > 0 }">--}}
{{--                                        <div v-for="(tag, index) in each?.tags" class="rounded-2xl text-[10px] leading-[14px] h-[14px] font-[400] text-center w-[50px] capitalize" :class="{'bg-primary': index === 0, 'bg-first text-secondary': index === 1, 'bg-dark3': index === 2, 'bg-red': index === 3}">@{{ tag }}</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-[10px] font-[400] leading-[13.5px] text-black dark:!text-light2" :class="{ 'text-truncate-line-9 whitespace-pre-line' : index === 0, 'text-truncate-line-4' : index > 0 }">--}}
{{--                                        <p>@{{ each.short_description }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="flex items-center text-secondary dark:!text-light2 text-[10px] leading-[12px] mt-[10px] pb-[2px] gap-1" :class="{ 'justify-center sm:justify-start' : index === 0, 'justify-center' : index > 0 }">--}}
{{--                                    <span>@{{ each.published_at_format }}</span>--}}
{{--                                    <span>•</span>--}}
{{--                                    <span>3m Read</span>--}}
{{--                                    <span>•</span>--}}
{{--                                    <span>@{{ each.views_count }} Views</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </template>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mt-5 flex justify-center items-center"--}}
{{--                 v-if="tableData.length > 0 && loading === false && last_page > 1">--}}
{{--                <div class="flex justify-center items-center gap-x-1">--}}
{{--                    <div @click="PrevPage()">--}}
{{--                        <a href="javascript:void(0)"--}}
{{--                           class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"--}}
{{--                                 fill="none"--}}
{{--                                 stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                 class="acorn-icons acorn-icons-chevron-left undefined">--}}
{{--                                <path--}}
{{--                                    d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>--}}
{{--                            </svg>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div v-if="buttons.length <= 6" class="flex justify-center items-center gap-x-1">--}}
{{--                        <div v-for="(page, index) in buttons">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="{'bg-cyan-400': page === current_page}"--}}
{{--                               @click="pageChange(page)" v-text="page"></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div v-if="buttons.length > 6" class="flex justify-center items-center gap-x-1">--}}
{{--                        <div>--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="formData.page === 0 || formData.page === 1 ? 'bg-cyan-400' : ''"--}}
{{--                               @click="pageChange(1)">1</a>--}}
{{--                        </div>--}}
{{--                        <div v-if="current_page > 3">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               @click="pageChange(current_page - 2)">...</a>--}}
{{--                        </div>--}}
{{--                        <div v-if="current_page == buttons.length">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="formData.page === current_page - 2 ? 'bg-cyan-400' : ''"--}}
{{--                               @click="pageChange(current_page - 2)" v-text="current_page - 2"></a>--}}
{{--                        </div>--}}
{{--                        <div v-if="current_page > 2">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="formData.page === current_page - 1 ? 'bg-cyan-400' : ''"--}}
{{--                               @click="pageChange(current_page - 1)" v-text="current_page - 1"></a>--}}
{{--                        </div>--}}
{{--                        <div v-if="current_page != 1 && current_page != buttons.length">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="formData.page === current_page ? 'bg-cyan-400' : ''"--}}
{{--                               @click="pageChange(current_page)" v-text="current_page"></a>--}}
{{--                        </div>--}}
{{--                        <div v-if="current_page < buttons.length - 1">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="formData.page === current_page + 1 ? 'bg-cyan-400' : ''"--}}
{{--                               @click="pageChange(current_page + 1)" v-text="current_page + 1"></a>--}}
{{--                        </div>--}}
{{--                        <div v-if="current_page == 1">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="formData.page === current_page + 2 ? 'bg-cyan-400' : ''"--}}
{{--                               @click="pageChange(current_page + 2)" v-text="current_page + 2"></a>--}}
{{--                        </div>--}}
{{--                        <div v-if="current_page < buttons.length - 2">--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               @click="pageChange(current_page + 2)">...</a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <a href="javascript:void(0)"--}}
{{--                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"--}}
{{--                               :class="{'bg-cyan-400': formData.page === last_page }"--}}
{{--                               @click="pageChange(buttons.length)" v-text="buttons.length"></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div @click="NextPage()">--}}
{{--                        <a href="javascript:void(0)"--}}
{{--                           class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"--}}
{{--                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined">--}}
{{--                                <path--}}
{{--                                    d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path>--}}
{{--                            </svg>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script src="{{asset('/js/post.js')}}"></script>--}}

@endsection
