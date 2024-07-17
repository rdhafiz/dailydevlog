@extends('user-panel.layout.layout')
@section('content')

    <section class="h-dvh flex justify-center items-center p-3 md:p-5">
        <div class="border p-5 md:p-10  bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-[565px] rounded-md">
            <form class="w-full">
                <div class="text-2xl font-semibold mb-2"> Welcome to Daily Dev Blog!👋🏻 </div>
                <div class="mb-5 text-sm"> Please sign-in to your account and start the adventure </div>
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
                        <label for="remember-me" class="flex justify-start items-center cursor-pointer">
                            <input id="remember-me" type="checkbox" class="me-2 form-checkbox">
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
