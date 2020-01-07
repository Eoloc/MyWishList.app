<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My WishList</title>
</head>
<body>
    <?php
    session_start();

    use Slim\App;
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


    $app->get('/', function (Request $request, Response $response, array $args) {
        $cont = new PagesController();
        $cont->index();
    })->setName('index');
    
    $app->get('/liste', function (Request $request, Response $response, array $args) {
        $cont = new ListController();
        $cont->showAll();
    })->setName('list.all');

    $app->get('/liste/{token}', function (Request $request, Response $response, array $args) {
        $cont = new ListController();
        $cont->showList($args['token']);
    })->setName('list.token');
    //Execution
    try {
        $app->run();
    } catch (Throwable $e) {
        echo "<pre>$e</pre>";
    }


    ?>

</body>
</html>
