@extends('user-panel.layout.layout')
@section('content')

    <section class="h-full md:h-dvh flex justify-center items-center p-3 md:p-5">
        <div class="border p-5 md:p-10  bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-[565px] rounded-md">
            <form class="w-full" id="loginForm">
                <div class="text-2xl font-semibold mb-2"> Welcome to Daily Dev Blog! 👋🏻 </div>
                <div class="mb-5 text-sm"> Please sign-in to your account and start the adventure </div>
                <div class="mb-5">
                    <label for="username" class="block dark:text-cyan-600 font-semibold"> Email </label>
                    <input id="username" type="text" name="username" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your username">
                    <div class="text-red-500 text-sm mt-2" id="user-name-error"></div>
                </div>
                <div class="mb-5">
                    <label for="password" class="block dark:text-cyan-600 font-semibold"> Password </label>
                    <input id="password" type="password" name="password" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your password">
                    <div class="text-red-500 text-sm mt-2" id="user-password-error"></div>
                </div>
                <div class="flex justify-between items-center font-medium flex-wrap mb-5">
                    <div class="mb-3">
                        <label for="remember-me" class="flex justify-start items-center cursor-pointer">
                            <input id="remember-me" type="checkbox" class="me-2 form-checkbox">
                            Remember me
                        </label>
                    </div>
                    <div class="mb-3">
                        <a href="{{route('user.panel.forget.password')}}" class="decoration-0 text-red-500">
                            Forgot password
                        </a>
                    </div>
                </div>
                <button type="submit" id="login-button" class="btn-theme rounded-md w-[120px]">
                    Login
                </button>
            </form>
        </div>
    </section>

    <script>

        let userNameError = document.querySelector('#user-name-error');
        let userPasswordError = document.querySelector('#user-password-error');
        const form = document.querySelector('#loginForm');

        async function loginData() {
            const formData = new FormData(form)
            try {
                const response = await fetch('{{route('API.USER.LOGIN')}}', {
                    method: 'post',
                    body: formData,
                });
                const res = await response.json();
                if(res.status === 200) {
                    window.location.reload();
                } else {
                    if(res.error && res.error.username) {
                        userNameError.innerText = res?.error.username[0]
                    }
                    if(res.error && res.error.password) {
                        userPasswordError.innerText = res?.error.password[0]
                    }
                }
            } catch (err) {
                console.log(err)
            }
        }

        form.addEventListener("submit", (event) => {
            event.preventDefault();
            loginData();
        });

    </script>

@endsection
