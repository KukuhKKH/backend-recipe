<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Traits\SerializeDatabaseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    use SerializeDatabaseTrait;
    private $postRepository, $categoryRepository;
    private $limit;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->limit = 10;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->all($request->all(), $this->limit, null, ['category']);
        return Inertia::render("Post/Index", [
            'posts' => $posts,
            'filters' => $request->all('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all(null, 1000, 0);
        $levels = $this->levelColumn();
        if(count($categories) <= 0) return Redirect::back()->with('error', 'Kategori Belum Dibuat');
        return Inertia::render('Post/Create', [
            'categories' => $categories,
            'levels' => $levels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostStoreRequest  $postStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $postStoreRequest)
    {
        try {
            $this->postRepository->store($postStoreRequest->all());
            return Redirect::route('post.index')->with('success', "Berhasil Membuat Resep Masakan");
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->all(null, 1000, 0);
        $levels = $this->levelColumn();
        $post = $this->postRepository->show($id);
        return Inertia::render('Post/Edit', [
            'categories' => $categories,
            'levels' => $levels,
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PostUpdateRequest  $postUpdateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $postUpdateRequest, $id)
    {
        try {
            $this->postRepository->update($postUpdateRequest->all(), $id);
            return Redirect::route('post.index')->with('success', "Berhasil Mengubah Resep Masakan");
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->postRepository->destroy($id);
            return Redirect::route('post.index')->with('success', "Berhasil Menghapus Resep Masakan");
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function step($id) {
        $post = $this->postRepository->show($id, ['step']);
        return Inertia::render('Step/Index', [
            'post' => $post
        ]);
    }

    public function ingredient($id) {
        return Inertia::render('Post/Ingredient');
    }
}
