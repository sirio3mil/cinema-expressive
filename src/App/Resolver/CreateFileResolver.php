<?php


namespace App\Resolver;


use App\Entity\File;
use App\Entity\GlobalUniqueObject;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\UploadedFileInterface;

class CreateFileResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * EditTapeUserResolver constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param GlobalUniqueObject $globalUniqueObject
     * @param UploadedFileInterface $file
     * @return File
     */
    protected function execute(GlobalUniqueObject $globalUniqueObject, UploadedFileInterface $file): File
    {

    }

    /**
     * @param array $args
     * @return mixed
     */
    public function resolve(array $args)
    {
        $object = $args['globalUniqueObjectId']->getEntity();

        return $this->execute($object, $args['file']);
    }
}