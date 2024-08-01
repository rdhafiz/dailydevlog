@extends('user-panel.layout.layout')
@section('content')

    <div id="post" class="p-2 md:p-4">
        <div class="border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl py-5 px-0 md:p-10">
            <form>
                <div class="mb-7 text-2xl md:text-4xl font-bold px-5 md:px-0"><span
                        v-if="!this.postParam.id"> Create </span> <span
                        v-if="this.postParam.id"> Edit </span> Post
                </div>
                <div class="w-full flex-wrap flex">

                    <div class="mb-5 w-full px-4">
                        <div class="w-full">
                            <div class="relative" v-if="!uploadLoading">
                                <label for="upload-file"
                                       class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-cyan-400 rounded-lg bg-transparent duration-500 hover:bg-cyan-400 hover:text-black fw-medium">
                                    <a class="flex items-center justify-center relative h-full w-full">
                                        <input type="file" id="upload-file" class="hidden" @change="uploadFile($event)">
                                        Upload Featured Image
                                        <div class="absolute top-0 bottom-0 start-0 end-0 h-full w-full">
                                            <img :src="'/storage/media/'+postParam.featured_image"
                                                 class="w-full object-contain bg-contain h-full" alt="featured-image"
                                                 v-if="postParam.featured_image">
                                        </div>
                                    </a>
                                </label>
                                <div class="absolute top-3 end-3"
                                     v-if="postParam.featured_image !== null">
                                    <button type="button"
                                            class="outline-0 border-0 flex justify-center items-center duration-500 bg-red-500 hover:bg-red-800 w-[45px] h-[45px] rounded-lg"
                                            @click="postParam.featured_image = null">
                                        <svg viewBox="0 0 24 24" class="w-[24px] h-[24px]" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                               stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M10 11V17" class="stroke-white" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M14 11V17" class="stroke-white" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M4 7H20" class="stroke-white" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                                    class="stroke-white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                    class="stroke-white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div v-if="uploadLoading">
                                <div
                                    class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-cyan-400 rounded-lg bg-transparent duration-500 hover:bg-cyan-400 hover:text-black fw-medium">
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
                    <div class="mb-5 w-full px-4">
                        <label for="title" class="block font-semibold"> Title </label>
                        <input id="title" type="text" name="title" v-model="postParam.title"
                               class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"
                               v-model="postParam.title" placeholder="Enter your post title">
                        <div class="error-report text-red-500 text-sm mt-2"
                             v-if="error != null && error.title !== undefined" v-text="error.title[0]"></div>
                    </div>
                    <div class="mb-5 w-full px-4">
                        <label for="content_description" class="block font-semibold mb-5"> Content </label>
                        <textarea name="content" v-model="postParam.content" id="content_description"
                                  placeholder="Write your content here"
                                  class="resize-0 py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white"></textarea>
                        <div class="error-report text-red-500 text-sm mt-2"
                             v-if="error != null && error.content !== undefined" v-text="error.content[0]"></div>
                    </div>
                    <div class="mb-5 w-full md:w-1/2 px-4 switch">
                        <label for="is_featured" class="block font-semibold"> Is Featured? </label>
                        <label for="is_featured" class="flex items-center cursor-pointer pt-3">
                            <input type="checkbox" id="is_featured" class="sr-only peer">
                            <div
                                class="block relative bg-cyan-500 w-16 h-7 p-1 rounded-full before:absolute before:bg-gray-400 before:w-5 before:h-5 before:p-1 before:rounded-full before:transition-all before:duration-500 before:left-1 peer-checked:before:left-10 peer-checked:before:bg-white"></div>
                        </label>
                    </div>
                    <div class="mb-5 w-full md:w-1/2 px-4">
                        <label for="allow_comment" class="block font-semibold"> Allow Comment </label>
                        <label for="comment" class="flex items-center cursor-pointer pt-3">
                            <input type="checkbox" id="comment" class="sr-only peer">
                            <div
                                class="block relative bg-cyan-500 w-16 h-7 p-1 rounded-full before:absolute before:bg-gray-400 before:w-5 before:h-5 before:p-1 before:rounded-full before:transition-all before:duration-500 before:left-1 peer-checked:before:left-10 peer-checked:before:bg-white"></div>
                        </label>
                    </div>

                    <div class="mb-5 w-full md:w-1/2 px-4">
                        <label for="category" class="block font-semibold"> Tags </label>
                        <div class="relative inline-block text-left w-full" id="categoryDropdown">
                            <div
                                class="w-full border-0 border-b border-b-cyan-400 bg-transparent text-black outline-0 dark:text-white flex flex-wrap gap-2"
                                id="insertToggle">
                                <div class="cursor-pointer flex items-center justify-between w-full py-5 h-[64px]"
                                     v-if="categories.length === 0" @click="categoryDropdown">
                                    <span class="ps-1">
                                        Select Tags
                                    </span>
                                    <button type="button" class="border-0 outline-0 bg-transparent">
                                        <svg viewBox="0 0 24 24" class="w-[26px] h-[26px]" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                               stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g id="Arrow / Caret_Down_MD">
                                                    <path id="Vector" d="M16 10L12 14L8 10"
                                                          class="stroke-black dark:stroke-white" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="error-report text-red-500 text-sm mt-2"
                                 v-if="error != null && error.category_ids !== undefined"
                                 v-text="error.category_ids[0]"></div>
                        </div>
                    </div>
                    <div class="w-full flex justify-end items-center px-4">
                        <button type="button" class="btn-red w-[120px] rounded-lg me-2" v-if="!archiveLoading" @click="managePost('archive')">Archive</button>
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
                        <button type="button" class="btn-orange w-[120px] rounded-lg me-2" v-if="!draftLoading" @click="managePost('draft')">Draft</button>
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
                        <button type="button" class="btn-theme w-[120px] rounded-lg me-2" v-if="!publishLoading" @click="managePost('publish')">Publish</button>
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

    <script src="{{asset('/js/single-post.js')}}"></script>

@endsection
