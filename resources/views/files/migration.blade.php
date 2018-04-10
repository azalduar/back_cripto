<?php echo "<?php"; ?>

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class {!! $migration['name'] !!} extends Migration
{
    public function up()
    {
        Schema::create('{!! $migration['table'] !!}', function (Blueprint $table) {

            $table->increments('id');

            @foreach($migration['columns'] as $column)$table->{!! $column['type'] !!}('{!! $column['name'] !!}'){!! $column['modifier'] !!};
            @endforeach

            $table->timestamps();
            //$table->softDeletes();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('{!! $migration['table'] !!}');
    }
}
