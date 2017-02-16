<!DOCTYPE html>
<!-- saved from url=(0056)http://demo.web3canvas.com/themeforest/hello/index3.html -->
<html class="gr__demo_web3canvas_com">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <title>Project Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript" async="" src="{{ URL::to('landing/ga.js')}}">
</script><script async="" src="{{ URL::to('landing/cloudflare.min.js')}}"></script><script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"b11494fe7efffe8f9c87a9f1ba8665b4",petok:"c124342e2a39f425fba6d152dac573d311db9a84-1486761526-3600",zone:"web3canvas.com",rocket:"0",apps:{"abetterbrowser":{"ie":"7","opera":null,"chrome":null,"safari":null,"firefox":null},"ga_key":{"ua":"UA-38030533-1","ga_bs":"2"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=f2befc48d1/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<link href="{{ URL::to('landing/bootstrap.css')}}" rel="stylesheet">
<link href="{{ URL::to('landing/bootstrap-responsive.css')}}" rel="stylesheet" media="screen">

<link href="{{ URL::to('landing/css')}}" rel="stylesheet" type="text/css">

<link href="{{ URL::to('landing/jquery.tweet.css')}}" media="all" rel="stylesheet" type="text/css">

<link href="{{ URL::to('landing/main.css')}}" rel="stylesheet" media="all">
<script type="text/javascript">
/* <![CDATA[ */
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-38030533-1']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

(function(b){(function(a){"__CF"in b&&"DJS"in b.__CF?b.__CF.DJS.push(a):"addEventListener"in b?b.addEventListener("load",a,!1):b.attachEvent("onload",a)})(function(){"FB"in b&&"Event"in FB&&"subscribe"in FB.Event&&(FB.Event.subscribe("edge.create",function(a){_gaq.push(["_trackSocial","facebook","like",a])}),FB.Event.subscribe("edge.remove",function(a){_gaq.push(["_trackSocial","facebook","unlike",a])}),FB.Event.subscribe("message.send",function(a){_gaq.push(["_trackSocial","facebook","send",a])}));"twttr"in b&&"events"in twttr&&"bind"in twttr.events&&twttr.events.bind("tweet",function(a){if(a){var b;if(a.target&&a.target.nodeName=="IFRAME")a:{if(a=a.target.src){a=a.split("#")[0].match(/[^?=&]+=([^&]*)?/g);b=0;for(var c;c=a[b];++b)if(c.indexOf("url")===0){b=unescape(c.split("=")[1]);break a}}b=void 0}_gaq.push(["_trackSocial","twitter","tweet",b])}})})})(window);
/* ]]> */
</script>
<style type="text/css">.cf-hidden { display: none; } .cf-invisible { visibility: hidden; }</style></head>
<body id="layout3" data-gr-c-s-loaded="true" style="zoom: 1;">

<div class="jumbotron masthead">
<div class="container">

<h1>TeamBiosis</h1>

<p>Get more done, while {having='fun'}</p>

<div class="row-fluid">
<div class="span8 offset2 Wrapcountdown">
<p>We will be launching in</p>
<ul id="countdown">
<li> <span class="days">00</span>
<p class="timeRefDays">days</p>
</li>
<li> <span class="hours">00</span>
<p class="timeRefHours">hours</p>
</li>
<li> <span class="minutes">00</span>
<p class="timeRefMinutes">minutes</p>
</li>
<li> <span class="seconds">00</span>
<p class="timeRefSeconds">seconds</p>
</li>
</ul>
</div>
</div>

<div class="row-fluid">
<div class="span8 offset2 LightTwitter">

<div class="TwitterFeeds">
  <div id="ticker"><p class="loading">Create your <a href="{{ URL::to('login')}}">BETA</a> account, to see the real progress...</p></div>
</div>

</div>
</div>
</div>
</div>
<div class="container">

<div class="row-fluid">
<div class="span10 offset1 subscribe">
<h2>Sign-up for early access</h2>
<h4>We will never spam or share your info. Promise</h4>
<form class="form-search" action="http://feedburner.google.com/fb/a/mailverify?uri=web3canvas/rmrQ" method="post" target="popupwindow" onsubmit="window.open(&#39;http://feedburner.google.com/fb/a/mailverify?uri=web3canvas/rmrQ=&lt;?php echo $yam_feedburner; ?&gt;&#39;, &#39;popupwindow&#39;, &#39;scrollbars=yes,width=550,height=520&#39;);return true">
<input class="input-xxlarge" name="email" type="email" placeholder="Enter your email" required="required">
<input type="hidden" value="&lt;?php echo $yam_feedburner; ?&gt;" name="uri">
<input type="hidden" name="loc" value="en_US">
<button class="btn btn-large btn-warning" type="submit">Notify me</button>
</form>
</div>
</div>

<div class="row-fluid">
<div class="span8 offset2 footer">
<p class="socialicons"> <a href="http://facebook.com/web3canvas" target="_blank" class="icons facebook"></a> <a href="http://twitter.com/web3canvas" target="_blank" class="icons twitter"></a> <a href="http://web3canvas.com/" target="_blank" class="icons linkedin"></a> </p>
<p class="footertext"> copyright © 2017 Made with love in Croatia</p>
</div>
</div>
</div>

<script src="{{ URL::to('landing/jquery-1.9.0.min.js')}}"></script>

<script src="{{ URL::to('landing/bootstrap.js')}}"></script>

<script src="{{ URL::to('landing/countdown.js')}}"></script>
<script>

    $(document).ready(function(){
      $("#countdown").countdown({
      date: "02 02 2018 09:00:00",/*Change your time here*/
      format: "on"
      },

      function() {
        // callback function
      });
    });

  </script>

</body></html>
