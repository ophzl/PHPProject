<?php


namespace src\Controller;


class ErrorController extends AbstractController
{

    public function ErrorId()
    {
        return $this->twig->render(
            'Error/missingid.html.twig');
    }

}