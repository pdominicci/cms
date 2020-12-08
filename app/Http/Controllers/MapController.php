<?php

namespace App\Http\Controllers;

use DateTime;

ini_set('date.timezone', 'America/Argentina/Buenos_Aires');

define("URL", 'http://www.geoplugin.net/xml.gp?ip=');

class MapController extends Controller
{
    public function getLocation(){
        $date = new DateTime();
        $format_date = $date->format('Y-m-d');

        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        //////////////////////////////////////////////////////////////////////////////
        $ipaddress = '181.114.53.105'; //// mi ip hardcodeada
        //////////////////////////////////////////////////////////////////////////////

        $url = URL.$ipaddress;
        $xml = file_get_contents($url);
        $geo = simplexml_load_string($xml);

        if (is_object($geo)) {
            $data = ['geo' => $geo];
            return view('admin.map.location', $data);
        } else {
              echo "No se pudo leer el XML";
        }
    }
}
