<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:25
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CertificationType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'certification' => Type::string(),
                'details' => Type::string(),
                'country' => Type::string(),
                'isoCountryCode' => Type::string()
            ]
        ]);
    }
}