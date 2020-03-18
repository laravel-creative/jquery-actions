<?php

namespace LaravelCreative\JqueryActions;

use http\Exception;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SuperClosure\Serializer;
use function foo\func;

class JqueryActions
{
    protected $scripts;

    /**
     * @param $code
     * @param int $expire
     * @param bool $onetime
     * @param null $jquerySuccessCallback
     * @param null $jqueryErrorCallback
     * @throws \Exception
     */
    public function onClick($code,$expire=20,$onetime=false,$jquerySuccessCallback=null,$jqueryErrorCallback=null)
    {
        if(is_string($code)) $code=$this->fetchControllerCode($code);
        if (!is_callable($code)) throw new \Exception('Code parameter must be callable function');

        $serializer = new Serializer();
        $serialized = $serializer->serialize($code);
        $jqueryFunction = 'laravel_creative_'.Str::random(25);
        $jqueryMethod = 'onclick';
        $hashedCode = Str::random(199);
        $secondHashedCode = Str::random(199);
        Cache::put($hashedCode . '-' . $secondHashedCode, $serialized, $expire);
        $this->scripts[] = new JqueryActionScript($jqueryFunction, $jqueryMethod, $hashedCode, $secondHashedCode,$onetime,$jquerySuccessCallback,$jqueryErrorCallback);
        echo "$jqueryMethod='$jqueryFunction()'";
    }


    /**
     * @param $method
     * @param $code
     * @param int $expire
     * @param bool $onetime
     * @param null $jquerySuccessCallback
     * @param null $jqueryErrorCallback
     * @throws \Exception
     */
    public function on($method,$code,$expire=20,$onetime=false,$jquerySuccessCallback=null,$jqueryErrorCallback=null)
    {
        if(is_string($code)) $code=$this->fetchControllerCode($code);

        if (!is_callable($code)) throw new \Exception('Code parameter must be callable function');

        $serializer = new Serializer();
        $serialized = $serializer->serialize($code);
        $jqueryFunction = 'laravel_creative_'.Str::random(25);
        $jqueryMethod = $method;
        $hashedCode = Str::random(199);
        $secondHashedCode = Str::random(199);
        Cache::put($hashedCode . '-' . $secondHashedCode, $serialized, $expire);
        $this->scripts[] = new JqueryActionScript($jqueryFunction, $jqueryMethod, $hashedCode, $secondHashedCode,$onetime,$jquerySuccessCallback,$jqueryErrorCallback);
        echo "$jqueryMethod='$jqueryFunction()'";
    }

    /**
     * @param $selector
     * @param $method
     * @param $code
     * @param int $expire
     * @param bool $onetime
     * @param null $jquerySuccessCallback
     * @param null $jqueryErrorCallback
     * @throws \Exception
     */
    public function static($selector,$method,$code,$expire=20,$onetime=false,$jquerySuccessCallback=null,$jqueryErrorCallback=null)
    {
        if(is_string($code)) $code=$this->fetchControllerCode($code);

        if (!is_callable($code)) throw new \Exception('Code parameter must be callable function');

        $serializer = new Serializer();
        $serialized = $serializer->serialize($code);
        $jqueryFunction = 'laravel_creative_'.Str::random(25);
        $jqueryMethod = $method;
        $hashedCode = Str::random(199);
        $secondHashedCode = Str::random(199);
        Cache::put($hashedCode . '-' . $secondHashedCode, $serialized, $expire);
        $this->scripts[] = new JqueryActionScript($jqueryFunction, $jqueryMethod, $hashedCode, $secondHashedCode,$onetime,$jquerySuccessCallback,$jqueryErrorCallback,$selector);
     }


     public function fetchControllerCode($code){
        $data=explode('@',$code);
         $function=app()
            ->make($data[0]);
         $action=$data[1];
         $newFunction=function($request) use($function,$action){
             return $function->$action($request);
         };
         return $newFunction;
     }

    public function initScripts()
    {

        echo '<script>';
        foreach ($this->scripts as $script)
            echo $script->render();


        echo '</script>';

    }

}
