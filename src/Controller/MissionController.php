<?php


namespace App\Controller;

use App\Model\MissionManager;

class MissionController extends AbstractController
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
        $missionManager = new MissionManager();
        $missions = $missionManager->selectAll();
        return $this->twig->render('Missions/index.html.twig', ['missions'=>$missions]);
    }
}
