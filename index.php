<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Blog\PostMapper;
// guzzle
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;

require __DIR__ . '/vendor/autoload.php';

$loader = new FilesystemLoader('templates'); //загрузка директории шаблона \templates 
$view = new Environment($loader);  // задействуем view

$config = include 'config/database.php'; //конфигурация коннекта с БД
$dsn = $config['dsn'];
$username = $config['username'];
$password = $config['password'];

try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo 'Database error: ' . $exception->getMessage();
    die();
}

$postMapper = new PostMapper($connection);

// guzzle
$client = new GuzzleHttp\Client();

// web-приложение на Slim
$app = new \Slim\App;

// рут. маршруты: 
$app->get('/', function ($request, $response, $args) use ($view) {
    $body = $view->render('index.twig');
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function ($request,  $response, $args) use ($view) {
    $body = $view->render('about.twig', [
        'name' => 'Slim PHP'
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/mod', function ($request,  $response, $args) use ($view, $client) {
	$res = $client->request('GET', 'http://numbersapi.com/random/date');
	$datastatus = $res->getStatusCode();// стутус "200"
	$dataok = $res->getReasonPhrase(); //>>OK
	$datahead = $res->getHeader('content-type')[0];// Заголовок 'application/json; charset=utf8'
	$databody = $res->getBody();
	
    $body = $view->render('mod.twig', [
		'datastatus' => $datastatus,
		'dataok' => $dataok,
		'datahead' => $datahead,
		'databody' => $databody
	]);
    
	$response->getBody()->write($body);
    return $response;
});

$app->get('/hello/{name}', function ($request,  $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/ny', function ($request, $response, $args) use ($view) {
    $body = $view->render('ny.twig');
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function ($request,  $response, $args) use ($view, $postMapper) {
    $post = $postMapper->getByUrlKey((string) $args['url_key']);

    if (empty($post)) {
        $body = $view->render('not-found.twig');
    } else {
        $body = $view->render('post.twig', [
            'post' => $post
        ]);
    }
    $response->getBody()->write($body);
    return $response;
});

$app->run();
