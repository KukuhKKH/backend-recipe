<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{

    private $categoryRepository;
    private $limit;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->limit = 1;
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

    /**
     * store
     *
     * @return void
     */
    public function store(CategoryStoreRequest $categoryStoreRequest) {
        try {
            $this->categoryRepository->store($categoryStoreRequest->all());
            return Redirect::route('category.index')->with('success', "Berhasil Membuat Kategori");
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * create
     *
     * @return void
     */
    public function edit($id) {
        try {
            $category = $this->categoryRepository->show($id);
            return Inertia::render('Category/Edit', [
                'category' => $category
            ]);
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update(CategoryUpdateRequest $categoryUpdateRequest, $id) {
        try {
            $this->categoryRepository->update($categoryUpdateRequest->all(), $id);
            return Redirect::route('category.index')->with('success', "Berhasil Mengubah Kategori");
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * destroy
     *
     * @return void
     */
    public function destroy($id) {
        try {
            $this->categoryRepository->destroy($id);
            return Redirect::route('category.index')->with('success', "Berhasil Menghapus Kategori");
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * change recomendation
     *
     * @return void
     */
    public function changeRecomendation($id) {
        try {
            $this->categoryRepository->changeRecomendation($id);
            return Redirect::route('category.index')->with('success', "Berhasil Mengubah Rekomendasi Pada Kategori Ini");
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

}
