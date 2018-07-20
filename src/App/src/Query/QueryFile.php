<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 12:22
 */

namespace App\Query;


class QueryFile
{
    public static function getContent(string $filePath): string
    {
        if(!file_exists($filePath)){
            return '';
        }
        return file_get_contents($filePath);
    }
}