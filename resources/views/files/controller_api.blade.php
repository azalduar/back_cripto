<?php echo "<?php"; ?>

namespace App\Http\Controllers;

use App\{!!$controller['model']!!};
use Illuminate\Http\Request;
use App\Lib\AjaxResponse;
use Validator;

class {!!$controller['name']!!} extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('access:{!!$controller['plural_name']!!}_create')->only(['store','create']);
        $this->middleware('access:{!!$controller['plural_name']!!}_read')->only(['index','show']);
        $this->middleware('access:{!!$controller['plural_name']!!}_update')->only(['update','edit']);
        $this->middleware('access:{!!$controller['plural_name']!!}_delete')->only(['delete']);
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ${!!$controller['plural_name']!!} = {!!$controller['model']!!}::all();
        return AjaxResponse::success(${!!$controller['plural_name']!!});
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only({!!$controller['input']!!});

        $rules = [

            @foreach($controller['columns'] as $column)'{!!$column['name']!!}' => '{!!$column['validate']!!}',
            @endforeach

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors') );
        }

        ${!!$controller['single_name']!!} = {!!$controller['model']!!}::create($input);

        return AjaxResponse::success(${!!$controller['single_name']!!});
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\{!!$controller['model']!!} ${!!$controller['single_name']!!}
     * @return \Illuminate\Http\Response
     */
    public function show({!!$controller['model']!!} ${!!$controller['single_name']!!})
    {
        return AjaxResponse::success(${!!$controller['single_name']!!});
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\{!!$controller['model']!!} ${!!$controller['single_name']!!}
     * @return \Illuminate\Http\Response
     */
    public function edit({!!$controller['model']!!} ${!!$controller['single_name']!!})
    {
    	//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\{!!$controller['model']!!} ${!!$controller['single_name']!!}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, {!!$controller['model']!!} ${!!$controller['single_name']!!})
    {
        $input= $request->only({!!$controller['input']!!});

        $rules= [

            @foreach($controller['columns'] as $column)'{!!$column['name']!!}'=> '{!!$column['validate']!!}',
            @endforeach

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors') );
        }

    	${!!$controller['single_name']!!}->fill($input)->save();

        return AjaxResponse::success(${!!$controller['single_name']!!});
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\{!!$controller['model']!!} ${!!$controller['single_name']!!}
     * @return \Illuminate\Http\Response
     */
    public function destroy({!!$controller['model']!!} ${!!$controller['single_name']!!})
    {
    	${!!$controller['single_name']!!}->delete();
        return AjaxResponse::success(${!!$controller['single_name']!!});
    }
}
