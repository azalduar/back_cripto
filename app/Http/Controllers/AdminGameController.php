<?php
namespace App\Http\Controllers;

use App\Game;
use App\Category;
use App\Platform;
use App\Rating;
use Illuminate\Http\Request;
use Validator;


class AdminGameController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('access:games_create')->only(['store','create']);
        $this->middleware('access:games_read')->only(['index','show']);
        $this->middleware('access:games_update')->only(['update','edit']);
        $this->middleware('access:games_delete')->only(['delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', [ 'games' => $games ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::orderBy('name')->get()->mapWithKeys(function($item){
            return [$item->id => $item->name];
        })->all();

        $platforms= Platform::orderBy('name')->get()->mapWithKeys(function($item){
            return [$item->id => $item->name];
        })->all();

        $ratings= Rating::orderBy('name')->get()->mapWithKeys(function($item){
            return [$item->id => $item->name];
        })->all();

     	return view('games.create', compact(['categories','platforms','ratings']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['name', 'image', 'rating_id', 'categories', 'platforms']);

        /*print_r($input);
        die();*/
        $rules = [

            'name' => 'required|unique:games,name|string|max:191',
            'image' => 'required|string',
            'rating_id' => 'required|exists:ratings,id',
            'categories' => 'required|array',
            'platforms' => 'required|array',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        $game = Game::create($input);
        $game->platforms()->sync($input['platforms']);
        $game->categories()->sync($input['categories']);

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_created');

        return redirect('games')->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param    \App\Game $game
     * @return  \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
    	return view('games.show', [ 'game' => $game ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Game $game
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Game $game)
    {
        $categories= Category::orderBy('name')->get()->mapWithKeys(function($item){
            return [$item->id => $item->name];
        })->all();

        $platforms= Platform::orderBy('name')->get()->mapWithKeys(function($item){
            return [$item->id => $item->name];
        })->all();

        $ratings= Rating::orderBy('name')->get()->mapWithKeys(function($item){
            return [$item->id => $item->name];
        })->all();

    	if (! $request->old()) {
            
            $game['categories']= $game->categories()->orderBy('name')->get()->map(function($item){
                return $item->id;
            })->all();

            $game['platforms']= $game->platforms()->orderBy('name')->get()->map(function($item){
                return $item->id;
            })->all();

            $request->replace($game->toArray());        
            $request->flash();
        }

    	return view('games.edit', compact(['categories','platforms','ratings', 'game']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    \App\Game $game
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $input= $request->only(['name', 'image', 'rating_id', 'categories', 'platforms']);

        $rules= [

            'name'=> 'required|unique:games,name,'.$game->id.'|string|max:191',
            'image'=> 'required|string',
            'rating_id'=> 'required|exists:ratings,id',
            'categories'=> 'required|array',
            'platforms'=> 'required|array',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

    	$game->fill($input)->save();
        $game->platforms()->sync($input['platforms']);
        $game->categories()->sync($input['categories']);
        
    	$alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_updated');;

        return redirect('games')->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    \App\Game $game
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
    	$game->delete();

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_deleted');

        return redirect('games')->with('alert', $alert);
    }
}
