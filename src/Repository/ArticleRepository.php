<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    //    /**
    //     * @return Article[] Returns an array of Article objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Article
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findAllOrderedByDate(): \Doctrine\ORM\Query
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.dateDePublication', 'DESC') // Trier par la date (descendant)
            ->getQuery();
    }
    public function findRandomArticles(int $limit = 3): array
    {
        // Charger tous les articles
        $articles = $this->findAll();

        // Mélanger les articles de manière aléatoire
        shuffle($articles);

        // Limiter à 3 articles
        return array_slice($articles, 0, $limit);
    }
}
