@if($script->selector!=null)
    $('{{$script->selector}}').on('{{$script->jqueryMethod}}', function {{$script->jqueryFunction}}() {
    @if($script->onLoad!=null)
        {!! $script->onLoad !!}
    @endif
        $.ajax({
            type: '{{$script->method??'POST'}}',
            url: '{{$script->url??route('JA:fetch',[$script->hashedCode,$script->secondHashedCode,$script->onetime])}}',
            data:{_token:'{{csrf_token()}}'},
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
    @else
    function {{$script->jqueryFunction}}() {
    @if($script->onLoad!=null)
        {!! $script->onLoad !!}
    @endif
        $.ajax({
            type: '{{$script->method??'POST'}}',
            url: '{{$script->url??route('JA:fetch',[$script->hashedCode,$script->secondHashedCode,$script->onetime])}}',
            data:{_token:'{{csrf_token()}}'},

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
    }
@endif
