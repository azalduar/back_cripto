<?php

namespace App\Http\Controllers;

use App\User;
use App\Game;
use Illuminate\Http\Request;
use App\Notifications\AccountActivation;
use App\Lib\AjaxResponse;
use Validator;

class UserController extends Controller
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

    public function index(Request $request)
    {
        #$tags = Tag::all();
        $users = User::search($request->name)->orderBy('name', 'asc')->get();
        return AjaxResponse::success($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['name','nickname', 'email', 'password', 'avatar']);

        $rules= [
            'name' => 'required|string|max:191',
            'nickname' => 'required|string|max:191|unique:users',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'avatar' => 'nullable|max:191|url'
        ];

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422);
        }        

        $input['password'] = bcrypt($input['password']);
        $input['activation_code'] = str_random(25);

        //creacion de usuario
        $user = User::create($input);
        //generar token de acceso inmediato
        $user['access_token'] =  $user->createToken('register')->accessToken;

        //$user->notify(new AccountActivation());

        return AjaxResponse::success($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return AjaxResponse::success($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules= [
            'name' => 'string|max:191',
            'nickname' => 'string|max:191|unique:users,id,'.$user->id,
            'email' => 'string|email|max:191|unique:users,id,'.$user->id
        ];

        $input = $request->all();

        $validator= Validator::make($input, $rules);

        if ($validator->fails()) {
            $validator_errors= $validator->errors();
            return AjaxResponse::fail('validator erros', compact('validator_errors'), 422);
        }

        $user->fill($input)->save();

        return AjaxResponse::success($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return AjaxResponse::success($user);
    }

    public function befriend(Request $request, User $user)
    {
        return AjaxResponse::success($request->user()->befriend($user));
    }

    public function acceptFriendRequest(Request $request, User $user)
    {
        return AjaxResponse::success($request->user()->acceptFriendRequest($user));
    }

    public function denyFriendRequest(Request $request, User $user)
    {
        return AjaxResponse::success($request->user()->denyFriendRequest($user));
    }

    public function unfriend(Request $request, User $user)
    {
        return AjaxResponse::success($request->user()->unfriend($user));
    }

    public function blockFriend(Request $request, User $user)
    {
        return AjaxResponse::success($request->user()->blockFriend($user));  
    }

    public function unblockFriend(Request $request, User $user)
    {
        return AjaxResponse::success($request->user()->unblockFriend($user));  
    }    

    public function friends(Request $request)
    {
        $friends= $request->user()->getFriends();
        $friends= $friends->sortBy('name')->values()->all();
        foreach ($friends as $friend) {
            $friend->games;
        }
        return AjaxResponse::success($friends);
    }

    public function friendsById(Request $request, User $user)
    {
        $friends= $user->getFriends();
        $friends= $friends->sortBy('name')->values()->all();
        /*foreach ($friends as $friend) {
            $friend->games;
        }*/
        return response($friends,200)->header('Content-Type', 'soap+xml');
        //return AjaxResponse::success($friends);
    }

    public function getFriend(Request $request, User $user)
    {
        if ($request->user()->isFriendWith($user)) {
            $user->games;
            return AjaxResponse::success($user);    
        }
        return AjaxResponse::fail('You do not have access to view this profile',null, 403);
        
    }

    public function getAcceptFriendships(Request $request)
    {
        return AjaxResponse::success($request->user()->getAcceptedFriendships());
    }


    public function addGame(Request $request, Game $game)
    {
        $user = $request->user();
        $user->games()->syncWithoutDetaching([$game->id]);
        return AjaxResponse::success($user->games);
    }

    public function removeGame(Request $request, Game $game)
    {
        $user = $request->user();
        $user->games()->detach($game->id);
        return AjaxResponse::success($user->games);
    }

    public function activateAccount(User $user, $code=null)
    {
        if ($user->is_activated) {
            return 'El usuario ya esta activo';
        }

        if ($user->activation_code != $code) {
            return 'El codigo de activacion no es valido';
        }

        $user->is_activated= true;
        $user->activation_code= null;

        $user->save();
        return 'Gracias por activar tu cuenta, ya puedes empezar!!!';
    }

    public function posiblesAmigos(Request $request)
    {
        /*print_r($request->user()->toArray());
        die();*/
        $friends= $request->user()->getAllFriendships()->toArray();
        $friends_sender= array_pluck($friends, 'sender_id');
        $friends_recipient= array_pluck($friends, 'recipient_id');
        $admins = User::role('admin')->get()->pluck('id')->toArray();
        $respuesta= User::whereNotIn('id', array_merge($admins,$friends_sender,$friends_recipient, [$request->user()->id]))
                ->orderBy('name', 'asc')
                ->with(['games'])
                ->get();

        return AjaxResponse::success($respuesta);
    }

    public function solicitudes(Request $request){
        $solicitudes= $request->user()->getPendingFriendships()->toArray();
        $friends_sender= array_pluck($solicitudes, 'sender_id');
        $respuesta= User::whereIn('id', $friends_sender)->whereNotIn('id', [$request->user()->id])
                ->orderBy('name', 'asc')
                ->get();
        return AjaxResponse::success($respuesta); 
        //print_r($solicitudes);
    }

}
