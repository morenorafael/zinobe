<?php

namespace App\Http\Controllers;

use App\Models\User;
use Zend\Diactoros\ServerRequest;

class HomeController extends BaseController
{
    /**
     * @param ServerRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(ServerRequest $request)
    {
        $users = [];

        if (isset($request->getQueryParams()['search'])) {
            $users = User::where('first_name', 'LIKE', "%{$_GET['search']}%")
                ->orWhere('email', 'LIKE', "%{$_GET['search']}%")
                ->get();
        } else {
            $users = User::all();
        }


        return $this->view->render('welcome', compact('users'));
    }
}