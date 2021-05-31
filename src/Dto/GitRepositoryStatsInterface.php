<?php

namespace App\Dto;

interface GitRepositoryStatsInterface
{
    public function getFullName(): string;

    public function getImageUrl(): ?string;

    public function getWatchersCount(): int;

    public function getStarsCount(): int;

    public function getForksCount(): int;

    public function getOpenPullRequestsCount(): int;

    public function getClosedPullRequestsCount(): int;

    public function getLastReleaseDate(): ?\DateTimeImmutable;

    public function toApiArray(): array;

}