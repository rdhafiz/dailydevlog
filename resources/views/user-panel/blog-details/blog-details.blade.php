@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')
    @php
        $date = function ($publishDate){
           $date = new DateTime($publishDate);
          return $date->format('M d Y');
       };

       $content = $post['content'];

    @endphp

    <div class="mt-[50px] fixed-container" id="single-details">
        <div class="max-w-[735px] mx-auto">
            <div
                class="text-3xl leading-[45px] text-secondary dark:text-white font-bold mb-[10px]">{{$post['title']}}</div>
            <div class="bg-white dark:bg-dark2 rounded-2xl">
                <div>
                    @if($post['featured_image'] !== null)
                        <img src="{{asset('/storage/media/').'/'.$post['featured_image']}}"
                             class="w-full h-[250px] object-contain lg:object-cover rounded-2xl"
                             alt="blog-details">
                    @else
                        <img src="{{asset('/images/default.png')}}"
                             class="w-full h-[350px] lg:h-[550px] object-contain lg:object-cover rounded-2xl"
                             alt="blog-details">
                    @endif
                </div>
                <div class="py-[25px] px-[22px]">
                    <div
                        class="flex items-center text-secondary dark:!text-light2 text-[8px] font-[400] leading-[12px] mb-[8px] gap-1">
                        <span>{{$date($post['publish_date'])}}</span>
                        <span>•</span>
                        <span>3m Read</span>
                        <span>•</span>
                        <span>{{$post['views_count']}} Views</span>
                    </div>
                    <div
                        class="flex flex-wrap items-center gap-[3px]">
                        @foreach(collect(explode(",", $post['tags']))->take(4) as $i => $tag)
                            <div
                                class="{{$i === 0 ? 'bg-primary' : '' }} {{$i === 1 ? 'bg-first' : '' }} {{$i === 2 ? 'bg-dark3' : '' }} {{$i === 3 ? 'bg-red' : '' }}  {{$i === 1 ? 'text-secondary' : 'text-white' }} {{$i > 3 ? 'bg-primary' : '' }} rounded-2xl text-[7px] leading-[14px] h-[14px] text-center w-[50px] capitalize">{{$tag}}</div>
                        @endforeach
                    </div>
                    <div class="mt-[25px] text-[13px] leading-[19.5px] text-black dark:!text-white" id="content_description">
                        <div id="editorjs"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.editorContent = {!! $content !!};
    </script>

    <script src="{{asset('/js/blog-details.js')}}"></script>

@endsection
