<?php
namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use App\Lib\AjaxResponse;
use Validator;

class GameController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    /*
    public function __construct()
    {
        $this->middleware('access:game_create')->only(['store','create']);
        $this->middleware('access:game_read')->only(['index','show']);
        $this->middleware('access:game_update')->only(['update','edit']);
        $this->middleware('access:game_delete')->only(['delete']);
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::with(['rating', 'platforms','tags','categories', 'users'])->get();
        return AjaxResponse::success($games);
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
        $input = $request->only(['name', 'image', 'rating_id','tags_id']);
        #dd($request->tags_id);
        $rules = [

            'name' => 'required|unique:games,name|string|max:255',
            'image' => 'required|max:255|url',
            'rating_id' => 'required|exists:ratings,id',
            'tags_id'=> 'exists:tags,id',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }

        $game = Game::create($input);

        $game->tags()->sync($request->tags_id);

        return AjaxResponse::success($game);
    }

     /**
     * Display the specified resource.
     *
     * @param    \App\Game $game
     * @return  \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return AjaxResponse::success($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Game $game
     * @return  \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
    	//
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
        $input= $request->only(['name', 'image', 'rating_id', 'tag_id']);

        $rules= [

            'name'=> 'required|unique:games,name|string|max:255',
            'image'=> 'required|max:255|url',
            'rating_id'=> 'required|exists:ratings,id',
            'tags_id'=> 'exists:tags,id',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }


    	$game->fill($input)->save();

      $game ->tags()->sync($request->tags_id);

        return AjaxResponse::success($game);
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
        return AjaxResponse::success($game);
    }


    
}
