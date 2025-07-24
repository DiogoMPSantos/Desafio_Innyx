<?php

namespace App\Interfaces;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Collection;

interface CategoriaRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Categoria;
    public function create(array $data): Categoria;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
