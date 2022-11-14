<?php

namespace App\Controller;

use App\Service\Container;
use App\Model\CupcakeManager;
use App\Model\AccessoryManager;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcake = $_POST;
            $cupcakeManager = new CupcakeManager();
            $cupcakeManager->addCupcake($cupcake);
            header('Location:/cupcake/list');
        }
        //TODO retrieve all accessories for the select options
        return $this->twig->render('Cupcake/add.html.twig', [
            'accessories' => $accessories
        ]);
    }

    /**
     * Display list of cupcakes
     * Route /cupcake/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        //TODO Retrieve all cupcakes
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAllWithAccessories("id", "DESC");
        return $this->twig->render('Cupcake/list.html.twig', [
            'cupcakes' => $cupcakes
        ]);
    }


    /**
     * Display list of cupcakes
     * Route /cupcake/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id): string
    {

        //TODO Retrieve my favorite cupcake
        $cupcakeManager = new CupcakeManager();
        $cupcake = $cupcakeManager->selectOneWithAccessory($id);

        return $this->twig->render('Cupcake/show.html.twig', [
            'cupcake' => $cupcake
        ]);
    }
}
