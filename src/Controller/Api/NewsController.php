<?php

namespace App\Controller\Api;

use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: '/api/news', name: 'api_news_', methods: ['GET', 'POST', 'PUT'])]
final class NewsController extends AbstractController
{
    #[Route('/{id}', name: 'index', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function index(int $id, NewsService $newsService): JsonResponse
    {
        try{
            $news = $newsService->getById($id);
            return $this->json($news, Response::HTTP_OK);
        } catch(NotFoundHttpException $exception){
            return $this->json($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }        
    }
}
