<?php

namespace App\Http\Controllers;

use App\Services\View;

class HomeController extends BaseController
{
    public function __construct(View $view)
    {
        parent::__construct($view);
    }

    /**
     *
     */
    public function index($request, $response)
    {
        return $this->view->render('welcome');
    }
}