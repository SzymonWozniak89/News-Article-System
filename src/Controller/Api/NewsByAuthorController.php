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
final class NewsByAuthorController extends AbstractController
{
    #[Route('/author/{name}', name: 'author_index', methods: ['GET'])]
    public function index(string $name, NewsService $newsService): JsonResponse
    {
        try {
            $news = $newsService->getByAuthor($name);

            return $this->json($news, Response::HTTP_OK);
        } catch (NotFoundHttpException $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
