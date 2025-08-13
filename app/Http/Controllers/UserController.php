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
        $query = User::with(['businessProfile', 'properties']);
        if (Auth::user()->role !== 'Admin') {
            $query->where('id', Auth::id());
        }
        return UserResource::collection($query->get());
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
