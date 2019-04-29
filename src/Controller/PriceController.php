<?php
namespace App\Controller;

class PriceController extends AbstractController
{


    public function index()
    {
        return $this->twig->render('/Price/index.html.twig');
    }
}