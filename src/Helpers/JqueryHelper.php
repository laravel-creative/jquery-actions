<?php

namespace LaravelCreative\JqueryAction\Helpers;

class JqueryHelper
{


    /**
     * @param $selector
     * @param $openTag
     * @param $msg
     * @param $closedTag
     * @return string
     */
    public static function append($selector, $openTag, $msg, $closedTag)
    {

        $data = null;
        $tags = self::getContents($msg, '{', '}');

        $msg = str_replace('{', "", $msg);//data.msg
        $msg = str_replace('}', "", $msg);//data.msg
        foreach ($tags as $tag) {
            $msg = str_replace($tag, "'+$tag+'", $msg);//data.msg

        }
        return "$('$selector').append('$openTag $msg $closedTag');";
    }

    /**
     * @param $selector
     * @return string
     */
    public static function remove($selector)
    {
        return "$('$selector').remove();";
    }

    /**
     * @param $selector
     * @return string
     */
    public static function hide($selector)
    {
        return "$('$selector').hide();";
    }


    /**
     * @param $selector
     * @return string
     */
    public static function show($selector)
    {
        return "$('$selector').show();";
    }


    /**
     * @param $selector
     * @param $msg
     * @return string
     */
    public static function html($selector,$msg)
    {
        $data = null;
        $tags = self::getContents($msg, '{', '}');

        $msg = str_replace('{', "", $msg);//data.msg
        $msg = str_replace('}', "", $msg);//data.msg
        foreach ($tags as $tag) {
            $msg = str_replace($tag, "'+$tag+'", $msg);//data.msg

        }

        return "$('$selector').html('$msg');";
    }


    /**
     * @param $selector
     * @param $msg
     * @return string
     */
    public static function console($msg)
    {
        $data = null;
        $tags = self::getContents($msg, '{', '}');

        $msg = str_replace('{', "", $msg);//data.msg
        $msg = str_replace('}', "", $msg);//data.msg
        foreach ($tags as $tag) {
            $msg = str_replace($tag, "'+$tag+'", $msg);//data.msg

        }

        return "console.log('$msg')";
    }



    /**
     * @param $selector
     * @param $function
     * @param $msg
     * @return string
     */
    public static function function($selector, $function, $msg)
    {

        $data = null;
        $tags = self::getContents($msg, '{', '}');

        $msg = str_replace('{', "", $msg);//data.msg
        $msg = str_replace('}', "", $msg);//data.msg
        foreach ($tags as $tag) {
            $msg = str_replace($tag, "'+$tag+'", $msg);//data.msg

        }
        return "$('$selector').$function('$msg');";
    }


    /**
     * @param $title
     * @param $msg
     * @return string
     */
    public static function jqueryAlert($title, $msg)
    {
        $msgTags = self::getContents($msg, '{', '}');

        $msg = str_replace('{', "", $msg);//data.msg
        $msg = str_replace('}', "", $msg);//data.msg
        foreach ($msgTags as $tag) {
            $msg = str_replace($tag, "'+$tag+'", $msg);//data.msg

        }


        $titleTags = self::getContents($title, '{', '}');

        $title = str_replace('{', "", $title);//data.msg
        $title = str_replace('}', "", $title);//data.msg
        foreach ($titleTags as $tag) {
            $title = str_replace($tag, "'+$tag+'", $title);//data.msg

        }

        return "_jqueryLC.alert({
    title: '$title',
    content: '$msg',
});";
    }


    /**
     * @param $str
     * @param $startDelimiter
     * @param $endDelimiter
     * @return array
     */
    private static function getContents($str, $startDelimiter, $endDelimiter)
    {
        $contents = array();
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;
        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($str, $endDelimiter, $contentStart);
            if (false === $contentEnd) {
                break;
            }
            $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        }

        return $contents;
    }
}
