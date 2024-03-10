<?php

namespace App\Service;

use App\Repository\AuthorRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AuthorService
{
    public function __construct(
        public readonly AuthorRepository $authorRepository,
    ) {
    }

    public function getTop3()
    {
        $authors = $this->authorRepository->findTopAuthors();
        if (0 === count($authors)) {
            throw new NotFoundHttpException('There are no authors of articles from last week.');
        }

        return $authors;
    }
}
