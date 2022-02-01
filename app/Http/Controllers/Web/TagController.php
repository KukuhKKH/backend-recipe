<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Repositories\TagRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagStoreRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    private $tagRepository;
    private $limit;

    public function __construct(TagRepository $tagRepository) {
        $this->tagRepository = $tagRepository;
        $this->limit = 10;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = $this->tagRepository->all($request->all(), $this->limit);
        return Inertia::render('Tag/Index', [
            'tags' => $tags,
            'filters' => $request->all('search', 'trashed')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Inertia
     */
    public function create()
    {
        return Inertia::render("Tag/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TagStoreRequest  $tagStoreRequest
     * @return \Inertia\Inertia
     */
    public function store(TagStoreRequest $tagStoreRequest)
    {
        try {
            $this->tagRepository->store($tagStoreRequest->all());
            return Redirect::route('tag.index')->with('success', 'Berhasil Membuat Tag');
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Inertia
     */
    public function edit($id)
    {
        try {
            $tag = $this->tagRepository->show($id);
            return Inertia::render('Tag/Edit', [
                'tag' => $tag
            ]);
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TagUpdateRequest  $tagUpdateRequest
     * @param  int  $id
     * @return \Inertia\Inertia
     */
    public function update(TagUpdateRequest $tagUpdateRequest, $id)
    {
        try {
            $this->tagRepository->update($tagUpdateRequest->all(), $id);
            return Redirect::route('tag.index')->with('success', 'Berhasil Mengubah Tag');
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Inertia\Inertia
     */
    public function destroy($id)
    {
        try {
            $this->tagRepository->destroy($id);
            return Redirect::route('tag.index')->with('success', 'Berhasil Menghapus Tag');
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
