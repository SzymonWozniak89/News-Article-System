<?php

namespace App\Service;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class NewsService
{
    public function __construct(
        public readonly NewsRepository $newsRepository,
    ) {
    }

    public function save(News $news)
    {
        return $this->newsRepository->save($news);
    }

    public function getAllNews()
    {
        return $this->newsRepository->findBy([], ['createdAt' => 'DESC']);
    }

    public function getById($id)
    {
        $news = $this->newsRepository->find($id);
        if (null === $news) {
            throw new NotFoundHttpException('News with such id does not exists.');
        }

        return $news;
    }

    public function getByAuthor($name)
    {
        $news = $this->newsRepository->findByAuthorName($name);
        if (0 === count($news)) {
            throw new NotFoundHttpException('News with such author name does not exists.');
        }

        return $news;
    }
}
