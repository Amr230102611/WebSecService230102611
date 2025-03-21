<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users2 extends Model
{
    public $timestamps = false;

    protected $table = 'users2'; // define table

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];
}