<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    use HasFactory;
    public $table ='user_admin';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = false;
}
