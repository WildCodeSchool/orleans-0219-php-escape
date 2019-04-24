<?php


namespace App\Controller;


class AdminController extends AbstractController
{

    /**
     * Display admin home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function admin()
    {
        return $this->twig->render('Admin/home.html.twig');
    }
}