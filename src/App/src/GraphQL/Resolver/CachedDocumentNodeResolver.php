<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 12:18
 */

namespace App\GraphQL\Resolver;


use App\Query\QueryFile;
use GraphQL\Language\AST\DocumentNode;
use GraphQL\Language\Parser;
use GraphQL\Language\Source;
use Zend\Cache\PatternFactory;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

class CachedDocumentNodeResolver
{
    public static function resolve(AbstractAdapter $adapter, string $filePath): DocumentNode
    {

        /** @var ClassCache $cache */
        $cache = PatternFactory::factory('class', [
            'class'  => QueryFile::class,
            'storage' => $adapter
        ]);
        $source = $cache->getContent($filePath);
        $key = 'DocumentNode' . pathinfo($filePath, PATHINFO_FILENAME);
        if(!$adapter->hasItem($key)){
            $adapter->setItem($key, Parser::parse(new Source($source ?: '', 'GraphQL')));
        }
        return $adapter->getItem($key);
    }
}