<?php

namespace App\Services;

use Respect\Validation\Validator;

class Request
{
    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $mesasges = [];

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;

        $this->rules();
        $this->mesasges();
    }

    /**
     *
     */
    public function rules()
    {
        //
    }

    /**
     *
     */
    public function mesasges()
    {
        //
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->mesasges;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        return $this->validator->assert($_POST);
    }
}