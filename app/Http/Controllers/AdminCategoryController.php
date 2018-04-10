<?php
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;


class AdminCategoryController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('access:categories_create')->only(['store','create']);
        $this->middleware('access:categories_read')->only(['index','show']);
        $this->middleware('access:categories_update')->only(['update','edit']);
        $this->middleware('access:categories_delete')->only(['delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', [ 'categories' => $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
     	return view('categories.create');
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

            'name' => 'required|unique:categories,name|string|max:199',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        $category = Category::create($input);

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_created');

        return redirect('categories')->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param    \App\Category $category
     * @return  \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    	return view('categories.show', [ 'category' => $category ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Category $category
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {

    	if (! $request->old()) {
            $request->replace($category->toArray());        
            $request->flash();
        }

    	return view('categories.edit', [ 'category' => $category ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    \App\Category $category
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input= $request->only(['name']);

        $rules= [

            'name'=> 'required|unique:categories,name|string|max:199',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

    	$category->fill($input)->save();

    	$alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_updated');;

        return redirect('categories')->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    \App\Category $category
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
    	$category->delete();

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_deleted');

        return redirect('categories')->with('alert', $alert);
    }
}
