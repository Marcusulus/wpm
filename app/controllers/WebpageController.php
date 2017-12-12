<?php
use Phalcon\Image\Factory;

/*
*   Controller für Webpage Verwaltung
*/
class WebpageController extends ControllerBase
{

    /*
    *   Funktion zum Anzeigen von Inhalten der Webpage
    *   @param id In DB gespeicherte ID der Webpage
    *   @return Inhalt von Webpage/info.volt
    */
    public function infoAction($id = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        if($id != -1)
        {
            //webpage id von server aulsesn
            $this->session->set('webpageid', $id);
            //webpage aus Db an ansicht übergeben
            $view->webpage = Webpages::findFirstByid($id);         
            //webpageliste an ansicht übegeben
            $view->webpages =  Webpages::findByprojekt_id($this->session->get('projektid'));
            //webpagestatus an anicht
            $view->webpagestatus = Webpagestatus::find();
        }
    }

    /*
    *   Aktualisiert den Satus der Webpage
    */
    public function WebpageStatusUpdateAction()
    {
        //webpage daten aus DB alden
        $webpage = Webpages::findFirstByid($this->session->get('webpageid'));
        //formulardaten ermitteln
        $postdata = $this->request->getPost();
        //webpagedaten aktualisieren
        $webpage->save($postdata);
    }

    /*
    *   Speichert eine neue webpage
    */
    public function neuAction()
    {
        //formulardaten auslesen
        $postdata = $this->request->getPost();
        //nbeue webpage erstellen
        $webpage = new Webpages();
        //postdaten erweitern
        //aktuelle webpage zur übergeordneten der neuen
        $postdata["parent_id"] =$this->session->get('webpageid');
        //standardwebpagestatus ermitteln
        $postdata["status_id"] = Webpagestatus::findFirstByiststandard(1)->id;
        //serverseitig gespeichterte projekltid ermitteln
        $postdata["projekt_id"] =$this->session->get('projektid');
        //daten speichern
        $webpage->save($postdata);
        //id für die weiterlting(s.u.) setzen
        $id = $webpage->id;
        //weiterleiten zur info der Webseite
        $this->dispatcher->forward(
            [ 
                'controller' => 'Webpage',
                'action' => 'info',
                'params' => [$id]
            ]);    
    }

    /*
     * Speichert Änderungen an Webpages
     */
    public function speichernAction()
    {
        //formulardaten auslesen
        $postdata = $this->request->getPost();
        //serverseitg gespeicherte id der weboage ermitteln
        $id = $this->session->get('webpageid');
        //webpage daten aus db ermitteln
        $webpage = Webpages::findFirstByid($id);
        //wurzel webpage ermitteln
        $root = Webpages::findFirst([ 'conditions' => ' parent_id is null']);
        //wenn keine seite übergeordnet sein soll
        if($postdata["parent_id"] == $webpage->id)
        {
            //seite der wurzel seite überordnen
            $root->save(['parent_id' => $webpage->id]);
            //zur wurzel seite machen
            $postdata["parent_id"] = null;
            
        }
        //wenn ursprüngliche root seite einer anderen untergeordnet wird
        else if($root->id == $webpage->id)
        {
            //nächtse seite zur root seite
            $newroot = Webpages::findFirstByparent_id($webpage->id);
            $newroot->save([ 'parent_id' => null ]);
            //alle anderen seiten der neuen root unterordnen
            $pages = Webpages::findFirstByparent_id($webpage->id);
            $pages->save(['parent_id' => $newroot->id]);
        }
        //änderungen speichern
        $webpage->save($postdata);
        //weiterleiten zur info der Webseite
        $this->dispatcher->forward(
            [ 
                'controller' => 'Webpage',
                'action' => 'info',
                'params' => [$id]
            ]);           
    }

    /*
    * Löscht eine Webpage
    */
    public function loeschenAction()
    {
        //webpagedaten aus db ermitteln
        $webpage = Webpages::findFirstByid($this->session->get('webpageid'));
        $id = $webpage->parent_id;
        //wenn root seite
        if($webpage->parent_id == null)
        {
            //nächtse seite zur root seite
            $newroot = Webpages::findFirstByparent_id($webpage->id);
            $newroot->save([ 'parent_id' => null ]);
            //alle anderen seiten der neuen root unterordnen
            $pages = Webpages::findFirstByparent_id($webpage->id);
            //wenn es die anderen seiten gibt
            if($pages != false)
            {
                $pages->save(['parent_id' => $newroot->id]);
            }
            //id druch root ersetzen für die weiterlting
            $id = $newroot->id;
        }
        //seite löschen
        $webpage->delete();
        //weiterleiten zur info der Webseite
        $this->dispatcher->forward(
            [ 
                'controller' => 'Webpage',
                'action' => 'info',
                'params' => [$id]
            ]);
    }

    /*
    *   Funktion zum Hochladen von Bildern
    */
    public function bildHochladenAction()
    {     
        //übertragenen dateien abfragen
        $files = $this->request->getUploadedFiles();
        //verzeichnis für temporäre datei erzeugen
        if( ! is_dir('temp/'. $this->session->get('projektid')))
        {
            mkdir('temp/'. $this->session->get('projektid'));
        }

        foreach ($files as $f ) 
        {
            //dateiname und pfad  ermitteln
            $file = 'temp/'. $this->session->get('projektid') . '/' . $f->getName();
            //datei in tempverzeichnis ablegen
            $f->moveTo($file);
            //optionen für bild adapter setzen
            $options =[ 'file' => $file, 'adapter' => 'gd'];
            //bildadapter initialisieren
            $image = Factory::load($options);
            //hoehe und breite des bildes bestimmen
            $hoehe = $image->getHeight();
            $breite = $image->getWidth();
            //bild ablegen
            $filecontent = file_get_contents($file);
            //standard status ermitteln
            $status = Status::findFirstByiststandard(1);
            //query daten zusammen bauen
            $querydata = ['titel' => $f->getName(), 'dateiname' => $f->getName(), 'daten' => $filecontent, 'status_id' => $status->id, 'hoehe'=> $hoehe, 'breite'=> $breite, 'projekt_id' => $this->session->get('projektid')];
            // neues bild erstellen
            $image = new Bilddateien();
            //daten in Db speichern
            $image->save($querydata);
            //wenn bild einer webpage zugeordnet werden soll
            if($this->session->get('webpageid') != -1)
            {
                //bild webpage verknüpfung erstellen
                $image_page = new WebpageBild();
                //daten in db speichern
                $image_page->save(['webpage_id' => $this->session->get('webpageid'), 'bild_id' => $image->id]);
            }
            //datei löschen
            unlink($file);
        }

        
    }

    /*
    *   Funktion zum Hochladen von TExtdateien
    */
    public function textdateiHochladenAction()
    {    
        //übertragenen dateien abfragen
        $files = $this->request->getUploadedFiles();
        //verzeichnis für temporäre datei erzeugen
        if( ! is_dir('temp/'. $this->session->get('projektid')))
        {
            mkdir('temp/'. $this->session->get('projektid'));
        }
        foreach ($files as $f) 
        {
           //dateiname und pfad  ermitteln
            $file = 'temp/'. $this->session->get('projektid') . '/' . $f->getName();
            //datei in tempverzeichnis ablegen
            $f->moveTo($file);
            //datei in tempverzeichnis ablegen
            $filecontent = file_get_contents($file);
            //standard status ermitteln   
            $status = Status::findFirstByiststandard(1);
            //query daten zusammen bauen
            $querydata = [ 'titel' => $f->getName(), 'dateiname' => $f->getName(), 'daten' => $filecontent, 'status_id' => $status->id, 'projekt_id' => $this->session->get('projektid')];
            // neues testdatei erstellen
            $text = new Textdateien();
            //daten in Db speichern
            $text->save($querydata);
            //wenn bild einer webpage zugeordnet werden soll
            if($this->session->get('webpageid') != -1)
            {
                //bild webpage verknüpfung erstellen
                $text_page = new WebpageTextdaten();
                //daten in db speichern
                $text_page->save(['webpage_id' => $this->session->get('webpageid') , 'text_id' => $text->id]);
            }
            //datei löschen
            unlink($file);
        }
    }

    /*
    *   Funktion zum ändern von Texdatei-Daten
    */
    public function textdateieditAction($action)
    {
        //formulardaten auslesen
        $postdata = $this->request->getPost();
        //wenn gelöscht werden soll
        if($action == 'Delete')
        {
            //verknüpfung mit webpage ermitteln
            $text_page = WebpageTextdaten::findFirstBytext_id($this->session->get('textdateiid'));
            //verknüpfung löschen
            $text_page->delete();
            //textdateidaten in db ermitteln
            $text = Textdateien::findFirstByid($this->session->get('textdateiid'));
            //daten löschen
            $text->delete();
        }
        //wenn aktualisert werden soll
        else if($action == 'update')
        {
            //textdateidatenm aus db ermitteln
            $text = Textdateien::findFirstByid($this->session->get('textdateiid'));
            //daten aktualisieren
            $text->save($postdata);
        }
    }

    /*
    *   Funktion zum ändern von Bild-Daten
    */
    public function bildeditAction($action)
    {
        //formulardaten ermitteln
        $postdata = $this->request->getPost();
        //wenn gelöscht werden soll
        if($action == 'Delete')
        {   
            //verknüpfung zur webpage ermitteln
            $bild_page = WebpageBild::findFirstBybild_id($this->session->get('bildid'));
            //verknüpfung löschen
            $bild_page->delete();
            //bilddaten ermitteln
            $bild = Bilddateien::findFirstByid($this->session->get('bildid'));
            //bilddaten löschen
            $bild->delete();
        }
        //wenn aktualisert werden soll
        else if($action == 'update')
        {
            //bilddaten ermitteln
            $bild = Bilddateien::findFirstByid($this->session->get('bildid'));
            //bilddaten aktualiseren
            $bild->save($postdata);
        }
    }

    /*
    *   Funktion zum ändern von Text-Daten
    */
    public function texteditAction($action)
    {
        //formulardaten ermitteln
        $postdata = $this->request->getPost();
        //wenn gelöscht werden soll
        if($action == 'Delete')
        {
            //verknüpfung mit webpage ermitteln
            $text_page = WebpageText::findFirstBybild_id($this->session->get('textid'));
            //verknüpfung löschen
            $text_page->delete();
            //textdaten ermitteln
            $text = Texte::findFirstByid($this->session->get('textid'));
            //textdaten löschen
            $text->delete();
        }
        //wenn aktualisiert werden soll
        else if($action == 'update')
        {
            //textdaten ermitteln
            $text = Texte::findFirstByid($this->session->get('textid'));
            //textdaten aktualisieren
            $text->save($postdata);
        }
        //wenn neu erstellt werden soll
        else if($action == 'new')
        {
            //statuslsite ermitteln
            $status = Status::findFirstByiststandard(1);
            //neuen texterstellen
            $text = new Texte();
            //textdaten speichern
            $text->save(array_merge($postdata, ['status_id' => $status->id]));
            //neue verknüpfung mit webpage erstellen
            $text_page = new WebpageText();
            //verknüpfung speichern
            $text_page->save([ 'text_id' => $text->id, 'webpage_id' => $this->session->get('webpageid') ]);
        }
    }

    /*
    *   Funktion zum Anzeigen von Bild-Daten
    *   @return Inhalt von Webpage/bild.volt
    */
    public function bildAction($id = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //serverseitig gespeicherte bildid setzen
        $this->session->set('bildid',$id);
        //bilddaten aus db auslesne
        $image = Bilddateien::findFirstByid($id);
        //daten um pfad erweitern
        $image->pfad = 'temp/'. $this->session->get('projektid') . '/' . $image->dateiname;
        //daten an ansciht übergben        
        $view->bild = $image;
        //statuslsite an ansciht übergben
        $view->status = Status::find();
    }

    /*
    *   Funktion zum Anzeigen von Textdatei-Daten
    *   @return Inhalt von Webpage/textdatei.volt
    */
    public function textdateiAction($id = -1)
    {
        $this->SetLayoutRender();
        $view = $this->view;
        //serverseitig gespeicherte bilddateiid setzen
        $this->session->set('textdateiid',$id);
        //textdateidaten aus db auslesne
        $file = Textdateien::findFirstByid($id);
        //daten um pfad erweitern
        $file->pfad = 'temp/'. $this->session->get('projektid') . '/' . $file->dateiname;
        //daten an ansciht übergben 
        $view->datei = $file;
        //statuslsite an ansciht übergben
        $view->status = Status::find();
    }

    /*
    *   Funktion zum Anzeigen von Text-Daten
    *   @return Inhalt von Webpage/texte.volt
    */
    public function texteAction($id = -1)
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //serverseitig gespeicherte bilddateiid setzen
        $this->session->set('textid',$id);
        //textdaten aus db auslesne
        $view->text = Texte::findFirstByid($id);
        //statuslsite an ansciht übergben
        $view->status = Status::find();
    }

    public function bilderlisteAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //serverseitg gespeicherte webpage id ermitteln
        $id = $this->session->get('webpageid');
        //abfragen der webpage zugeordneten bilder
        $image_pages = WebpageBild::findBywebpage_id($id);
        //leeren array für bilder erzeugen
        $images = array();
        //für jedes bild aus db
        foreach ($image_pages as $ip ) 
        {
            //bild daten aus db
            $imagedata = Bilddateien::findFirstByid($ip->bild_id);
            //verzeichnis für temporäre datei erzeugen
            if( ! is_dir('temp/'. $this->session->get('projektid')))
            {
                mkdir('temp/'. $this->session->get('projektid'));
            }
            //datei in verzeichnis ablegen
            file_put_contents('temp/'. $this->session->get('projektid') . '/' . $imagedata->dateiname, $imagedata->daten);
            //pfad in bilddaten setzen
            $imagedata->pfad = 'temp/'. $this->session->get('projektid') . '/' . $imagedata->dateiname;
            //bild dem array hinzufügen
            $images = array_merge($images, array($imagedata));
        }
        //bilder aus array an Ansicht übergeben
        $view->bilder = $images;
    }

    public function textdateilisteAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //serversetig gespeichterte webpage id ermitteln
        $id = $this->session->get('webpageid');
        //abfragen der webpage zugeordneten textdateien
        $textfile_pages = WebpageTextdaten::findBywebpage_id($id);
        //leeres array für textdateien
        $textfiles = array();
        //für jede textdatei aus db
        foreach ($textfile_pages as $tp ) 
        {
            //textdatei daten aus DB
            $textfiledata = Textdateien::findFirstByid($tp->text_id);
            //verzeichnis für temporäre datei erzeugen
            if( ! is_dir('temp/'. $this->session->get('projektid')))
            {
                mkdir('temp/'. $this->session->get('projektid'));
            }
            //datei in verzeichnis ablegen
            file_put_contents('temp/'. $this->session->get('projektid') . '/' . $textfiledata->dateiname, $textfiledata->daten);
             //pfad in textdateidaten setzen
            $textfiledata->pfad = 'temp/'. $this->session->get('projektid') . '/' . $textfiledata->dateiname;
            //textdatei dem array hinzufügen
            $textfiles = array_merge($textfiles, array($textfiledata));
        }
        //textdateidaten aus array an Ansicht übergeben
        $view->dateien = $textfiles;
    }

    public function textlisteAction()
    {
        $this->SetLayoutRender();
        //ansciht bestimmen
        $view = $this->view;
        //serverseritg gespeicherte webpage id ermitteln
        $id = $this->session->get('webpageid');
        //abfragen der webpage zugeordneten texte        
        $texte_pages = WebpageText::findBywebpage_id($id);
        //leeres array für texte
        $texte = array();
        //für jeden text aus db
        foreach ($texte_pages as $tp ) 
        {
            //textdaten aus db auslesen
            $text = Texte::findFirstByid($tp->text_id);
            //textdaten dem array hinzufügen
            $texte = array_merge($texte, array($text));
        }
        //textedaten aus array an Ansicht übergeben
        $view->texte =$texte;
    }
}

