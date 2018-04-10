<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Game extends Model
{

    protected $table = 'games';
    protected $fillable= ['name', 'image', 'rating_id'];
    protected $hidden = ['pivot'];
    
    public function setImageAttribute($value)
    {
        if (! starts_with($value, 'http') ) {

            $data = explode(',', $value);
            do {

                $name = str_random(20);  

            } while ( Storage::exists('/images/'.$name) );
            
            Storage::put('/images/'.$name, base64_decode($data[1]));
            $value= url('local-img/').'/'.$name;
        }
        
        $this->attributes['image'] = $value;
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_game', 'game_id', 'category_id');
    }

    public function platforms()
    {
        return $this->belongsToMany('App\Platform', 'game_platform', 'game_id', 'platform_id');
    }

    public function rating()
    {
        return $this->belongsTo('App\Rating', 'rating_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'game_user', 'game_id', 'user_id');
    }

}
