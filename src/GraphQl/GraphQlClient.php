<?php

namespace App\GraphQl;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GraphQlClient
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function graphqlQuery(string $endpoint, string $query, array $variables = [], ?string $token = null): array
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        if ($token !== null) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        $response = $this->client->request('POST', $endpoint, [
            'headers' => $headers,
            'json' => ['query' => $query, 'variables' => $variables],
        ]);

        return $response->toArray();
    }
}