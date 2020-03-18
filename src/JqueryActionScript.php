<?php

namespace LaravelCreative\JqueryActions;

use http\Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SuperClosure\Serializer;

class JqueryActionScript
{

    public $jqueryFunction;
    public $jqueryMethod;
    public $hashedCode;
    public $secondHashedCode;
    public $onetime;
    public $jquerySuccessCallback;
    public $jqueryErrorCallback;
    public $selector;

    /**
     * JqueryActionScript constructor.
     * @param $jqueryFunction
     * @param $jqueryMethod
     * @param $hashedCode
     * @param $secondHashedCode
     * @param $onetime
     * @param $jquerySuccessCallback
     * @param $jqueryErrorCallback
     * @param $selector
     */
    public function __construct($jqueryFunction, $jqueryMethod, $hashedCode, $secondHashedCode, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $selector=null)
    {
        $this->jqueryFunction = $jqueryFunction;
        $this->jqueryMethod = $jqueryMethod;
        $this->hashedCode = $hashedCode;
        $this->secondHashedCode = $secondHashedCode;
        $this->onetime = $onetime;
        $this->jquerySuccessCallback = $jquerySuccessCallback;
        $this->jqueryErrorCallback = $jqueryErrorCallback;
        $this->selector = $selector;
    }


    /**
     * @return mixed
     */
    public function render(){

         return view('jquery-actions::script',['script'=>$this]);
    }

}
