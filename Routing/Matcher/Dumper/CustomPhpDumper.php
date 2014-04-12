<?php
/**
 * User: Mario Giustiniani
 * Date: 12/04/14
 * Time: 14.12
 */

namespace Manticora\RestExtraBundle\Routing\Matcher\Dumper;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherDumper;

class CustomPhpDumper extends PhpMatcherDumper {

    /**
     * @param ExpressionLanguage $expressionLanguage
     */
    public function setExpressionLanguage(ExpressionLanguage $expressionLanguage = null)
    {

        $class = new \ReflectionClass($this);
        $parent = $class->getParentClass();
        $property = $parent->getProperty("expressionLanguage");
        $property->setAccessible(true);
        $property->setValue($this,$expressionLanguage );

    }



} 