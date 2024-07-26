<div id="footer">
    <footer class="container mx-auto py-10 px-5">
        <div
            class="w-full flex flex-wrap border border-gray-300 p-10 rounded-3xl bg-blue-50 dark:border-gray-700 dark:bg-gray-900">
            <div class="w-full sm:w-1/2 xl:w-1/3">

                <div class="my-5">
                    <img src="{{asset('/images/logo-dark.svg')}}" class="w-[120px]" alt="logo-dark">
                </div>

                <p class="text-gray-600 font-semibold pe-5 dark:text-cyan-700">
                    When an unknown prnoto sans took a galley and scrambled it to make specimen book not only five When an
                    unknown prnoto sans took a galley and scrambled it to five centurie.
                </p>

                <div class="font-semibold my-5 text-2xl text-gray-400 dark:text-cyan-500">
                    Address
                </div>
                <p class="text-gray-600 font-semibold mb-10 dark:text-cyan-700">
                    123 Main Street
                    <br>
                    New York, NY 10001
                </p>
            </div>
            <div class="w-full sm:w-1/2 xl:w-1/3">
                <div class="font-semibold my-5 text-2xl text-gray-400 dark:text-cyan-500">
                    Categories
                </div>

                <div class="mb-5">
                    <div class="flex flex-wrap">
                        <div class="w-full" v-for="(each) in categoryData">
                            <a href="javascript:void(0)" class="decoration-0 text-gray-600 font-semibold duration-500 ps-0 hover:ps-4 block p-3 dark:text-cyan-700 dark:hover:text-cyan-400 hover:text-cyan-400">
                                @{{ each.name }}
                            </a>
                        </div>
                    </div>

                </div>

            </div>
            <div class="w-full sm:w-1/2 xl:w-1/3">

                <div class="font-semibold my-5 text-2xl text-gray-400 dark:text-cyan-500">
                    Newsletter
                </div>

                <div class="relative mb-5">
                    <div class="absolute top-0 bottom-0 start-0 flex justify-start items-center h-full">
                        <img src="{{asset('/images/footer/person.svg')}}" class="w-[24px]" alt="person">
                    </div>
                    <input type="text" name="name"
                           class="bg-transparent w-full outline-0 border-0 border-b-2 border-b-gray-300 py-4 ps-7"
                           placeholder="Enter your name here">
                </div>

                <div class="relative mb-5">
                    <div class="absolute top-0 bottom-0 start-0 flex justify-start items-center h-full">
                        <img src="{{asset('/images/footer/envelope.svg')}}" class="w-[24px]" alt="person">
                    </div>
                    <input type="text" name="email"
                           class="bg-transparent w-full outline-0 border-0 border-b-2 border-b-gray-300 py-4 ps-7"
                           placeholder="Enter your email here">
                </div>

                <a href="javascript:void(0)" class="btn-theme px-5 rounded-md">
            <span class="flex justify-center items-center">
                Subscribe
                <span class="ms-2">
                   <img src="{{asset('/images/home/arrow-right.svg')}}" class="w-[18px] h-[18px]" alt="arrow-right">
                </span>
            </span>
                </a>

            </div>
            <div class="w-full xl:w-1/2 lg:py-10 order-2 lg:order-1">
                <a href="https://redishketch.com/" class="decoration-0 text-gray-600 font-semibold dark:text-cyan-500 max-[500px]:text-[14px]">
                    © 2023 Created by Redishketch.com
                </a>
            </div>
            <div class="w-full xl:w-1/2 py-10 flex flex-wrap justify-start xl:justify-end gap-5 order-1 lg:order-1">
                <a href="javascript:void(0)"
                   class="decoration-0 text-gray-800 dark:text-gray-400 flex justify-start items-center font-semibold gap-x-2 group">
                    <svg class="transition duration-500 fill-gray-400 group-hover:fill-cyan-500" height="24px" width="24px"
                         version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-143 145 512 512" xml:space="preserve"><g
                            id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M113,145c-141.4,0-256,114.6-256,256s114.6,256,256,256s256-114.6,256-256S254.4,145,113,145z M169.5,357.6l-2.9,38.3h-39.3 v133H77.7v-133H51.2v-38.3h26.5v-25.7c0-11.3,0.3-28.8,8.5-39.7c8.7-11.5,20.6-19.3,41.1-19.3c33.4,0,47.4,4.8,47.4,4.8l-6.6,39.2 c0,0-11-3.2-21.3-3.2c-10.3,0-19.5,3.7-19.5,14v29.9H169.5z"></path>
                        </g></svg>
                    <span class="transition duration-500 group-hover:text-cyan-400"> Facebook </span>
                </a>
                <a href="javascript:void(0)"
                   class="decoration-0 text-gray-800 dark:text-gray-400 flex justify-start items-center font-semibold gap-x-2 group">
                    <svg class="transition duration-500 fill-gray-400 group-hover:fill-cyan-500" height="24px" width="24px"
                         version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-143 145 512 512" xml:space="preserve"
                         stroke="#8888"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M113,145c-141.4,0-256,114.6-256,256s114.6,256,256,256s256-114.6,256-256S254.4,145,113,145z M41.4,508.1H-8.5V348.4h49.9 V508.1z M15.1,328.4h-0.4c-18.1,0-29.8-12.2-29.8-27.7c0-15.8,12.1-27.7,30.5-27.7c18.4,0,29.7,11.9,30.1,27.7 C45.6,316.1,33.9,328.4,15.1,328.4z M241,508.1h-56.6v-82.6c0-21.6-8.8-36.4-28.3-36.4c-14.9,0-23.2,10-27,19.6 c-1.4,3.4-1.2,8.2-1.2,13.1v86.3H71.8c0,0,0.7-146.4,0-159.7h56.1v25.1c3.3-11,21.2-26.6,49.8-26.6c35.5,0,63.3,23,63.3,72.4V508.1z "></path>
                        </g></svg>
                    <span class="transition duration-500 group-hover:text-cyan-400"> Linkedin </span>
                </a>
                <a href="javascript:void(0)"
                   class="decoration-0 text-gray-800 dark:text-gray-400 flex justify-start items-center font-semibold gap-x-2 group">
                    <svg class="transition duration-500 fill-gray-400 group-hover:fill-cyan-500" height="24px" width="24px"
                         version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-143 145 512 512" xml:space="preserve"
                         stroke="#8888"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M113,145c-141.4,0-256,114.6-256,256s114.6,256,256,256s256-114.6,256-256S254.4,145,113,145z M215.2,361.2 c0.1,2.2,0.1,4.5,0.1,6.8c0,69.5-52.9,149.7-149.7,149.7c-29.7,0-57.4-8.7-80.6-23.6c4.1,0.5,8.3,0.7,12.6,0.7 c24.6,0,47.3-8.4,65.3-22.5c-23-0.4-42.5-15.6-49.1-36.5c3.2,0.6,6.5,0.9,9.9,0.9c4.8,0,9.5-0.6,13.9-1.9 C13.5,430-4.6,408.7-4.6,383.2v-0.6c7.1,3.9,15.2,6.3,23.8,6.6c-14.1-9.4-23.4-25.6-23.4-43.8c0-9.6,2.6-18.7,7.1-26.5 c26,31.9,64.7,52.8,108.4,55c-0.9-3.8-1.4-7.8-1.4-12c0-29,23.6-52.6,52.6-52.6c15.1,0,28.8,6.4,38.4,16.6 c12-2.4,23.2-6.7,33.4-12.8c-3.9,12.3-12.3,22.6-23.1,29.1c10.6-1.3,20.8-4.1,30.2-8.3C234.4,344.5,225.5,353.7,215.2,361.2z"></path>
                        </g></svg>
                    <span class="transition duration-500 group-hover:text-cyan-400"> Twitter </span>
                </a>
                <a href="javascript:void(0)"
                   class="decoration-0 text-gray-800 dark:text-gray-400 flex justify-start items-center font-semibold gap-x-2 group">
                    <svg class="transition duration-500 fill-gray-400 group-hover:fill-cyan-500" height="24px" width="24px"
                         version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-143 145 512 512" xml:space="preserve"
                         stroke="#8888"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M113,446c24.8,0,45.1-20.2,45.1-45.1c0-9.8-3.2-18.9-8.5-26.3c-8.2-11.3-21.5-18.8-36.5-18.8s-28.3,7.4-36.5,18.8 c-5.3,7.4-8.5,16.5-8.5,26.3C68,425.8,88.2,446,113,446z"></path>
                                <polygon
                                    points="211.4,345.9 211.4,308.1 211.4,302.5 205.8,302.5 168,302.6 168.2,346 "></polygon>
                                <path
                                    d="M183,401c0,38.6-31.4,70-70,70c-38.6,0-70-31.4-70-70c0-9.3,1.9-18.2,5.2-26.3H10v104.8C10,493,21,504,34.5,504h157 c13.5,0,24.5-11,24.5-24.5V374.7h-38.2C181.2,382.8,183,391.7,183,401z"></path>
                                <path
                                    d="M113,145c-141.4,0-256,114.6-256,256s114.6,256,256,256s256-114.6,256-256S254.4,145,113,145z M241,374.7v104.8 c0,27.3-22.2,49.5-49.5,49.5h-157C7.2,529-15,506.8-15,479.5V374.7v-52.3c0-27.3,22.2-49.5,49.5-49.5h157 c27.3,0,49.5,22.2,49.5,49.5V374.7z"></path>
                            </g>
                        </g></svg>
                    <span class="transition duration-500 group-hover:text-cyan-400"> Instagram </span>
                </a>
            </div>
        </div>
    </footer>

    <script src="{{asset('/js/footer.js')}}"></script>

</div>
