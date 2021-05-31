<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends AbstractController
{
    public function success(array $data, int $status = 200, array $headers  = []): JsonResponse
    {
        $data = [
            'status' => 'ok',
            'data' => $data,
        ];
        return $this->json($data, $status, $headers);
    }

    public function error(string $msg, int $status = 400, array $headers  = []): JsonResponse
    {
        $data = [
            'status' => 'error',
            'msg' => $msg,
        ];
        return $this->json($data, $status, $headers);
    }
}