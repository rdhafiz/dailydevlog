@extends('user-panel.layout.layout')
@section('content')

    <section class="h-dvh flex justify-center items-center p-3 md:p-5">
        <div class="border p-5 md:p-10  bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-2/3 xl:w-1/3 rounded-md">
            <form class="w-full">
                <div class="text-center text-2xl font-semibold"> Welcome to your account </div>
                <div class="mb-5 text-center text-sm font-medium mb-2"> Enter your email and password to access your account </div>
                <div class="mb-5">
                    <label for="email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                    <input id="email" type="text" name="email" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your email">
                </div>
                <div class="mb-5">
                    <label for="password" class="block dark:text-cyan-600 font-semibold"> Password </label>
                    <input id="password" type="password" name="password" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your password">
                </div>
                <div class="flex justify-between items-center mb-5 font-medium">
                    <div>
                        <div class="inline-flex items-center">
                            <label class="relative flex items-center p-3 rounded-full cursor-pointer" for="check">
                                <input type="checkbox"
                                       class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                       id="check" />
                                <span class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"
                                         stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </label>
                        </div>
                        <label for="remember-me">
                            <input type="checkbox" name="remember-me" id="remember-me">
                            Remember me
                        </label>
                    </div>
                    <div>
                        <a href="{{route('user.panel.forget.password')}}" class="decoration-0 text-red-500">
                            Forget password
                        </a>
                    </div>
                </div>
                <button type="submit" class="btn-theme rounded-md w-[120px]">
                    Login
                </button>
            </form>
        </div>
    </section>

@endsection
