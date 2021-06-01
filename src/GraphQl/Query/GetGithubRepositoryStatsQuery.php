<?php

namespace App\GraphQl\Query;

class GetGithubRepositoryStatsQuery
{
    public static function getQuery(): string
    {
        return <<<'GRAPHQL'
query($project: String!, $owner: String!) {
    repository(owner: $owner, name: $project) {
      description
      nameWithOwner
      owner {
        avatarUrl
      }
      latestRelease {
        publishedAt
      }
      forks {
        totalCount
      }
      stargazers {
        totalCount
      }
      watchers {
        totalCount
      }
      openpullRequests: pullRequests(states: OPEN) {
        totalCount
      }
      closedpullRequests: pullRequests(states: CLOSED) {
        totalCount
      }
    }
}
GRAPHQL;
    }
}