@extends('user-panel.layout.layout')
@section('content')

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
                Self-observation is the first step of inner
            </a>
        </div>
        <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
    </section>
    <section class="w-full py-10 px-5 md:px-[120px]">
        <div class="text-center flex justify-center mb-5">
            <div
                class="w-full lg:w-2/4 text-5xl font-bold leading-normal bg-gradient-to-r from-blue-600 to-green-400 inline-block text-transparent bg-clip-text">
                Self-observation is the first step of inner
            </div>
        </div>
        <img src="{{asset('/images/blog-details/blog-details.jpg')}}" class="bg-cover w-full h-auto rounded-3xl"
             alt="blog-details">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3">
                <div class="flex justify-between items-center mt-10 w-full flex-wrap">
                    <div class="flex items-center justify-start">
                        <img src="{{asset('/images/home/avatar.png')}}" class="w-[45px] h-[45px]" alt="avatar">
                        <div class="ms-3">
                            <div class="font-bold text-gray-600 dark:text-cyan-600">
                                William
                            </div>
                            <div class="text-sm dark:text-gray-500 font-semibold text-gray-400">
                                Feb 12, 2023 <span class="ms-5"> 1 min to read </span>
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
                    The fancy moon going in little artist painting. Thirty days of lavender in the dreamy light inside.
                    Other perfect oh plants, for and again. I’ve honey feeling. Caring dreamland projects noteworthy
                    than minimal, their it oh pretty feeling may. Include pink be.
                </div>
                <img src="{{asset('/images/blog-details/img.jpg')}}" class="bg-cover w-full h-auto" alt="">
                <div class="my-10 font-semibold text-cyan-700">
                    Tortor placerat bibendum consequat sapien, facilisi facilisi pellentesque morbi. Id conse ctetur ut
                    vitae a massa a. Lacus ut bibendum sollicitudin fusce sociis mi. Dictum volutpat praesent ornare
                    accumsan elit venenatis. Congue sodales nunc quis ultricies odio porta. Egestas mauris placerat leo
                    phasellu s ut sit. <br> <br>
                    Thirty there & time wear across days, make inside on these you. Can young a really, roses blog small
                    of song their dreamy life pretty? Because really duo living to noteworthy bloom bell. Transform
                    clean daydreaming cute twenty process rooms cool. White white dreamy dramatically place everything
                    although. Place out apartment afternoon whimsical kinder, little romantic joy we flower handmade.
                    Thirty she a studio of she whimsical projects, afternoon effect going a floated maybe.
                </div>
                <hr class="w-full border border-cyan-300 my-5 px-5 md:px-[120px]">
                <div class="flex justify-start flex-wrap gap-3">
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        Animal
                    </button>
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        Business
                    </button>
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        Culture
                    </button>
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        Fashion
                    </button>
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        Food
                    </button>
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        Interior
                    </button>
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        LifeStyle
                    </button>
                    <button type="button" class="bg-gray-300 px-5 py-2 rounded-md text-gray-600 outline-0 border border-gray-400">
                        Travel
                    </button>
                </div>
                <div class="my-10 font-semibold text-gray-400 text-4xl">
                    Leave a comment
                </div>
                <a href="javascript:void(0)" class="text-gray-400 decoration-0">
                    You must be <span class="text-cyan-400"> logged in </span> to post a comment.
                </a>
            </div>
        </div>
    </section>

@endsection
