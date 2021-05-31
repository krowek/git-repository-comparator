<?php

namespace App\Controller\Api;

use App\Factory\GithubRepositoryStatsFactory;
use App\GitRepository\GithubApi;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

/** @Route("api/v1") */
class GitRepositoryController extends BaseController
{
    private $githubApi;

    public function __construct(GithubApi $githubApi)
    {
        $this->githubApi = $githubApi;
    }

    /**
     * @Route("/git-repository/{owner}/{project}", methods={"GET"}, name="get_git_repository")
     * @SWG\Tag(name="git-repository")
     * @SWG\Response(
     *     response=200,
     *     description="Repository stats",
     *     @SWG\Schema(ref=@Model(type="App\Dto\GithubRepositoryStats"))
     * )
     */
    public function getGitRepository(string $owner, string $project): JsonResponse
    {
        $statsFactory = new GithubRepositoryStatsFactory($this->githubApi);

        try {
            $stats = $statsFactory->create($owner, $project);
        } catch (\Exception $e) {
            return $this->error('Repository not found', 404);
        }

        return $this->success($stats->toApiArray());
    }
}
