<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:19
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Iterator\CertificateIterator;
use ImdbScraper\Mapper\ParentalGuideMapper;
use ImdbScraper\Model\Certificate;

class MovieCertificatesWrapper extends AbstractPageWrapper
{

    public function __construct()
    {
        $this->setPageMapper(new ParentalGuideMapper());
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