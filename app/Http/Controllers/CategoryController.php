<?php
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Lib\AjaxResponse;
use Validator;

class CategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    /*
    public function __construct()
    {
        $this->middleware('access:category_create')->only(['store','create']);
        $this->middleware('access:category_read')->only(['index','show']);
        $this->middleware('access:category_update')->only(['update','edit']);
        $this->middleware('access:category_delete')->only(['delete']);
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return AjaxResponse::success($categories);
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

            'name' => 'required|unique:categories,name|string|max:255',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422);
        }

        $category = Category::create($input);

        return AjaxResponse::success($category);
    }

     /**
     * Display the specified resource.
     *
     * @param    \App\Category $category
     * @return  \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return AjaxResponse::success($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    \App\Category $category
     * @return  \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
    	//
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

            'name'=> 'required|unique:categories,name|string|max:255',

        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422);
        }

    	$category->fill($input)->save();

        return AjaxResponse::success($category);
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
        return AjaxResponse::success($category);
    }
    public function games (Category $category)
    {
    
      return AjaxResponse::success($category->games()->with('users')->get());
     }
}
