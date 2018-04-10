<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use DB;

class AdminUsersController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('access:admin_users_create')->only(['store','create']);
        $this->middleware('access:admin_users_read')->only(['index','show']);
        $this->middleware('access:admin_users_update')->only(['update','edit']);
        $this->middleware('access:admin_users_delete')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_users_items = User::all();
        return view('admin_users.index', ['admin_users_items' =>$admin_users_items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
     	return view('admin_users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input= $request->only(['name' ,'email' ,'permisos']);


        $rules= [

            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|max:255',
            'permisos'=> 'required|array',
            'permisos.*' => 'required|exists:permissions,name',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        $user = User::Create([
            'name'=>$input['name'],
            'email'=>$input['email'],
            'password'=>bcrypt('123456')
        ]);

        $permisos= $request->input('permisos');
        
        $user->givePermissionTo($permisos);

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_created');;

        return redirect('admin_users')->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$admin_users_item= User::find($id);
    	return view('admin_users.show', ['admin_users_item' =>$admin_users_item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    	$admin_users= User::find($id);

    	if (! $request->old()) {
            $input=$admin_users->toArray();

            $permisos=$admin_users->permissions->map(function ($item, $key) {
                return $item->name;
            });

            $input['permisos']= $permisos?$permisos->toArray():[];
            $request->replace($input);        
            $request->flash();
        }

    	return view('admin_users.edit', ['admin_users' =>$admin_users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input= $request->only(['name' ,'email' ,'permisos']);

        $rules= [

            'name'=> 'required|string',
            'email'=> 'required|email',
            'permisos'=> 'required|array',
            
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()
                         ->withErrors($validator->errors());
        }

        $admin_users_item= User::find($id);

    	$admin_users_item->fill($input)->save();

        $count= DB::table('permission_user')->where('user_id', '=', $admin_users_item->id)->delete();

        $permisos= $request->input('permisos');
        $admin_users_item->givePermissionTo($permisos);

    	$alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_updated');;

        return redirect('admin_users')->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$admin_users_item= User::find($id);
    	$admin_users_item->delete();

        $alert=[];
        $alert['status']= 'success';
        $alert['message']= trans('message.successfully_deleted');

        return redirect('admin_users')->with('alert', $alert);
    }
}
