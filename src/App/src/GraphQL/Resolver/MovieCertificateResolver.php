<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:19
 */

namespace App\GraphQL\Resolver;


use GraphQL\Type\Definition\Type;
use ImdbScraper\Iterator\CertificateIterator;
use ImdbScraper\Mapper\ParentalGuideMapper;
use ImdbScraper\Model\Certificate;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use App\GraphQL\TypeRegistry;

class MovieCertificateResolver
{

    public function __construct(AbstractAdapter $cacheStorageAdapter, TypeRegistry $typeRegistry)
    {
        $this->setPageMapper(new ParentalGuideMapper());
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->type = Type::listOf($typeRegistry->get('certification'));
        $this->args = [
            'imdbNumber' => Type::nonNull(Type::int()),
        ];
    }

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public function getData(array $args): array
    {
        $data = [];
        $this->pageMapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        /** @var CertificateIterator $certificates */
        $certificates = $this->pageMapper->getCertificates();
        if ($certificates->getIterator()->count()) {
            /** @var Certificate $certificate */
            foreach ($certificates as $certificate) {
                $data[] = [
                    'certification' => $certificate->getCertification(),
                    'details' => $certificate->getDetails(),
                    'country' => $certificate->getCountryName(),
                    'isoCountryCode' => $certificate->getIsoCountryCode()
                ];
            }
        }
        return $data;
    }
}