<?php

namespace App\Controller\Api;

use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: '/api/author', name: 'api_author_', methods: ['GET', 'POST', 'PUT'])]
final class TopAuthorsController extends AbstractController
{
    #[Route('/top', name: 'index', methods: ['GET'])]
    public function index(AuthorService $authorService): JsonResponse
    {
        try {
            $authors = $authorService->getTop3();

            return $this->json($authors, Response::HTTP_OK);
        } catch (NotFoundHttpException $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
