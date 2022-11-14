<?php

namespace App\Controller;

use App\Service\Container;

class LogisticController extends AbstractController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcakeNumber = trim($_POST['cupcakeNumber']);
            // TODO call inbox() method of Container class with $cupcakeNumber as parameter
            $container = new Container();
            $delivery = $container->inbox($cupcakeNumber);
        }
        return $this->twig->render('Logistic/index.html.twig', [
                "delivery" => $delivery
        ]);
    }
}
