<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-6">Каталог книг</h1>
        
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <form method="GET" action="{{ route('catalog.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" placeholder="Поиск по автору или названию..." 
                           value="{{ request('search') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="flex space-x-4">
                    <select name="type" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Все типы</option>
                        <option value="share" {{ request('type') === 'share' ? 'selected' : '' }}>Готовы поделиться</option>
                        <option value="wish" {{ request('type') === 'wish' ? 'selected' : '' }}>Ищут читатели</option>
                    </select>
                    
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Найти
                    </button>
                    
                    <a href="{{ route('catalog.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                        Сбросить
                    </a>
                </div>
            </form>
        </div>

        @if($cards->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cards as $card)
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 
                        {{ $card->type === 'share' ? 'border-green-500' : 'border-blue-500' }} hover:shadow-lg transition duration-200">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $card->title }}</h3>
                        <p class="text-gray-700 mb-2"><span class="font-semibold">Автор:</span> {{ $card->author }}</p>
                        <p class="text-gray-700 mb-3">
                            <span class="font-semibold">Тип:</span> 
                            <span class="font-semibold {{ $card->type === 'share' ? 'text-green-600' : 'text-blue-600' }}">
                                {{ $card->type === 'share' ? 'Готов поделиться' : 'Хочу получить' }}
                            </span>
                        </p>
                        <p class="text-gray-700 mb-3"><span class="font-semibold">Добавил:</span> {{ $card->user->full_name }}</p>
                        
                        @if($card->publisher || $card->year || $card->binding || $card->condition)
                            <div class="border-t pt-3 mt-3">
                                @if($card->publisher)
                                    <p class="text-gray-600 text-sm"><span class="font-medium">Издательство:</span> {{ $card->publisher }}</p>
                                @endif
                                @if($card->year)
                                    <p class="text-gray-600 text-sm"><span class="font-medium">Год издания:</span> {{ $card->year }}</p>
                                @endif
                                @if($card->binding)
                                    <p class="text-gray-600 text-sm"><span class="font-medium">Переплет:</span> {{ $card->binding }}</p>
                                @endif
                                @if($card->condition)
                                    <p class="text-gray-600 text-sm"><span class="font-medium">Состояние:</span> {{ $card->condition }}</p>
                                @endif
                            </div>
                        @endif
                        
                        <div class="mt-4 pt-3 border-t">
                            <p class="text-sm text-gray-600 mb-1">
                                <span class="font-medium">Email:</span> 
                                <a href="mailto:{{ $card->user->email }}" class="text-blue-600 hover:underline">
                                    {{ $card->user->email }}
                                </a>
                            </p>
                            @if($card->user->phone)
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Телефон:</span> 
                                    <a href="tel:{{ $card->user->phone }}" class="text-blue-600 hover:underline">
                                        {{ $card->user->phone }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Книги не найдены</h3>
                <p class="text-gray-500 mb-4">Попробуйте изменить параметры поиска или сбросить фильтры</p>
                <a href="{{ route('catalog.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Показать все книги
                </a>
            </div>
        @endif
    </div>
</x-layout>