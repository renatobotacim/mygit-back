<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{

    private ProfileService $profileService;

    /**
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * @param string $profile
     * @return JsonResponse
     */
    public function show(string $profile): JsonResponse
    {
        return $this->profileService->show($profile);
    }

    /**
     * @param string $profile
     * @return JsonResponse
     */
    public function listFollowers(string $profile): JsonResponse
    {
        return $this->profileService->listFollowers($profile);
    }

    /**
     * @param string $profile
     * @return JsonResponse
     */
    public function listFollowing(string $profile): JsonResponse
    {
        return $this->profileService->listFollowing($profile);
    }

}
