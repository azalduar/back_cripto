<?php

namespace App\Lib;

class AjaxResponse
{
    static function success($data){

        return response()->json([
            'data' => $data
        ]);
    }

    static function fail($message= 'Access to resource failed', $errors= null, $status=400){
        $response_data = [
            'message'=> $message
        ];

        if ($errors) { $response_data['errors']= $errors; }

        return response()->json($response_data, $status);
    }
}
