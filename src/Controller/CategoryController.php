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
        AdminController::roleNeed();
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

        AdminController::roleNeed();
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

    public function update($categoryID)
    {
        AdminController::roleNeed();
        $categorySQL = new Category();
        $category = $categorySQL->SqlGet(BDD::getInstance(), $categoryID);

        if ($_POST) {
            $category->setLabel($_POST['label']);
            $category->setCodeReference($_POST['code_reference']);

            $category->SqlUpdate(BDD::getInstance());
            header('Location:/Category');
        }

        return $this->twig->render('Category/update.html.twig', [
            'category' => $category
        ]);
    }

    public function Delete($categoryID)
    {
        AdminController::roleNeed();
        $category = new Category();
        $category->SqlDelete(BDD::getInstance(), $categoryID);

        header('Location:/Category/');
    }
}