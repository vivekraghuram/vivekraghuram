<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Contact Us</title>

<link href="index.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>

<!--Tipuesearch stuff-->
<link href="http://fonts.googleapis.com/css?family=Lato:300,400|Open+Sans:300,400" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../example.css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript" src="tipuesearch/tipuesearch_set.js"></script>
<link rel="stylesheet" type="text/css" href="tipuesearch/tipuesearch.css">
<script type="text/javascript" src="tipuesearch/tipuesearch.js"></script>
<!--end tipuesearch stuff-->

<!--email form stuff-->
<script type="text/javascript">
function hgsubmit()
{
if (/\S+/.test(document.hgmailer.name.value) == false) alert ("Please provide your name.");
else if (/^\S+@[a-z0-9_.-]+\.[a-z]{2,6}$/i.test(document.hgmailer.email.value) == false) alert ("A valid email address is required.");
 else if (/\S+/.test(document.hgmailer.comment.value) == false) alert ("Your email content is needed.");
  else {
       document.hgmailer.submit();
       alert ('Thank you!\nYour email is sent.');
       }
}
</script>
<!--end email form stuff-->
        
</head>

<body style="height:100%; background-color:#FAFFFF;">
<div class="container">

<!--navbar-->
	<div class="containerwide" style="background-color:#7AC844; height:9px;">&nbsp;</div>
	<div class="containerwide">
  		<div class="header">
        	<div class="middlenarrower">


  			<div style="float:left; margin-top:24px;"><a href="index.html"><img src="images/Teen%20Grus%20Logo%205.0.png" height="60" draggable="false" /></a></div>
            
            <div style="width:25%; float:left;">&nbsp;</div>
            <div style="float:left; margin-top:50px;" align="center">

				<div style="float: left;"><input type="text" id="tipue_search_input"></div>
				<div style="float: left; margin-left: 13px;"><input type="button" id="tipue_search_button"></div>
				<div id="tipue_search_content"></div>

			</div>
            
            <script>
				$(document).ready(function() {
     			$('#tipue_search_input').tipuesearch({
          			'mode': 'live',
          			'show': 6
     				});
			});
			</script>
            
            <div style="width:3%; float:left;">&nbsp;</div>
            <div style="float:right; margin-top:49px; margin-right:5px;"><font style="font-size:20px; text-decoration:none;"><a class="link" href="contact.html">CONTACT US</a></font></div>
            <div style="float:right; margin-top:49px; margin-right:65px;"><font style="font-size:20px; text-decoration:none;"><a class="link" href="model.html">OUR MODEL</a></font></div>
              
            
            
            <div style="width:100%; height:1px; background-color:#999; margin-top:24px; float:right;"></div>


			</div>
    	</div><!-- end .header -->
    </div><!-- end .containerwide -->
<!--end navbar-->

<div class="containerwide" style="height:190px;">
	<div class="middlenarrow">
		<div class="middlenarrower">
    		<div style="font-size:36px; color:#7AC844; float:left; margin-left:50px; margin-top:20px; width:60%;">Got Questions?</font></div>
            
            <div style="width:200px; float:right; margin-top:20px;">
            <a href="http://www.facebook.com"><div class="icon"><img src="images/facebook.png" style="vertical-align:middle;"/>&nbsp;Facebook</div></a>
            <a href="http://www.twitter.com"><div class="icon"><img src="images/twitter.png" style="vertical-align:middle;"/>&nbsp;Twitter</div></a>
            <a href="http://www.tumblr.com"><div class="icon"><img src="images/tumblr.png" style="vertical-align:middle;"/>&nbsp;Tumblr</div></a>
            </div>
            
            <div style="font-size:20px; color:#666; float:left; margin-left:80px; margin-top:15px; width:60%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut felis odio, pretium at laoreet et, malesuada quis enim. Nulla gravida nunc quis tellus elementum varius. Donec tincidunt euismod nunc ac facilisis. Fusce sit amet diam lorem, in interdum neque.</div>
    	</div>
    </div>
</div>

<!--<div class="containerwide">
	<div class="middlenarrow">
		<div class="middlenarrower">

		<iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Monta+Vista+High+School,+21840+McClellan+Rd,+Cupertino,+CA&amp;aq=0&amp;oq=monta+v&amp;sll=37.30925,-122.043644&amp;sspn=0.116737,0.222988&amp;t=m&amp;ie=UTF8&amp;hq=Monta+Vista+High+School,+21840+McClellan+Rd,+Cupertino,+CA&amp;ll=37.315431,-122.056689&amp;spn=0.011946,0.021458&amp;z=15&amp;iwloc=A&amp;output=embed&amp;iwloc=near"></iframe>
        
    	</div>    
	</div>
</div>-->

<div class="containerwide">
	<div class="containernarrow">

<form action="http://www.teengurus.com/cgi-sys/formmail.pl" method="post" name="hgmailer">
<input type="hidden" name="recipient" value="vivekrag95@gmail.com">
<input type="hidden" name="subject" value="FormMail E-Mail">
Whatever you want to say here<br><br>
Visitor Name: <input type="text" name="name" size="30" value=""><br>
Visitor E-Mail: <input type="text" name="email" size="30" value=""><br>
E-Mail Content: <textarea name="comment" cols="50" rows="5"></textarea><br><br>
<input type="button" value="E-Mail Me!" onclick="hgsubmit();">
<input type="hidden" name="redirect" value="http://www.teengurus.com/contact.html">
</form>

</div>
</div>

</div>
</body>
</html>
