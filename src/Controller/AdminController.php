<?php


namespace App\Controller;

use App\Model\MissionManager;

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
    public function index()
    {
        $missionsManager = new MissionManager();
        $missions = $missionsManager->selectAll();

        return $this->twig->render('Admin/index.html.twig', ['missions' => $missions]);
    }

    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $missionsManager = new MissionManager();
        $mission = $missionsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mission['title'] = $_POST['title'];
            $mission['minplayers'] = $_POST['minplayers'];
            $mission['maxplayers'] = $_POST['maxplayers'];
            $mission['level'] = $_POST['level'];
            $mission['subtitle'] = $_POST['subtitle'];
            $mission['description'] = $_POST['description'];
            $mission['image'] = $_POST['image'];

            $missionsManager->update($mission);
            header('location:/Admin/index');
        }

        return $this->twig->render('Admin/edit.html.twig', ['mission' => $mission]);
    }
}
