<?php echo "<?php"; ?>

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\{!!$controller['name']!!};

class {!!$controller['name'].'Controller'!!} extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('access:{!!$controller['view']!!}_create')->only(['store','create']);
        $this->middleware('access:{!!$controller['view']!!}_read')->only(['index','show']);
        $this->middleware('access:{!!$controller['view']!!}_update')->only(['update','edit']);
        $this->middleware('access:{!!$controller['view']!!}_delete')->only(['delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ${!!$controller['view'].'_items = '.$controller['name'].'::all();'!!}
        return view('{!!$controller['view']!!}.index', ['{!!$controller['view']!!}_items' =>${!!$controller['view']!!}_items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     	return view({!! "'".$controller['view'].".create'" !!});
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input= $request->only({!!$controller['input']!!});

        $rules= [

            @foreach($controller['columns'] as $column)'{!!$column['name']!!}'=> '{!!$column['validate']!!}',
            @endforeach

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        ${!!$controller['view']!!}= {!!$controller['name']!!}::create($input);

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_created');

        return redirect('{!!$controller['view']!!}')->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	${!!$controller['view']!!}_item= {!!$controller['name']!!}::find($id);
    	return view('{!!$controller['view']!!}.show', ['{!!$controller['view']!!}_item' =>${!!$controller['view']!!}_item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    	${!!$controller['view']!!}= {!!$controller['name']!!}::find($id);

    	if (! $request->old()) {
            $request->replace(${!!$controller['view']!!}->toArray());        
            $request->flash();
        }

    	return view('{!!$controller['view']!!}.edit', ['{!!$controller['view']!!}' =>${!!$controller['view']!!}]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input= $request->only({!!$controller['input']!!});

        $rules= [

            @foreach($controller['columns'] as $column)'{!!$column['name']!!}'=> '{!!$column['validate']!!}',
            @endforeach

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        ${!!$controller['view']!!}_item= {!!$controller['name']!!}::find($id);

    	${!!$controller['view']!!}_item->fill($input)->save();

    	$alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_updated');;

        return redirect('{!!$controller['view']!!}')->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	${!!$controller['view']!!}_item= {!!$controller['name']!!}::find($id);
    	${!!$controller['view']!!}_item->delete();

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_deleted');

        return redirect('{!!$controller['view']!!}')->with('alert', $alert);
    }
}
