<?

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;
use App\Interfaces\CategoriaRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    public function __construct(
        protected CategoriaRepositoryInterface $categoryRepository
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->categoryRepository->all());
    }

    public function store(StoreCategoriaRequest $request): JsonResponse
    {
        $category = $this->categoryRepository->create($request->validated());
        return response()->json($category, 201);
    }

    public function show(int $id): JsonResponse
    {
        $category = $this->categoryRepository->find($id);
        return response()->json($category);
    }

    public function update(UpdateCategoriaRequest $request, int $id): JsonResponse
    {
        $category = $this->categoryRepository->update($id, $request->validated());
        return response()->json($category);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->categoryRepository->delete($id);
        return response()->json(['message' => 'Categoria deleteda com sucesso.']);
    }
}
