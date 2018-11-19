<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 19/11/2018
 * Time: 16:41
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Mapper\AbstractPageMapper;

abstract class AbstractPageWrapper extends AbstractWrapper
{
    /** @var AbstractPageMapper $pageMapper */
    protected $pageMapper;

    /**
     * @param $pageMapper
     */
    public function setPageMapper(AbstractPageMapper $pageMapper): void
    {
        $this->pageMapper = $pageMapper;
    }

    /**
     * @return AbstractPageMapper
     */
    public function getPageMapper(): AbstractPageMapper
    {
        return $this->pageMapper;
    }
}