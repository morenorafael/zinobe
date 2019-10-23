<?php

namespace App\Http\Controllers;

use App\Services\View;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController
{
    /**
     * @var View
     */
    protected $view;

    /**
     * BaseController constructor.
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }
}