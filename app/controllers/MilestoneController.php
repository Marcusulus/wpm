<?php

class MilestoneController extends ControllerBase
{

    public function infoAction($id = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        $this->session->set('milestoneid',$id );
        if($id <= -1)
        {
            $view->milestone = new Milestones();
            $view->milestone->id = -1;
        }
        else {
            //milestone an ansicht übergeben
            $view->milestone = Milestones::findFirstByid($id) ;  
        }
        
    }

    /*
    *   Funktion zum Speichern von Änderungen an Milestones
    *   @param $action Gibt an welche art der Änderung es sich Handelt
    *                   Delete <=> löschen
    *                   save <=> speichern
    */
    public function editAction($action)
    {
        //auslesen der übertragenen formuölardaten
        $post = $this->request->getPost();
        $id = $this->session->get('milestoneid');

        //Kovertieren des übergeben form wertes in integer
        if(array_key_exists('iststandard', $post))
        {
            $post['iststandard'] = 1;
        }
        else {
            $post['iststandard'] = 0;
        }
        //wenn gespeichter werden soll
        if($action == 'save')
        {
            //wenn vorhandener status
            if($id > -1)
            {
                //Statusdaten aus db auslesen
                $status = MileStones::findFirstByid($id);
            }
            //Wenn neuer status
            else
            {
                //id aus entfernen damit sie von DB gesetzt werdn kann
                unset($post['id']);
                //leeren Status erstellen
                $status = new MileStones();
            }
            //formulardaten in db speichern
            $status->save($post);
        }
        //wenn gelöscht werden soll
        else if($action == 'Delete')
        {
            //satusdaten aus db auslesen
            $status = MileStones::findFirstByid($id);
            //statuslöschen
            $status->delete();
        }                   
    }

    /*
    *   Funktion zum Anzeigen einer liste von Liste
    *   @return Inhalt von Milestone/liste.volt
    */
    public function listeAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //milestone liste aus DB an Ansicht übertragen
        $view->milestones = Milestones::find();
    }

    public function startAction($id)
    {
        $pid = $this->session->get('projektid');

        $msproj = ProjektMilestones::findFirst([ 'conditions' => ' projekt_id = ' . $pid . ' and milestone_id = ' . $id ]);

        $msproj->save([ 'start' => date('Y-m-d') ]);

        $this->dispatcher->forward(
            [
                'controller' => 'Projekte',
                'action' => 'info',
                'params' => [$pid]
            ]);
    }

    public function stopAction($id)
    {
        $pid = $this->session->get('projektid');

        $msproj = ProjektMilestones::findFirst([ 'conditions' => ' projekt_id = ' . $pid . ' and milestone_id = ' . $id ]);
        
        $msproj->save([ 'ende' => date('Y-m-d') ]);

        $this->dispatcher->forward(
            [
                'controller' => 'Projekte',
                'action' => 'info',
                'params' => [$pid]
            ]);
    }

}

