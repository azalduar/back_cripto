<?php
namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use App\Lib\AjaxResponse;
use Validator;

class RatingController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    /*
    public function __construct()
    {
        $this->middleware('access:rating_create')->only(['store','create']);
        $this->middleware('access:rating_read')->only(['index','show']);
        $this->middleware('access:rating_update')->only(['update','edit']);
        $this->middleware('access:rating_delete')->only(['delete']);
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = Rating::all();
        return AjaxResponse::success($ratings);
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
        $input = $request->only(['name']);

        $rules = [

            'name' => 'required|unique:ratings,name|string|max:255',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }

        $rating = Rating::create($input);

        return AjaxResponse::success($rating);
    }

     /**
     * Display the specified resource.
     *
     * @param    \App\Rating $rating
     * @return  \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        return AjaxResponse::success($rating);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Rating $rating
     * @return  \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
    	//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    \App\Rating $rating
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        $input= $request->only(['name']);

        $rules= [

            'name'=> 'required|unique:ratings,name|string|max:255',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }

    	$rating->fill($input)->save();

        return AjaxResponse::success($rating);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    \App\Rating $rating
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
    	$rating->delete();
        return AjaxResponse::success($rating);
    }
    public function games (Rating $rating)
    {
    
      return AjaxResponse::success($rating->games()->with('users')->get());
     }
}
