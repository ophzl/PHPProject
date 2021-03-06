<?php

namespace src\Controller;

use src\Model\Article;
use src\Model\Bdd;
use DateTime;
use src\Model\Category;
use src\Model\User;

class ArticleController extends AbstractController
{

    public function Index()
    {
        return $this->ListAll();
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints the list of all articles in Db
     */
    public function ListAll()
    {
        $article = new Article();
        $listArticle = $article->SqlGetAllApproved(Bdd::GetInstance());
        //Lancer la vue TWIG
        return $this->twig->render(
            'Article/list.html.twig', [
                'articleList' => $listArticle
            ]
        );
    }

    /*
     * !!IF POST!!
     * Verify that SESSION USER is "redacteur"
     * Add the Article in Db
     * !!ELSE!!
     * Return Twig Render that prints the form to add an article
     * CRSF-proof
     */
    public function add()
    {
        UserController::roleNeed('redacteur');
        if ($_POST AND $_SESSION['token'] == $_POST['token']) {
            $sqlRepository = null;
            $nomImage = null;
            if (!empty($_FILES['image']['name'])) {
                $tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if (in_array(strtolower($extension), $tabExt)) {
                    $nomImage = md5(uniqid()) . '.' . $extension;
                    $dateNow = new DateTime();
                    $sqlRepository = $dateNow->format('Y/m');
                    $repository = './uploads/images/' . $dateNow->format('Y/m');
                    if (!is_dir($repository)) {
                        mkdir($repository, 0777, true);
                    }
                    move_uploaded_file($_FILES['image']['tmp_name'], $repository . '/' . $nomImage);
                }
            }
            $article = new Article();
            $article->setTitre($_POST['Titre'])
                ->setDescription($_POST['Description'])
                ->setAuteur($_POST['Auteur'])
                ->setDateAjout($_POST['DateAjout'])
                ->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $_POST['Categorie']))
                ->setUser((new User)->SqlGet(Bdd::GetInstance(), $_POST['User']));
            //->setImageRepository($sqlRepository)
            //->setImageFileName($nomImage);


            $article->SqlAdd(BDD::getInstance());
            header('Location:/Article');
        } else {
            // Génération d'un TOKEN
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;

            $listCategory = (new Category)->SqlGetAll(Bdd::GetInstance());

            return $this->twig->render('Article/add.html.twig', [
                'token' => $token,
                'listCategory' => $listCategory
            ]);
        }
    }

    /**
     * @param $articleID
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * !!IF POST!!
     * Verify that SESSION USER is "redacteur"
     * Update the Article in Db corresponding to idArticle
     * !!ELSE!!
     * Return Twig Render that prints the form to update an article
     * CRSF-proof
     */
    public function update($articleID)
    {
        $articleSQL = new Article();
        $article = $articleSQL->SqlGet(BDD::getInstance(), $articleID);
        if ($_POST && $_POST['crsf'] == $_SESSION['token']) {
            $sqlRepository = null;
            $nomImage = null;
            if (!empty($_FILES['image']['name'])) {
                $tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if (in_array(strtolower($extension), $tabExt)) {
                    $nomImage = md5(uniqid()) . '.' . $extension;
                    $dateNow = new DateTime();
                    $sqlRepository = $dateNow->format('Y/m');
                    $repository = './uploads/images/' . $dateNow->format('Y/m');
                    if (!is_dir($repository)) {
                        mkdir($repository, 0777, true);
                    }
                    move_uploaded_file($_FILES['image']['tmp_name'], $repository . '/' . $nomImage);
                    // suppression ancienne image si existante

                    if ($_POST['imageAncienne'] != '/') {
                        unlink('./uploads/images/' . $_POST['imageAncienne']);
                    }
                }
            }

            $article->setTitre($_POST['Titre'])
                ->setDescription($_POST['Description'])
                ->setAuteur($_POST['Auteur'])
                ->setDateAjout($_POST['DateAjout'])
                ->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $_POST['Categorie']))
                ->setUser((new User)->SqlGet(Bdd::GetInstance(), $_POST['User']));
            //->setImageRepository($sqlRepository)
            //->setImageFileName($nomImage);


            $article->SqlUpdate(BDD::getInstance());
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $listCategory = (new Category)->SqlGetAll(Bdd::GetInstance());

        return $this->twig->render('Article/update.html.twig', [
            'article' => $article,
            'token' => $token,
            'listCategory' => $listCategory
        ]);
    }

    /**
     * @param $articleID
     * Delete article in Db corresponding to idArticle
     * Redirects to Article#ListArticle
     */
    public function Delete($articleID)
    {
        $articleSQL = new Article();
        $article = $articleSQL->SqlGet(BDD::getInstance(), $articleID);
        $article->SqlDelete(BDD::getInstance(), $articleID);
        if ($article->getImageFileName() != '') {
            unlink('./uploads/images/' . $article->getImageRepository() . '/' . $article->getImageFileName());
        }

        header('Location:/');
    }

    /**
     * @throws \Exception
     * Fill Db with fictive articles
     * Redirects to Article#
     */
    public function fixtures()
    {

        $arrayTitre = array('PHP en force', 'React JS une valeur montante', 'C# toujours au top', 'Java en légère baisse'
        , 'Les entreprises qui recrutent', 'Les formations à ne pas rater', 'Les langages populaires en 2020', 'L\'année du Javascript');
        $dateajout = new DateTime();
        $arrayCat = ['2','3','5'];
        $arrayUser = ['1','4','5','6','9'];


        $article = new Article();
        $article->SqlTruncate(BDD::getInstance());
        for ($i = 1; $i <= 50; $i++) {
            shuffle($arrayTitre);
            shuffle($arrayCat);
            shuffle($arrayUser);
            $Valid = rand(0, 2);
            $dateajout->modify('+1 day');

            $user = (new User)->SqlGet(Bdd::GetInstance(), $arrayUser[0]);
            $category = (new Category)->SqlGet(Bdd::GetInstance(), $arrayCat[0]);

            $article->setTitre($arrayTitre[0])
                ->setDescription('On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).')
                ->setDateAjout($dateajout->format('Y-m-d'))
                ->setAuteur((new User)->SqlGet(Bdd::GetInstance(), $arrayUser[0])->getName())
                ->setValid(($Valid == 1) ? 1 : null)
                ->setUser($user);

            $article->setCategory($category);
            $article->SqlAdd(BDD::getInstance());
        }
        header('Location:/Article');
    }

    /**
     * Export to file all articles content to article.json
     * Redirects to Article#
     */
    public function Write()
    {

        $article = new Article();
        $listArticle = $article->SqlGetAll(Bdd::GetInstance());

        $file = 'article.json';
        if (!is_dir('./uploads/file/')) {

            mkdir('./uploads/file/', 0777, true);
        }
        file_put_contents('./uploads/file/' . $file, json_encode($listArticle));

        header('location:/Article/');
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints the content of article.json decoded by json_decode
     */
    public function Read()
    {
        $file = 'article.json';
        $datas = file_get_contents('./uploads/file/' . $file);
        $contenu = json_decode($datas);

        return $this->twig->render('Article/readfile.html.twig', [
            'fileData' => $contenu
        ]);
    }

    /**
     * @param $idArticle
     * Export to file article that corresponds to idArticle
     * Redirects to Article#
     */
    public function WriteOne($idArticle)
    {
        $article = new Article();
        $articleData = $article->SqlGet(Bdd::GetInstance(), $idArticle);

        $file = 'article_' . $idArticle . '.json';
        if (!is_dir('./uploads/file/')) {
            mkdir('./uploads/file/', 0777, true);
        }
        file_put_contents('./uploads/file/' . $file, json_encode($articleData));

        header('location:/Article/');
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Search all article that corresponds to Post.Search with SqlGetByLike
     * Return Twig Render that prints the result of the Search
     */
    public function Search()
    {
        $article = new Article();

        $listArticle = $article->SqlGetByLike(Bdd::GetInstance(), 'SELECT * FROM articles WHERE (Titre LIKE :param
                        OR Auteur LIKE :param OR Id LIKE :param) AND article_Valid = 1',
            $_POST['search']);

        if ($listArticle != null) {
            return $this->twig->render('Article/list.html.twig', [
                'articleList' => $listArticle
            ]);
        } else {
            return $this->twig->render('Error/searchempty.html.twig', [
                'search' => $_POST['search']
            ]);
        }

    }

    /**
     * @param $idArticle
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints the article content that corresponds to idArticle
     */
    public function ReadArticle($idArticle)
    {
        $article = new Article();
        $articleData = $article->SqlGet(Bdd::GetInstance(), $idArticle);

        return $this->twig->render('Article/readarticle.html.twig', [
            'articleData' => $articleData
        ]);
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints the Home page
     */
    public function Home()
    {
        $article = new Article();
        $listArticle = $article->SqlGetAllApproved(Bdd::GetInstance());

        for ($k = 0; $k < count($listArticle); $k++){
            $listArticle[$k]->setDescription($listArticle[$k]->firstXwords(25));
        }
            //Lancer la vue TWIG
            return $this->twig->render(
                'home.html.twig', [
                    'articleList' => $listArticle
                ]
            );
    }

}
