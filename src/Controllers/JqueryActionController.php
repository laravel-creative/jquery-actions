<?php
namespace LaravelCreative\JqueryAction\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use SuperClosure\Serializer;

class JqueryActionController extends  BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @param $hashedKey
     * @param $secondKey
     * @param null $onetime
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function fetch($hashedKey,$secondKey,$onetime=null,\Illuminate\Http\Request $request){
         if (Cache::has($hashedKey.'-'.$secondKey)) {
            $code=Cache::get($hashedKey.'-'.$secondKey);
            $serializer = new Serializer();
            $originalCode = $serializer->unserialize($code);
            if($onetime==true){
                Cache::forget($hashedKey.'-'.$secondKey);
            }
            return $originalCode($request);
        }else{
           return abort(500,'Function callback is unavailable');
        }

    }
}
