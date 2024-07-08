<?php

namespace App\Services;

use App\Helpers\Logs;
use App\Services\Github\GithubService;
use App\Services\Service;
use Illuminate\Http\JsonResponse;

class ProfileService extends Service
{

    private $response;

    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string $profile
     * @return JsonResponse
     */
    public function show(string $profile): JsonResponse
    {
        $github = new GithubService();
        $github->getUser($profile);
        $this->response = $github->getResponse();
        if (!$this->response) {
            $this->returnRequestWarning(null, 'Unable to locate the given record!', 422);
        }
        $this->registerLog($this->response);
        return $this->returnRequestSucess($this->response);
    }

    /**
     * @param string $profile
     * @return JsonResponse
     */
    public function listFollowers(string $profile): JsonResponse
    {
        $github = new GithubService();
        $github->listFollowers($profile);
        $this->response = $github->getResponse();
        if (!$this->response) {
            $this->returnRequestWarning(null, 'Unable to locate the given record!', 422);
        }
        $this->registerLog($this->response);
        return $this->returnRequestSucess($this->response);
    }

    /**
     * @param string $profile
     * @return JsonResponse
     */
    public function listFollowing(string $profile): JsonResponse
    {
        $github = new GithubService();
        $github->listFollowing($profile);
        $this->response = $github->getResponse();
        if (!$this->response) {
            $this->returnRequestWarning(null, 'Unable to locate the given record!', 422);
        }
        $this->registerLog($this->response);
        return $this->returnRequestSucess($this->response);
    }

}
