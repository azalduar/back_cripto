<?php
namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Validator;


class AdminTagController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('access:tags_create')->only(['store','create']);
        $this->middleware('access:tags_read')->only(['index','show']);
        $this->middleware('access:tags_update')->only(['update','edit']);
        $this->middleware('access:tags_delete')->only(['delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', [ 'tags' => $tags ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
     	return view('tags.create');
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
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        $tag = Tag::create($input);

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_created');

        return redirect('tags')->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param    \App\Tag $tag
     * @return  \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
    	return view('tags.show', [ 'tag' => $tag ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Tag $tag
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Tag $tag)
    {

    	if (! $request->old()) {
            $request->replace($tag->toArray());        
            $request->flash();
        }

    	return view('tags.edit', [ 'tag' => $tag ]);
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
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

    	$tag->fill($input)->save();

    	$alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_updated');;

        return redirect('tags')->with('alert', $alert);
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

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_deleted');

        return redirect('tags')->with('alert', $alert);
    }
}
