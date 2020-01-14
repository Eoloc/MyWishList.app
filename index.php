<?php
    session_start();

    use Slim\App;
use wishlist\controllers\ItemController;
use wishlist\controllers\ListController;
    use wishlist\controllers\PagesController;
    use wishlist\models\Database;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once 'vendor/autoload.php';

    Database::connect();

    //Important pour l'execution de slim et pour afficher les erreurs(pour le dev)
    $config = ['settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true,
    ]];
    $app = new App($config);
    $container = $app->getContainer();

    //TODO personnalisé le notFound
    $container['notFoundHandler'] = function ($container) {
        return function (Request $request, Response $response) {
            return $response->withStatus(404)
                ->withHeader('Content-Type', 'text/html')
                ->write('Page not found');
        };
    };

    $app->get('/img/{data}', function (Request $request, Response $response, array $args){
        $data = $args['data'];
        $image = @file_get_contents("src/img/$data");
        if ($image === FALSE) {
            $handler = $this->notFoundHandler;
            return $handler($request, $response);
        }
        $response->write($image);
        return $response->withHeader('Content-Type', FILEINFO_MIME_TYPE);
    })->setName('img');


    $app->get('/', function (Request $request, Response $response, array $args) use ($app) {
        $cont = new PagesController($app);
        $cont->index();
    })->setName('index');

    $app->get('/list', function (Request $request, Response $response, array $args) use ($app) {
        $cont = new ListController($app);
        $cont->showAll();
    })->setName('list.all');

    $app->get('/list/{token}', function (Request $request, Response $response, array $args) use ($app) {
        $cont = new ListController($app);
        $cont->showList($args['token']);
    })->setName('list.token');

    $app->get('/item/{id}', function (Request $request, Response $response, array $args) use ($app) {
        $cont = new ItemController($app);
        $cont->showItem($args['id']);
    })->setName('item.id');

    $app->get('/item/{id}/modify', function (Request $request, Response $response, array $args) use ($app) {
        $cont = new ItemController($app);
        $cont->modifyItem($args['id']);
    })->setName('item.id.modify');

    $app->get('/item/{id}/reserve', function (Request $request, Response $response, array $args) use ($app) {
        $cont = new ItemController($app);
        $cont->reserveItem($args['id']);
    })->setName('item.id.reserve');

    $app->get('/item/{id}/reserve/valideReserve', function (Request $request, Response $response, array $args) use ($app) {
        $cont = new ItemController($app);
        $cont->showItem($args['id']);
    })->setName('item.id.reserve.valide');

    $app->post('/item/{id}/reserve/valideReserve', function ($request, $response, $args) use ($app) {
        $cont = new ItemController($app);
        $cont->valideReserve($args['id']);
        return $response->withRedirect("http://" . $request->getUri()->getHost() . "/item/" . $args['id']);   // REDIRECTION
    });


    //Execution
    try {
        $app->run();
    } catch (Throwable $e) {
        echo "<pre>$e</pre>";
    }