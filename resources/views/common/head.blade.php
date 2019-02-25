
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team Education - @yield('title', '')</title>
    <link rel="icon" type="image/png" href="/images/favi.png">
    
    <!-- Fonts files -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,700" rel="stylesheet"> 
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    
    @stack('before-main-css')
    <!-- Theme files -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/responsive.css">

    @stack('style')
    <script type="text/javascript">
        var baseUrl = "{{ url('/') }}";

        function formToJson(formArray) {
          var returnArray = {};
          for (var i = 0; i < formArray.length; i++){
            returnArray[formArray[i]['name']] = formArray[i]['value'];
          }
          return returnArray;
        }

    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>