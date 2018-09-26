<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    
    protected $table = 'tblemployee';
    protected $primaryKey = "ID";
    public $timestamps = false;
    protected $guarded = [];
}
