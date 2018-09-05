<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\GraphQL\Resolver;


use App\Entity\ImdbNumber;
use App\Entity\RowType;
use App\Entity\Tape;
use App\GraphQL\TypeRegistry;
use Doctrine\ORM\EntityManager;
use http\Exception\InvalidArgumentException;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\Query;

class EditTapeUserResolver
{
    public static function resolve(TypeRegistry $typeRegistry, array $args): array
    {

        /** @var ContainerInterface $container */
        $container = $typeRegistry->getContainer();

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        if(empty($args['tapeId'])){
            if(empty($args['imdbNumber'])) {
                throw new InvalidArgumentException('Undefined Tape');
            }

            /** @var RowType $tapeRowType */
            $tapeRowType = $entityManager->getRepository(RowType::class)->findOneBy([
                "rowTypeId" => RowType::ROW_TYPE_TAPE
            ]);
            /** @var Query $query */
            $query = $entityManager->createQuery('SELECT i FROM App\Entity\ImdbNumber i JOIN i.object o WHERE i.imdbNumber = :imdbNumber AND o.rowType = :rowType');
            $query->setParameters([
                'imdbNumber' => $args['imdbNumber'],
                'rowType' => $tapeRowType
            ]);
            /** @var ImdbNumber $imdbNumber */
            $imdbNumber = $query->getSingleResult();
            /** @var Tape $tape */
            $tape = $entityManager->getRepository(Tape::class)->findOneBy([
                "object" => $imdbNumber->getObject()
            ]);
        }
        else{
            /** @var Tape $tape */
            $tape = $entityManager->getRepository(Tape::class)->find($args['tapeId']);
        }

        if(!$tape){
            throw new InvalidArgumentException('Tape not found');
        }

        return [
            'tapeUserId' => 0,
            'tapeUserHistoryId' => 0
        ];
    }
}