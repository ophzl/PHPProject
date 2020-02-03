<?php
namespace src\Controller;

class AbstractController {
    protected $loader;
    protected $twig;

    public function __construct()
    {
        //Conf de TWIG
        $this->loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'].'/../templates');
        $this->twig = new \Twig\Environment(
            $this->loader,[
                'cache' => $_SERVER['DOCUMENT_ROOT'].'/../var/cache',
                'debug' => true
            ]
        );
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        if(isset($_SESSION['USER'])) {
            $this->twig->addGlobal('userConnected', $_SESSION['USER']);
        }


        // Ajout d'une fonction PHP
        $fileExist = new \Twig\TwigFunction('file_exist', function($cheminFichier){
                if(file_exists($cheminFichier)){
                    return true;
                }else{
                    return false;
                }
        });
        $this->twig->addFunction($fileExist);

        $this->twig->addGlobal('session', $_SESSION);
    }

    public function getTwig(){
        return $this->twig;
    }


}