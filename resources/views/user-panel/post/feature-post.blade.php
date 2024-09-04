@extends('user-panel.layout.layout')
@section('title', 'Daily Dev Log | Insights & Tutorials on Web and Mobile App Development')
@section('content')

    <div id="featured-post">
        <div class="fixed-container mt-[50px]">
            <div class="w-full px-4" v-if="tableData.length === 0 && !loading">
                <div
                    class="w-full overflow-hidden rounded-3xl h-[500px] flex justify-center items-center border-2 border-cyan-500 flex-col">
                    <div class="font-medium text-cyan-600 dark:text-gray-500 text-2xl">No feature blog found.</div>
                </div>
            </div>

            <div class="px-3" v-if="loading">
                <div class="w-full h-[100vh] flex justify-center items-center">
                    <span>
                        <svg class="h-[60px] mx-auto w-[60px] animate-spin text-white"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </div>
            </div>

            <template v-if="tableData.length > 0 && !loading">
                <div class="grid grid-cols-1 sm:grid-cols-2 min-[917px]:grid-cols-3 gap-[15px]">
                    <template v-for="(each, index) in tableData">
                        <div class="group rounded-2xl bg-white dark:bg-[#222222] shadow-lg sm:h-[316px]"
                             :class="{ 'sm:col-span-2 block sm:grid sm:grid-cols-2 sm:gap-[15px]' : index === 0, 'col-span-1 lg:col-span-1 flex flex-col' : index > 0 }">
                            <a :href="`/blog-details/`+each.id" class="block rounded-2xl overflow-hidden min-h-[120px]"
                               :class="{ 'sm:w-[316px] sm:h-[316px] sm:col-span-1 h-[120px] w-full' : index === 0, 'h-[125px]' : index > 0 }">
                                <img :src="'/storage/media/'+ each.featured_image"
                                     class="!h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                     alt="blog image" v-if="each.featured_image">
                                <img src="{{asset('/images/default.png')}}"
                                     class="h-full w-full rounded-2xl object-cover scale-[1] group-hover:scale-[1.2] duration-500"
                                     alt="blog image" v-if="!each.featured_image">
                            </a>
                            <div class="grow flex flex-col gap-0 justify-between overflow-auto"
                                 :class="{ 'sm:col-span-1 text-center sm:text-left pr-[6px] pt-[15px] pb-2' : index === 0, 'px-2 pt-2 pb-1 text-center' : index > 0 }">
                                <div class="overflow-auto">
                                    <a :href="`/blog-details/`+each.id"
                                       class="text-secondary dark:text-white block font-bold dark:hover:text-second hover:text-second duration-500"
                                       :class="{ 'text-truncate-line-3 text-[20px] leading-[30px]' : index === 0, 'text-truncate-line-2 text-[17px] leading-[25.5px]' : index > 0 }">
                                        @{{ each.title }}
                                    </a>
                                    <div class="flex flex-wrap items-center pt-1 pb-[12px]"
                                         :class="{ 'gap-x-[9px] justify-center sm:justify-start' : index === 0, 'gap-x-[8px] justify-center' : index > 0 }">
                                        <div v-for="(tag, indexTag) in each?.tags"
                                             class="rounded-2xl leading-[14px] font-[400] text-center flex justify-center items-center capitalize"
                                             :class="{'bg-primary !text-white': indexTag === 0, 'bg-first !text-[#333333]': indexTag === 1, 'bg-dark3 !text-white': indexTag === 2, 'bg-red !text-white': indexTag === 3, 'w-[65px] h-[20px] text-[12px]' : index === 0, 'w-[50px] h-[16px] text-[11px]' : index > 0 }">
                                            @{{ tag }}
                                        </div>
                                    </div>
                                    <div class="font-[400] leading-[21px] text-black dark:!text-light2"
                                         :class="{ 'text-[14px] text-truncate-line-5' : index === 0, 'text-[13px] text-truncate-line-3' : index > 0 }">
                                        <p>@{{ each.short_description }}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center font-[400] text-secondary dark:!text-light2 text-[13px] leading-[19.5px] pb-[2px] gap-1"
                                    :class="{ 'justify-center sm:justify-start' : index === 0, 'justify-center' : index > 0 }">
                                    <span>@{{ each.published_at_format }}</span>
                                    <span>•</span>
                                    <span>3m Read</span>
                                    <span>•</span>
                                    <span>@{{ each.views_count }} Views</span>
                                </div>
                            </div>

                        </div>
                    </template>
                </div>
            </template>

            <div class="mt-5 flex justify-center items-center"
                 v-if="tableData.length > 0 && loading === false && last_page > 1">
                <div class="flex justify-center items-center gap-x-1">
                    <div @click="PrevPage()">
                        <a href="javascript:void(0)"
                           class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"
                                 fill="none"
                                 stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="acorn-icons acorn-icons-chevron-left undefined">
                                <path
                                    d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>
                            </svg>
                        </a>
                    </div>
                    <div v-if="buttons.length <= 6" class="flex justify-center items-center gap-x-1">
                        <div v-for="(page, index) in buttons">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="{'bg-cyan-400': page === current_page}"
                               @click="pageChange(page)" v-text="page"></a>
                        </div>
                    </div>
                    <div v-if="buttons.length > 6" class="flex justify-center items-center gap-x-1">
                        <div>
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="formData.page === 0 || formData.page === 1 ? 'bg-cyan-400' : ''"
                               @click="pageChange(1)">1</a>
                        </div>
                        <div v-if="current_page > 3">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               @click="pageChange(current_page - 2)">...</a>
                        </div>
                        <div v-if="current_page == buttons.length">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="formData.page === current_page - 2 ? 'bg-cyan-400' : ''"
                               @click="pageChange(current_page - 2)" v-text="current_page - 2"></a>
                        </div>
                        <div v-if="current_page > 2">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="formData.page === current_page - 1 ? 'bg-cyan-400' : ''"
                               @click="pageChange(current_page - 1)" v-text="current_page - 1"></a>
                        </div>
                        <div v-if="current_page != 1 && current_page != buttons.length">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="formData.page === current_page ? 'bg-cyan-400' : ''"
                               @click="pageChange(current_page)" v-text="current_page"></a>
                        </div>
                        <div v-if="current_page < buttons.length - 1">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="formData.page === current_page + 1 ? 'bg-cyan-400' : ''"
                               @click="pageChange(current_page + 1)" v-text="current_page + 1"></a>
                        </div>
                        <div v-if="current_page == 1">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="formData.page === current_page + 2 ? 'bg-cyan-400' : ''"
                               @click="pageChange(current_page + 2)" v-text="current_page + 2"></a>
                        </div>
                        <div v-if="current_page < buttons.length - 2">
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               @click="pageChange(current_page + 2)">...</a>
                        </div>
                        <div>
                            <a href="javascript:void(0)"
                               class="p-3 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"
                               :class="{'bg-cyan-400': formData.page === last_page }"
                               @click="pageChange(buttons.length)" v-text="buttons.length"></a>
                        </div>
                    </div>
                    <div @click="NextPage()">
                        <a href="javascript:void(0)"
                           class="p-2 border border-cyan-400 outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined">
                                <path
                                    d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('/js/featured-post.js')}}"></script>

@endsection
