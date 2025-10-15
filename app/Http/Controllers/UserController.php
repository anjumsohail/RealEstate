<?php

namespace App\Http\Controllers;

use App\Models\User;

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$query = User::with(['businessProfile', 'properties']);
        if (Auth::user()->role !== 'Admin') {
            $user = User::with(['businessProfile', 'properties'])->findOrFail(Auth::id());
        }
        return view('pages.user', compact('user'));
    }

    public function UserProperties()
    {
        //if (Auth::user()->role !== 'Admin') {
        //            $user = User::with(['businessProfile', 'properties'])->findOrFail(Auth::id());        }
        return view('pages.userproperties');
    }


    public function edit()
    {
        $user = User::with(['businessProfile', 'properties'])->findOrFail(Auth::id());
        $cities = \App\Models\City::orderBy('name')->get();

        return view('pages.profile', compact('user', 'cities'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return new UserResource($user->load(['businessProfile', 'properties']));
    }


    public function show(User $user)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized');
        }
        return new UserResource($user->load(['businessProfile', 'properties']));
    }

    public function update(StoreUserRequest $request, User $user)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized');
        }
        $data = $request->validated();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return new UserResource($user->load(['businessProfile', 'properties']));
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized');
        }
        $user->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
