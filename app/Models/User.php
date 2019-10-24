<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 * @property-read int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $document
 * @property string $email
 * @property string $country
 * @property string $password
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'document', 'email', 'country', 'password'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}