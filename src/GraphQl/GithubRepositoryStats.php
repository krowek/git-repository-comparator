<?php

namespace App\GraphQl;

use App\GraphQl\Query\GetGithubRepositoryStatsQuery;

class GithubRepositoryStats
{
    private $graphQlClient;
    private $githubApiToken;

    public function __construct(GraphQlClient $graphQlClient, string $githubApiToken)
    {
        $this->graphQlClient = $graphQlClient;
        $this->githubApiToken = $githubApiToken;
    }

    public function getProjectStats(string $owner, string $project)
    {
        return $this->graphQlClient->graphqlQuery(
            'https://api.github.com/graphql',
            GetGithubRepositoryStatsQuery::getQuery(),
            ['owner' => $owner, 'project' => $project],
            $this->githubApiToken
        );
    }
}