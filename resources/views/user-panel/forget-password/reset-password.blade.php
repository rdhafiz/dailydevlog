@extends('user-panel.layout.layout')
@section('content')

    <section class="h-dvh flex justify-center items-center p-3 md:p-5">
        <div class="border p-5 md:p-10  bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-2/3 xl:w-1/3 rounded-md">
            <form class="w-full">
                <div class="text-center text-2xl font-semibold mb-5"> Reset your account </div>
                <div class="mb-5">
                    <label for="email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                    <input id="email" type="text" name="email" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your email">
                </div>
                <div class="mb-5">
                    <label for="reset_code" class="block dark:text-cyan-600 font-semibold"> Reset code </label>
                    <input id="reset_code" type="text" name="reset_code" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your reset code">
                </div>
                <div class="mb-5">
                    <label for="password" class="block dark:text-cyan-600 font-semibold"> Password </label>
                    <input id="password" type="password" name="password" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your password">
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="block dark:text-cyan-600 font-semibold"> Password confirmation </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your password confirmation">
                </div>
                <button type="submit" class="btn-theme rounded-md w-[120px]">
                    Reset
                </button>
            </form>
        </div>
    </section>

@endsection
