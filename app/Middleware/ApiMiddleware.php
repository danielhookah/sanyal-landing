<?php

namespace App\Middleware;

use App\Auth\Auth;
use Slim\Http\{
    Request,
    Response
};

class ApiMiddleware extends Middleware
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        $this->setRequest($request);
        $container = $this->container;
        /** @var Auth $auth */
        $auth = $container->auth;

        $token = $request->getHeaderLine('X-AUTH-Token');
        $authorization = $auth->checkUserFromHeader($token);

        if (false === $authorization) {
            return $response->withStatus(401)->withJson(['error' => 'UNAUTHORIZED']);
        }
        $response = $next($request, $response)->withHeader('X-AUTH-Token', $token);
        return $response;
    }


    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }


}
