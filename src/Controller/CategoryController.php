<?php


namespace src\Controller;


use src\Model\Bdd;
use src\Model\Category;

class CategoryController extends AbstractController
{
    public function Index()
    {
        return $this->ListAll();
    }

    public function ListAll()
    {
        $category = new Category();
        $listCategory = $category->SqlGetAll(Bdd::GetInstance());
        //Lancer la vue TWIG
        return $this->twig->render(
            'Category/list.html.twig', [
                'categoryList' => $listCategory
            ]
        );
    }

    public function add()
    {

        UserController::roleNeed('admin');
        if ($_POST AND $_SESSION['token'] == $_POST['token']) {

            $category = new Category();
            $category->setLabel($_POST['label']);
            $category->setCodeReference($_POST['code_reference']);
            $category->SqlAdd(BDD::getInstance());
            header('Location:/Category');
        } else {
            // Génération d'un TOKEN
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            return $this->twig->render('Category/add.html.twig',
                [
                    'token' => $token
                ]);
        }
    }

    public function Delete($categoryID)
    {
        $category= new Category();
        $category->SqlDelete(BDD::getInstance(), $categoryID);

        header('Location:/Category/');
    }
}