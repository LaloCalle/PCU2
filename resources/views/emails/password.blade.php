{{ trans('strings.hello') }} <strong>{{$user->name}}</strong>.
<br><br>
{{ trans('strings.recoverynote') }}: <strong>{{$user->username}}</strong>.
<br><br>
{{ trans('strings.resetpasswordnote1') }} <a href="{{url('password/reset/'.$token)}}">{{ trans('strings.resetpassword') }}</a>, {{ trans('strings.resetpasswordnote2') }}.