@extends('user-panel.layout.layout')
@section('content')

    <section class="h-dvh flex justify-center items-center p-3 md:p-5">
        <div class="border p-5 md:p-10  bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-[565px] rounded-md">
            <form class="w-full">
                <div class="text-center text-2xl font-semibold mb-2"> Forget your password? </div>
                <div class="mb-5 text-center text-sm font-medium"> Enter your email to send your reset code </div>
                <div class="mb-5">
                    <label for="email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                    <input id="email" type="text" name="email" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your email">
                </div>
                <a href="{{route('user.panel.reset.account')}}" class="btn-theme rounded-md w-[120px]">
                    Forget
                </a>
            </form>
        </div>
    </section>

@endsection
