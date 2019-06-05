<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'grade',
        'teacher_name',
        'special_disabilities',
        'guardian_name',
        'guardian_contact',
        'avatar_url',
        'avatar_path'
    ];

}