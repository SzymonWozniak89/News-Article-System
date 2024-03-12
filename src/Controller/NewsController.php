<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('news/index.html.twig', [
            'newses' => $newsService->getAllNews(),
        ]);
    }

    #[Route('/add', name: 'add', methods: ['GET', 'POST'])]
    public function add(Request $request, NewsService $newsService): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newsService->save($news);
            $this->addFlash('success', 'New article added');

            return $this->redirectToRoute('news_index');
        }

        return $this->render('news/add.html.twig', [
            'newsForm' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'PUT'])]
    public function editArticle(Request $request, NewsService $newsService, News $news): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsService->save($news);

            $this->addFlash('success', 'Article updated');

            return $this->redirectToRoute('news_index');
        }

        return $this->render('news/edit.html.twig', [
            'newsForm' => $form->createView(),
        ]);
    }
}
