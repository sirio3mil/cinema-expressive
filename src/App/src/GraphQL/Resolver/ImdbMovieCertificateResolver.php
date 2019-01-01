<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:19
 */

namespace App\GraphQL\Resolver;

use ImdbScraper\Iterator\CertificateIterator;
use ImdbScraper\Mapper\ParentalGuideMapper;
use ImdbScraper\Model\Certificate;
use Psr\Container\ContainerInterface;

class ImdbMovieCertificateResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        $data = [];
        /** @var ParentalGuideMapper $mapper */
        $mapper = $container->get(ParentalGuideMapper::class);
        $mapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        /** @var CertificateIterator $certificates */
        $certificates = $mapper->getCertificates();
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