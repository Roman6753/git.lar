<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-6">Каталог книг</h1>
        <p class="text-gray-600 mb-6">Здесь вы можете найти книги, которые другие пользователи готовы подарить или обменять, а также книги, которые они ищут.</p>

        @if($cards->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cards as $card)
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 {{ $card->type === 'share' ? 'border-green-500' : 'border-blue-500' }}">
                        <h3 class="text-xl font-bold mb-2">{{ $card->title }}</h3>
                        <p class="text-gray-700 mb-2">Автор: {{ $card->author }}</p>
                        <p class="text-gray-700 mb-2">
                            Тип: 
                            <span class="font-semibold {{ $card->type === 'share' ? 'text-green-600' : 'text-blue-600' }}">
                                {{ $card->type === 'share' ? 'Готов поделиться' : 'Хочу получить' }}
                            </span>
                        </p>
                        <p class="text-gray-700 mb-2">Владелец: {{ $card->user->full_name }}</p>
                        <p class="text-gray-700 mb-2">Контакты: {{ $card->user->email }}, {{ $card->user->phone }}</p>

                        @if($card->publisher || $card->year)
                            <div class="border-t pt-3 mt-3">
                                @if($card->publisher)
                                    <p class="text-gray-600 text-sm">Издательство: {{ $card->publisher }}</p>
                                @endif
                                @if($card->year)
                                    <p class="text-gray-600 text-sm">Год издания: {{ $card->year }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">В каталоге пока нет книг.</p>
        @endif
    </div>
</x-layout>