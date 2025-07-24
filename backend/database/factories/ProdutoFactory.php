<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'nome' => $this->faker->word(),
            'descricao' => $this->faker->sentence(6),
            'preco' => $this->faker->randomFloat(2, 1, 1000),
            'data_validade' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'imagem' => 'https://picsum.photos/seed/' . $this->faker->uuid . '/600/400',
            'categoria_id' => Categoria::inRandomOrder()->first()->id ?? Categoria::factory(),
        ];
    }
}
