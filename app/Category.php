<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{    
    protected $table = 'categories';
    protected $fillable= ['name'];
    protected $hidden = ['pivot'];
            
    public function games()
    {
        return $this->belongsToMany('App\Game', 'category_game', 'category_id', 'game_id');
    }
            
}