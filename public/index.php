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
$router->get('/', "Article#Home");
$router->get('/Home', "Article#Home");
$router->get('/Article', "Article#ListAll");
$router->get('/Article/Update/:id', "Article#Update#id");
$router->post('/Article/Update/:id', "Article#Update#id");
$router->get('/Article/Update','Error#ErrorId');
$router->get('/Article/Add', "Article#Add");
$router->post('/Article/Add', "Article#Add");
$router->get('/Article/Delete/:id', "Article#Delete#id");
$router->get('/Article/Delete','Error#ErrorId');
$router->get('/Article/Fixtures', "Article#Fixtures");
$router->get('/Article/WriteAll/', "Article#Write");
$router->get('/Article/WriteOne/:id', "Article#WriteOne#id");
$router->get('/Article/WriteOne','Error#ErrorId');
$router->get('/Article/Read', "Article#Read");
$router->get('/Article/ListAll','Article#listAll');
$router->post('/Article/Search','Article#Search');
$router->get('/Article/Show/:id','Article#ReadArticle#id');
$router->get('/Article/Show','Error#ErrorId');

//API Methods
$router->get('/Api/Article', "Api#ArticleGet");
$router->get('/Api/Article/Five/:token', "Api#ArticleFive#token");
$router->post('/Api/Article', "Api#ArticlePost");
$router->put('/Api/Article/:id/:json', "Api#ArticlePut#id#json");


//Contact Methods
$router->get('/Contact', 'Contact#showForm');
$router->post('/Contact/sendMail', 'Contact#sendMail');
$router->get('/Contact/Article/:id', 'Contact#FormId#id');
$router->get('/Contact/Article','Error#ErrorId');

//User Methods
$router->get('/Login', 'User#loginForm');
$router->post('/Login', 'User#loginCheck');
$router->get('/Register', 'User#RegisterForm');
$router->post('/Register', 'User#RegisterCheck');
$router->get('/Logout', 'User#logout');
$router->get('/Profile', 'User#Profile');
$router->post('/Profile', 'User#Profile');
$router->get('/CreateToken', 'User#setTokenAPI');

//Admin methods
$router->get('/Admin/ListUser/', 'Admin#ListUser');
$router->get('/Admin/ListArticlesWaiting/', 'Admin#ListArticlesWaiting');
$router->get('/Admin/ApproveUser/:id', 'Admin#ApproveUser#id');
$router->get('/Admin/ApproveUser','Error#ErrorId');
$router->get('/Admin/ApproveArticle/:id','Admin#ApproveArticle#id');
$router->get('/Admin/ApproveArticle','Error#ErrorId');
$router->get('/Admin/ChangeRoles/:id', 'Admin#ChangeRolesForm#id');
$router->get('/Admin/ChangeRoles','Error#ErrorId');
$router->post('/Admin/ChangeRoles/', 'Admin#ChangeRoles');
$router->get('/Admin/DeleteUser/:id', 'Admin#DeleteUser#id');
$router->get('/Admin/DeleteUser','Error#ErrorId');
$router->get('/Admin/ApproveArticle/:id','Admin#ApproveArticle#id');
$router->get('/Admin/ApproveArticle','Error#ErrorId');
$router->get('/Admin/ChangeTheme/','Admin#ChangeTheme');
$router->post('/Admin/ChangeTheme/','Admin#ChangeTheme');

//Category Methods
$router->get('/Category/', "Category#ListAll");
$router->get('/Category/ListAll', "Category#ListAll");
$router->get('/Category/Article/', "Category#ListAll");
$router->get('/Category/Article/:id', "Category#ListArticle");
$router->get('/Category/Add', "Category#Add");
$router->post('/Category/Add', "Category#Add");
$router->get('/Category/Update/:id', "Category#Update#id");
$router->get('/Category/Update','Error#ErrorId');
$router->post('/Category/Update/:id', "Category#Update#id");
$router->get('/Category/Update','Error#ErrorId');
$router->get('/Category/Delete/:id', "Category#Delete#id");
$router->get('/Category/Delete','Error#ErrorId');




echo $router->run();



