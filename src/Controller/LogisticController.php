<?php

namespace App\Controller;

class LogisticController extends AbstractController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $cupcakeNumber = trim($_POST['cupcakeNumber']);
            // TODO call inbox() method of Container class with $cupcakeNumber as parameter
        }
        return $this->twig->render('Logistic/index.html.twig', [
                // TODO send a containers variable to Twig with results of inbox() method
        ]);
    }
}
