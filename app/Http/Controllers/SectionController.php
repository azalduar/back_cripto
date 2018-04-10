<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;
use Storage;
use App\Section;
use Artisan;

class SectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('access:sections');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types= config('mixedmedia-admin.migration.column_types');
        $components= config('mixedmedia-admin.html_components');
        $relations= config('mixedmedia-admin.model.relationships');

        return view('section.create',['types'=>$types, 'components'=>$components, 'relationships'=>$relations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        
        $input= $request->all();

        foreach ($input['attributes'] as $key => $value) {
            $input['attributes'][$key]['name']= str_slug($value['name'], '_');
        }

        $columns= $input['attributes'];
        $columns_names= array_pluck($columns, 'name');

        $model = [];
        $model['name'] = studly_case( str_slug($input['single_name'], '_') );
        $model['table'] = str_slug($input['plural_name'], '_');
        $model['fillable'] = "['".implode("', '", $columns_names)."']";
        $model['cast'] = [];
        $model['relationships'] = $request->has('relationships')?$input['relationships']:[];
        $model['view'] = view('files.model',['model' =>$model])->render();
        $model['path'] = 'app/'.$model['name'].'.php';
        //$model['flag'] = Storage::disk('root')->put($model['path'], $model['view']);

        $controller = [];
        $controller['model'] = $model['name'];
        $controller['name'] = 'Admin'.$model['name'].'Controller';
        $controller['single_name'] = str_slug($input['single_name'], '_');
        $controller['plural_name'] = str_slug($input['plural_name'], '_');
        $controller['columns'] = $columns;
        $controller['input'] = $model['fillable'];
        $controller['view'] = view('files.controller_web',['controller'=>$controller])->render();
        $controller['path']= 'app/Http/Controllers/'.$controller['name'].'.php';        
        $controller['flag']= Storage::disk('root')->put($controller['path'], $controller['view']);

        $route=[];
        $route['name']= $controller['plural_name'];
        $route['controller']= $controller['name'];
        $route['view']= view('files.routes',['route'=>$route])->render();
        $route['path'] = 'routes/web.php';
        $route['flag']= Storage::disk('root')->append($route['path'], $route['view']);

        $view=[];
        $view['columns']=$columns;
        $view['route']= $model['table'];
        $view['display_name']= title_case($input['plural_name']);
        $view['single_name'] = str_slug($input['single_name'], '_');
        $view['plural_name'] = str_slug($input['plural_name'], '_');
        $view['view_index']= view('files.view_index', ['view'=>$view])->render();
        $view['view_create']= view('files.view_create', ['view'=>$view])->render();
        $view['view_edit']= view('files.view_edit', ['view'=>$view])->render();
        $view['path_index']= 'resources/views/'.$model['table'].'/index.blade.php';
        $view['path_create']= 'resources/views/'.$model['table'].'/create.blade.php';
        $view['path_edit']= 'resources/views/'.$model['table'].'/edit.blade.php';
        $view['flag_index']= Storage::disk('root')->put($view['path_index'], $view['view_index']);
        $view['flag_create']= Storage::disk('root')->put($view['path_create'], $view['view_create']);
        $view['flag_edit']= Storage::disk('root')->put($view['path_edit'], $view['view_edit']);

        /*$migration = [];
        $migration['name'] = 'Create'.studly_case($model['table']).'Table';
        $migration['table'] = $model['table'];
        $migration['columns'] = $columns;
        $migration['view'] = view('files.migration', ['migration' =>$migration] )->render();
        $migration['path'] = 'database/migrations/'.date('Y_m_d_His').'_create_'.$migration['table'].'_table.php';
        $migration['flag'] = Storage::disk('root')->put($migration['path'], $migration['view']);
        
        $permission = Permission::firstOrCreate(['name' => $controller['plural_name'].'_create']);
        $permission = Permission::firstOrCreate(['name' => $controller['plural_name'].'_read']);
        $permission = Permission::firstOrCreate(['name' => $controller['plural_name'].'_update']);
        $permission = Permission::firstOrCreate(['name' => $controller['plural_name'].'_delete']);


        $user= Auth::user();

        $user->givePermissionTo(
            $controller['plural_name'].'_create',
            $controller['plural_name'].'_read',
            $controller['plural_name'].'_update',
            $controller['plural_name'].'_delete'
        );

        $section= Section::firstOrCreate([
            'display_name' => title_case($input['plural_name']),
            'route'=> $controller['plural_name'],
            'icon' => 'glyphicon glyphicon-link',
        ]);

        $exitCode = Artisan::call('migrate');*/
        return 'todo bien';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
