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
        <div
            class="mb-5 text-secondary dark:text-white block font-bold text-[16px] leading-[24px] dark:hover:text-second hover:text-second duration-500 text-truncate-line-2">
            Showing blogs matching the search for <span class="text-second" id="global-data-show"> </span></div>
        @if(count($posts) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 min-[917px]:grid-cols-3 gap-[15px]">
                @foreach($posts as $index => $p)
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
                {{ $posts->links('vendor.pagination.custom') }}
            </div>
        @else
            <div
                class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">No blog has found.</div>
            </div>
        @endif
    </div>
@endsection
