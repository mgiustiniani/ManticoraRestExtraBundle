<?php
/**
 * User: Mario Giustiniani
 * Date: 12/04/14
 * Time: 14.21
 */

namespace Manticora\RestExtraBundle\DependencyInjection\Compiler;


use Manticora\RestExtraBundle\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container){


        $definition = $container->getDefinition('router.default');
        $definition->setClass('Manticora\RestExtraBundle\Routing\Router');

        $arguments =$definition->getArgument(2);

        $arguments['matcher_class'] = 'Manticora\RestExtraBundle\Routing\CustomUrlMatcher';
        $arguments['matcher_base_class'] = 'Manticora\RestExtraBundle\Routing\Matcher\CustomUrlMatcher';
        $arguments['matcher_dumper_class'] = 'Manticora\RestExtraBundle\Routing\Matcher\Dumper\CustomPhpDumper';

        $definition->replaceArgument(2, $arguments);
        $definition->addMethodCall('setExpressionLanguage',array(new Reference('manticora_rest_extra.expression_language')));

    }
}