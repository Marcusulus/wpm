<?php



/*
*   Controller für Konfigurationslogik
*/
class KonfigurationController extends ControllerBase
{

    

    /*
    *   Einstiegspunkt des Controllers
    *   @return Inhalt von Konfiguration/index.volt
    */
    public function indexAction()
    {
        //renderlevel setzen
        $this->SetLayoutRender();
    }

    /*
    *   Funktion zum Anzeigen der Mitarbeiter
    *   @return Inhalt von Konfiguration/mitarbeiter.volt
    */
    public function mitarbeiterAction()
    {
        $this->SetLayoutRender();
        //setzen der serverseitgen variable
        //-1 weil Personen keinem kundnezugeordnet sind
        $this->session->set('kundenid', -1);

        //ansciht bestimmen
        $view = $this->view;
    }

    /*
    *   Funktion zum Anzeigen der Status
    *   @return Inhalt von Konfiguration/status.volt
    */ 
    public function statusAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;

    }

    /*
    *   Funktion zum Anzeigen der Milestones
    *   @return Inhalt von Konfiguration/mitarbeiter.volt
    */
    public function milestonesAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
    }
}

