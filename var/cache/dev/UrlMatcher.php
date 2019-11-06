<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/places' => [
            [['_route' => 'app_place_postplaces', '_controller' => 'App\\Controller\\PlaceController::postPlacesAction'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'app_place_getplaces', '_controller' => 'App\\Controller\\PlaceController::getPlacesAction'], null, ['GET' => 0], null, false, false, null],
        ],
        '/users' => [
            [['_route' => 'app_user_postusers', '_controller' => 'App\\Controller\\UserController::postUsersAction'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'app_user_getusers', '_controller' => 'App\\Controller\\UserController::getUsersAction'], null, ['GET' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/places/([^/]++)(?'
                    .'|(*:61)'
                    .'|/prices(?'
                        .'|(*:78)'
                    .')'
                .')'
                .'|/users/([^/]++)(?'
                    .'|(*:105)'
                    .'|(*:113)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        61 => [
            [['_route' => 'app_place_deleteplace', '_controller' => 'App\\Controller\\PlaceController::deletePlaceAction'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'app_place_putplace', '_controller' => 'App\\Controller\\PlaceController::putPlaceAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_place_patchplace', '_controller' => 'App\\Controller\\PlaceController::patchPlaceAction'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'app_place_getplace', '_controller' => 'App\\Controller\\PlaceController::getPlaceAction'], ['id'], ['GET' => 0], null, false, true, null],
        ],
        78 => [
            [['_route' => 'app_price_getprices', '_controller' => 'App\\Controller\\PriceController::getPricesAction'], ['id'], ['GET' => 0], null, false, false, null],
            [['_route' => 'app_price_postprices', '_controller' => 'App\\Controller\\PriceController::postPricesAction'], ['id'], ['POST' => 0], null, false, false, null],
        ],
        105 => [
            [['_route' => 'app_user_patchuser', '_controller' => 'App\\Controller\\UserController::patchUserAction'], ['id'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'app_user_putuser', '_controller' => 'App\\Controller\\UserController::putUserAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_user_deleteuser', '_controller' => 'App\\Controller\\UserController::deleteUserAction'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        113 => [
            [['_route' => 'app_user_getuser', '_controller' => 'App\\Controller\\UserController::getUserAction'], ['user_id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
