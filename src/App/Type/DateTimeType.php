<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 15:47
 */

namespace App\Type;

use DateTime;
use Exception;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;
use UnexpectedValueException;

class DateTimeType extends ScalarType
{
    public function parseLiteral($valueNode, array $variables = null)
    {
        if (!($valueNode instanceof StringValueNode)) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, $valueNode);
        }

        return $valueNode->value;
    }

    /**
     * @param mixed $value
     * @param array|null $variables
     * @return DateTime|mixed
     * @throws Exception
     */
    public function parseValue($value, array $variables = null)
    {
        if (!is_string($value)) {
            throw new UnexpectedValueException('Cannot represent value as DateTime date: ' . Utils::printSafe($value));
        }

        return new DateTime($value);
    }

    public function serialize($value)
    {
        if ($value instanceof DateTime) {
            return $value->format('c');
        }

        return $value;
    }
}
