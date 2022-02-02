<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    private $limit;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
        $this->limit = 10;
    }

    public function index(Request $request) {
        $posts = $this->postRepository->all(
            $request->only("sort", "sort_by", "search"),
            $request->limit ?? $this->limit,
            $request->offset ?? null,
            ['step.detail', 'ingredient', 'user']
        );
        return response()->success($posts, "Berhasil Mendapatkan Post", 200);
    }
}
