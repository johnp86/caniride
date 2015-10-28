<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html ng-app="caniride" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Can I ride @if(!empty($location)) in {{ $location }}@endif?</title>
        <meta name="description" content="Want to know if you should ride where you are right now?">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="wqo8d8SboP86Q-bkPC26fhPVEKaHJulVxYZ6YxuqA48" />

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link href='https://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/styles.css">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="components/jquery/jquery.min.js"><\/script>')</script>

        <script src="/components/angular/angular.min.js"></script>
        <script src="/assets/js/app/app.js"></script>
        <script src="/assets/js/snap.svg-min.js"></script>

        <meta property="og:image" content="http://caniride.com/assets/img/ride.jpg">
        @if(!empty($location))
        <script type="text/javascript">var presetloc = '{{$location}}'</script>
        @endif
    </head>
    <body ng-controller="WeatherCtrl" id="{[{page_class}]}">

<div class="container">
<a href="" target="_blank"><span class="logo">FAIR WEATHER RIDER<br><span style="font-family:arial; font-size:10px; color:#919191; text-align:left;">CANIRIDEMYSCOOTER.COM</span></span></a>
</div>
@yield('content')


<script src="/assets/js/script.js"></script>

<script>
  
  

</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-8386424-10', 'caniride.com');
  ga('send', 'pageview');

</script>
</body>
</html>