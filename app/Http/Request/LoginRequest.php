<?php

namespace App\Http\Request;

use App\Services\Contracts\Request as ContractRequest;
use App\Services\Request;
use Respect\Validation\Validator;

class LoginRequest extends Request implements ContractRequest
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
        $this->validator->key('email', Validator::email())
            ->key('password', Validator::length(6));
    }

    public function mesasges()
    {
        $this->mesasges = [
            'email' => 'El correo no es válido.',
            'length' => 'El password debe tener minimo 6 caracteres.'
        ];
    }
}