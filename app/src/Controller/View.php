<?php

namespace App\Controller;

use Simples\Controller\ViewController;
use Simples\Message\Lang;

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
        $data = [
            'title' => Lang::get('error', 'page-not-found')
        ];
        return $this->view('whoops.php', $data);
    }

}