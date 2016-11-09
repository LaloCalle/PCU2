<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>Portal Cliente Único</title>

    <!-- Bootstrap -->
    {!!Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css')!!}

    <!-- Switch -->
    {!!Html::style('css/highlight.css')!!}
    {!!Html::style('css/bootstrap3/bootstrap-switch.css')!!}
    {!!Html::style('http://getbootstrap.com/assets/css/docs.min.css')!!}
    {!!Html::style('css/main.css')!!}

    <!-- Menú -->
    {!!Html::style('css/sb-admin.css')!!}
    {!!Html::style('css/metisMenu.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    
    <!-- jQueryUI -->
    {!!Html::style('http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css')!!}

    <!-- Custom -->
    {!!Html::style('css/custom.css')!!}

    @yield('styles')
    
    <script>
        var direction;
        direction = '<?php echo env('APP_ROUTE_VM'); ?>';
    </script>
  </head>
  <body>

    <div id="wrapper">

      @include('layouts.menus.main-menu')

      <div id="page-wrapper">
        @include('alerts.success')
        @include('alerts.errors')
        @include('alerts.request')
        @include('alerts.json')
        @yield('content')
        <div id="principalPanel">
            @yield('table-result')
        </div>
      </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!!Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')!!}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {!!Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')!!}

    <!-- Menú -->
    {!!Html::script('js/metisMenu.min.js')!!}
    {!!Html::script('js/sb-admin-2.js')!!}

    <!-- jQueryUI -->
    {!!Html::script('http://code.jquery.com/ui/1.11.3/jquery-ui.js')!!}

    <!-- Switch -->
    {!!Html::script('js/highlight.js')!!}
    {!!Html::script('js/bootstrap-switch.js')!!}
    {!!Html::script('js/main.js')!!}

    <!-- Other -->
    {!!Html::script('js/delete-reg.js')!!}

    @yield('scripts')
    
  </body>
</html>