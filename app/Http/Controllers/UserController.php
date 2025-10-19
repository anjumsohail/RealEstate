<?php

namespace App\Http\Controllers;

use App\Models\User;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\UserCreateService;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$query = User::with(['businessProfile', 'properties']);
        if (Auth::user()->role !== 'Admin') {
            $user = User::with(['businessProfile'])->findOrFail(Auth::id());
        }
        //dd($user->businessProfile);
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

    public function store(StoreUserRequest $request, UserCreateService $userService)
    {
        try {
            // Authorization: only Admins can create users
            if (Auth::user()->role !== 'Admin') {
                abort(403, 'Unauthorized');
            }

            // Extract validated arrays
            $userData = $request->validated('user');
            $profileData = $request->validated('profile');

            // Attach file objects if present
            if ($request->hasFile('user.profile_photo')) {
                $userData['profile_photo_file'] = $request->file('user.profile_photo');
            }

            if ($request->hasFile('profile.logo')) {
                $profileData['logo_file'] = $request->file('profile.logo');
            }

            if ($request->hasFile('profile.vcard')) {
                $profileData['vcard_file'] = $request->file('profile.vcard');
            }

            // Call the service to create both
            $user = $userService->createUserWithProfile($userData, $profileData);

            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (Exception $e) {
            \Log::error('User creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }
    }


    public function show(User $user)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized');
        }
        return new UserResource($user->load(['businessProfile', 'properties']));
    }

    public function update(StoreUserRequest $request, User $user, UserCreateService $userService)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $userData = $request->validated('user');
        $profileData = $request->validated('profile');



        // Attach files for service to handle
        if ($request->hasFile('user.profile_photo_path')) {
            $userData['profile_photo_path'] = $request->file('user.profile_photo_path');
        }

        if ($request->hasFile('profile.logo')) {
            $profileData['logo_file'] = $request->file('profile.logo');
        }

        if ($request->hasFile('profile.vcard')) {
            $profileData['vcard_file'] = $request->file('profile.vcard');
        }

        // Delegate full logic to service
        $userService->updateUserWithProfile($user, $userData, $profileData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
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
