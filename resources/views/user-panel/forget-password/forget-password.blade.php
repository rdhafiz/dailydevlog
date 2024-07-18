@extends('user-panel.layout.layout')
@section('content')

    <section class="h-full md:h-dvh flex justify-center items-center p-3 md:p-5">
        <div class="border p-5 md:p-10 bg-gray-50 dark:bg-gray-800 border-cyan-200 dark:border-gray-700 w-full md:w-[565px] rounded-md">

            <form class="w-full forgetContent" id="forgetForm">
                <div class=" text-2xl font-semibold mb-2"> Forgot Password 🔒 </div>
                <div class="mb-5 text-sm"> Enter your email and we'll send you instructions to reset your password </div>
                <div class="mb-5">
                    <label for="forget-email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                    <input id="forget-email" type="email" name="email" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your email">
                    <div class="text-red-500 text-sm mt-2" id="email-error"></div>
                </div>
                <button type="submit" class="btn-theme rounded-md w-[120px]">
                    Forget
                </button>
            </form>

            <form class="w-full resetContent hidden" id="resetForm">
                <div class="text-2xl font-semibold mb-2"> Reset your account </div>
                <div class="mb-5 text-sm"> After fill form to click in reset button </div>
                <div class="mb-5">
                    <label for="email" class="block dark:text-cyan-600 font-semibold"> Email </label>
                    <input id="email" type="email" name="email" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" disabled placeholder="Enter your email">
                    <div class="text-red-500 text-sm mt-2" id="reset-email-error"></div>
                </div>
                <div class="mb-5">
                    <label for="code" class="block dark:text-cyan-600 font-semibold"> Reset code </label>
                    <input id="code" type="text" name="code" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your reset code">
                    <div class="text-red-500 text-sm mt-2" id="reset-code-error"></div>
                </div>
                <div class="mb-5">
                    <label for="password" class="block dark:text-cyan-600 font-semibold"> Password </label>
                    <input id="password" type="password" name="password" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your password">
                    <div class="text-red-500 text-sm mt-2" id="reset-password-error"></div>
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="block dark:text-cyan-600 font-semibold"> Password confirmation </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="outline-0 w-full py-3 border border-transparent border-b-2 border-b-cyan-200 dark:border-b-gray-600 bg-transparent" placeholder="Enter your password confirmation">
                    <div class="text-red-500 text-sm mt-2" id="reset-password-confirmation-error"></div>
                </div>
                <button type="submit" class="btn-theme rounded-md w-[120px]">
                    Reset
                </button>
            </form>

        </div>
    </section>

    <script>

        const forgetForm = document.querySelector('#forgetForm');
        let emailError = document.querySelector('#email-error');
        let forgetContent = document.querySelector('.forgetContent');
        let forgetEmail = document.getElementById('forget-email');

        const resetForm = document.querySelector('#resetForm');
        let resetContent = document.querySelector('.resetContent');

        let email = document.getElementById('email');
        let resetEmailError = document.querySelector('#reset-email-error');
        let resetCodeError = document.querySelector('#reset-code-error');
        let resetPasswordError = document.querySelector('#reset-password-error');
        let resetPasswordConfirmationError = document.querySelector('#reset-password-confirmation-error');

        async function forgetData() {
            const formData = new FormData(forgetForm)
            try {
                const response = await fetch('{{route('API.USER.FORGOT')}}', {
                    method: 'post',
                    body: formData,
                });
                const res = await response.json();
                if(res.status === 200) {
                    email.value = forgetEmail.value
                    forgetContent.classList.add('hidden');
                    resetContent.classList.remove('hidden');
                } else {
                    if(res.error && res.error.email) {
                        emailError.innerText = res?.error.email[0]
                    }
                }
            } catch (err) {
                console.log(err)
            }
        }

        forgetForm.addEventListener("submit", (event) => {
            event.preventDefault();
            forgetData();
        });

        async function resetData() {
            const formData = new FormData(resetForm)
            formData.set('email',email.value)
            try {
                const response = await fetch('{{route('API.USER.RESET')}}', {
                    method: 'post',
                    body: formData,
                });
                const res = await response.json();
                if(res.status === 200) {
                    window.location.href = '{{route('user.panel.login')}}'
                } else {
                    if(res.error && res.error.email) {
                        resetEmailError.innerText = res?.error.email[0]
                    }
                    if(res.error && res.error.code) {
                        resetCodeError.innerText = res?.error.code[0]
                    }
                    if(res.error && res.error.password) {
                        resetPasswordError.innerText = res?.error.password[0]
                    }
                    if(res.error && res.error.password_confirmation) {
                        resetPasswordConfirmationError.innerText = res?.error.password_confirmation[0]
                    }
                }
            } catch (err) {
                console.log(err)
            }
        }

        resetForm.addEventListener("submit", (event) => {
            event.preventDefault();
            resetData();
        });

    </script>

@endsection
