<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 23/07/2018
 * Time: 22:40
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$paths = [
    __DIR__. "/src/App/src/Entity"
];
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/mapping/yml"), $isDevMode);
// or if you prefer XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config"), $isDevMode);
// database configuration parameters
$conn = array(
    'driver' => 'sqlsrv',
    'host' => ".",
    'user' => "sa",
    'password' => "ms3CjP{R?1^A",
    'dbname' => "Film"
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);