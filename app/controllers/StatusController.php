<?php

/*
*   COntroller für Statusverwaltung
*/
class StatusController extends ControllerBase
{

    /*
    *   Funktion zum anzeigen eines Formulars zu bearbeitung von Status für Bilder und Texte
    *   @param $statusid In DB gespeicherte ID des Status
    *   @return Inahlt von Status/content.volt
    */
    public function contentAction($statusid = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;

        $this->session->set('statusid', $statusid);
        $this->session->remove('webstatusid');

        //wenn vorhandener status
        if($statusid > -1)
        {
            //Statusdaten an formular übergeben
            $view->status = Status::findFirstByid($statusid);
        }
        //wenn enuer status
        else 
        {
            //leeren Status erstellen
            $view->status = new Status();
            //als neuen statuskennzeichnern
            $view->status->id = -1;
        }
    }

    /*
    *   Funktion zum anzeigen eines Formulars zu bearbeitung von Status für Webpages
    *   @param $statusid In DB gespeicherte ID des Status
    *   @return Inahlt von Status/web.volt
    */
    public function webAction($statusid = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        
        $this->session->set('webstatusid', $statusid);
        $this->session->remove('statusid');
        //wenn vorhandener status
        if($statusid > -1)
        {
            //Statusdaten an formular übergeben
            $view->status = WebpageStatus::findFirstByid($statusid);
        }
        else 
        {
            //leeren Status erstellen
            $view->status = new Status();
            //als neuen statuskennzeichnern
            $view->status->id = $statusid;
        }
    }

    /*
    *   Funktion zum Speichern von Änderungen an Status
    *   @param $action Gibt an welche art der Änderung es sich Handelt
    *                   Delete <=> löschen
    *                   save <=> speichern
    */
    public function speichernAction()
    {
        
        //auslesen der übertragenen formuölardaten
        $post = $this->request->getPost();

        if($this->session->has('statusid'))
        {
            $type = 'Status';
            $id = $this->session->get('statusid');
        }
        else 
        {
            $type = 'Webpagestatus';
            $id = $this->session->get('webstatusid');
        }

        //Kovertieren des übergeben form wertes in integer
        if(array_key_exists('iststandard', $post))
        {
            $post['iststandard'] = 1;
        }
        else {
            $post['iststandard'] = 0;
        }

        //wenn vorhandener status
        if($id > -1)
        {
            //Statusdaten aus db auslesen
            $status = $type::findFirstByid($id);
            //Statusdaten aktualisieren
        }
        //Wenn neuer status
        else
        {
            //id aus entfernen damit sie von DB gesetzt werdn kann
            unset($post['id']);
            //leeren Status erstellen
            $status = new $type();
        }
        //formulardaten in db speichern
        $status->save($post);
              
    }

    public function loeschenAction()
    {
        //auslesen der übertragenen formuölardaten
        $post = $this->request->getPost();

        if($this->session->has('statusid'))
        {
            $type = 'Status';
            $id = $this->session->get('statusid');
        }
        else 
        {
            $type = 'Webpagestatus';
            $id = $this->session->get('webstatusid');
        }

         //satusdaten aus db auslesen
         $status = $type::findFirstByid($id);
         //statuslöschen
         $status->delete();
    }

    /*
    *   Funktion zum Anzeigen einer liste von Status für Bilder und Texte
    *   @return Inhalt von Status/liste.volt
    */
    public function listeAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //Contentstatus liste aus DB an Ansicht übertragen
        $view->status = Status::find();
        //status aals contentstatus kennzeichen
        $view->type = 'Status';
    }

    /*
    *   Funktion zum Anzeigen einer liste von Status für Webpages
    *   @return Inhalt von Status/liste.volt
    */
    public function weblisteAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //webpagestatusliste aus DB an ansicht übergeben
        $view->webstatus = Webpagestatus::find();
        //status aals contentstatus kennzeichen
        $view->type = 'Webpagestatus';
    }

}

