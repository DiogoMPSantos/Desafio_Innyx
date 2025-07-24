<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Interfaces\ProdutoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    public function allPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Produto::with('categoria')->paginate($perPage);
    }

    public function find(int $id): ?Produto
    {
        return Produto::with('categoria')->find($id);
    }

    public function create(array $data): Produto
    {
        return Produto::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $produto = Produto::findOrFail($id);
        return $produto->update($data);
    }

    public function delete(int $id): bool
    {
        return Produto::destroy($id) > 0;
    }

    public function search(string $term, int $perPage = 10): LengthAwarePaginator
    {
        return Produto::where('nome', 'like', "%$term%")
                      ->orWhere('descricao', 'like', "%$term%")
                      ->paginate($perPage);
    }
}
