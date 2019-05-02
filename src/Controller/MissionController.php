<?php


namespace App\Controller;

use App\Model\MissionManager;

class MissionController extends AbstractController
{
    /**
     * Display mission page
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

        return $this->twig->render('/Mission/index.html.twig', ['missions'=>$missions]);
    }

    /**
     * Display mission informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $missionManager = new MissionManager();
        $mission= $missionManager->selectOneById($id);

        return $this->twig->render('Mission/show.html.twig', ['mission'=>$mission]);
    }
}
