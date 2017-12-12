<?php

Class Webpage 
{
    public $titel;
    public $id;
    public $projektid;
    public $children;

    public function fillChildren()
    {

        $childrenresult = Webpages::find([ 'conditions' => 'projekt_id = ' . $this->projektid . ' and parent_id = '  . $this->id]);

        $this->children = array();
        


        $length = count($childrenresult);
        for($i = 0; $i < $length; $i++)
        {
            $child = new Webpage();

            $child->id = $childrenresult[$i]->id;
            $child->projektid = $this->projektid;
            $child->titel = $childrenresult[$i]->titel;

            $child->fillChildren();
            if($i != 0)
            {
               $this->children = array_merge($this->children, array($child));
            }
            else {
                $this->children = array($child);
            }
        }
        
    }

}