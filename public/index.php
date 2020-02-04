<?php



function chargerClasse($classe){
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__."{$ds}.."; //Remonte d'un cran par rapport à index.php
    $classeName = str_replace('\\', $ds,$classe);

    $file = "{$dir}{$ds}{$classeName}.php";
    if(is_readable($file)){
        require_once $file;
    }
}

require '../vendor/autoload.php';
include "config.php";

spl_autoload_register('chargerClasse');

session_start();
$router = new \src\Router\Router($_GET['url']);

//Articles Methods
$router->get('/', "Article#ListAll");
$router->get('/Article', "Article#ListAll");
$router->get('/Article/Update/:id', "Article#Update#id");
$router->post('/Article/Update/:id', "Article#Update#id");
$router->get('/Article/Add', "Article#Add");
$router->post('/Article/Add', "Article#Add");
$router->get('/Article/Delete/:id', "Article#Delete#id");
$router->get('/Article/Fixtures', "Article#Fixtures");
$router->get('/Article/Write', "Article#Write");
$router->get('/Article/Read', "Article#Read");
$router->get('/Article/WriteOne/:id', "Article#Read#id");
$router->get('/Article/ListAll','Article#listAll');
$router->post('/Article/Search','Article#Search');
$router->get('/Article/Validate/:id','Article#Validate#id'); //TODO

//API Methods
$router->get('/Api/Article', "Api#ArticleGet");
$router->post('/Api/Article', "Api#ArticlePost");
$router->put('/Api/Article/:id/:json', "Api#ArticlePut#id#json");

//Contact Methods
$router->get('/Contact', 'Contact#showForm');
$router->post('/Contact/sendMail', 'Contact#sendMail');
$router->get('/Contact/ListArticles', 'Contact#ListArticles');

//User Methods
$router->get('/Login', 'User#loginForm'); //TODO: verify
$router->post('/Login', 'User#loginCheck'); //TODO: verify
$router->get('/Register', 'User#RegisterForm'); //TODO
$router->post('/Register', 'User#RegisterCheck'); //TODO
$router->get('/Logout', 'User#logout');
$router->get('/Admin/Validate/:id', 'User#Validate#id'); //TODO

$router->get('/Article/Show/:id','Article#ReadArticle#id');


echo $router->run();



