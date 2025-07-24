<?php

namespace App\Interfaces;

use App\Models\Produto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProdutoRepositoryInterface
{
    public function allPaginated(int $perPage = 10): LengthAwarePaginator;
    public function find(int $id): ?Produto;
    public function create(array $data): Produto;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function search(string $term, int $perPage = 10): LengthAwarePaginator;
}
