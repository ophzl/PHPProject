<?php


namespace src\Controller;


use src\Model\Article;
use src\Model\Bdd;
use src\Model\Category;

class CategoryController extends AbstractController
{
    /**
     * list All category
     * @return string
     */
    public function Index()
    {
        return $this->ListAll();
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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

    /**
     * return twig render that print add a new Category
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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

    /**
     * return twig render that print update a Category
     * @param $categoryID
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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
            'Category' => $category
        ]);
    }

    /**
     * delete a Category and redirect to /Category/
     * @param $categoryID
     */
    public function Delete($categoryID)
    {
        AdminController::roleNeed();
        $category = new Category();
        $category->SqlDelete(BDD::getInstance(), $categoryID);

        header('Location:/Category/');
    }

    /**
     * return twig render that print all articles of on Category
     * @param $categoryID
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function ListArticle($categoryID)
    {
        AdminController::roleNeed();
        $category = (new Category)->SqlGet(Bdd::GetInstance(), $categoryID);
        $listArticle = (new Article)->SqlGetBy(Bdd::GetInstance(),
            'SELECT * FROM articles WHERE articles_category_id=:param', $categoryID);
        return $this->twig->render('Category/listarticle.html.twig', [
            'articleList' => $listArticle,
            'category' => $category
        ]);
    }
}