<?php

namespace LaravelCreative\JqueryAction\Scripts;

use http\Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SuperClosure\Serializer;

class JqueryActionForm
{

    public $jqueryFunction;
    public $formClass;
    public $hashedCode;
    public $secondHashedCode;
    public $onetime;
    public $jquerySuccessCallback;
    public $jqueryErrorCallback;
    public $onLoad;
    public $url;
    public $method;
    /**
     * JqueryActionForm constructor.
     * @param $jqueryFunction
     * @param $formClass
     * @param $hashedCode
     * @param $secondHashedCode
     * @param $onetime
     * @param $jquerySuccessCallback
     * @param $jqueryErrorCallback
     * @param null $selector
     */
    public function __construct($url, $method, $jqueryFunction, $class, $hashedCode, $secondHashedCode, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad)
    {
        $this->jqueryFunction = $jqueryFunction;
        $this->hashedCode = $hashedCode;
        $this->formClass = $class;
        $this->secondHashedCode = $secondHashedCode;
        $this->onetime = $onetime;
        $this->jquerySuccessCallback = $jquerySuccessCallback;
        $this->jqueryErrorCallback = $jqueryErrorCallback;
        $this->onLoad = $onLoad;
        $this->url = $url;
        $this->method = $method;
    }


    /**
     * render form tag
     * @return mixed
     */
    public function renderTag()
    {

        return view('jquery-actions::formTag', ['script' => $this]);
    }


    /**
     * render form scripts
     * @return mixed
     */
    public function render()
    {

        return view('jquery-actions::formScript', ['script' => $this]);
    }

}
