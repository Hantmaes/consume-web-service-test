<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SimpleXML;
use Illuminate\Support\Facades\Http;
use App;
use App\Models\Ico;
use App\Http\Resources\Ico as IcoResources;
use App\Mail\MessageReceived;
// use App\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class GuzzleController extends Controller
{
    public function list(){

        $articles = Ico::all();
        // $articles = Ico::orderBy('created_at', 'desc')->paginate(5);
        // $articles = Ico::paginate(5);

        // return view('icos.index', compact('articles'));
        return IcoResources::collection($articles);
        // echo($articles);
        // return view('index');
    }
    
    
    public function getRemoteData(Request $request)
    {
        
        $request = request('q');

        if($request != ""){

            $file = @file_get_contents("http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=".$request);

            $xml = @simplexml_load_string($file);
       

            $ns = $xml->getDocNamespaces();
            $data = $xml->children($ns['are']);
            $el = $data->children($ns['D'])->VBAS;
            
           
            if (strval($el->ICO) == $request) 
            {
                $ares_ico_fin = strval($el->ICO);
                $ares_dic_fin = strval($el->DIC);
                $ares_firma_fin = strval($el->OF);
                $ares_ulice_fin	= strval($el->AA->NU);
                $ares_cp1_fin	= strval($el->AA->CD);
                $ares_cp2_fin	= strval($el->AA->CO);
                if($ares_cp2_fin != ""){ $ares_cp_fin = $ares_cp1_fin."/".$ares_cp2_fin; }else{ $ares_cp_fin = $ares_cp1_fin; }
                $ares_mesto_fin	= strval($el->AA->N);
                $ares_psc_fin	= strval($el->AA->PSC);
                $ares_stav_fin = 1;
            } 
            else
              {
                return view ( 'data' )->withMessage ( 'No Details found. Try to search again !' );
              } 

                $element = new Ico;
                $element->ares_firma_fin = $ares_firma_fin;
                $element->ares_ulice_fin = $ares_ulice_fin;
                $element->ares_mesto_fin = $ares_mesto_fin;
                $element->ares_psc_fin = $ares_psc_fin;
                $element->ares_dic_fin = $ares_ico_fin;

                $element->save();
            
            if (count ( $el ) > 0)

            return view ( 'data' )
            ->withFirma ($ares_firma_fin )
            ->withUlice ($ares_ulice_fin )
            ->withMesto ($ares_mesto_fin )
            ->withPsc ($ares_psc_fin )
            ->withDic ($ares_ico_fin )
            ->withQuery ( $request );
            else
                return view ( 'data' )->withMessage ( 'No Details found. Try to search again !' );
            
        } else {
            return view ( 'data' )->withMessage ( 'No Details found. Try to search again !' );
        }
        //return view ( 'search-functionality-in-laravel/data' )->withMessage ( 'No Details found. Try to search again !' )
    }

    public function show(){

        return view('data');
    }

    public function table(){

        return view('tables.index');
    }

    public function sendEmail(Request $request) {
        $data = array(
            
            'ares_firma_fin'     => $request['ares_firma_fin'],
            'ares_ulice_fin'      => $request['ares_ulice_fin'],
            'ares_mesto_fin'      => $request['ares_mesto_fin'],
            'ares_psc_fin'      => $request['ares_psc_fin'],
            'ares_ico_fin'      => $request['ares_ico_fin'],
            'created_at'      => $request['created_at'],
        );

        Mail::to('webtestinizio@gmail.com')->send(new MessageReceived($data));

        return response()->json(true);

    }

    public function feed()
    {
        $posts = Ico::orderBy('created_at', 'desc')->take(20)->get();
        return view('feed')->with(compact('posts'));
    }


}
