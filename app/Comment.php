<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';

    protected $primaryKey = 'id';

    protected $fillable = ['content', 'userid', 'articleid','parent'];



}
