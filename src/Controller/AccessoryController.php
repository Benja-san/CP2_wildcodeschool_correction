<?php

namespace App\Controller;

use App\Model\AccessoryManager;

/**
 * Class AccessoryController
 *
 */
class AccessoryController extends AbstractController
{
    /**
     * Display accessory creation page
     * Route /accessory/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $errors = [];
        $accessory = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accessory = array_map("trim", $_POST);
            foreach($accessory as $key => $value){
                if(empty($value)){
                    $errors[$key] = "Veuillez remplir le champ $key";
                }
                if(strlen($value) > 255){
                    $errors[$key] = "Veuillez raccourcir le champ $key";
                }
            }
            if(!filter_var($accessory['url'], FILTER_VALIDATE_URL)){
                $errors["url"] = "Veuillez entrer une url valide.";
            }

            if(empty($errors)){
                $accessoryManager = new AccessoryManager();
                $accessoryManager->addAccessory($accessory);
                header('Location:/accessory/list');
            }
            //TODO Add your code here to create a new accessory
        }
        return $this->twig->render('Accessory/add.html.twig',[
            'errors' => $errors,
            'accessory' => $accessory
        ]);
    }

    /**
     * Display list of accessories
     * Route /accessory/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();
        //TODO Add your code here to retrieve all accessories
        return $this->twig->render('Accessory/list.html.twig', [
            'accessories' => $accessories
        ]);
    }
}
