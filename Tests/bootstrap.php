<?php
/**
 * User: Mario Giustiniani
 * Date: 04/05/14
 * Time: 15.56
 */
$file = __DIR__.'/../vendor/autoload.php';
if (!file_exists($file)) {
    throw new RuntimeException('Install dependencies to run test suite.');
}

$autoload = require_once $file;

use Doctrine\Common\Annotations\AnnotationRegistry;
AnnotationRegistry::registerLoader(function($class) {
    if (strpos($class, 'FOS\RestBundle\Controller\Annotations\\') === 0) {
        $path = __DIR__.'/../'.str_replace('\\', '/', substr($class, strlen('FOS\RestBundle\\')))   .'.php';
        require_once $path;
    }

    return class_exists($class, false);
});