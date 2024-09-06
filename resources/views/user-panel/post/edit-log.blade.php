@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    <div id="post" class="p-2 md:p-4 mt-[50px]">
        <div class="fixed-container">
            <div
                class="border border-cyan-100 dark:border-cyan-900 bg-gray-100 dark:bg-gray-800 rounded-3xl py-5 px-0 md:p-10">
                <form id="managePost" enctype='multipart/form-data' action="/api/front/posts">
                    <div class="w-full flex-wrap flex">

                        <div class="mb-5 w-full px-4">
                            <div class="w-full">

                                {{-- Upload file --}}
                                <div class="relative" v-if="!uploadLoading">

                                    <label for="upload-file"
                                           class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-cyan-400 rounded-lg duration-500 bg-transparent hover:bg-gray-400 dark:hover:bg-gray-600 fw-medium">
                                        <a class="flex items-center justify-center relative h-full w-full text-gray-600 dark:text-gray-400 duration-500">
                                            <input type="file" id="upload-file" class="hidden"
                                                   @change="uploadFile($event)"
                                                   accept="image/*">
                                            Upload Featured Image
                                            <div class="absolute top-0 bottom-0 start-0 end-0 h-full w-full">
                                                <img :src="'/storage/media/'+postParam.featured_image"
                                                     class="w-full object-cover h-full" alt="featured-image"
                                                     v-if="postParam.featured_image">
                                            </div>
                                        </a>
                                    </label>

                                </div>

                                {{-- Upload Loading --}}
                                <div v-if="uploadLoading">
                                    <div
                                        class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-cyan-400 rounded-lg bg-transparent duration-500 hover:bg-gray-400 dark:hover:bg-gray-400 hover:text-black fw-medium">
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
                            <input id="title" type="text" name="title" v-model="postParam.title"
                                   class="h-[51px] px-4 border-0 border-b border-b-cyan-500 placeholder-gray-400 bg-transparent text-gray-600 dark:text-white w-full outline-0"
                                   v-model="postParam.title" placeholder="Enter your post title">
                            <div class="error-report text-red-500 text-sm mt-2"
                                 v-if="error != null && error.title !== undefined" v-text="error.title[0]"></div>
                        </div>

                        {{-- Short description --}}
                        <div class="mb-5 w-full px-4">
                            <label for="short_description" class="block font-semibold"> Short Description </label>
                            <textarea name="short_description"
                                      placeholder="Enter short description"
                                      class="resize-none py-5 px-4 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                                      v-model="postParam.short_description"></textarea>
                            <div class="error-report text-red-500 text-sm mt-2"
                                 v-if="error != null && error.short_description !== undefined"
                                 v-text="error.short_description[0]"></div>
                        </div>

                        {{-- content description --}}
                        <div class="mb-5 w-full px-4">
                            <label for="content_description" class="block font-semibold mb-5"> Content </label>
                            <textarea name="content" id="content_description"
                                      placeholder="Write your content here"
                                      class="resize-0 py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"></textarea>
                            <div class="error-report text-red-500 text-sm mt-2"
                                 v-if="error != null && error.content !== undefined" v-text="error.content[0]"></div>
                        </div>

                        {{-- Is featured --}}
                        <div class="mb-5 w-full md:w-1/2 px-4 switch">
                            <label for="is_featured" class="block font-semibold"> Is Featured? </label>
                            <label for="is_featured" class="flex items-center cursor-pointer pt-3">
                                <input type="checkbox" id="is_featured" class="sr-only peer"
                                       @change="changeIsFeatured(event)">
                                <div
                                    :class="{'block relative bg-cyan-500 w-16 h-7 p-1 rounded-full before:absolute before:w-5 before:h-5 before:p-1 before:rounded-full before:transition-all before:duration-500 before:left-1': true, 'peer-checked:before:left-10 peer-checked:before:bg-white' : postParam.is_featured == 1, ' before:bg-gray-400': postParam.is_featured == 0}"></div>
                            </label>
                        </div>

                        {{-- Allow comment --}}
                        <div class="mb-5 w-full md:w-1/2 px-4">
                            <label for="allow_comment" class="block font-semibold"> Allow Comment </label>
                            <label for="comment" class="flex items-center cursor-pointer pt-3">
                                <input type="checkbox" id="comment" class="sr-only peer"
                                       @change="changeAllowComments(event)">
                                <div
                                    :class="{'block relative bg-cyan-500 w-16 h-7 p-1 rounded-full before:absolute before:w-5 before:h-5 before:p-1 before:rounded-full before:transition-all before:duration-500 before:left-1': true, 'peer-checked:before:left-10 peer-checked:before:bg-white' : postParam.allow_comments == 1, ' before:bg-gray-400': postParam.allow_comments == 0}"></div>
                            </label>
                        </div>

                        {{-- Tags --}}
                        <div class="mb-5 w-full md:w-1/2 px-4">
                            <label for="selectTag" class="block font-semibold"> Tags </label>
                            <div id="selectTagParent">
                                <select id="selectTag" class="w-100" name="tags" multiple="multiple"
                                        v-model="postParam.tags">
                                    <option></option>
                                    <option value="">@{{ tags?.length }}</option>
                                    <option v-for="each in tags" :value="each.title" v-text="each.title"></option>
                                </select>
                            </div>
                            <div class="error-report text-red-500 text-sm mt-2"
                                 v-if="error != null && error.tags !== undefined" v-text="error.tags[0]"></div>
                        </div>

                        <div class="w-full flex justify-end items-center px-4">

                            {{-- Submit Button - archived --}}
                            <button type="submit" class="btn-red w-[120px] rounded-lg me-2" v-if="!archiveLoading"
                                    @click="managePost('archived')">Archive
                            </button>

                            {{-- archived btn loading --}}
                            <button type="button"
                                    class="btn-red rounded-md w-[120px] flex justify-center items-center h-[45px] text-white me-2"
                                    disabled v-if="archiveLoading">
                                <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>

                            {{-- Submit Button - draft --}}
                            <button type="button" class="btn-orange w-[120px] rounded-lg me-2" v-if="!draftLoading"
                                    @click="managePost('draft')">Draft
                            </button>

                            {{-- draft btn loading --}}
                            <button type="button"
                                    class="btn-orange rounded-md w-[120px] flex justify-center items-center h-[45px] text-white me-2"
                                    disabled v-if="draftLoading">
                                <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>

                            {{-- Submit Button - publish --}}
                            <button type="button" class="btn-theme w-[120px] rounded-lg me-2" v-if="!publishLoading"
                                    @click="managePost('published')">Publish
                            </button>

                            {{-- publish btn loading --}}
                            <button type="button"
                                    class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white"
                                    disabled v-if="publishLoading">
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
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('/js/edit-post.js')}}"></script>

@endsection
