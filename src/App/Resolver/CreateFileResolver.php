<?php

namespace App\Resolver;

use App\Entity\File;
use App\Entity\GlobalUniqueObject;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\UploadedFileInterface;

class CreateFileResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * EditTapeUserResolver constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(private EntityManager $entityManager)
    {
    }

    /**
     * @param GlobalUniqueObject $globalUniqueObject
     * @param UploadedFileInterface $file
     * @return File
     */
    protected function execute(GlobalUniqueObject $globalUniqueObject, UploadedFileInterface $file): File
    {
        return new File();
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function resolve(array $args): File
    {
        $object = $args['globalUniqueObjectId']->getEntity();

        return $this->execute($object, $args['file']);
    }
}
