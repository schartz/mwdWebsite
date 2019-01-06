<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    /**
     * Fields that will be filled by the user
     * @var array
     */
    protected $fillable = [
        'title', 'body'
    ];


    /**
     * Name of the table in the database
     * @var string
     */
    protected $table = 'tuts';
}
