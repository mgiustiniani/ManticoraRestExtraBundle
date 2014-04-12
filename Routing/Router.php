<?php

namespace Manticora\RestExtraBundle\Routing;
use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Symfony\Component\Config\ConfigCache;
use Psr\Log\LoggerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Routing\Generator\ConfigurableRequirementsInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Generator\Dumper\GeneratorDumperInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Matcher\Dumper\MatcherDumperInterface;


class Router extends BaseRouter
{

    /**
     * @var ExpressionLanguage|null
     */
    protected  $expressionLanguage;

    /**
     * @param ExpressionLanguage $expressionLanguage
     */
    public function setExpressionLanguage(ExpressionLanguage $expressionLanguage = null)
    {
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * Gets the UrlMatcher instance associated with this Router.
     *
     * @return UrlMatcherInterface A UrlMatcherInterface instance
     */
    public function getMatcher()
    {
        if (null !== $this->matcher) {
            return $this->matcher;
        }

        if (null === $this->options['cache_dir'] || null === $this->options['matcher_cache_class']) {
            $this->matcher = new $this->options['matcher_class']($this->getRouteCollection(), $this->context);
            if (method_exists($this->matcher, 'setExpressionLanguage')) {
                $this->matcher->setExpressionLanguage($this->expressionLanguage);
            }

            return $this->matcher = new $this->options['matcher_class']($this->getRouteCollection(), $this->context);
        }

        $class = $this->options['matcher_cache_class'];
        $cache = new ConfigCache($this->options['cache_dir'].'/'.$class.'.php', $this->options['debug']);
        if (!$cache->isFresh()) {
            $dumper = $this->getMatcherDumperInstance();
            if (method_exists($dumper, 'setExpressionLanguage')) {
                 $dumper->setExpressionLanguage($this->expressionLanguage);
            }

            $options = array(
                'class'      => $class,
                'base_class' => $this->options['matcher_base_class'],
            );

            $cache->write($dumper->dump($options), $this->getRouteCollection()->getResources());
        }

        require_once $cache;

        $this->matcher = new $class($this->context);
        if (method_exists($this->matcher, 'setExpressionLanguage')) {
             $this->matcher->setExpressionLanguage($this->expressionLanguage);
        }

        return $this->matcher;
    }

}
