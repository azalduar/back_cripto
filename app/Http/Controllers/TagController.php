<?php
namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Lib\AjaxResponse;
use Validator;

class TagController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    /*
    public function __construct()
    {
        $this->middleware('access:tag_create')->only(['store','create']);
        $this->middleware('access:tag_read')->only(['index','show']);
        $this->middleware('access:tag_update')->only(['update','edit']);
        $this->middleware('access:tag_delete')->only(['delete']);
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        #$tags = Tag::all();
        $tags = Tag::search($request->name)->get();
        return AjaxResponse::success($tags);
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

            'name' => 'required|unique:tags,name|string|max:50|min:3',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }

        $tag = Tag::create($input);

        return AjaxResponse::success($tag);
    }

     /**
     * Display the specified resource.
     *
     * @param    \App\Tag $tag
     * @return  \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return AjaxResponse::success($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Tag $tag
     * @return  \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
    	//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    \App\Tag $tag
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $input= $request->only(['name']);

        $rules= [

            'name'=> 'required|unique:tags,name|string|max:50|min:3',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422 );
        }

    	$tag->fill($input)->save();

        return AjaxResponse::success($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    \App\Tag $tag
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
    	$tag->delete();
        return AjaxResponse::success($tag);
    }

    public function games (Tag $tag)
    { 
      return AjaxResponse::success($tag->games()->with('users')->get());
    }
}
