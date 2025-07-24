<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Interfaces\CategoriaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoriaRepository implements CategoriaRepositoryInterface
{
    public function all(): Collection
    {
        return Categoria::all();
    }

    public function find(int $id): ?Categoria
    {
        return Categoria::find($id);
    }

    public function create(array $data): Categoria
    {
        return Categoria::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $categoria = Categoria::findOrFail($id);
        return $categoria->update($data);
    }

    public function delete(int $id): bool
    {
        return Categoria::destroy($id) > 0;
    }
}
