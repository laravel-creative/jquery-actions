$("#{{$script->jqueryFunction}}").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var url = '{{$script->url??route('JA:fetch',[$script->hashedCode,$script->secondHashedCode,$script->onetime])}}'
@if($script->onLoad!=null)
    {!! $script->onLoad !!}
@endif
$.ajax({
type: "{{$script->method??'POST'}}",
url: url,
data: form.serialize(), // serializes the form's elements.
success: function (data) {
@if($script->jquerySuccessCallback!=null)
    {!! $script->jquerySuccessCallback !!}
@endif
},
error: function (error) {
@if($script->jqueryErrorCallback!=null)
    {!! $script->jqueryErrorCallback !!}
@endif
}
});


});

