<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasGroups extends Model
{
    use HasFactory;

    protected $table = "user_has_groups";
    protected $fillable = ["user_id" , "group_id"];
}
