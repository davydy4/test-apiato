<?php

/**
 * @OA\Get(
 *      path="/enterprises-quota",
 *      tags={"Enterprises"},
 *      summary="Get enterprises where quota exceeded",
 *      description="Get enterprises where quota exceeded and send email",
 *      security={ {"bearer": {} }},
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *       )
 *     )
 * @var \Illuminate\Routing\Router $router
 */


$router->get('enterprises-quota', [
    'as' => 'api_enterprise_get_enterprises_quota',
    'uses'  => 'Controller@getEnterprisesQuota',
    'middleware' => [
      'jwt',
    ],
]);
