<?php


namespace App\Controller;

use App\Model\MissionsManager;

class MissionsController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $missionsManager = new MissionsManager();
        $missions = $missionsManager->selectAll();
        return $this->twig->render('Missions/index.html.twig', ['missions'=>$missions]);
    }
}
