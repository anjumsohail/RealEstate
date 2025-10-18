<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;

class UserCreateService
{


    /**
     * Create user with business profile
     */
    public function createUserWithProfile(array $userData, array $profileData): User
    {
        $storagePath = 'profile-photos';
        $storedFiles = [];

        try {
            return DB::transaction(function () use ($userData, $profileData, $storagePath, &$storedFiles) {

                // --- Handle password ---
                if (!empty($userData['password'])) {
                    $userData['password'] = Hash::make($userData['password']);
                }

                // --- Handle profile photo ---
                if (isset($userData['profile_photo_path'])) {
                    $path = $userData['profile_photo_path']->store($storagePath, 'public');
                    $userData['profile_photo_path'] = $path;
                    $storedFiles[] = $path;
                    unset($userData['profile_photo_path']);
                }

                // --- Create user first ---
                $user = User::create($userData);

                // --- Handle business profile files ---
                if (isset($profileData['logo_file'])) {
                    $path = $profileData['logo_file']->store($storagePath, 'public');
                    $profileData['logo'] = $path;
                    $storedFiles[] = $path;
                    unset($profileData['logo_file']);
                }

                if (isset($profileData['vcard_file'])) {
                    $path = $profileData['vcard_file']->store($storagePath, 'public');
                    $profileData['vcard'] = $path;
                    $storedFiles[] = $path;
                    unset($profileData['vcard_file']);
                }

                // --- Create business profile ---
                if (!empty($profileData)) {
                    $user->businessProfile()->create($profileData + ['user_id' => $user->id]);
                }

                return $user;
            });
        } catch (Exception $e) {
            // Clean up files on failure
            foreach ($storedFiles as $file) {
                if (is_string($file) && Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            \Log::error('User creation transaction failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }

    public function updateUserWithProfile(User $user, array $userData, array $profileData): User
    {
        $storagePath = 'profile-photos';
        $storedFiles = []; // keep track of newly uploaded files

        try {
            return DB::transaction(function () use ($user, $userData, $profileData, $storagePath, &$storedFiles) {

                // --- Password ---
                if (!empty($userData['password'])) {
                    $userData['password'] = Hash::make($userData['password']);
                } else {
                    unset($userData['password']);
                }

                // --- Profile Photo ---


                if (isset($userData['profile_photo_path'])) {
                    // Delete old photo safely
                    $old = trim($user->profile_photo_path);
                    if (is_string($old) && Storage::disk('public')->exists($old)) {
                        Storage::disk('public')->delete($old);
                    }

                    $path = $userData['profile_photo_path']->store($storagePath, 'public');

                    $userData['profile_photo_path'] = $path;
                    $storedFiles[] = $path;

                    //unset($userData['profile_photo_path']);
                }

                // --- Business Logo ---
                if (isset($profileData['logo_file'])) {
                    $old = trim(optional($user->businessProfile)->logo);


                    if (is_string($old) && Storage::disk('public')->exists($old)) {

                        Storage::disk('public')->delete($old);
                    }

                    $path = $profileData['logo_file']->store($storagePath, 'public');
                    $profileData['logo'] = $path;
                    $storedFiles[] = $path;
                    // unset($profileData['logo_file']);
                }

                // --- Business vCard ---
                if (isset($profileData['vcard_file'])) {
                    $old = trim(optional($user->businessProfile)->vcard);
                    if (is_string($old) && Storage::disk('public')->exists($old)) {
                        Storage::disk('public')->delete($old);
                    }

                    $path = $profileData['vcard_file']->store($storagePath, 'public');
                    $profileData['vcard'] = $path;
                    $storedFiles[] = $path;
                    //  unset($profileData['vcard_file']);
                }

                // --- Update user ---
                $user->update($userData);

                // --- Update or create business profile ---
                if (!empty($profileData)) {

                    if ($user->businessProfile) {
                        $user->businessProfile->update($profileData);
                    } else {
                        $user->businessProfile()->create($profileData + ['user_id' => $user->id]);
                    }
                }

                return $user;
            });
        } catch (Exception $e) {
            // Rollback new files if anything fails
            foreach ($storedFiles as $file) {
                if (is_string($file) && Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            // Optional: log the error for debugging
            \Log::error('User profile update failed: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'trace' => $e->getTraceAsString(),
            ]);

            // Rethrow so controller catches or returns an error response
            throw $e;
        }
    }
}
