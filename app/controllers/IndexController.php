<?php

/*
*   Controller für Startseite
*/
class IndexController extends ControllerBase
{

    /*
    *   Einstiegspunkt des Controllers 
    */
    public function indexAction()
    {

    }

    /*
    *   Funktion für die Navigation
    *   @param $controller  Gibt zu welchem Controller weitegeleitet werden soll 
    */
    public function WechselZuAction($controller)
    {
        //weiterleiten zum einstigespunkt der zieseite(controller)
        $this->dispatcher->forward(
            [
                'controller' => $controller,
                'action' => 'index'
            ]
            );
    }

}

