<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <nav class="sticky top-0 py-4 bg-ternary">
        <div class="container mx-auto flex justify-between items-center">
            <a>Logo</a>
            <ul class="flex">
                @guest
                    @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}">
                                <div class="border-2 rounded-2xl border-black mr-2 px-9 py-2 text-sm">
                                    Log In
                                </div>
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">
                                <div class="border-2 rounded-2xl border-black bg-primary px-9 py-2 text-white text-sm">
                                    Sign Up
                                </div>
                            </a>
                        </li>
                    @endif
                @else
                    <li>
                        <div class="flex items-center">
                            <a href="#">
                                {{ Auth::user()->name }}
                            </a>

                            <form action="{{ route('logout') }}" method="POST" class="ml-2">
                                @csrf
                                <button href="{{ route('logout') }}"
                                    class="border-2 rounded-2xl border-black bg-primary px-9 py-2 text-white text-sm" type="submit">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    @yield('content')
    <footer class="bg-primary py-6">
        <div class="container mx-auto text-white text-center text-sm">
            2021 Made by Daking🦆
        </div>
    </footer>
</body>

</html>