<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    private $userRepository;
    private $limit;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
        $this->limit = 10;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all($request->all(), $this->limit);
        return Inertia::render('User/Index', [
            'users' => $users,
            'filters' => $request->all('search', 'trashed')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserStoreRequest  $userStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $userStoreRequest)
    {
        try {
            $this->userRepository->store($userStoreRequest->all());
            return Redirect::route('user.index')->with('success', 'Berhasil Membuat User');
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
        try {
            $user = $this->userRepository->show($id);
            return Inertia::render('User/Edit', [
                'user' => $user
            ]);
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserUpdateRequest  $userUpdateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $userUpdateRequest, $id)
    {
        try {
            $this->userRepository->update($userUpdateRequest->all(), $id);
            return Redirect::route('user.index')->with('success', 'Berhasil Mengubah User');
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
            $this->userRepository->destroy($id);
            return Redirect::route('user.index')->with('success', 'Berhasil Menghapus User');
        } catch(\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
