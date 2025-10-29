<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-6">Панель администратора</h1>
        
        @if($cards->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cards as $card)
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                        <h3 class="text-xl font-bold mb-2">{{ $card->title }}</h3>
                        <p class="text-gray-700 mb-2">Автор: {{ $card->author }}</p>
                        <p class="text-gray-700 mb-2">
                            Тип: 
                            <span class="font-semibold {{ $card->type === 'share' ? 'text-green-600' : 'text-blue-600' }}">
                                {{ $card->type === 'share' ? 'Готов поделиться' : 'Хочу получить' }}
                            </span>
                        </p>
                        <p class="text-gray-700 mb-2">Пользователь: {{ $card->user->full_name }} ({{ $card->user->login }})</p>
                        
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
                            <form action="{{ route('admin.cards.approve', $card) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded text-sm transition">
                                    Одобрить
                                </button>
                            </form>
                            
                            <button type="button" 
                                    onclick="openRejectModal({{ $card->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm transition">
                                Отклонить
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Нет карточек для модерации.</p>
        @endif
    </div>

    <!-- Модальное окно для указания причины отклонения -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900">Укажите причину отклонения</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mt-2">
                        <textarea name="reason" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  required></textarea>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition">
                            Отклонить
                        </button>
                        <button type="button" 
                                onclick="closeRejectModal()"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition">
                            Отмена
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal(cardId) {
            document.getElementById('rejectForm').action = '/admin/cards/' + cardId + '/reject';
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-layout>