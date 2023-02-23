<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "comment",
        'email_verified_at',
        "created_at",
        "updated_at"];

 

}
