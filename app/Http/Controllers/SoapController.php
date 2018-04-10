<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\MySoapServer;

class SoapController extends Controller
{
    public function wsdl(){
        return response()->file(app_path('Http/Controllers/wsdl.xml'));
    }

    public function soap() {
        $server = new \SoapServer(app_path('Http/Controllers/wsdl.xml')/*null, array('uri' => "http://localhost/profiles/action")*/);
        $server->setClass('App\MySoapServer');
        //$server->addFunction(['list', 'check']);

        $response = response('');
        $response->header("Content-Type","text/xml; charset=utf-8");
        //$response->setContent('test');
        ob_start();
        $server->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }

}


