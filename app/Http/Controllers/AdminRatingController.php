<?php
namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Validator;


class AdminRatingController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('access:ratings_create')->only(['store','create']);
        $this->middleware('access:ratings_read')->only(['index','show']);
        $this->middleware('access:ratings_update')->only(['update','edit']);
        $this->middleware('access:ratings_delete')->only(['delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = Rating::all();
        return view('ratings.index', [ 'ratings' => $ratings ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
     	return view('ratings.create');
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

            'name' => 'required|unique:ratings,name|string|max:191',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        $rating = Rating::create($input);

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_created');

        return redirect('ratings')->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param    \App\Rating $rating
     * @return  \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
    	return view('ratings.show', [ 'rating' => $rating ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Rating $rating
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Rating $rating)
    {

    	if (! $request->old()) {
            $request->replace($rating->toArray());        
            $request->flash();
        }

    	return view('ratings.edit', [ 'rating' => $rating ]);
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

            'name'=> 'required|unique:ratings,name|string|max:191',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

    	$rating->fill($input)->save();

    	$alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_updated');;

        return redirect('ratings')->with('alert', $alert);
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

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_deleted');

        return redirect('ratings')->with('alert', $alert);
    }
}
