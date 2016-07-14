<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use SIU\AccesoApi;
use SIU\barrios;
use SIU\Http\Requests;
use Carbon\Carbon;
use Mockery\CountValidator\Exception;

class ApigoogleController extends Controller
{
    public function calendar($calendario, $totaleventos,Request $request)
    {

        $user=$request->header('user');
        $apikey=$request->header('apikey');
        $accesoapi=null;


            $accesoapi = AccesoApi::where('user', $user)->first();
//        dd($accesoapi->apikey);

        if($accesoapi==null){
            return response()->json(['code'=>403,'datos'=>null,'mensaje'=>'No Autorizado'
            ]);
        }
        elseif($accesoapi->apikey == $apikey){
//                validar calendario y api de calendario
            
                $barrio = barrios::where('id', $calendario)->first();

                if($barrio){

                    $results=array();
                    try {


                        $client = new \Google_Client();
                        $client->setApplicationName("calendario");
                        $client->setDeveloperKey(env('APIKEYGOOGLE'));

                        $service = new \Google_Service_Calendar($client);

                        $fecha = Carbon::create()->now();
                        $optParams = array('singleEvents' => true, 'orderBy' => 'startTime', 'timeMin' => $fecha->toRfc3339String(), 'maxResults' => $totaleventos);

                        $results = $service->events->listEvents($barrio->nombrecalendario, $optParams);
                    }
                    catch (Exception $e){

                    }
                    finally{

                        if (count($results->getItems()>0)) {
                            $respuesta = array();
                            foreach ($results->getItems() as $eventos) {
                                $registro = "";
                                if (isset($eventos->start->dateTime)) {

                                    $inicio = explode("T", $eventos->start->dateTime);

//                    dd(explode(":",$inicio[1])[1]);
                                    $startdate = Carbon::create(explode("-", $inicio[0])[0], explode("-", $inicio[0])[1], explode("-", $inicio[0])[2], explode(":", $inicio[1])[0], explode(":", $inicio[1])[1], "00", "America/Mexico_City");
                                    $registro = $eventos->summary;
                                    $registro .= " Fecha " . $startdate->format("l d M Y");
                                    $registro .= " Hora " . $startdate->format("h:m a");
                                } elseif (isset($eventos->start->date)) {
                                    $inicio = $eventos->start->date;
                                    $startdate = Carbon::createFromDate(explode("-", $inicio)[0], explode("-", $inicio)[1], explode("-", $inicio)[2]);
                                    $registro = $eventos->summary;
                                    $registro .= " Fecha " . $startdate->format("l d M Y");
                                }

                                $respuesta[] = $registro;
                            }

                            return response()->json([
                                'code'=>200,'datos'=>$respuesta,'mensaje'=>'Exito'
                            ]);
                        }
                    }


                }
                else{
                    return response()->json(['code'=>500,'datos'=>null,'mensaje'=>'Calendario no encontrado'
                    ]);
                }



        }
        else{
            return response()->json(['code'=>403,'datos'=>null,'mensaje'=>'No Autorizado'
            ]);
        }









    }

    public function buscareventos($calendario,$eventos){
        $results = array();
        $respuesta=array();
        try {


            $client = new \Google_Client();
            $client->setApplicationName("calendario");
            $client->setDeveloperKey("AIzaSyCWNBlnKa5507bm-ACF2iEVoFCXL3ysOrQ");

            $service = new \Google_Service_Calendar($client);

            $fecha = Carbon::create()->now();
            $optParams = array('singleEvents' => true, 'orderBy' => 'startTime', 'timeMin' => $fecha->toRfc3339String(), 'maxResults' => $eventos);

            $results = $service->events->listEvents($calendario, $optParams);
dd($results);


        } catch (Exception $e) {

        } finally {
            if($results) {

                    $respuesta = array();
                    foreach ($results->getItems() as $eventos) {
                        $registro = "";
                        if (isset($eventos->start->dateTime)) {

                            $inicio = explode("T", $eventos->start->dateTime);

//                    dd(explode(":",$inicio[1])[1]);
                            $startdate = Carbon::create(explode("-", $inicio[0])[0], explode("-", $inicio[0])[1], explode("-", $inicio[0])[2], explode(":", $inicio[1])[0], explode(":", $inicio[1])[1], "00", "America/Mexico_City");
                            $registro = $eventos->summary;
                            $registro .= " Fecha " . $startdate->format("l d M Y");
                            $registro .= " Hora " . $startdate->format("h:m a");
                        } elseif (isset($eventos->start->date)) {
                            $inicio = $eventos->start->date;
                            $startdate = Carbon::createFromDate(explode("-", $inicio)[0], explode("-", $inicio)[1], explode("-", $inicio)[2]);
                            $registro = $eventos->summary;
                            $registro .= " Fecha " . $startdate->format("l d M Y");
                        }

                        $respuesta[] = $registro;
                    }
                dd($respuesta);

                    return response()->json(
                        [
                            'code' => 200,
                            'data' => $respuesta,
                            'messege' => 'Exito',
                        ]);

            }
            else{
                return response()->json(
                    [
                        'code' => 200,
                        'data' => $respuesta,
                        'messege' => 'Sin Eventos',
                    ]);
            }


        }//finaly
    }


}