<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	protected $table = "users";
    protected $fillable=['ID','login','name_last','name_first'];
    use HasFactory;
}
