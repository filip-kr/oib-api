<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\OibService;

class OibController extends AbstractController
{
    #[Route(
        path: '/oib',
        name: 'app_oib',
        defaults: ['_format' => 'json'],
        methods: ['GET']
    )]
    public function index(
        Request $request,
        OibService $oibService
    ): JsonResponse 
    {
        if ($request->query->get('generate')) {
            $count = $request->query->get('generate');
            $data = [];

            for ($i = 0; $i < $count; $i++) {
                $data[] = $oibService->generateOib();
            }

            return $this->json($data);
        }

        if ($request->query->get('validate')) {
            return $this->json(
                $oibService->isOibValid(
                    $request->query->get('validate')
                )
            );
        }
    }
}
