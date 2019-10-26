<?php

namespace App\Http\Request;

use App\Services\Contracts\Request as ContractRequest;
use App\Services\Request;
use Respect\Validation\Validator;

class RegisterRequest extends Request implements ContractRequest
{
    /**
     * @var array
     */
    protected $mesasges = [];

    /**
     *
     */
    public function rules()
    {
        $this->validator->key('first_name', Validator::alpha())
            ->key('last_name', Validator::alpha())
            ->key('document', Validator::alpha())
            ->key('country', Validator::alpha())
            ->key('email', Validator::email())
            ->key('password', Validator::length(6))
            ->key('password_confirmation', Validator::equals($_POST['password']));
    }

    public function mesasges()
    {
        $this->mesasges = [
            'email' => 'El correo no es válido.',
            'length' => 'La contraseña debe tener minimo 6 caracteres.',
            'equals' => 'Las contraseñas no coinciden.',
        ];
    }
}