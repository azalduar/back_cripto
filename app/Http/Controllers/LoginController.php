<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Lib\AjaxResponse;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username= $request->input('email');
        $password= $request->input('password');

        $ldaprdn  = 'cn='.$request->input('email').',ou=Games,dc=arqsoft,dc=unal,dc=edu,dc=co';// ldap rdn or dn
		$ldappass = $request->input('password');  // associated password

		// conexión al servidor LDAP
		$ldapconn = ldap_connect("192.168.1.7"/*"192.168.1.7"*/)
		    or die("Could not connect to LDAP server.");
		ldap_set_option ($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3); 

		if ($ldapconn) {

		    // realizando la autenticación
		    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);

		    // verificación del enlace
		    if ($ldapbind) {
		        $http = new Client;
	            $client_secret= '1GzFDeMrNuYhcn0w6avSy0y9A9motj2NrQBmYZgK';

	            $response = $http->post(/*url(*/'192.168.1.5/oauth/token'/*)*/, [
	                'form_params' => [
	                    'grant_type' => 'password',
	                    'client_id' => 2,
	                    'client_secret' => $client_secret,
	                    'username' => $username,
	                    'password' => $password,
	                    'scope' => '',
	                ],
	            ]);            
	            
	            $response= json_decode((string) $response->getBody(), true);

	            return response()->json($response);

		    } else {
		        return AjaxResponse::fail('Usuario o contraseña incorrectos');
		    }

		}else{
			return AjaxResponse::fail('Error al conectar con ldap');
		}        
    }
}
