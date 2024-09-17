@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    @php
        $date = function ($publishDate){
            $date = new DateTime($publishDate);
           return $date->format('M d Y');
        }
    @endphp

    <div>
        <section class="fixed-container mt-[85px]">
            <form id="searchDataForm">
            <div class="w-full flex justify-between flex-wrap sm:flex-nowrap items-center px-3 gap-2 sm:gap-5 mb-10">
                <div class="w-full sm:w-1/3 py-2 sm:py-3">
                    <!-- Search input -->
                        <input type="text" name="keyword" id="searchKey" value="{{old('keyword')}}"
                               class="p-3 bg-transparent border-0 outline-0 border-b-[#AED725] border-b-2 w-full"
                               autocomplete="off" placeholder="Search Here">
                </div>
                <div class="w-full sm:w-1/3 flex gap-2 sm:gap-5">
                    <div class="from-group w-full lg:w-1/2">
                        <select name="status" id="selectData" class="p-3 bg-transparent border-0 outline-0 border-b-[#AED725] border-b-2 w-full">
                            <option value="" class="text-black">Status</option>
                            <option value="published" class="text-black">Published</option>
                            <option value="draft" class="text-black">Draft</option>
                            <option value="archived" class="text-black">Archived</option>
                        </select>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 flex justify-end py-3">
                    <!-- New -->
                    <a href="{{route('user.panel.create.post')}}" class="btn h-[45px] flex justify-center text-black items-center border border-[#0000003F] custom-gradient rounded-md w-[120px]">
                        New Blog
                    </a>
                </div>
            </div>
            </form>
            @if(count($result) > 0)
                <div class="px-3 min-h-[500px]">
                    <div class="w-full max-[768px]:overflow-x-scroll">
                        @foreach($result as $index => $p)
                            <div
                                class="group bg-white dark:bg-[#222222] w-full py-3 px-4 rounded-lg mb-3 flex items-center justify-between min-w-[744px]">
                                <div class="grow-0">
                                    @if($p['featured_image'])
                                        <img src="{{asset('/storage/media/' .$p['featured_image'])}}"
                                             class=" object-cover w-[100px] min-w-[100px] h-[60px]"
                                             alt="blog">
                                    @else
                                        <img src="{{asset('/images/default.png')}}"
                                             class="object-cover w-[100px] min-w-[100px] h-[60px]"
                                             alt="blog">
                                    @endif
                                </div>
                                <div class="grow text-start mx-8">
                                    <div
                                        class="font-bold text-lg dark:text-white duration-500 dark:group-hover:text-second text-secondary group-hover:text-second text-truncate-line-2">
                                        {{$p['title']}}
                                    </div>
                                    <div
                                        class="flex justify-between items-center mt-1 text-gray-600 dark:text-gray-400 text-sm font-medium">
                                        @if($p['tags'])
                                            <div class="flex items-center gap-2 me-3 grow">
                                                @foreach(collect(explode(",", $p['tags'])) as $i)
                                                    #{{$i}}
                                                @endforeach
                                            </div>
                                        @else
                                            No Tags founded
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-1 grow-0">
                                    <a href="/blog-details/{{$p['id']}}"
                                       class="h-8 w-8 flex items-center justify-center rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-600 duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px"
                                             viewBox="0 0 24 24"
                                             fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9ZM11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12Z"
                                                  fill="#000000" class="fill-gray-600 dark:fill-gray-400"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M21.83 11.2807C19.542 7.15186 15.8122 5 12 5C8.18777 5 4.45796 7.15186 2.17003 11.2807C1.94637 11.6844 1.94361 12.1821 2.16029 12.5876C4.41183 16.8013 8.1628 19 12 19C15.8372 19 19.5882 16.8013 21.8397 12.5876C22.0564 12.1821 22.0536 11.6844 21.83 11.2807ZM12 17C9.06097 17 6.04052 15.3724 4.09173 11.9487C6.06862 8.59614 9.07319 7 12 7C14.9268 7 17.9314 8.59614 19.9083 11.9487C17.9595 15.3724 14.939 17 12 17Z"
                                                  fill="#000000" class="fill-gray-600 dark:fill-gray-400"/>
                                        </svg>
                                    </a>
                                    <a href="/edit-logs/{{$p['id']}}"
                                       class="h-8 w-8 flex items-center justify-center rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-600 duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                             viewBox="0 0 24 24"
                                             fill="none">
                                            <g id="Edit / Edit_Pencil_01">
                                                <path id="Vector"
                                                      d="M12 8.00012L4 16.0001V20.0001L8 20.0001L16 12.0001M12 8.00012L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L16 12.0001M12 8.00012L16 12.0001"
                                                      stroke="#000000" class="stroke-gray-600 dark:stroke-gray-400"
                                                      stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </g>
                                        </svg>
                                    </a>
                                    <form action="/api/front/posts/{{$p['id']}}" method="POST">
                                        @method('DELETE')
                                        @csrf()
                                        <button type="submit"
                                                class="h-8 w-8 flex items-center justify-center rounded-full bg-transparent hover:bg-gray-300 dark:hover:bg-gray-600 duration-500">
                                            <svg viewBox="0 0 24 24" class="w-[20px] h-[20px]" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                   stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M10 11V17" class="stroke-gray-600 dark:stroke-gray-400"
                                                          stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14 11V17" class="stroke-gray-600 dark:stroke-gray-400"
                                                          stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4 7H20" class="stroke-gray-600 dark:stroke-gray-400"
                                                          stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path
                                                        d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                                        class="stroke-gray-600 dark:stroke-gray-400" stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                        class="stroke-gray-600 dark:stroke-gray-400" stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-[50px]">
                        {{ $result->links('vendor.pagination.custom') }}
                    </div>
                </div>
            @else
                <div class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-[#AED725] flex-col">
                    <div class="text-secondary dark:text-white block font-[500] text-[19px] dark:hover:text-second hover:text-second duration-500">
                        No blog has been found.
                    </div>
                </div>
            @endif
        </section>
    </div>

    <script src="{{asset('/js/my-post.js')}}"></script>

@endsection
