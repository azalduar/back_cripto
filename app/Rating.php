<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{    
    protected $table = 'ratings';
    protected $fillable= ['name'];
    protected $hidden = ['pivot'];
            
    public function games()
    {
        return $this->hasMany('App\Game', 'rating_id', 'id');
    }
            
}