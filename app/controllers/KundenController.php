<?php

use Phalcon\Mvc\View;

/*
*   Controller für die Kundenverwaltung
*/
class KundenController extends ControllerBase
{

    /*
    *   Einstiegspunkt des Controllers
    *   @return Inhalt von Kunden/index.volt
    */
    public function indexAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //Kundenlsite aus Db an Ansciht übergeben   
        $view->kunden = Auftraggeber::find();
    }


    /*
    *   Funktion zum Anzeigen des Formulars zum Bearbeiten von Kundendaten 
    *   @return Inhalt von Kunden/edit.volt
    */
    public function editAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //kundenid von serverseitigen variable laden
        $kundenid = $this->session->get('kundenid');
        //Prüfen ob Kunde existier
        //wenn kein Neukunde
        if($kundenid != -1)
        {
            //Daten aus Db an Form übertragen
            $view->kunde = Auftraggeber::findFirstByid($kundenid);
        }
        //wenn neu kunde ist
        else
        {
            //Leeres kundenobjekt an Formübergeben
            $view->kunde = new Auftraggeber();
            $view->kunde->id = -1;
        }
    }

    /*
    *   Funktion zum einleiten der Neukundenanlage
    */
    public function neuAction()
    {
        //seerverseitiges setzen der kunden id
        //-1 weil neukunde
        $this->session->set('kundenid',-1);

        //weiterleiten zum Formular
        $this->dispatcher->forward(
            [
                'controller' => 'Kunden',
                'action' => 'edit'
            ]
        );
    }

    /*
    *   Funktion zum Speichern von Kundendaten
    *   @param $kundenid In DB gespeicherte ID des Kunden. 
    *           Standard: -1
    */
    public function speichernAction()
    {
        //
        $postdata =  $this->request->getPost();
        //sewrverseitg gespeicherte Kunden id auslesen
        $kundenid = $this->session->get('kundenid');
        //Prüfen ob  Neukunde
        //wenn kein neukunde
        if($kundenid >= 0)
        {
            //bestehende kundendaten auslesen
            $kunde = Auftraggeber::findFirstByid($kundenid);

        }
        //wenn Neukkunde
        else 
        {
            //Neuen Kunden anlegen
            $kunde = new Auftraggeber();
        }
        //änderungen aus Formular in DB übertragen
        $kunde->save($postdata);
        //weiterleiten zum anzeigen der Kundendaten
        $this->dispatcher->forward(
            [
                'action' => 'info',
                'params' => [$kunde->id]
            ]);
    }

    /*
    *   Funktion zum Anzeigen von Kundendaten
    *   @param $kundenid In DB gespeicherte ID des Kunden. 
    *           Standard: -1
    *   @return Inhalt von Kunden/info.volt
    */
    public function infoAction($kundenid = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //wenn kunden id übergeben
        if($kundenid != -1)
        {
            //Serverseitges speichern der kundenid
            $this->session->set('kundenid',$kundenid);
            //kundendaten aus Db an ansicht übergeben
            $view->kunde = Auftraggeber::findFirstByid($kundenid);
        }
    }

    /*
    *   Funktion zum Löschen von Kundendaten
    *   @param $kundenid In DB gespeicherte ID des Kunden. 
    *           Standard: -1
    */
    public function loeschenAction()
    {
        //serverseitig gespeicherte kundenid auslesen
        $kundenid = $this->session->get('kundenid');
        //kundenobjekt aus db lesen
        $kunde = Auftraggeber::findFirstByid($kundenid);
        //kunde löschen
        $kunde->delete();
    }

    /*
    *   Funktion zum Anzeigen einer Liste an Kunden
    *   @return Inhalt von Kunden/liste.volt
    */
    public function listeAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //Kundenlsite aus Db an Ansciht übergeben   
        $view->kunden = Auftraggeber::find();
    }
}

