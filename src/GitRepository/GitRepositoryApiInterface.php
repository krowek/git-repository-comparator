<?php

namespace App\GitRepository;

interface GitRepositoryApiInterface
{
    public function getRepository(string $owner, string $project): array;

    public function getOpenPullRequests(string $owner, string $project, int $perPage): array;

    public function getClosedPullRequests(string $owner, string $project, int $perPage): array;

    public function getLastRelease(string $owner, string $project): array;
}