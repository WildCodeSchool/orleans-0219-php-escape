<?php


namespace App\Controller;

class FaqController extends AbstractController
{
    /**
     * Display Faq page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Faq/index.html.twig');
    }
}
