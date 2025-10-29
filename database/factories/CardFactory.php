<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
        $russianAuthors = [
            'Лев Толстой', 'Фёдор Достоевский', 'Антон Чехов', 'Александр Пушкин',
            'Николай Гоголь', 'Иван Тургенев', 'Михаил Лермонтов', 'Александр Солженицын',
            'Владимир Набоков', 'Михаил Булгаков', 'Иван Бунин', 'Максим Горький',
            'Сергей Есенин', 'Анна Ахматова', 'Марина Цветаева', 'Борис Пастернак'
        ];

        $russianTitles = [
            'Война и мир', 'Преступление и наказание', 'Анна Каренина', 'Евгений Онегин',
            'Мёртвые души', 'Отцы и дети', 'Герой нашего времени', 'Мастер и Маргарита',
            'Тихий Дон', 'Доктор Живаго', 'Обломов', 'Идиот', 'Братья Карамазовы',
            'Белая гвардия', 'Ревизор', 'Горе от ума', 'Капитанская дочка'
        ];

        $publishers = [
            'Эксмо', 'АСТ', 'Дрофа', 'Просвещение', 'Росмэн', 
            'Азбука', 'Лениздат', 'Молодая гвардия', 'Художественная литература'
        ];

        return [
            'user_id' => User::factory(),
            'author' => $this->faker->randomElement($russianAuthors),
            'title' => $this->faker->randomElement($russianTitles),
            'type' => $this->faker->randomElement(['share', 'wish']),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'reason' => $this->faker->optional(0.3)->sentence(), // 30% chance to have a reason
            'publisher' => $this->faker->optional(0.7)->randomElement($publishers), // 70% chance to have publisher
            'year' => $this->faker->optional(0.8)->numberBetween(1950, 2023), // 80% chance to have year
            'binding' => $this->faker->optional(0.6)->randomElement(['твердый', 'мягкий', 'интегральный']),
            'condition' => $this->faker->optional(0.5)->randomElement(['отличное', 'хорошее', 'удовлетворительное']),
        ];
    }

    public function share(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'share',
        ]);
    }

    public function wish(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'wish',
        ]);
    }


    public function status(string $status): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => $status,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'reason' => $this->faker->sentence(),
        ]);
    }
}
