<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 22:37
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Mapper\AbstractPageMapper;

abstract class AbstractWrapper
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

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public abstract function getData(array $args): array;
}