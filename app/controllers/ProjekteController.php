<?php

/*
*   Controller für Projektverwaltung
*/ 
class ProjekteController extends ControllerBase
{

    /*
    *   Einstiegspunkt für Controller
    *   @return Inhalt von Projekte/index.volt
    */
    public function indexAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //Projektliste aus DB an Ansicht übergeben
        $view->projekte = Projekte::find();
    }

    /*
    *   Funktion zum Anzeigen des Formulares zum bearbeitn/anlegen eines neuen Projektes
    *   @return Inhalt von Projekte/neu.volt
    */
    public function editAction($id = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;

        $this->session->set('projektid',$id);
        if($id == -1)
        {
            $view->projekt = new Projekte();
            
        }
        else {
            $view->projekt = Projekte::findFirstByid($id);
        }
        //Kundenliste aus Db an ansicht übergeben
        $view->kunden = Auftraggeber::find();
        //milestone lsite aus db
        $milestones  = Milestones::find();

        $temparray = array();
        //wenn vorhandenes Projekt
     
        foreach ($milestones as $milestone) 
        {
            $temp = new Milestone(); 
            $temp->id = $milestone->id;
            $temp->bezeichnung = $milestone->bezeichnung;
            $temp->start_geplant = null;
            $temp->ende_geplant = null;
            if($id > -1)
            { 
                $pms = ProjektMilestones::findFirst(['conditions' => 'milestone_id = '. $milestone->id .' and projekt_id = '. $id  ]);
                if($pms != false)
                {               
                        $temp->iststandard = 1;
                        $temp->start_geplant = $pms->start_geplant;
                        $temp->ende_geplant = $pms->ende_geplant;
                }
                else 
                {
                        $temp->iststandard = 0;
                        
                }
            }
            else 
            {         
                $temp->iststandard = $milestone->iststandard;   
            }
            $temparray = array_merge($temparray, array($temp));
        }            

        $milestones = $temparray;

        $view->milestones = $milestones;
    }

    /*
    *   Funktion zum speichern von Neuem Projekt
    *   @param $select ob das Projekt ausgewählt und angeseigt werden soll
    */
    public function speichernAction($select)
    {
        //Übertragenen Formulardaten auslesen
        $data = $this->request->getPost();
        //falls keine deadline gesetzt ist den schlüssel entfernen
        if($data['deadline'] == "")
        {
            unset($data['deadline']);
        }
        $pid = $this->session->get('projektid');
        if($pid == -1)
        {
            // Leeres Projekt anlegen
            $projekt = new Projekte();
        }
        else 
        {
            $projekt = Projekte::findFirstByid($pid);
        }
        //formulardaten in DB speichern
        $projekt->save($data);
        //milestones extrahiern 
        $milestones = Helper::preg_grep_keys("/^(milestone)(\d+)/" , $data);
        foreach ($milestones as $milestone) 
        {
            //wenn milestone ausgewählt
            if(array_key_exists('milestone_id', $milestone))
            {
                //nicht gesezte werte entfernen
                if($milestone['start_geplant'] == "")
                    unset($milestone['start_geplant']);
                if($milestone['ende_geplant'] == "")
                    unset($milestone['ende_geplant']);
                //projekt id anhängen
                $milestone['projekt_id'] = $projekt->id;
                //verknüpfung milestone und projekt
                $ms = new ProjektMilestones();
                //daten speichern
                $ms->save($milestone);
            }
        }
        
        if($pid == -1)
        {
            //leere Webpage erstellen
            $page = new Webpages();
            //standard webpage status aus db auslesen
            $status = Webpagestatus::findFirst([ 'conditions' => 'iststandard = TRUE']);

            //neue webpage in db anlegen
            $page->save(
                [
                    'titel' => 'index',
                    'status_id' => $status->id,
                    'projekt_id' => $projekt->id
                ]
                );  
        }
        //wenn das neue projekt nicht ausgewählt werden soll
        if($select == 'false')
        {
            //weiterleiten zum anzeigen der projekt übersicht
            $this->dispatcher->forward(
                [
                    'controller' => 'Projekte',
                    'action'=> 'index'
                ]);
        }
        //wenn ausgewählt werden soll
        else 
        {
            //serveritiges speichern der projekt id
            $this->session->set('projektid', $projekt->id);
            //weiterleiten zu projekt infos
            $this->dispatcher->forward(
                [
                    'controller' => 'Projekte',
                    'action'=> 'info',
                    'params' => $projekt->id
                ]);
        }
    }

    /*
    *   Funktion zum anzeigen von Projektinformationen
    *   @param id In DB gespeicherte ID des Projektes
    *   @return Inhalt von Projekt/info.volt
    */
    public function infoAction($id = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //setzen serverseitg gespeicherter projekt id
        $this->session->set('projektid', $id);    
        //projektdaten aus db laden   
        $projekt = Projekte::findFirstByid($id); 
        //projektdaten an Ansicht übergeben
        $view->projekt = $projekt;
        //milestone und milestone_projekt tabllen kombinieren und an ansciht übergeben
        $view->milestones = $this->modelsManager->createBuilder()->from('Milestones')->join('ProjektMilestones')->columns(['id','bezeichnung', 'start', 'start_geplant', 'ende', 'ende_geplant'])->where('projekt_id = ' . $id)->orderBy('start,start_geplant,ende, ende_geplant')->getQuery()->execute();        
        //AUftraggeber des Projektes an Ansicht übertragen
        $view->kunde = Auftraggeber::findFirstByid($projekt->auftraggeber_id);
    }

    /*
    *   Funktion zum Anzeigen der Struktur, der zum Projekt zugehörigen Website
    *   @param $id In DB gespeicherte ID des Projektes
    *   @return Inhalt von Projekte/struktur.volt
    */
    public function strukturAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
    }
    
    public function strukturansichtAction()
    {
        $this->SetLayoutRender();
        //serverseitig gespeicherte id auslesen
        $id = $this->session->get('projektid');
        
        //wurzelverzeichnis aus db auslesen
        $rootpage = Webpages::findFirst(['conditions' => 'projekt_id = ' . $id . ' and parent_id is null' ]);

        //erstellen leeer webpage für ansischt
        $webpage = new Webpage();
        //setzen der Attribute der Webpage
        $webpage->id = $rootpage->id;
        $webpage->projektid = $id;
        $webpage->titel = $rootpage->titel;
        //verzeichnis struktur aufbauen
        $webpage->fillChildren();
        //webpage an ANsicht übergeben
        $this->view->page = $webpage; 
    }
}

