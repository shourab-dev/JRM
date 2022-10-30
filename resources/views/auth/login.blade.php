<x-guest-layout>
    <!-- BEGIN: Login Info -->
    <div class="g-col-2 g-col-xl-1 d-none d-xl-flex flex-column min-vh-screen">
        <a href="login-light-login.html" class="-intro-x d-flex align-items-center pt-5">

            <span class="text-white fs-lg ms-3"> Ru<span class="fw-medium">bick</span> </span>
        </a>
        <div class="my-auto">
            <img alt="Rubick Bootstrap HTML Admin Template" class="-intro-x w-1/2 mt-n16"
                src="{{ asset('backend/images/illustration.svg') }}">
            <div class="-intro-x text-white fw-medium fs-4xl lh-base mt-10">
                A few more clicks to
                <br>
                sign in to your account.
            </div>

        </div>
    </div>
    <div class="g-col-2 g-col-xl-1 h-screen h-xl-auto d-flex py-5 py-xl-0 my-10 my-xl-0">
        <div
            class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-2/4 w-xl-auto">
            <h2 class="intro-x fw-bold fs-2xl fs-xl-3xl text-center text-xl-start">
                Sign In
            </h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="intro-x mt-8">
                    <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block"
                        placeholder="Email" name="email">
                    <input type="password"
                        class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4"
                        placeholder="Password" name="password">
                </div>
                <div class="intro-x d-flex text-gray-700 dark-text-gray-600 fs-xs fs-sm-sm mt-4">
                    <div class="d-flex align-items-center me-auto">
                        <input id="remember-me" type="checkbox" class="form-check-input border me-2" name="remember">
                        <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
                <x-jet-validation-errors class="mb-4" />
                <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                    <button class="btn btn-primary py-3 px-4 w-full w-xl-32 me-xl-3 align-top">Login</button>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary py-3 px-4 w-full w-xl-32 mt-3 mt-xl-0 align-top">Sign
                        up</a>
                </div>
            </form>
            <div class="intro-x mt-10 mt-xl-24 text-gray-700 dark-text-gray-600 text-center text-xl-start">
                By signin up, you agree to our
                <br>
                <a class="text-theme-1 dark-text-theme-10" href="login-light-login.html">Terms and
                    Conditions</a> & <a class="text-theme-1 dark-text-theme-10" href="login-light-login.html">Privacy
                    Policy</a>
            </div>
        </div>
    </div>
    <!-- END: Login Form -->
</x-guest-layout>