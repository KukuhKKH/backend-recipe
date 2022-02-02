<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $limit;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->limit = 10;
    }

    public function index(Request $request) {
        $categories = $this->categoryRepository->all($request->only("sort", "sort_by", "search"), $request->limit ?? $this->limit, $request->offset ?? null);
        return response()->success($categories, "Berhasil Mendapatkan Kategori", 200);
    }
}
