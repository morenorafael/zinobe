<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Request\RegisterRequest;
use App\Services\Auth;
use App\Services\Session;
use App\Services\View;
use Respect\Validation\Exceptions\NestedValidationException;
use Zend\Diactoros\ServerRequest;

class RegisterController extends BaseController
{
    /**
     * @var RegisterRequest
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

    public function __construct(View $view, RegisterRequest $validator, Session $session, Auth $auth)
    {
        parent::__construct($view);
        $this->validator = $validator;
        $this->session = $session;
        $this->auth = $auth;
    }

    public function showFormRegister()
    {
        return $this->view->render('auth/register');
    }

    /**
     * @param ServerRequest $request
     */
    public function register(ServerRequest $request)
    {
        try {

            $data = $request->getParsedBody();
            $firstName = $data['first_name'];
            $lastName = $data['last_name'];
            $document = $data['document'];
            $country = $data['country'];
            $email = $data['email'];
            $password = sha1($data['password']);

            $this->validator->validate();

            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'document' => $document,
                'country' => $country,
                'email' => $email,
                'password' => sha1($password),
            ]);

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
}