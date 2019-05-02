<?php


namespace App\Controller;

class CgvuController extends AbstractController
{

    /**
     * Display CGVU page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Cgvu/index.html.twig');
    }
}
