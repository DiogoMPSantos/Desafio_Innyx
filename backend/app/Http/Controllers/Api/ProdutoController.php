<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Interfaces\ProdutoRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function __construct(
        protected ProdutoRepositoryInterface $produtoRepository
    ) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->produtoRepository->allPaginated());
    }

    public function store(StoreProdutoRequest $request): JsonResponse
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem')) {
            $arquivo = $request->file('imagem');
            $nomeImagem = uniqid('img_') . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->storeAs('produtos', $nomeImagem, 'public');
            $dados['imagem'] = $nomeImagem;
        }

        $produto = $this->produtoRepository->create($dados);

        return response()->json($produto, 201);
    }

    public function show(int $id): JsonResponse
    {
        $produto = $this->produtoRepository->find($id);
        return response()->json($produto);
    }

    public function update(UpdateProdutoRequest $request, int $id): JsonResponse
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem')) {
            $arquivo = $request->file('imagem');
            $nomeImagem = uniqid('img_') . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->storeAs('produtos', $nomeImagem, 'public');
            $dados['imagem'] = $nomeImagem;
        }

        $produto = $this->produtoRepository->update($id, $dados);

        return response()->json($produto);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->produtoRepository->delete($id);
        return response()->json(['message' => 'Produto excluído com sucesso.']);
    }

    public function search(Request $request): JsonResponse
    {
        $term = $request->query('term', '');
        $perPage = $request->query('per_page', 10);

        $produtos = $this->produtoRepository->search($term, $perPage);
        return response()->json($produtos);
    }
}
