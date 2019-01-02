<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 02/01/2019
 * Time: 15:29
 */

namespace App\GraphQL\Resolver;

use App\Entity\File;
use App\Entity\Image;
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
        $filteredFiles = new RegexIterator($fileIterator, '/^.+\.jpg/i', RecursiveRegexIterator::GET_MATCH);

        $count = 0;
        $batchSize = 20;

        foreach ($filteredFiles as $filteredFile) {
            $imageSize = getimagesize($filteredFile[0]);
            if (!$imageSize) {
                continue;
            }
            $pathInfo = pathinfo($filteredFile[0]);
            if(!$pathInfo){
                continue;
            }
            $file = new File();
            $file->setImage((new Image())->setWidth($imageSize[0])->setHeight($imageSize[1]));
            $file->setMime($imageSize['mime']);
            $file->setPath($pathInfo['dirname']);
            $file->setExtension($pathInfo['extension']);
            $file->setName($pathInfo['filename']);
            $file->setSize(filesize($filteredFile[0]));
            $entityManager->persist($file);
            $count++;
            if (($count % $batchSize) === 0) {
                $entityManager->flush();
                $entityManager->clear();
            }
        }

        $entityManager->flush();
        $entityManager->clear();

        return $count;
    }
}