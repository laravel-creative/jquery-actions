# Turn jQuery into magic with php

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-creative/jquery-actions.svg?style=flat-square)](https://packagist.org/packages/laravel-creative/jquery-actions)
[![Build Status](https://img.shields.io/travis/laravel-creative/jquery-actions/master.svg?style=flat-square)](https://travis-ci.org/laravel-creative/jquery-actions)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-creative/jquery-actions.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-creative/jquery-actions)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-creative/jquery-actions.svg?style=flat-square)](https://packagist.org/packages/laravel-creative/jquery-actions)

Tired of jquery ajax ? and laravel blades , now all of those things has been turned into magic , with this creative package you can do all ajax stuff without writing any javascript code.
also if you want to write fast laravel function without routes or controllers you can do it , i told u its magic :)
## Installation

You can install the package via composer:

```bash
composer require laravel-creative/jquery-actions
```
## requires
This package requires ``jquery
                       and jquery-confirm``
                       you can install by cdn
 ```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">           

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
```

## Usage
### jQuery Actions
Jquery actions is static class with ``facades`` you can use it on ``laravel blades`` to do the magic. <br>
all functions are based on jquery ajax and secured hashed urls , of course you can use your own ``routes``

#### onClick()
```php 
JqueryAction::onClick($function, $options = [])
```
when you use this function in blades like this and don`t forget to add ``@jqueryScripts`` blade directive in the end of your file after jquery scripts.
```html
<button {{JqueryAction::onClick(function($request){ echo 'Hello'; })}}>Say Hello</button>
```
when the user click the ``Say Hello`` button , an ajax request will go to secured hashed url and the response will be ``Hello``
<br>
* Ok Great , but i want to run the function from controller ?
<br>
Then you have to mention the controller and the actions like this.
```html
<button {{JqueryAction::onClick('app\Http\Controllers\HomeController@sayHello')}}>Say Hello</button>
```
* that`s awesome, but i want to use custom url
<br>
then you can use ``$options`` array to make the magic.
```php
$options = [
             'url'=>null, //Ajax Request Url
             'method'=>'POST', //Ajax Request Method
             'onetime'=>false, //Allow One Time Request to this secured url, only work with built in urls.
             'jquerySuccessCallback'=>null, //The callback when success response, you can write jquery codes here and use the data as response, or use JqueryHelpers
             'jqueryErrorCallback'=>null, //The callback when error response, you can write jquery codes here and use the data as response, or use JqueryHelpers
             'onLoadCallback'=>null, // The javascript call back when function started
             'expires'=>20 //Function Expires after 20 second , only work with built in urls.
];
```

so for custom urls your code would be like this

```html
    <button {{JqueryAction::onClick(null,[
    'url'=>route('name'),
    'method'=>'POST'
    ])}}>Say Hello</button>
```


* all methods work the same way as function and options


#### on()
```php
JqueryAction::on($attribute,$function,$options=[])
```
in javascript you can use ``$('#id').on('onmouseenter',function(e){})`` to run a method when mouse enter div with id  ``#id``
you can use the same with this package.
```html
    <button {{JqueryAction::on('onmouseenter',null,[
    'url'=>route('name'),
    'method'=>'POST'
    ])}}>Say Hello</button>
```
with all ``onClick()`` magic too. you can use all html attributes on the first parameter

#### static()
```php
JqueryAction::static($selector,$method,$function,$options=[])
```
You can make your own static javascript function without inline tag method,
 
in javascript you can use ``$('#id').on('hover',function(e){})`` to run a method when mouse hover a div with id  ``#id``
you can use the same with this method. its ajax too.

```html
{{JqueryAction::static('#id','hover',null,[
    'url'=>route('name'),
    'method'=>'POST'
    ])}}
```

#### jqueryForm()
you can do the magic with forms too.
<br>
start your form tag
```html
  {{JqueryAction::jqueryForm(function (\Illuminate\Http\Request $request){
      $post=new \App\Post();
    $post->text=$request->text;
    $post->user_id=$request->user()->id;
    $post->save();
    return $post->text;
},[
    'onetime'=>false,
    'expires'=>1200,
    'jquerySuccessCallback'=>\LaravelCreative\JqueryAction\Helpers\JqueryHelper::append('#posts','<li>','New Post {data}','</li>'),
    'onLoadCallback'=>\LaravelCreative\JqueryAction\Helpers\JqueryHelper::jqueryAlert('Loading','Form Is Sending...'),
])}}
```
then add your fields and close the form

```html
  {!! JqueryAction::closeForm() !!}
```
### JqueryHelpers
You saw those keys in ``$options`` array above 
```
'jquerySuccessCallback'=>null, //The callback when success response, you can write jquery codes here and use the data as response, or use JqueryHelpers
'jqueryErrorCallback'=>null, //The callback when error response, you can write jquery codes here and use the data as response, or use JqueryHelpers
'onLoadCallback'=>null,
```
how can you use them.
 <br>
 1- you can use pure javascript or jquery functions as `text` instead of `null` to control the ajax response.
```
'jquerySuccessCallback'=>'alert("success :"+ data)', 
'jqueryErrorCallback'=>'console.log(error.status)', 
'onLoadCallback'=>'alert("loading..")',
```
 2-or you can use our ``jqueryHelper`` functions.
 
#### append($selector, $openTag, $msg, $closedTag)
uses jquery ``append`` function
```
'jquerySuccessCallback'=>jqueryHelper::append("#status",'<p>','Success Status : {data.status}','</p>'), 
'jqueryErrorCallback'=>jqueryHelper::append("#status",'<p>','Error Status : {error.status}','</p>'), 
'onLoadCallback'=>jqueryHelper::append("#status",'<p>','Loading....','</p>'), 
```
you can use ``{data}`` to access javascript data object ``{data.msg}``

#### remove($selector)
uses jquery ``remove`` method to remove element 
```
'jquerySuccessCallback'=>jqueryHelper::remove("#loading"),  
```

#### hide($selector)
 ```
'jquerySuccessCallback'=>jqueryHelper::hide("#loading"),  
```


#### show($selector)
 ```
'onLoadCallback'=>jqueryHelper::show("#loading"),  
```


#### html($selector,$msg)
change element html
```
'jquerySuccessCallback'=>jqueryHelper::html("#msg",'Success'),  
```

#### console($msg)
write to the console
```
'jquerySuccessCallback'=>jqueryHelper::console('{data.users}'),  
```
#### static function function($selector, $function, $msg)
this would print `` $('$selector').$function('$msg');"; ``
for example i want to change html of div when success.
```
'jquerySuccessCallback'=>jqueryHelper::function('#text','html','{data.text}'),  
```
so the result would be
```javascript
$('#text').html(data.text);
```


#### jqueryAlert($title, $msg)
we uses ``jquery confirm`` alerts to display alerts messages.
 ```
'jqueryErrorCallback'=>jqueryHelper::jqueryAlert("Error !","cant reach : {error}"),  
```

 
 

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mustafakhaled.dev@gmail.com instead of using the issue tracker.

## Credits

- [Mustafa Khaled](https://github.com/laravel-creative)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
 
