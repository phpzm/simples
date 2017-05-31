<?php

namespace App\Controller;

use Simples\Controller\ViewController;

/**
 * Class View
 * @package App
 */
class View extends ViewController
{
    /**
     * @return \Simples\Http\Response
     */
    public function home()
    {
        return $this->view('index.php');
    }

    /**
     * @return \Simples\Http\Response
     */
    function __invoke()
    {
        return $this->view('whoops.php');
    }

}