<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class OibController extends AbstractController
{
    #[Route(
        path: '/oib',
        name: 'app_oib',
        defaults: ['_format' => 'json'],
        methods: ['GET']
    )]
    public function index(Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/OibController.php',
        ]);
    }
}
