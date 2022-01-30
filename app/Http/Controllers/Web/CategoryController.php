<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{

    private $categoryRepository;
    private $limit;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->limit = 10;
    }

    /**
     * index
     *
     * @return void
     */
    public function index(Request $request) {
        $categories = $this->categoryRepository->all($request->all(), $this->limit);
        return Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create() {
        return Inertia::render('Category/Create');
    }

}
