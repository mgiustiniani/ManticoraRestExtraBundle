<?php
/**
 * User: Mario Giustiniani
 * Date: 12/04/14
 * Time: 14.10
 */

namespace Manticora\RestExtraBundle\Routing\Matcher;


use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class CustomUrlMatcher extends  RedirectableUrlMatcher
{

    /**
     * @param ExpressionLanguage $expressionLanguage
     */
    public function setExpressionLanguage(ExpressionLanguage $expressionLanguage = null)
    {
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * Redirects the user to another URL.
     *
     * @param string $path   The path info to redirect to.
     * @param string $route  The route that matched
     * @param string $scheme The URL scheme (null to keep the current one)
     *
     * @return array An array of parameters
     */
    public function redirect($path, $route, $scheme = null)
    {
        return array(
            '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::urlRedirectAction',
            'path'        => $path,
            'permanent'   => true,
            'scheme'      => $scheme,
            'httpPort'    => $this->context->getHttpPort(),
            'httpsPort'   => $this->context->getHttpsPort(),
            '_route'      => $route,
        );
    }
}