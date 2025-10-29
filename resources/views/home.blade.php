<x-layout>
    <div class="text-center py-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Добро пожаловать в Буквоежку!</h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Портал для обмена книгами между читателями. Находите новые книги и делитесь теми, что уже прочитали.
        </p>
        
        @auth
            <div class="space-x-4">
                <a href="{{ route('cards.index') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Мои карточки
                </a>
                <a href="{{ route('cards.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Создать карточку
                </a>
                @if(Auth::user()->login === 'admin')
                    <a href="{{ route('admin.index') }}" 
                       class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                        Панель администратора
                    </a>
                @endif
            </div>
        @else
            <div class="space-x-4">
                <a href="{{ route('register') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Зарегистрироваться
                </a>
                <a href="{{ route('login') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Войти
                </a>
            </div>
            
            <div class="mt-12 bg-blue-50 p-6 rounded-lg max-w-3xl mx-auto">
                <h2 class="text-2xl font-semibold mb-4 text-blue-800">Как это работает?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="font-bold text-lg mb-2 text-blue-700">1. Регистрация</h3>
                        <p class="text-gray-600">Создайте аккаунт, указав свои данные</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="font-bold text-lg mb-2 text-blue-700">2. Создайте карточки</h3>
                        <p class="text-gray-600">Укажите книги, которыми хотите поделиться или которые ищете</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="font-bold text-lg mb-2 text-blue-700">3. Обменивайтесь</h3>
                        <p class="text-gray-600">Находите подходящие книги и связывайтесь с другими читателями</p>
                    </div>
                </div>
            </div>
        @endauth
    </div>

    @if(!auth()->check())
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-center mb-8">Популярные книги на платформе</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['author' => 'Лев Толстой', 'title' => 'Война и мир', 'type' => 'share'],
                ['author' => 'Фёдор Достоевский', 'title' => 'Преступление и наказание', 'type' => 'wish'],
                ['author' => 'Михаил Булгаков', 'title' => 'Мастер и Маргарита', 'type' => 'share'],
                ['author' => 'Александр Пушкин', 'title' => 'Евгений Онегин', 'type' => 'wish'],
            ] as $book)
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition duration-200">
                <h3 class="font-bold text-lg mb-2">{{ $book['title'] }}</h3>
                <p class="text-gray-600 mb-3">Автор: {{ $book['author'] }}</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm 
                    {{ $book['type'] === 'share' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ $book['type'] === 'share' ? 'Готовы поделиться' : 'Ищут читатели' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</x-layout>