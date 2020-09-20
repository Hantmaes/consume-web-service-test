<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Ico;

class IcoController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=27074358');
        $response = $request->getBody();
       
        dd($response);
        
    }
}