<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-6">Мои карточки</h1>
        
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Активные карточки</h2>
            @if($activeCards->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($activeCards as $card)
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 
                            {{ $card->isPending() ? 'border-yellow-500' : 'border-green-500' }}">
                            <h3 class="text-xl font-bold mb-2">{{ $card->title }}</h3>
                            <p class="text-gray-700 mb-2">Автор: {{ $card->author }}</p>
                            <p class="text-gray-700 mb-2">
                                Тип: 
                                <span class="font-semibold {{ $card->type === 'share' ? 'text-green-600' : 'text-blue-600' }}">
                                    {{ $card->type === 'share' ? 'Готов поделиться' : 'Хочу получить' }}
                                </span>
                            </p>
                            <p class="text-gray-700 mb-4">
                                Статус: 
                                @if($card->isPending())
                                    <span class="text-yellow-600 font-semibold">На модерации</span>
                                @elseif($card->isApproved())
                                    <span class="text-green-600 font-semibold">Одобрено</span>
                                @endif
                            </p>
                            
                            @if($card->publisher || $card->year)
                                <div class="border-t pt-3 mt-3">
                                    @if($card->publisher)
                                        <p class="text-gray-600 text-sm">Издательство: {{ $card->publisher }}</p>
                                    @endif
                                    @if($card->year)
                                        <p class="text-gray-600 text-sm">Год издания: {{ $card->year }}</p>
                                    @endif
                                    @if($card->binding)
                                        <p class="text-gray-600 text-sm">Переплет: {{ $card->binding }}</p>
                                    @endif
                                    @if($card->condition)
                                        <p class="text-gray-600 text-sm">Состояние: {{ $card->condition }}</p>
                                    @endif
                                </div>
                            @endif
                            
                            <div class="mt-4 flex space-x-2">
    <a href="{{ route('cards.edit', $card) }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm transition">
        Редактировать
    </a>
    <form action="{{ route('cards.destroy', $card) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm transition">
            Удалить
        </button>
    </form>
</div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">У вас нет активных карточек.</p>
            @endif
        </div>
        
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Архивные карточки</h2>
            @if($archivedCards->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($archivedCards as $card)
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-gray-400">
                            <h3 class="text-xl font-bold mb-2">{{ $card->title }}</h3>
                            <p class="text-gray-700 mb-2">Автор: {{ $card->author }}</p>
                            <p class="text-gray-700 mb-2">
                                Тип: 
                                <span class="font-semibold {{ $card->type === 'share' ? 'text-green-600' : 'text-blue-600' }}">
                                    {{ $card->type === 'share' ? 'Готов поделиться' : 'Хочу получить' }}
                                </span>
                            </p>
                            <p class="text-gray-700 mb-4">
                                Статус: 
                                @if($card->isRejected())
                                    <span class="text-red-600 font-semibold">Отклонено</span>
                                    @if($card->reason)
                                        <p class="text-gray-600 text-sm mt-1">Причина: {{ $card->reason }}</p>
                                    @endif
                                @else
                                    <span class="text-gray-600 font-semibold">В архиве</span>
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">У вас нет архивных карточек.</p>
            @endif
        </div>
        
        <a href="{{ route('cards.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
            Создать новую карточку
        </a>
    </div>
</x-layout>