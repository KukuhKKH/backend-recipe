<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Repositories\PostRepository;

class DataController extends Controller
{
    private $postRepository;
    private $limit;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
        $this->limit = 10;
    }

    public function searchCategory(Request $request, $category) {
        $post = $this->postRepository->searchByRelation("category", $category, $request->only("pagination"));
        return response()->success($post, "Berhasil Mendapatkan Post");
    }

    public function searchTag(Request $request, $tag) {
        $post = $this->postRepository->searchByRelation("tags", $tag, $request->only("pagination"));
        return response()->success($post, "Berhasil Mendapatkan Post");
    }
}
