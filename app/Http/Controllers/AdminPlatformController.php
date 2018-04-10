<?php
namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;
use Validator;


class AdminPlatformController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('access:platforms_create')->only(['store','create']);
        $this->middleware('access:platforms_read')->only(['index','show']);
        $this->middleware('access:platforms_update')->only(['update','edit']);
        $this->middleware('access:platforms_delete')->only(['delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $platforms = Platform::all();
        return view('platforms.index', [ 'platforms' => $platforms ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
     	return view('platforms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['name', 'logo']);

        $rules = [

            'name' => 'required|unique:platforms,name|string|max:191',
            'logo' => 'required|string',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        $platform = Platform::create($input);

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_created');

        return redirect('platforms')->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param    \App\Platform $platform
     * @return  \Illuminate\Http\Response
     */
    public function show(Platform $platform)
    {
    	return view('platforms.show', [ 'platform' => $platform ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Platform $platform
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Platform $platform)
    {

    	if (! $request->old()) {
            $request->replace($platform->toArray());        
            $request->flash();
        }

    	return view('platforms.edit', [ 'platform' => $platform ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    \App\Platform $platform
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Platform $platform)
    {
        $input= $request->only(['name', 'logo']);

        $rules= [

            'name'=> 'required|unique:platforms,name,'.$platform->id.'|string|max:191',
            'logo'=> 'required|string',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

    	$platform->fill($input)->save();

    	$alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_updated');;

        return redirect('platforms')->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    \App\Platform $platform
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Platform $platform)
    {
    	$platform->delete();

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_deleted');

        return redirect('platforms')->with('alert', $alert);
    }
}
