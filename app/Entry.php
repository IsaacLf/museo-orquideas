<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use Notifiable;
    
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'entries';
    
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'title', 'synonym', 'distribution', 'description','image', 'imageType', 'author'
    ];

    /**
     * Return the a string with name + extension of the image
     * 
     * @return string
     */
    public function getImageName(){
        return $this->image.$this->imageType;
    }
}
