<?php

namespace App\Factory;

use App\Dto\GithubRepositoryStats;
use App\Dto\GitRepositoryStatsInterface;
use App\GitRepository\GitRepositoryApiInterface;

class GithubRepositoryStatsFactory
{
    private $githubRepositoryApi;

    public function __construct(GitRepositoryApiInterface $githubRepositoryApi)
    {
        $this->githubRepositoryApi = $githubRepositoryApi;
    }

    public function create(string $owner, string $project): GitRepositoryStatsInterface
    {
        $githubRepositoryStats = new GithubRepositoryStats();

        $repository = $this->githubRepositoryApi->getRepository($owner, $project);

        $githubRepositoryStats->setFullName($repository['full_name']);
        $githubRepositoryStats->setDescription($repository['description']);
        $githubRepositoryStats->setImageUrl($repository['owner']['avatar_url']);
        $githubRepositoryStats->setWatchersCount($repository['subscribers_count']);
        $githubRepositoryStats->setStarsCount($repository['stargazers_count']);
        $githubRepositoryStats->setForksCount($repository['forks_count']);

        $openPullRequests = $this->githubRepositoryApi->getOpenPullRequests($owner, $project, 1);
        $githubRepositoryStats->setOpenPullRequestsCount($openPullRequests['total_count']);

        $closedPullRequests = $this->githubRepositoryApi->getClosedPullRequests($owner, $project, 1);
        $githubRepositoryStats->setClosedPullRequestsCount($closedPullRequests['total_count']);

        $lastRelease = $this->githubRepositoryApi->getLastRelease($owner, $project);
        $lastReleaseDate = \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s\Z', $lastRelease['published_at']);
        $githubRepositoryStats->setLastReleaseDate($lastReleaseDate);

        return $githubRepositoryStats;
    }
}