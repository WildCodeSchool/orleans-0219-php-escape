<?php

namespace App\Controller;

class MentionController extends AbstractController
{
    /**
     * Display Mention page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Mention/index.html.twig');
    }
}
