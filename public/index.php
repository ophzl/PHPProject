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
$router->get('/Article/WriteAll/', "Article#Write");
$router->get('/Article/WriteOne/:id', "Article#WriteOne#id");
$router->get('/Article/Read', "Article#Read");
$router->get('/Article/ListAll','Article#listAll');
$router->post('/Article/Search','Article#Search');
$router->get('/Article/Show/:id','Article#ReadArticle#id');

//API Methods
$router->get('/Api/Article', "Api#ArticleGet");
$router->post('/Api/Article', "Api#ArticlePost");
$router->put('/Api/Article/:id/:json', "Api#ArticlePut#id#json");

//Contact Methods
$router->get('/Contact', 'Contact#showForm');
$router->post('/Contact/sendMail', 'Contact#sendMail');
$router->get('/Contact/Article/:id', 'Contact#FormId#id');

//User Methods
$router->get('/Login', 'User#loginForm'); //TODO: verify
$router->post('/Login', 'User#loginCheck'); //TODO: verify
$router->get('/Register', 'User#RegisterForm'); //TODO
$router->post('/Register', 'User#RegisterCheck'); //TODO
$router->get('/Logout', 'User#logout');
$router->get('/Profile', 'User#Profile');



$router->get('/Admin/ListUser/', 'Admin#ListUser');
$router->get('/Admin/ListArticlesWaiting/', 'Admin#ListArticlesWaiting');
$router->get('/Admin/ApproveUser/:id', 'Admin#ApproveUser#id');
$router->get('/Admin/ApproveArticle/:id','Admin#ApproveArticle#id');
$router->get('/Admin/ChangeRoles/:id', 'Admin#ChangeRolesForm#id');
$router->post('/Admin/ChangeRoles/', 'Admin#ChangeRoles');
$router->get('/Admin/DeleteUser/:id', 'Admin#DeleteUser#id');
$router->get('/Admin/ApproveArticle/:id','Article#ApproveArticle#id'); //TODO

//Category Methods
$router->get('/Category', "Category#ListAll");
$router->get('/Category/ListAll', "Category#ListAll");
$router->get('/Category/Add', "Category#Add");
$router->post('/Category/Add', "Category#Add");
$router->get('/Category/Update/:id', "Category#Update#id");
$router->post('/Category/Update/:id', "Category#Update#id");
$router->get('/Category/Delete/:id', "Category#Delete#id");



echo $router->run();



