<x-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Редактирование карточки книги</h1>
        
        <form method="POST" action="{{ route('cards.update', $card) }}">
            @csrf
            @method('PUT')
            
            <div class="flex space-x-4">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                    Обновить карточку
                </button>
                <a href="{{ route('cards.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded transition">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</x-layout>