<?php

/*
*   Controller für Personendaten 
*/
class PersonController extends ControllerBase
{

    /*
    *   Funktion zum Anzeigen des Formulars zur bearbeitung von PersonenDaten
    *   @return INhalt von Person/edit.volt
    */
    public function editAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //serverseitg gespeicherte Id der Person auslesen
        $personID = $this->session->get('personid');
        //serverseitg gespeicherte ID des Kunden auslesen
        $kundeid = $this->session->get('kundenid');
        //Prüfen ob Person existiert
        //wenn existiert
        if($personID != -1)
        {   
            //übertagen der PErsonendaten von db an Formular
            $view->person = Person::findFirstByid($personID);
        }
        else 
        {
            //erstellen eines leeren PErsonenobjektes
            $view->person = new Person();
            //als neue person kennzeichnen
            $view->person->id = -1;
            //kunden zuordnen
            $tview->person->auftraggeber_id = $kundeid;
        }
    }


    /*
    *   Funktion zum Einleiten des ANlegen einer neuen Person
    */
    public function neuAction()
    {
        $this->SetLayoutRender();
        //serverseitg gespeichter kunden id auslesen
        $kundeid = $this->session->set('personid', -1);

        //weiterleiten zum Formular
        $this->dispatcher->forward(
            [  
                'controller' => 'Person',
                'action' => 'edit'
            ]);
    }

    /*
    *   Funktion zum Anzeigen der Personendaten
    *   @param $personID In DB gespeicherte ID der zu bearbeitenden Person
    *          Standard: -1
    *   @return Inhalt von Person/info.volt
    */
    public function infoAction($personID)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //Personendaten aus DB an Ansicht übergeben
        $view->person = Person::findFirstByid($personID);
        //serverseitiges Speichern der Personen ID
        $this->session->set('personid', $personID);
    }

    /*
    *   Funktion zum Speichern von PersonenDaten
    *   @param $personID In DB gespeicherte ID der zu bearbeitenden Person
    *          Standard: -1
    *   @param $kundeid ID des Kunden dem die Person zugeordnet ist
    *          Standart NULL
    */
    public function speichernAction()
    {
        $this->SetLayoutRender();
        //Auslesen serverseitig gespeicherte personen ID
        $personID = $this->session->get('personid');
        //Auslesen serverseitg gespeicherter Kunden ID
        $kundenid = $this->session->get('kundenid');
        //Auslesen der übertragenen Daten
        $postdata = $this->request->getPost();
        //Prüfen ob neue Person
        //wenn nicht neu
        if($personID > -1)
        {   
            //bestehende PErsonendaten aus DB auslesen
            $person = Person::findFirstByid($personID);
        }
        else 
        {
            //Leeres personen objekt anlegen
            $person = new Person();
            //Wenn kein Mitarbieter
            if($kundenid > -1)
            {
                //kunden id den daten anhängen
                $postdata = array_merge($postdata, ['auftraggeber_id' => $kundenid]);
            }
        }
        //Personendaten in DB speichern
        $succes = $person->save($postdata);
        //weiterleiten zum anzeigen der personendaten
        $this->dispatcher->forward(
            [
                'controller' => 'Person',
                'action' => 'info',
                'params' => [$person->id]
            ]);
        
    }

 
    /*
    *   Funktion zum Löschen von Personendaten
    *   @param $personID In DB gespeicherte ID der zu bearbeitenden Person
    *          Standard: -1
    */
    public function loeschenAction()
    {
        $this->SetLayoutRender();
        //auslesen der serverseitg gespeichterten personen id
        $personID = $this->session->get('personid');
        //Personendaten aus DB laden
        $person = Person::findFirstByid($personID);
        //person löschen
        $person->delete();

    }

    /*
    *   Funktion zum Anzeigen einer Liste von Personen
    *   @return Inhalt von Person/liste.volt 
    */
    public function listeAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //serverseitig gespeicherte kunden id auslesen
        $kundenid = $this->session->get('kundenid');

        if($kundenid >= 0)
        {
            //Liste der Ansprechpartner aus DB an Ansicht übergeben
            $view->personen = Person::findByauftraggeber_id($kundenid);
        }
        else 
        {
            //Liste der Mitarbeiter aus DB an Ansicht übergeben
            $view->personen = Person::find(['conditions'=>'auftraggeber_id is null']);
        }
    }

}

