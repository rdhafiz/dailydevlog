@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')
    @php  $content_description = $post['content']; @endphp
    <div id="post" class="p-2 md:p-4 mt-[50px]">
        <div class="fixed-container">
            <div
                class="border border-[#AED725] dark:border-[#AED725] bg-white dark:bg-[#222222] rounded-3xl py-5 px-0 md:p-10">
                <form id="managePost" enctype='multipart/form-data' action="{{ route('posts.update', ['id' => $post['id']]) }}" method="post">

                    @csrf
                    <div class="w-full flex-wrap flex">

                        <div class="mb-5 w-full px-4">
                            <div class="w-full">
                                {{-- Upload file --}}
                                <div class="relative">
                                    <div>
                                        <label for="upload-file" class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-[#AED725] rounded-lg duration-500 bg-transparent hover:bg-gray-300 dark:hover:bg-gray-500 fw-medium group">
                                            <a class="flex items-center justify-center relative h-full w-full text-gray-600 dark:text-gray-400 duration-500 dark:group-hover:text-white">
                                                <input type="file" id="upload-file" name="featured_image" class="hidden" accept="image/*" value="{{old('featured_image')}}">
                                                Upload Featured Image
                                            </a>
                                            @if($post['featured_image'] !== null)
                                                <div class="absolute top-0 bottom-0 start-0 end-0">
                                                    <div class="w-full h-[250px] bg-white rounded-lg">
                                                        <img src="/storage/media/{{$post['featured_image']}}" id="featured_preview" class="w-full h-[250px] object-cover cursor-pointer border border-[#AED725] rounded-lg duration-500" alt="featured-image">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="absolute top-0 bottom-0 start-0 end-0 hidden" id="featured_preview_parent">
                                                    <div class="w-full h-[250px] bg-white rounded-lg">
                                                        <img src="" id="featured_preview" class="hidden w-full h-[250px] object-cover cursor-pointer border border-[#AED725] rounded-lg duration-500" alt="featured-image">
                                                    </div>
                                                </div>
                                            @endif
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="mb-5 w-full px-4">
                            <label for="title" class="block font-semibold"> Title </label>
                            <input id="title" type="text" name="title" value="{{$post['title']}}"
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
                                      class="resize-none py-5 px-4 border-0 border-b border-b-[#AED725] bg-transparent text-black w-full outline-0 dark:text-white">{{$post['short_description']}}</textarea>
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
                            <label class="block font-semibold mb-2"> Is Featured? </label>
                            <label class="switch" for="is_feature_checked">
                                <input type="checkbox" id="is_feature_checked" {{ $post['is_featured'] == 1 ? 'checked' : '' }} name="is_featured" onchange="changeIsFeatured(event)">
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
                                <input type="checkbox" id="is_allow_comment" {{ $post['allow_comments'] == 1 ? 'checked' : '' }} name="allow_comments" onchange="changeAllowComments(event)">
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
                                <select id="selectTag" class="w-100" name="tags[]" multiple="multiple" value="{{$post['tags']}}">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag['title'] }}"
                                                @if(in_array($tag['title'], explode(",", $post['tags']))) selected @endif>
                                            {{ $tag['title'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tags')
                                <div class="text-rose-600 text-sm mt-2" id="tags-error"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-5 md:w-1/2 px-4">
                            <label for="post-status" class="block font-semibold"> Status </label>
                            <select name="status" id="post-status" class="w-full h-[51px] px-4 border-0 border-b border-b-[#AED725] placeholder-gray-400 bg-transparent text-gray-600 dark:text-white outline-0">
                                <option value="published" {{ (old('status', $post['status']) == 'published') ? 'selected' : '' }} class="text-dark2">Published</option>
                                <option value="archived" {{ (old('status', $post['status']) == 'archived') ? 'selected' : '' }} class="text-dark2">Archived</option>
                                <option value="draft" {{ (old('status', $post['status']) == 'draft') ? 'selected' : '' }} class="text-dark2">Draft</option>
                            </select>

                            @error('status')
                                <div class="text-rose-600 text-sm mt-2"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="w-full flex justify-end items-center px-4">

                            {{-- Submit Button --}}
                            <div id="publishBtnSubmit">
                                <button type="submit" class="btn h-[45px] flex justify-center text-black items-center border border-[#0000003F] custom-gradient rounded-md w-[120px]">
                                    Update
                                </button>
                            </div>

                            {{-- Btn loading --}}
                            <div class="hidden" id="publishBtnLoading">
                                <button type="button" class="btn h-[45px] flex justify-center text-black items-center border border-[#0000003F] custom-gradient rounded-md w-[120px]" disabled>
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
    <script>
        window.content_description = {!! $content_description !!};
        window.featured_image = '{{$post['featured_image']}}';
    </script>
    <script src="{{asset('/js/edit-post.js')}}"></script>
@endsection
