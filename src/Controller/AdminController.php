<?php


namespace App\Controller;

use App\Model\ItemManager;
use App\Model\MissionsManager;

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
        $missionsManager = new MissionsManager();
        $missions = $missionsManager->selectAll();

        return $this->twig->render('/Admin/admin.html.twig', ['missions' => $missions]);
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
        $missionsManager = new MissionsManager();
        $missions = $missionsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mission['title'] = $_POST['title'];
            $missionsManager->update($missions);
        }

        return $this->twig->render('Item/edit.html.twig', ['missions' => $missions]);
    }
}
