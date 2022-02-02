<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $tagRepository;
    private $limit;

    public function __construct(TagRepository $tagRepository) {
        $this->tagRepository = $tagRepository;
        $this->limit = 10;
    }

    public function index(Request $request) {
        $tags = $this->tagRepository->all($request->only("sort", "sort_by", "search"), $request->limit ?? $this->limit, $request->offset ?? null);
        return response()->success($tags, "Berhasil Mendapatkan Tag", 200);
    }
}
