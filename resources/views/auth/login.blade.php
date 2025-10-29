<x-layout>
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Вход в систему</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="login" class="block text-gray-700 mb-2">Логин</label>
                <input type="text" id="login" name="login" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('login') }}" required>
                @error('login')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 mb-2">Пароль</label>
                <input type="password" id="password" name="password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required minlength="6">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                Войти
            </button>
            
            <div class="mt-4 text-center">
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Нет аккаунта? Зарегистрируйтесь</a>
            </div>

            <div class="mt-6 p-4 bg-gray-100 rounded-md">
                <p class="text-sm text-gray-600 text-center">
                    <strong>Для администратора:</strong><br>
                    Логин: admin<br>
                    Пароль: bookworm
                </p>
            </div>
        </form>
    </div>
</x-layout>