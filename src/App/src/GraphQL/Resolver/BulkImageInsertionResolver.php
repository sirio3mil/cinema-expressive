<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 02/01/2019
 * Time: 15:29
 */

namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use RecursiveRegexIterator;

class BulkImageInsertionResolver
{
    public static function resolve(ContainerInterface $container, array $args): int
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        $folderIterator = new RecursiveDirectoryIterator('/usr/share/nginx/html/cinema-expressive/public/photos/');
        $fileIterator = new RecursiveIteratorIterator($folderIterator);
        $filteredFiles = new RegexIterator($fileIterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach ($filteredFiles as $file){
            echo var_dump($file);
            die;
        }

        return 0;
    }
}