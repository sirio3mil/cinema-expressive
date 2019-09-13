<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/08/2018
 * Time: 17:12
 */

namespace App\Entity;

use DateTime;
use DateTimeZone;
use Exception;

class DateGenerator
{
    /**
     * @return DateTime
     * @throws Exception
     */
    public static function getUtcDateTime(): DateTime
    {
        return new DateTime('now', new DateTimeZone('UTC'));
    }
}