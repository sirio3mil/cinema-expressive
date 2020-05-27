<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 23/07/2018
 * Time: 22:40
 */

use App\Factory\EntityManagerFactory;

require_once "vendor/autoload.php";

$config = require "config/config.php";

$entityManager = EntityManagerFactory::createFromConfiguration($config);
