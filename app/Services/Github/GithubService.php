<?php

namespace App\Services\Github;

use App\Services\Service;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GithubService extends Service
{

    private $response;
    private $client;
    private $method;
    private $uri;
    private $data;


    /**
     * @return mixed
     */
    public function getResponse(): mixed
    {
        return $this->response;
    }

    /**
     * @param string $name
     * @return void
     */
    public function getUser(string $name): void
    {
        $this->uri = 'users/' . $name;
        $this->method = 'GET';
        $this->data = null;
        $this->executeGithub();
    }

    /**
     * @param string $name
     * @return void
     */
    public function listFollowers(string $name): void
    {
        $this->uri = 'users/' . $name . '/followers';
        $this->method = 'GET';
        $this->data = null;
        $this->executeGithub();
    }

    /**
     * @param string $name
     * @return void
     */
    public function listFollowing(string $name): void
    {
        $this->uri = 'users/' . $name . '/following';
        $this->method = 'GET';
        $this->data = null;
        $this->executeGithub();
    }

    /**
     * @return void
     * @throws GuzzleException
     */
    private function executeGithub(): void
    {
        try {
            $this->client = new Client();
            $aux = $this->client->request($this->method, 'https://api.github.com/' . $this->uri, [
                'body' => $this->data,
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json'
                ]
            ]);
            $this->response = json_decode($aux->getBody());
        } catch (\Exception $e) {
            $this->returnRequestError((array)$e);
            return;
        }
    }


}
