<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'tags';
    protected $fillable= ['name'];
    protected $hidden = ['pivot'];

    public function scopeSearch($query, $name="")
    {
      return $query->where('name', 'LIKE', "%$name%");
    }
    public function games()
    {
        return $this->belongsToMany('App\Game', 'game_tag', 'tag_id', 'game_id');
    }


}
