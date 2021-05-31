<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

    /**
     * @Route("/get-repo-stats", name="get_repo_stats_ajax")
     */
    public function getRepoStats(Request $request, HttpClientInterface $client): Response
    {
        $repoName = $request->query->get('repoName');

        if (!$repoName) {
            return $this->json(['status' => 'error', 'msg' => 'Missing repository name']);
        }

        $repoStats = $client->request('GET', 'http://127.0.0.1:8000/api/v1/git-repository/' . rawurlencode($repoName));
        $repoStats = $repoStats->toArray();

        if ($repoStats['status'] !== 'ok') {
            return $this->json(['status' => 'error', 'msg' => 'Invalid request']);
        }

        $html = $this->render('dashboard/_repo_stats_item.html.twig', ['item' => $repoStats['data']])->getContent();

        return $this->json([
            'status' => 'ok',
            'content' => $html,
        ]);
    }
}
