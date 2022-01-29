<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * index
     *
     * @return void
     */
     public function index() {
        $category = $this->categoryRepository->all();
        return Inertia::render('Category/Index', [
            'category' => $category
        ]);
     }
}
