<?php

namespace App\GitRepository;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubApi implements GitRepositoryApiInterface
{
    const BASE_API_URL = 'https://api.github.com';

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getRepository(string $owner, string $project): array
    {
        $apiUrl = sprintf(self::BASE_API_URL . '/repos/%s/%s', rawurlencode($owner), rawurlencode($project));

        $response = $this->client->request('GET', $apiUrl);

        return $response->toArray();
    }

    public function getOpenPullRequests(string $owner, string $project, int $perPage = 10): array
    {
        $repoFullName = rawurlencode($owner) . '/' . rawurlencode($project);

        $apiUrl = self::BASE_API_URL . '/search/issues?q=repo:' . $repoFullName .  '+is:pr+is:open&per_page=' . $perPage;

        $response = $this->client->request('GET', $apiUrl);

        return $response->toArray();
    }

    public function getClosedPullRequests(string $owner, string $project, int $perPage = 10): array
    {
        $repoFullName = rawurlencode($owner) . '/' . rawurlencode($project);

        $apiUrl = self::BASE_API_URL . '/search/issues?q=repo:' . $repoFullName .  '+is:pr+is:closed&per_page=' . $perPage;

        $response = $this->client->request('GET', $apiUrl);

        return $response->toArray();
    }

    public function getLastRelease(string $owner, string $project): array
    {
        $apiUrl = sprintf(self::BASE_API_URL . '/repos/%s/%s/releases/latest', rawurlencode($owner), rawurlencode($project));

        $response = $this->client->request('GET', $apiUrl);

        return $response->toArray();
    }

}