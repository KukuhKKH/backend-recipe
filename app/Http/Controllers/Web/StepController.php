<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Step\CreateOrUpdateStepRequest;
use App\Repositories\PostRepository;
use App\Repositories\StepRepository;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StepController extends Controller
{
    private $stepRepository, $postRepository;

    public function __construct(StepRepository $stepRepository, PostRepository $postRepository) {
        $this->stepRepository = $stepRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Render view from recipe to step page.
     *
     * @param  Integer  $post_id
     * @return \Inertia\Render
     */
    public function updateStep($post_id) {
        $post = $this->postRepository->show($post_id, ['step']);
        return Inertia::render("Step/Create", [
            'post' => $post
        ]);
    }

    /**
     * Action to create or update step post.
     *
     * @param  CreateOrUpdateStepRequest  $createOrUpdateStepRequest
     * @param Integer $post_id
     * @return \Inertia\Render
     */
    public function update(CreateOrUpdateStepRequest $createOrUpdateStepRequest, $post_id) {
        try {
            $this->stepRepository->createOrUpdate($createOrUpdateStepRequest->all(), $post_id);
            return Redirect::route('post.step', $post_id)->with('success', 'Sukses Menambah / Mengubah Langkah Langkah');
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Action to delete step (be carefull, is mean delete step detail to).
     *
     * @param Integer $id (step_id)
     * @return \Inertia\Render
     */
    public function destroy($id) {
        try {
            $this->stepRepository->destroy($id);
            return Redirect::back()->with('success', 'Sukses Menambah / Mengubah Langkah Langkah');
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Render view from step to step detail page.
     *
     * @param  Integer  $id (step_id)
     * @return \Inertia\Render
     */
    public function detail($id) {
        $post = $this->stepRepository->show($id);
        return Inertia::render("Step/Detail", [
            'post' => $post
        ]);
    }
}
