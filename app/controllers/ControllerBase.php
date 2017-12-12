<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class ControllerBase extends Controller
{
    protected function SetLayoutRender()
    {
        $this->view->setRenderLevel(
            View::LEVEL_LAYOUT
        );
    }
}
