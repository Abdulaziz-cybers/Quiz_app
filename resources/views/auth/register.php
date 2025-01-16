<?php componentsMain('header');?>
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Already have an account?
                <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
        <form id="form_" class="mt-8 space-y-6" onsubmit="register()">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="full_name" class="sr-only">Full name</label>
                    <input id="full_name" name="full_name" type="text" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Full name">
                </div>
                <div class="relative">
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" required
                           class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Email address">
                </div>
                <div class="relative">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required
                           class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Password">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 text-gray-500">
                        <i id="passwordIcon" class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="relative">
                    <label for="password_confirm" class="sr-only">Confirm Password</label>
                    <input id="password_confirm" name="password_confirm" type="password" required
                           class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Confirm password">
                    <button type="button" id="togglePasswordConfirm" class="absolute inset-y-0 right-0 px-3 text-gray-500">
                        <i id="passwordConfirmIcon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" required
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="terms" class="ml-2 block text-sm text-gray-900">
                    I agree to the
                    <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                </label>
            </div>
            <div id="error"></div>
            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
<script src="/js/register.js"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });

    document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
        const passwordConfirmInput = document.getElementById('password_confirm');
        const passwordConfirmIcon = document.getElementById('passwordConfirmIcon');

        if (passwordConfirmInput.type === 'password') {
            passwordConfirmInput.type = 'text';
            passwordConfirmIcon.classList.remove('fa-eye');
            passwordConfirmIcon.classList.add('fa-eye-slash');
        } else {
            passwordConfirmInput.type = 'password';
            passwordConfirmIcon.classList.remove('fa-eye-slash');
            passwordConfirmIcon.classList.add('fa-eye');
        }
    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</body>
</html>