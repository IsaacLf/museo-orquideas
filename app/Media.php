<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use Notifiable;
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'media';
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'imageType'
    ];
}