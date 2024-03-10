<?php

namespace App\Controller;

use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: '/news', name: 'news_', methods: ['GET', 'POST', 'PUT'])]
final class NewsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(NewsService $newsService): Response
    {
        //dd($newsService->getAllNews());
        return $this->render('news/index.html.twig', [
            'newses' => $newsService->getAllNews(),
        ]);
    }
}
