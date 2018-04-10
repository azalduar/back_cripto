<?php 
namespace App;
use Illuminate\Http\Request;
use App\User;
class MySoapServer
{
  	public function list($user_id)
    {
    	$user = User::find($user_id);
        $friends= $user->getFriends()->sortBy('name')->values()->all();
        $friends_ids=[];

        foreach ($friends as $friend) {
            $friends_ids[]=$friend->id;
        }
        return json_encode($friends_ids);// response($friends,200)->header('Content-Type', 'soap+xml');
        //return AjaxResponse::success($friends);
    }

    public function check($user_id){
    	return User::find($user_id)?true:false;
    }
}
?>