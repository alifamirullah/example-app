<!DOCTYPE html>
<html>
<head>
    <title>ABCD Website </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
      </svg>

      <a class="font-big text-xl" href='/home'>ABCD</a>
      </a>
      </div>
</header>
<main class="login-form">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                           <section class="text-gray-600 body-font">
                                <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
                                 <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                                  <h1 class="title-font font-medium text-3xl text-gray-900">Log in to the website</h1>
                                  <p class="leading-relaxed mt-4">You need to log in to access the site.</p>
                                </div>
                                <div class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                                  <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Sign Up</h2>
                                  <div class="relative mb-4">
                                    <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                                    <input type="text" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                    </div>
                                  <div class="relative mb-4">
                                    <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
                                    <input type="password" id="password" name="password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                  </div>
                                  <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Sign In</button>
                                  <p class="text-s text-gray-800 mt-3">If you have not register click<a class="text-s text-green-800 mt-3" href="/registration"> here.</a></p>
                                  
                                </div>
                              </div>
                            </section>
                        </form>
</main>
</body>
</html>
