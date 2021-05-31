<?php

namespace App\Dto;

use Swagger\Annotations as SWG;

class GithubRepositoryStats implements GitRepositoryStatsInterface
{
    /**
     * @SWG\Property(type="string", maxLength=255, example="symfony/symfony")
     */
    private $fullName;

    private $description;

    private $imageUrl;

    private $watchersCount;

    private $starsCount;

    private $forksCount;

    private $openPullRequestsCount;

    private $closedPullRequestsCount;

    /**
     * @SWG\Property(type="string", example="2021-05-31")
     */
    private $lastReleaseDate;

    public function toApiArray(): array
    {
        return [
            'fullName' => $this->fullName,
            'description' => $this->description,
            'imageUrl' => $this->imageUrl,
            'watchersCount' => $this->watchersCount,
            'starsCount' => $this->starsCount,
            'forksCount' => $this->forksCount,
            'openPullRequestsCount' => $this->openPullRequestsCount,
            'closedPullRequestsCount' => $this->closedPullRequestsCount,
            'lastReleaseDate' => $this->lastReleaseDate ? $this->lastReleaseDate->format('Y-m-d') : null,
        ];
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return int
     */
    public function getWatchersCount(): int
    {
        return $this->watchersCount;
    }

    /**
     * @param int $watchersCount
     */
    public function setWatchersCount(int $watchersCount): void
    {
        $this->watchersCount = $watchersCount;
    }

    /**
     * @return int
     */
    public function getStarsCount(): int
    {
        return $this->starsCount;
    }

    /**
     * @param int $starsCount
     */
    public function setStarsCount(int $starsCount): void
    {
        $this->starsCount = $starsCount;
    }

    /**
     * @return int
     */
    public function getForksCount(): int
    {
        return $this->forksCount;
    }

    /**
     * @param int $forksCount
     */
    public function setForksCount(int $forksCount): void
    {
        $this->forksCount = $forksCount;
    }

    /**
     * @return int
     */
    public function getOpenPullRequestsCount(): int
    {
        return $this->openPullRequestsCount;
    }

    /**
     * @param int $openPullRequestsCount
     */
    public function setOpenPullRequestsCount(int $openPullRequestsCount): void
    {
        $this->openPullRequestsCount = $openPullRequestsCount;
    }

    /**
     * @return int
     */
    public function getClosedPullRequestsCount(): int
    {
        return $this->closedPullRequestsCount;
    }

    /**
     * @param int $closedPullRequestsCount
     */
    public function setClosedPullRequestsCount(int $closedPullRequestsCount): void
    {
        $this->closedPullRequestsCount = $closedPullRequestsCount;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getLastReleaseDate(): ?\DateTimeImmutable
    {
        return $this->lastReleaseDate;
    }

    /**
     * @param \DateTimeImmutable $lastReleaseDate
     */
    public function setLastReleaseDate(\DateTimeImmutable $lastReleaseDate): void
    {
        $this->lastReleaseDate = $lastReleaseDate;
    }

}