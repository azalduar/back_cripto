<?php echo "<?php"; ?>

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class {!! $model['name'] !!} extends Model
{
    // use SoftDeletes;
    
    protected $table = '{!! $model['table'] !!}';
    protected $fillable= {!! $model['fillable'] !!};
    protected $hidden = ['id', 'created_at', 'updated_at' {{--,  'deleted_at' --}}];
    @if($model['cast'])
    protected $casts = {!! $model['cast'] !!};
    @endif
    @if($model['relationships'])
    @foreach($model['relationships'] as $relationship)

    public function {!!$relationship['name']!!}()
    {
        return $this->{!!$relationship['type']!!}({!!$relationship['args']!!});
    }
    @endforeach
    @endif
    
}