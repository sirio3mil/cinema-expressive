<?php

namespace App\Resolver;

use App\Entity\TvShow;
use Doctrine\Common\Collections\Collection;
use Exception;
use GraphQL\Doctrine\Annotation as API;

class ListTvShowChapterResolver extends AbstractResolver implements QueryResolverInterface
{
    /**
     * @API\Field(type="TvShowChapter[]")
     *
     * @param TvShow $tvShow
     * @param int $season
     * @return Collection
     * @throws Exception
     */
    protected function execute(TvShow $tvShow, int $season): Collection
    {
        return $tvShow->getChaptersBySeason($season);
    }

    /**
     * @param array $args
     * @return Collection
     * @throws Exception
     */
    public function resolve(array $args): Collection
    {
        /** @var TvShow $tvShow */
        $tvShow = $args['tvShowId']->getEntity();

        return $this->execute($tvShow, $args['season']);
    }
}
