<?php
namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;
use App\Lib\AjaxResponse;
use Validator;

class PlatformController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    /*
    public function __construct()
    {
        $this->middleware('access:platform_create')->only(['store','create']);
        $this->middleware('access:platform_read')->only(['index','show']);
        $this->middleware('access:platform_update')->only(['update','edit']);
        $this->middleware('access:platform_delete')->only(['delete']);
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $platforms = Platform::all();
        return AjaxResponse::success($platforms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            'name' => 'required|unique:platforms,name|string|max:255',
            'logo' => 'required|max:255|url',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }

        $platform = Platform::create($input);

        return AjaxResponse::success($platform);
    }

     /**
     * Display the specified resource.
     *
     * @param    \App\Platform $platform
     * @return  \Illuminate\Http\Response
     */
    public function show(Platform $platform)
    {
        return AjaxResponse::success($platform);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Platform $platform
     * @return  \Illuminate\Http\Response
     */
    public function edit(Platform $platform)
    {
    	//
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

            'name'=> 'required|unique:platforms,name|string|max:255',
            'logo'=> 'required|max:255|url',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }

    	$platform->fill($input)->save();

        return AjaxResponse::success($platform);
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
        return AjaxResponse::success($platform);
    }
    public function games (Platform $platform)
    {
      return AjaxResponse::success($platform->games()->with('users')->get());
    }

}
