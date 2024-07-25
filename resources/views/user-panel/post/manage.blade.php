@extends('user-panel.layout.layout')
@section('content')

    <div id="post">
    <div class="border border-cyan-100 dark:border-cyan-900 bg-cyan-100 dark:bg-cyan-800 rounded-3xl p-10">
        <form @submit.prevent="managePost">
            <div class="mb-7 text-2xl md:text-4xl font-bold"> <span v-if="postParam.id === undefined"> Create </span> <span v-if="postParam.id !== undefined"> Edit </span> Post </div>
            <div class="w-full flex-wrap flex">
                <div class="mb-5 w-full md:w-1/2 px-4">
                    <label for="title" class="block font-semibold"> Title </label>
                    <input id="title" type="text" name="title" v-model="postParam.title" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" v-model="postParam.title" placeholder="Enter your post title">
                    <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.title !== undefined" v-text="error.title[0]"></div>
                </div>
                <div class="mb-5 w-full md:w-1/2 px-4">
                    <label for="slug" class="block font-semibold"> Slug </label>
                    <input id="slug" type="text" name="slug" v-model="postParam.slug" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" v-model="postParam.slug" placeholder="Enter your post slug">
                    <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.slug !== undefined" v-text="error.slug[0]"></div>
                </div>
                <div class="mb-5 w-full px-4">
                    <label for="content" class="block font-semibold"> Content </label>
                    <textarea name="content" id="content" v-model="postParam.content" class="resize-0 py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Write your content here"></textarea>
                    <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.content !== undefined" v-text="error.content[0]"></div>
                </div>
                <div class="mb-5 w-full md:w-1/2 px-4">
                    <label for="category" class="block font-semibold"> Category </label>
                    <div class="relative inline-block text-left w-full" id="categoryDropdown" @click="categpryDropdown">
                    <div class="py-5 pe-5 w-full border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white h-[65px]" id="insertToggle">
                        <span class="cursor-pointer border-0 outline-0 bg-cyan-400 py-2 px-5 inline-block duration-500 hover:bg-cyan-700 relative" v-if="insertedData">
                            @{{insertedData}}
                        </span>
                    </div>
                    <div
                        class="absolute left-0 z-10 mt-1 w-full origin-top-left p-0 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none rounded overflow-hidden hidden" id="inserted-dropdown">
                        <div role="none" class="w-full max-h-[200px] overflow-y-scroll">
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Honda
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Modhi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Hindi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Glindi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Honda
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Modhi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Hindi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Glindi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Honda
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Modhi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Hindi
                            </button>
                            <button type="button" class="border-0 outline-0 text-black block w-full text-start duration-500 p-3 hover:bg-black hover:text-white" @click="insertData($event)">
                                Glindi
                            </button>
                        </div>
                    </div>
                    <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.category_id !== undefined" v-text="error.category_id[0]"></div>
                </div>
                </div>
                <div class="mb-5 w-full md:w-1/2 px-4">
                    <label for="status" class="block font-semibold"> Status </label>
                    <select name="status" id="status" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" v-model="postParam.status">
                        <option value="draft" class="text-black">Draft</option>
                        <option value="published" class="text-black">Published</option>
                        <option value="archived" class="text-black">Archived</option>
                    </select>
                    <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.status !== undefined" v-text="error.status[0]"></div>
                </div>
                <div class="mb-5 w-full md:w-1/2 px-4">
                    <label for="title" class="block font-semibold"> Meta Title </label>
                    <input id="title" type="text" name="meta_title" v-model="postParam.meta_title" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Enter your post Meta Title">
                    <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.meta_title !== undefined" v-text="error.meta_title[0]"></div>
                </div>
                <div class="mb-5 w-full px-4">
                    <label for="meta_description" class="block font-semibold"> Meta Description </label>
                    <textarea name="meta_description" id="meta_description" v-model="postParam.meta_description" class="resize-0 py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white" placeholder="Write your meta description"></textarea>
                    <div class="error-report text-red-500 text-sm mt-2" v-if="error != null && error.meta_description !== undefined" v-text="error.meta_description[0]"></div>
                </div>
                <div class="mb-5 w-full md:w-1/2 px-4">
                    <label for="is_featured" class="block font-semibold"> Is Featured? </label>
                    <select name="is_featured" id="is_featured" v-model="postParam.is_featured" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white">
                        <option value="true" class="text-black">Yes</option>
                        <option value="false" class="text-black">No</option>
                    </select>
                </div>
                <div class="mb-5 w-full md:w-1/2 px-4">
                    <label for="allow_comment" class="block font-semibold"> Allow Comment </label>
                    <select name="allow_comments" id="allow_comments" v-model="postParam.allow_comments" class="py-5 pe-5 border-0 border-b border-b-cyan-400 bg-transparent text-black w-full outline-0 dark:text-white">
                        <option value="true" class="text-black">Yes</option>
                        <option value="false" class="text-black">No</option>
                    </select>
                </div>
                <div class="mb-5 w-full px-4">
                    <div class="w-full md:w-1/2" v-if="postParam.featured_image !== null">
                        <img :src="'/storage/media/'+postParam.featured_image" class="w-full object-fit bg-cover" alt="">
                    </div>
                    <div class="w-full md:w-1/2" v-if="postParam.featured_image === null">
                        <label for="upload-file" class="w-full h-[250px] flex justify-center items-center cursor-pointer border border-cyan-400 rounded-lg bg-transparent duration-500 hover:bg-cyan-400 hover:text-black fw-medium">
                            <input type="file" id="upload-file" class="hidden" @change="uploadFile($event)">
                            Upload Featured Image
                        </label>
                    </div>
                </div>
                <div class="flex justify-end items-center px-4">
                    <button type="submit" class="btn-theme w-[120px] rounded-lg" v-if="!manageLoading">
                        <span v-if="postParam.id === undefined">
                            Save
                        </span>
                        <span v-if="postParam.id !== undefined">
                            Update
                        </span>
                    </button>
                        <button type="button" class="btn-theme rounded-md w-[120px] flex justify-center items-center h-[45px] text-white" disabled v-if="manageLoading">
                            <svg class="h-5 mx-auto w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{asset('/js/post.js')}}"></script>

@endsection
