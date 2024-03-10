<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function findTopAuthors()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT count(n2.id)
            FROM App\Entity\News n2
            JOIN n2.author a2
            WHERE DATE_DIFF(CURRENT_DATE(), n2.createdAt) < 7
            GROUP BY a2.name
            ORDER BY count(n2.id) DESC
            "
        )->setMaxResults(3);
    
        $query2 = $entityManager->createQuery(
            "SELECT a.name, count(n.id) as number_of_articles 
            FROM App\Entity\News n
            JOIN n.author a
            WHERE DATE_DIFF(CURRENT_DATE(), n.createdAt) < 7
            GROUP BY a.name
            having number_of_articles in (:prTop)
            order by number_of_articles desc"
        )->setParameter('prTop', $query->getResult());

        return $query2->getResult();
    }
}
