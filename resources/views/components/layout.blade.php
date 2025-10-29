<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Буквоежка - Портал обмена книгами</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <header class="bg-blue-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold">Буквоежка</h1>
                    <p class="text-blue-200">Портал обмена книгами</p>
                </div>
                <nav>
    <ul class="flex space-x-6">
        <li><a href="{{ route('home') }}" class="hover:text-blue-200 transition">Главная</a></li>
        <li><a href="{{ route('catalog.index') }}" class="hover:text-blue-200 transition">Каталог книг</a></li>
        
        @auth
            <li><a href="{{ route('cards.index') }}" class="hover:text-blue-200 transition">Мои карточки</a></li>
            <li><a href="{{ route('cards.create') }}" class="hover:text-blue-200 transition">Создать карточку</a></li>
            @if(Auth::user()->login === 'admin')
                <li><a href="{{ route('admin.index') }}" class="hover:text-blue-200 transition">Панель администратора</a></li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-blue-200 transition">Выйти ({{ Auth::user()->login }})</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}" class="hover:text-blue-200 transition">Войти</a></li>
            <li><a href="{{ route('register') }}" class="hover:text-blue-200 transition">Регистрация</a></li>
        @endauth
    </ul>
</nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>Буквоежка. Портал обмена книгами.</p>
        </div>
    </footer>
</body>
</html>