@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    <div id="post" class="p-2 md:p-4 mt-[50px]">
        <div class="fixed-container">
            <div
                class="border border-[#AED725] dark:border-[#AED725]0 bg-white dark:bg-[#222222] rounded-3xl py-5 px-0 md:p-10">
                <form id="managePost" enctype='multipart/form-data' method="post" action="{{route('posts.store')}}">
                    @csrf
                    <div class="w-full flex-wrap flex">

                        <div class="mb-5 w-full px-4">
                            <div class="w-full">
                                {{-- Upload file --}}
                                <div class="relative">

                                    <div id="before-upload">
                                        <label for="upload-file" class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-[#AED725] rounded-lg duration-500 bg-transparent hover:bg-gray-300 dark:hover:bg-gray-500 fw-medium">
                                            <a class="flex items-center justify-center relative h-full w-full text-gray-600 dark:text-gray-400 duration-500">
                                                <input type="file" id="upload-file" name="featured_image" class="hidden" accept="image/*" value="{{old('featured_image')}}">
                                                <span id="upload-text">Upload Featured Image</span>
                                                <img src="" id="featured_preview" class="hidden w-full h-[250px] object-cover cursor-pointer border border-[#AED725] rounded-lg duration-500" alt="featured-image">
                                            </a>
                                        </label>
                                    </div>
                                </div>

{{--                                <label for="change-file">--}}
{{--                                    <input type="file" id="change-file" name="featured_image" class="hidden" accept="image/*" value="{{old('featured_image')}}" onchange="uploadFile(event)">--}}
{{--                                </label>--}}

                                {{-- Upload Loading --}}
                                <div class="hidden" id="uploadLoading">
                                    <div
                                        class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-[#AED725] rounded-lg bg-transparent duration-500 hover:bg-gray-400 dark:hover:bg-gray-400 hover:text-black fw-medium">
                                        <svg class="h-[35px] mx-auto w-[35px] animate-spin text-white"
                                             xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="mb-5 w-full px-4">
                            <label for="title" class="block font-semibold"> Title </label>
                            <input id="title" type="text" name="title" value="{{old('title')}}"
                                   class="h-[51px] px-4 border-0 border-b border-b-[#AED725] placeholder-gray-400 bg-transparent text-gray-600 dark:text-white w-full outline-0"
                                   placeholder="Enter your post title">
                            @error('title')
                            <div class="text-rose-600 text-sm mt-2" id="title-error"> {{$message}} </div>
                            @enderror
                        </div>

                        {{-- Short description --}}
                        <div class="mb-5 w-full px-4">
                            <label for="short-description" class="block font-semibold"> Short Description </label>
                            <textarea id="short-description" name="short_description" placeholder="Enter short description"
                                      class="resize-none py-5 px-4 border-0 border-b border-b-[#AED725] bg-transparent text-black w-full outline-0 dark:text-white">
                                {{ old('short_description') }}
                            </textarea>
                            @error('short_description')
                            <div class="text-rose-600 text-sm mt-2" id="short-description-error"> {{$message}} </div>
                            @enderror
                        </div>

                        {{-- content description --}}
                        <div class="mb-5 w-full px-4">
                            <label for="editor-content" class="block font-semibold mb-5"> Content </label>
                            <div id="editorjs" class="resize-0 py-5 pe-5 border-0 border-b border-b-[#AED725] bg-transparent text-black w-full outline-0 dark:text-white"></div>
                            <textarea id="editor-content" name="content" hidden></textarea>
                            <div class="text-rose-600 text-sm mt-2 hidden" id="content-error"></div>
                        </div>

                        {{-- Is featured --}}
                        <div class="mb-5 w-full md:w-1/2 px-4">
                            <div class="block font-semibold mb-2"> Is Featured? </div>
                            <label for="is_feature_checked" class="switch">
                                <input type="checkbox" id="is_feature_checked" name="is_featured" onchange="changeIsFeatured(event)">
                                <span class="slider round"></span>
                            </label>
                            @error('is_featured')
                            <div class="text-rose-600 text-sm mt-2"> {{$message}} </div>
                            @enderror
                        </div>

                        {{-- Allow comment --}}
                        <div class="mb-5 w-full md:w-1/2 px-4">
                            <label for="is_allow_comment" class="block font-semibold mb-2"> Allow Comment </label>
                            <label class="switch" for="is_allow_comment">
                                <input type="checkbox" id="is_allow_comment" name="allow_comments" onchange="changeAllowComments(event)">
                                <span class="slider round"></span>
                            </label>
                            @error('allow_comment')
                            <div class="text-rose-600 text-sm mt-2"> {{$message}} </div>
                            @enderror
                        </div>

                        {{-- Tags --}}
                        <div class="mb-5 w-full md:w-1/2 px-4">
                            <label for="selectTag" class="block font-semibold"> Tags </label>
                            <div id="selectTagParent">
                                <select id="selectTag" class="w-100" name="tags[]" multiple="multiple" value="{{old('tags[]')}}">
                                    <option></option>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag['title']}}" {{ in_array($tag['title'], old('tags', [])) ? 'selected' : '' }}>
                                            {{$tag['title']}}
                                        </option>
                                    @endforeach
                                    <option id="tagArray"></option>
                                </select>
                            </div>
                            @error('tags')
                            <div class="text-rose-600 text-sm mt-2" id="tags-error"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-5 md:w-1/2 px-4">
                            <label for="post-status" class="block font-semibold"> Status </label>
                            <select name="status" id="post-status" class="w-full h-[51px] px-4 border-0 border-b border-b-[#AED725] placeholder-gray-400 bg-transparent text-gray-600 dark:text-white outline-0">
                                <option value="published" class="text-dark2"> Published </option>
                                <option value="archived" class="text-dark2">Archived</option>
                                <option value="draft" class="text-dark2">Draft</option>
                            </select>
                            @error('status')
                            <div class="text-rose-600 text-sm mt-2"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="w-full flex justify-end items-center px-4">

                            {{-- Submit Button - publish--}}
                            <div id="publishBtnSubmit">
                                <button type="submit" class="btn h-[45px] flex justify-center text-white items-center border border-[#0000003F] bg-gradient-to-r from-15% from-[#85A41C] via-50% via-[#AED725] to-85% to-[#85A41C] rounded-md w-[120px]">
                                    Submit
                                </button>
                            </div>

                            {{-- Btn loading--}}
                            <div class="hidden" id="publishBtnLoading">
                                <button type="button" class="btn h-[45px] flex justify-center text-white items-center border border-[#0000003F] bg-gradient-to-r from-15% from-[#85A41C] via-50% via-[#AED725] to-85% to-[#85A41C] rounded-md w-[120px]" disabled>
                                    <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('/js/create-post.js')}}"></script>

@endsection
