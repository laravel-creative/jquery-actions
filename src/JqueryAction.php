<?php

namespace LaravelCreative\JqueryAction;

use http\Exception;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use LaravelCreative\JqueryAction\Scripts\JqueryActionForm;
use LaravelCreative\JqueryAction\Scripts\JqueryActionScript;
use SuperClosure\Serializer;
use function foo\func;

class JqueryAction
{
    protected static $scripts = [];


    /**
     * @param $code
     * @param array $options
     * @throws \Exception
     */
    public static function onClick($code, $options = [])
    {
        $serialized = self::checkCode($code);
        $jqueryFunction = 'laravel_creative_' . Str::random(25);
        $jqueryMethod = 'onclick';
        $hashedCode = Str::random(199);
        $secondHashedCode = Str::random(199);
        list($url, $method, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad, $expire) = JqueryAction::fetchList($options);
        Cache::put($hashedCode . '-' . $secondHashedCode, $serialized, $expire);
        JqueryAction::$scripts[] = new JqueryActionScript($url, $method, $jqueryFunction, $jqueryMethod, $hashedCode, $secondHashedCode, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad);
        echo "$jqueryMethod='$jqueryFunction()'";
    }


    /**
     * @param $method
     * @param $code
     * @param array $options
     * @throws \Exception
     */
    public static function on($method, $code, $options = [])
    {
        $serialized = self::checkCode($code);

        $jqueryFunction = 'laravel_creative_' . Str::random(25);
        $jqueryMethod = $method;
        $hashedCode = Str::random(199);
        $secondHashedCode = Str::random(199);
        list($url, $method, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad, $expire) = JqueryAction::fetchList($options);
        Cache::put($hashedCode . '-' . $secondHashedCode, $serialized, $expire);
        JqueryAction::$scripts[] = new JqueryActionScript($url, $method, $jqueryFunction, $jqueryMethod, $hashedCode, $secondHashedCode, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad);
        echo "$jqueryMethod='$jqueryFunction()'";
    }

    /**
     * @param $selector
     * @param $method
     * @param $code
     * @param array $options
     * @throws \Exception
     */
    public static function static($selector, $method, $code, $options = [])
    {
        $serialized = self::checkCode($code);

        $jqueryFunction = 'laravel_creative_' . Str::random(25);
        $jqueryMethod = $method;
        $hashedCode = Str::random(199);
        $secondHashedCode = Str::random(199);
        list($url, $method, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad, $expire) = JqueryAction::fetchList($options);
        Cache::put($hashedCode . '-' . $secondHashedCode, $serialized, $expire);
        JqueryAction::$scripts[] = new JqueryActionScript($url, $method, $jqueryFunction, $jqueryMethod, $hashedCode, $secondHashedCode, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad, $selector);

    }


    /**
     * @param $code
     * @param $class
     * @param array $options
     * @throws \Exception
     */
    public static function jqueryForm($code, $options = [])
    {

        $serialized = self::checkCode($code);
        $jqueryFunction = 'laravel_creative_form_' . Str::random(25);
        $hashedCode = Str::random(199);
        $secondHashedCode = Str::random(199);
        list($url, $method, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad, $expire,$class) = JqueryAction::fetchList($options);

        Cache::put($hashedCode . '-' . $secondHashedCode, $serialized, $expire);
        $formScript = new JqueryActionForm($url, $method, $jqueryFunction, $class, $hashedCode, $secondHashedCode, $onetime, $jquerySuccessCallback, $jqueryErrorCallback, $onLoad);
        JqueryAction::$scripts[] = $formScript;
        echo $formScript->renderTag();
    }


    /**
     * Return Closed Form Tag
     */
    public static function closeForm()
    {
        echo '</form>';
    }

    /**
     * @param $code
     * @return \Closure
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function fetchControllerCode($code)
    {
        $data = explode('@', $code);
        $function = app()
            ->make($data[0]);
        $action = $data[1];
        $newFunction = function ($request) use ($function, $action) {
            return $function->$action($request);
        };
        return $newFunction;
    }

    /**
     * Init Laravel creative jquery scripts
     */
    public static function initScripts()
    {

        echo '<script>';
        echo '_jqueryLC=jQuery;' . "\n";
        foreach (JqueryAction::$scripts as $script)
            echo $script->render();


        echo '</script>';

    }


    /**
     * Check callback
     * @param $code
     * @return callable|\Closure|string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private static function checkCode($code)
    {
        if (is_string($code) && $code != null) $code = JqueryAction::fetchControllerCode($code);

        if (!is_callable($code) && $code != null) throw new \Exception('Code parameter must be callable function');
        if ($code != null) {
            $serializer = new Serializer();
            $serialized = $serializer->serialize($code);
        } else {
            $serialized = $code;
        }

        return $serialized;

    }

    /**
     * Fetch Options List
     * @param $options
     * @return mixed
     */
    private static function fetchList($options)
    {

        $data[0] = isset($options['url']) ? $options['url'] : null;
        $data[1] = isset($options['method']) ? $options['method'] : 'POST';
        $data[2] = isset($options['onetime']) ? $options['onetime'] : false;
        $data[3] = isset($options['jquerySuccessCallback']) ? $options['jquerySuccessCallback'] : null;
        $data[4] = isset($options['jqueryErrorCallback']) ? $options['jqueryErrorCallback'] : null;
        $data[5] = isset($options['onLoadCallback']) ? $options['onLoadCallback'] : null;
        $data[6] = isset($options['expires']) ? $options['expires'] : 20;
        $data[7] = isset($options['class']) ? $options['class'] : null;
        return $data;

    }

}
