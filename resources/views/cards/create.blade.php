<x-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Создание карточки книги</h1>
        
        <form method="POST" action="{{ route('cards.store') }}">
            @csrf
            
            <div class="mb-4">
                <label for="author" class="block text-gray-700 mb-2">Автор книги *</label>
                <input type="text" id="author" name="author" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('author') }}" required>
                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="title" class="block text-gray-700 mb-2">Название книги *</label>
                <input type="text" id="title" name="title" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('title') }}" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Тип карточки *</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="type" value="share" 
                               class="mr-2 text-blue-600 focus:ring-blue-500" 
                               {{ old('type') === 'share' ? 'checked' : 'checked' }}>
                        <span class="text-green-600 font-medium">Готов поделиться</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="type" value="wish" 
                               class="mr-2 text-blue-600 focus:ring-blue-500"
                               {{ old('type') === 'wish' ? 'checked' : '' }}>
                        <span class="text-blue-600 font-medium">Хочу в свою библиотеку</span>
                    </label>
                </div>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Дополнительные поля -->
            <div class="border-t pt-4 mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Дополнительная информация (необязательно)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="publisher" class="block text-gray-700 mb-2">Издательство</label>
                        <input type="text" id="publisher" name="publisher" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('publisher') }}">
                    </div>
                    
                    <div>
                        <label for="year" class="block text-gray-700 mb-2">Год издания</label>
                        <input type="number" id="year" name="year" min="1900" max="{{ date('Y') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('year') }}">
                    </div>
                    
                    <div>
                        <label for="binding" class="block text-gray-700 mb-2">Переплет</label>
                        <select id="binding" name="binding" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Выберите тип переплета</option>
                            <option value="твердый" {{ old('binding') === 'твердый' ? 'selected' : '' }}>Твердый</option>
                            <option value="мягкий" {{ old('binding') === 'мягкий' ? 'selected' : '' }}>Мягкий</option>
                            <option value="интегральный" {{ old('binding') === 'интегральный' ? 'selected' : '' }}>Интегральный</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="condition" class="block text-gray-700 mb-2">Состояние книги</label>
                        <select id="condition" name="condition" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Выберите состояние</option>
                            <option value="отличное" {{ old('condition') === 'отличное' ? 'selected' : '' }}>Отличное</option>
                            <option value="хорошее" {{ old('condition') === 'хорошее' ? 'selected' : '' }}>Хорошее</option>
                            <option value="удовлетворительное" {{ old('condition') === 'удовлетворительное' ? 'selected' : '' }}>Удовлетворительное</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="flex space-x-4">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                    Отправить на модерацию
                </button>
                <a href="{{ route('cards.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded transition">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</x-layout>