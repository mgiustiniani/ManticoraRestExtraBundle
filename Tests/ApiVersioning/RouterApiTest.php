<?php
/**
 * User: Mario Giustiniani
 * Date: 04/05/14
 * Time: 16.00
 */
namespace Manticora\RestExtraBundle\Tests\ApiVersioning;

use Manticora\RestExtraBundle\ExpressionLanguage\ExpressionLanguage;
use Manticora\RestExtraBundle\Routing\Matcher\CustomUrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


class RouterApiTest extends \PHPUnit_Framework_TestCase
{
    public function testCondition()
    {
        $route = new Route('/');
        $this->assertEquals(null, $route->getCondition());
        $route->setCondition('context.getMethod() == "GET"');
        $this->assertEquals('context.getMethod() == "GET"', $route->getCondition());

        $coll = new RouteCollection();
        $route = new Route('/foo');
        $route->setCondition("compare(request.query.get('version'),'1', '>')");
        $coll->add('foo', $route);
        $matcher = new CustomUrlMatcher($coll, new RequestContext());
        $matcher->setExpressionLanguage(new ExpressionLanguage());


        $matcher->matchRequest(Request::create('/foo','GET', array('version'=>'1.1')));
    }



} 