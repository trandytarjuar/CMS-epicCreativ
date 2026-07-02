<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// auth
$routes->group('', function ($routes) {
    $routes->get('/login', 'AuthController::login');
    $routes->post('/login', 'AuthController::loginProcess');

    $routes->get('/forgot-password', 'AuthController::forgotPassword');
    $routes->post('/forgot-password', 'AuthController::sendResetLink');

    $routes->get('/reset-password', 'AuthController::resetPassword');
    $routes->post('/reset-password', 'AuthController::updatePassword');

    $routes->get('/logout', 'AuthController::logout');
});


$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/user', 'UserController::index', ['filter' => 'auth']);
$routes->post('/user', 'UserController::store', ['filter' => 'auth']);
$routes->get('/user/(:num)', 'UserController::show/$1', ['filter' => 'auth']);
$routes->put('/user/(:num)', 'UserController::update/$1', ['filter' => 'auth']);
$routes->delete('/user/(:num)', 'UserController::delete/$1', ['filter' => 'auth']);
$routes->post('/user/check-username', 'UserController::checkUsername', ['filter' => 'auth']);
$routes->post('/user/check-email', 'UserController::checkEmail', ['filter' => 'auth']);
$routes->get('/profile', 'ProfileController::index', ['filter' => 'auth']);
$routes->post('/profile/update', 'ProfileController::update', ['filter' => 'auth']);
$routes->post('/profile/password', 'ProfileController::changePassword', ['filter' => 'auth']);

$routes->get('/client', 'ClientController::index', ['filter' => 'auth']);
$routes->post('/client', 'ClientController::store', ['filter' => 'auth']);
$routes->get('/client/show/(:num)', 'ClientController::show/$1', ['filter' => 'auth']);
$routes->post('/client/update/(:num)', 'ClientController::update/$1', ['filter' => 'auth']);
$routes->delete('/client/(:num)', 'ClientController::delete/$1', ['filter' => 'auth']);
// $routes->post('/forgot-password', 'AuthController::forgotPasswordProcess');

$routes->get('/language', 'LanguageController::index', ['filter' => 'auth']);
$routes->post('/language', 'LanguageController::store', ['filter' => 'auth']);
$routes->post('/language/update/(:num)', 'LanguageController::update/$1', ['filter' => 'auth']);
$routes->delete('/language/(:num)', 'LanguageController::delete/$1', ['filter' => 'auth']);

// $routes->get('/portfolio', 'PortfolioController::indexINA', ['filter' => 'auth']);
$routes->group(
    'banner',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            '/',
            'BannerController::index'
        );

        $routes->post(
            'store',
            'BannerController::store'
        );

        $routes->get(
            'show/(:num)',
            'BannerController::show/$1'
        );

        $routes->post(
            'update/(:num)',
            'BannerController::update/$1'
        );

        $routes->delete(
            'delete/(:num)',
            'BannerController::delete/$1'
        );
    }
);

$routes->group(
    'portfolio-category',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            'create/(:segment)',
            'PortfolioCategoryController::create/$1'
        );

        $routes->post(
            'store',
            'PortfolioCategoryController::store'
        );

        $routes->get(
            'translation/(:num)/(:segment)',
            'PortfolioCategoryController::translation/$1/$2'
        );

        $routes->get(
            'edit/(:num)/(:segment)',
            'PortfolioCategoryController::edit/$1/$2'
        );

        $routes->post(
            'update/(:num)/(:segment)',
            'PortfolioCategoryController::update/$1/$2'
        );

        $routes->delete(
            'delete/(:num)',
            'PortfolioCategoryController::delete/$1'
        );

        $routes->get(
            '(:segment)',
            'PortfolioCategoryController::index/$1'
        );
    }
);

$routes->group('service', ['filter' => 'auth'], function ($routes) {

    $routes->get('(:segment)', 'ServiceController::index/$1');

    $routes->get('create/(:segment)', 'ServiceController::create/$1');
    $routes->post('store', 'ServiceController::store');

    // translation
    $routes->get(
        'translation/(:num)/(:segment)',
        'ServiceController::translation/$1/$2'
    );

    $routes->post(
        'add-translation/(:num)',
        'ServiceController::addTranslation/$1'
    );

    // edit
    $routes->get(
        'edit/(:num)/(:segment)',
        'ServiceController::edit/$1/$2'
    );

    $routes->post(
        'update/(:num)/(:segment)',
        'ServiceController::update/$1/$2'
    );

    // detail
    $routes->get(
        'detail/(:num)/(:segment)',
        'ServiceController::detail/$1/$2'
    );

    // delete
    $routes->delete(
        'delete/(:num)',
        'ServiceController::delete/$1'
    );
});

$routes->group(
    'subservice',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            '(:segment)',
            'SubserviceController::index/$1'
        );

        $routes->get(
            'create/(:segment)',
            'SubserviceController::create/$1'
        );

        $routes->post(
            'store',
            'SubserviceController::store'
        );

        $routes->get(
            'translation/(:num)/(:segment)',
            'SubserviceController::translation/$1/$2'
        );

        $routes->post(
            'store-translation',
            'SubserviceController::storeTranslation'
        );

        $routes->delete(
            'delete/(:num)',
            'SubserviceController::delete/$1'
        );
        $routes->get(
            'edit/(:num)/(:segment)',
            'SubserviceController::edit/$1/$2'
        );

        $routes->post(
            'update/(:num)',
            'SubserviceController::update/$1'
        );
    }
);

// $routes->group(
//     'portfolio',
//     ['filter' => 'auth'],
//     function ($routes) {

//         // default
//         $routes->get(
//             '/',
//             'PortfolioController::index/id'
//         );

//         $routes->get(
//             '(:segment)',
//             'PortfolioController::index/$1'
//         );

//         $routes->get(
//             'create/(:segment)',
//             'PortfolioController::create/$1'
//         );

//         $routes->post(
//             'store',
//             'PortfolioController::store'
//         );

//         // translation
//         $routes->get(
//             'translation/(:num)/(:segment)',
//             'PortfolioController::translation/$1/$2'
//         );

//         $routes->post(
//             'add-translation/(:num)',
//             'PortfolioController::addTranslation/$1'
//         );

//         // edit
//         $routes->get(
//             'edit/(:num)/(:segment)',
//             'PortfolioController::edit/$1/$2'
//         );

//         $routes->post(
//             'update/(:num)/(:segment)',
//             'PortfolioController::update/$1/$2'
//         );

//         // detail
//         $routes->get(
//             'detail/(:num)/(:segment)',
//             'PortfolioController::detail/$1/$2'
//         );

//         // delete
//         $routes->delete(
//             'delete/(:num)/(:segment)',
//             'PortfolioController::delete/$1/$2'
//         );
//     }
// );


$routes->group(
    'portfolio',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            '/',
            'PortfolioController::index/id'
        );

        $routes->get(
            '(:segment)',
            'PortfolioController::index/$1'
        );

        /*
        |--------------------------------------------------------------------------
        | MASTER PORTFOLIO
        |--------------------------------------------------------------------------
        */

        $routes->get(
            'create/(:segment)',
            'PortfolioController::create/$1'
        );

        $routes->post(
            'store',
            'PortfolioController::store'
        );

        /*
        |--------------------------------------------------------------------------
        | TRANSLATION
        |--------------------------------------------------------------------------
        */

        $routes->get(
            'translation/(:num)/(:segment)',
            'PortfolioController::translation/$1/$2'
        );

        // $routes->post(
        //     'add-translation/(:num)',
        //     'PortfolioController::addTranslation/$1'
        // );

        /*
        |--------------------------------------------------------------------------
        | EDIT
        |--------------------------------------------------------------------------
        */

        $routes->get(
            'edit/(:num)/(:segment)',
            'PortfolioController::edit/$1/$2'
        );

        $routes->post(
            'update/(:num)/(:segment)',
            'PortfolioController::update/$1/$2'
        );

        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        */

        $routes->delete(
            'delete/(:num)/(:segment)',
            'PortfolioController::delete/$1/$2'
        );
    }
);
$routes->group(
    'about',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            '/',
            'AboutController::index/id'
        );

        $routes->get(
            '(:segment)',
            'AboutController::index/$1'
        );

        $routes->get(
            'create/(:segment)',
            'AboutController::create/$1'
        );

        $routes->post(
            'store',
            'AboutController::store'
        );

        $routes->get(
            'translation/(:num)/(:segment)',
            'AboutController::translation/$1/$2'
        );

        $routes->get(
            'edit/(:num)/(:segment)',
            'AboutController::edit/$1/$2'
        );

        $routes->post(
            'update/(:num)/(:segment)',
            'AboutController::update/$1/$2'
        );

        $routes->delete(
            'delete/(:num)/(:segment)',
            'AboutController::delete/$1/$2'
        );
    }
);

$routes->group(
    'portfolio-behind-scenes',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            '/',
            'PortfolioBehindSceneController::index'
        );

        $routes->get(
            'create/(:num)',
            'PortfolioBehindSceneController::create/$1'
        );

        $routes->post(
            'store',
            'PortfolioBehindSceneController::store'
        );

        $routes->get(
            'edit/(:num)',
            'PortfolioBehindSceneController::edit/$1'
        );

        $routes->get(
            'show/(:num)',
            'PortfolioBehindSceneController::show/$1'
        );

        $routes->post(
            'update/(:num)',
            'PortfolioBehindSceneController::update/$1'
        );

        $routes->delete(
            'delete/(:num)',
            'PortfolioBehindSceneController::delete/$1'
        );

        $routes->get(
            'detail/(:num)',
            'PortfolioBehindSceneController::detail/$1'
        );
    }
);
