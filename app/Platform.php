<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;


class Platform extends Model
{
    protected $table = 'platforms';
    protected $fillable= ['name', 'logo'];
    protected $hidden = ['pivot'];

    public function setLogoAttribute($value)
    {
        if (! starts_with($value, 'http') ) {

            $data = explode(',', $value);
            do {

                $name = str_random(20);  

            } while ( Storage::exists('/images/'.$name) );
            
            Storage::put('/images/'.$name, base64_decode($data[1]));
            $value= url('local-img/').'/'.$name;
        }
        
        $this->attributes['logo'] = $value;
    }
            
    public function games()
    {
        return $this->belongsToMany('App\Game', 'game_platform', 'platform_id', 'game_id');
    }
            
}