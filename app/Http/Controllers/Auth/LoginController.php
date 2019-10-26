<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Request\LoginRequest;
use App\Models\User;
use App\Services\Auth;
use App\Services\Session;
use App\Services\View;
use Respect\Validation\Exceptions\NestedValidationException;
use Zend\Diactoros\ServerRequest;

class LoginController extends BaseController
{
    /**
     * @var LoginRequest
     */
    protected $validator;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Auth
     */
    private $auth;

    public function __construct(View $view, LoginRequest $validator, Session $session, Auth $auth)
    {
        parent::__construct($view);
        $this->validator = $validator;
        $this->session = $session;
        $this->auth = $auth;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showFormLogin()
    {
        return $this->view->render('auth/login');
    }

    public function login(ServerRequest $request)
    {
        try {

            $data = $request->getParsedBody();
            $email = $data['email'];
            $password = sha1($data['password']);

            $this->validator->validate();

            $user = User::where(['email' => $email, 'password' => $password])->first();

            if (!is_null($user)) {
                $this->auth->generateUserSession($user);

                redirect('/');
            }

        } catch (NestedValidationException $exception) {
            $errors = $exception->findMessages($this->validator->getMessages());

            if ($errors) {
                $arrayErrors = [];

                foreach ($errors as $error) {
                    if ($error) {
                        $arrayErrors[] = $error;
                    }
                }

                $this->session->setFlash('errors', join('<br>', $arrayErrors));

                return redirect('login');
            }
        }
    }

    /**
     *
     */
    public function logout()
    {
        if ($this->auth->destroyUserSession()) {
            redirect('login');
        }

    }
}