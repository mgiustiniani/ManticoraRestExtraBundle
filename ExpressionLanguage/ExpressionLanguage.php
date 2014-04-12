<?php
/**
 * User: Mario Giustiniani
 * Date: 12/04/14
 * Time: 14.22
 */

namespace Manticora\RestExtraBundle\ExpressionLanguage;


use Symfony\Component\ExpressionLanguage\ExpressionLanguage as BaseExpressionLanguage;

class ExpressionLanguage extends BaseExpressionLanguage
{

    protected function registerFunctions()
    {
        parent::registerFunctions();

        $this->register('compare', function ($version1, $version2, $operator) {
            return sprintf('version_compare(%s, %s, %s)', $version1, $version2, $operator);
        }, function (array $values, $version1, $version2, $operator) {
            return version_compare($version1, $version2, $operator);
        });
    }

}