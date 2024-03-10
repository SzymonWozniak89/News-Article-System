<?php
namespace App\Service;

use App\Repository\NewsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class NewsService {

    public function __construct(
        public readonly NewsRepository $newsRepository,
        ){

    }

    public function getAllNews(){
        return $this->newsRepository->findAll();
    }

    public function getById($id){
        $news = $this->newsRepository->find($id);
        if($news===null){
            throw new NotFoundHttpException('News with such id does not exists.');
        }
        return $news;
    }

}