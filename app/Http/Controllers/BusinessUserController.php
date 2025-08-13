<?php

namespace App\Http\Controllers;

use App\Models\BusinessUser;
use App\Http\Requests\StoreBusinessUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class BusinessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = BusinessUser::with('user');
        if (Auth::user()->role !== 'Admin') {
            $query->where('user_id', Auth::id());
        }
        return $query->get();
    }

    public function store(StoreBusinessUserRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $businessUser = BusinessUser::create($data);
        return new UserResource($businessUser->user->load(['businessProfile', 'properties']));
    }

    public function show(BusinessUser $businessUser)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $businessUser->user_id) {
            abort(403, 'Unauthorized');
        }
        return new UserResource($businessUser->user->load(['businessProfile', 'properties']));
    }

    public function update(StoreBusinessUserRequest $request, BusinessUser $businessUser)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $businessUser->user_id) {
            abort(403, 'Unauthorized');
        }
        $businessUser->update($request->validated());
        return new UserResource($businessUser->user->load(['businessProfile', 'properties']));
    }

    public function destroy(BusinessUser $businessUser)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $businessUser->user_id) {
            abort(403, 'Unauthorized');
        }
        $businessUser->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
