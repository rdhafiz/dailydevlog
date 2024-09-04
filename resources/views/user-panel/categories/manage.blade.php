@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    <div id="categories" class="p-2 md:p-4">
        <section class="w-full">
            <div class="flex justify-start items-center gap-x-2 flex-wrap">
                <a href="{{route('user.panel.home')}}"
                   class="decoration-0 text-gray-400 dark:text-cyan-600 flex justify-center items-center">
                    Home
                </a>
                <img src="{{asset('/images/blog-details/chevron-dot-right.svg')}}" class="w-[22px] h-[22px]"
                     alt="chevron-dot-right.svg">
                <a href="{{route('user.panel.categories')}}"
                   class="decoration-0 text-gray-400 dark:text-cyan-600 flex justify-center items-center">
                    Categories
                </a>
                <img src="{{asset('/images/blog-details/chevron-dot-right.svg')}}" class="w-[22px] h-[22px]"
                     alt="chevron-dot-right.svg">
                <a href="javascript:void(0)" class="decoration-0 text-gray-600 font-semibold dark:text-cyan-400">
                 <span
                     v-if="!this.categoryParam.id"> Create </span> <span
                        v-if="this.categoryParam.id"> Edit </span>
                </a>
            </div>
            <hr class="w-full border border-cyan-300 mt-5 mb-[50px] px-5 md:px-[120px]">
        </section>
        <div
            class="border border-cyan-100 dark:border-cyan-900 bg-gray-100 dark:bg-gray-800 rounded-3xl py-5 px-0 md:p-10">
            <form @submit.prevent="manageCategory">
                <div class="w-full flex-wrap flex">

                    <div class="mb-5 w-full px-4">
                        <div class="w-full">
                            <div class="relative" v-if="!uploadLoading">
                                <label for="upload-file"
                                       class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-cyan-400 rounded-lg duration-500 bg-transparent hover:bg-gray-400 dark:hover:bg-gray-600 fw-medium">
                                    <a class="flex items-center justify-center relative h-full w-full text-gray-600 dark:text-gray-400 duration-500">
                                        <input type="file" id="upload-file" class="hidden" @change="uploadFile($event)"
                                               accept="image/*">
                                        <span v-if="!categoryParam.icon">Upload Icon</span>
                                        <div class="absolute top-0 bottom-0 start-0 end-0 h-full w-full">
                                            <img :src="'/storage/media/'+categoryParam.icon"
                                                 class="w-full object-contain h-full" alt="icon"
                                                 v-if="categoryParam.icon">
                                        </div>
                                    </a>
                                </label>
                                <div class="error-report text-red-500 text-sm mt-2"
                                     v-if="error != null && error.icon !== undefined" v-text="error.icon[0]"></div>
                                <div class="absolute top-3 end-3"
                                     v-if="categoryParam.icon !== null">
                                    <button type="button"
                                            class="outline-0 border-0 flex justify-center items-center duration-500 bg-red-500 hover:bg-red-800 w-[45px] h-[45px] rounded-lg"
                                            @click="categoryParam.icon = null">
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
                    <div class="mb-5 w-full px-4">
                        <label for="title" class="block font-semibold"> Name </label>
                        <input id="name" type="text" name="name"
                               class="h-[51px] border-0 border-b border-b-cyan-500 placeholder-gray-400 bg-transparent text-gray-600 dark:text-white w-full outline-0"
                               v-model="categoryParam.name" placeholder="Title">
                        <div class="error-report text-red-500 text-sm mt-2"
                             v-if="error != null && error.name !== undefined" v-text="error.name[0]"></div>
                    </div>
                    <div class="mb-5 w-full px-4">
                        <label for="description" class="block font-semibold"> Description </label>
                        <textarea name="description"
                                  placeholder="Description"
                                  class="resize-0 py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" v-model="categoryParam.description"></textarea>
                        <div class="error-report text-red-500 text-sm mt-2"
                             v-if="error != null && error.description !== undefined" v-text="error.description[0]"></div>
                    </div>
                    <div class="mb-5 w-full md:w-1/2 px-4">
                        <label for="parent_id" class="block font-semibold" v-model="categoryParam.parent_id">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="h-[51px] border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white">
                            <option value="" class="text-black">Select Parent Category</option>
                            <option :value="each.id" v-for="(each) in tableData" v-if="tableData.length > 0" class="text-black">@{{ each.name }}</option>
                        </select>
                        <div class="error-report text-red-500 text-sm mt-2"
                             v-if="error != null && error.description !== undefined" v-text="error.description[0]"></div>
                    </div>
                    <div class="w-full flex justify-end items-center px-4">
                        <button type="submit" class="btn-theme w-[120px] rounded-lg me-2" v-if="!manageLoading">
                             <span
                                 v-if="!this.categoryParam.id"> Save </span> <span
                                v-if="this.categoryParam.id"> Update </span>
                        </button>
                        <button type="button"
                                class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white"
                                disabled v-if="manageLoading">
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
    <script src="{{asset('/js/categories.js')}}"></script>

@endsection
