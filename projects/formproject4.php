<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product"> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<!-- Use the .htaccess and remove these lines to avoid edge case issues.
			 More info: h5bp.com/b/378 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Project</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="humans.txt">

	<link rel="shortcut icon" href="favicon.png" type="image/png" />

	<!-- Facebook Metadata /-->
	<meta property="fb:page_id" content="" />
	<meta property="og:image" content="" />
	<meta property="og:description" content=""/>
	<meta property="og:title" content=""/>

	<!-- Google+ Metadata /-->
	<meta itemprop="name" content="">
	<meta itemprop="description" content="">
	<meta itemprop="image" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

	<!-- We highly recommend you use SASS and write your custom styles in sass/_custom.scss.
			 However, there is a blank style.css in the css directory should you prefer -->
	<link rel="stylesheet" href="../css/gumby.css">
	<link rel="stylesheet" href="../css/style.css">

	<script src="../js/libs/modernizr-2.6.2.min.js"></script>
</head>



<body>
<div class="wrapper">
	<div class="row">
		<div class="ten columns centered">
			<h1 class="xlarge hovergreen" style="text-align:center">Leave a pin!</h1>
		</div>
	</div>





<?php

$Display = True;

if (isset($_POST['submit'])){

	$con = mysql_connect ("mysql.vivekraghuram.com","vivekraghuram","Mydbpass1");

	if (!$con){
		die("Cannot connect: " . msql_error());
		}

	mysql_select_db("vivekraghuram",$con);
	
	
	$message = $_POST['message'];
	$thename = $_POST['name'];
	
	//add variable stuff here to check empty
	
	if(!empty($message) && !empty($thename)){

		$sql = "INSERT INTO testtwo (message,name) VALUES ('$_POST[message]','$_POST[name]')";

		mysql_query($sql,$con);

		mysql_close($con);
	
		$Display = False;
	}
	
	else{
		?>
		
			<div class="row">
				<div class="ten columns centered">
					<h4 style="text-align:center; color:red;">Complete the form</h4>
				</div>
			</div>
	
		<?
	}
}

if ($Display){
?>
	<div class="row">
		<div class="eight columns centered">
			<form action="formproject3.php" method="post">
				<ul>
					<li class="field"><textarea class="input textarea" name="message" placeholder="Enter your message.." rows="4"></textarea></li>
					<li class="field"><input type="text" name="name" class="text input" placeholder="Who are you?" /></li>
							<li class="field"> Checks
							<label class="checkbox" for="checkbox1">
								<input name="checkbox1" type="checkbox" id="checkbox1" value="one">
								<span></span> Checkbox 1
							</label>
							<label class="checkbox" for="checkbox1">
								<input name="checkbox1" type="checkbox" id="checkbox2" value="two">
								<span></span> Checkbox 2
							</label>
							<label class="checkbox" for="checkbox1">
								<input name="checkbox1" type="checkbox" id="checkbox3" value="three">
								<span></span> Checkbox 3
							</label>
						</li>
					<li style="text-align:center"><input type="submit" name="submit" value="Submit" class="btn medium primary" style="width:100px; color:white;"></li>
					
				</ul>
			</form>
		</div>
	</div>
<?

} else {
	
	$con = mysql_connect ("mysql.vivekraghuram.com","vivekraghuram","Mydbpass1");
	
	mysql_select_db("vivekraghuram",$con);
	
	$query = mysql_query("SELECT * FROM testtwo ORDER BY ID DESC",$con);
	
	WHILE($rows=mysql_fetch_array($query)){
	
		$msg = $rows['message'];
		$name = $rows['name'];
	

	
	
?>
	<div class="row">
		<div class="eight columns centered" style="box-shadow:0px 0px 3px #BBB; padding:5px; font-weight:300;">
			<h3 style="text-align:center" class="onwhite"><?php echo $msg ?></h3>
			<h4 style="text-align:right" class="onwhite">-<?php echo $name ?></h4>
		</div>
	</div>
	<br>

<?

	}
}


?>

</div><!------end wrapper-------->


<!--------------------------------------------SCRIPTS-------------------------------------------------->
 <!-- Grab Google CDN's jQuery, fall back to local if offline -->
  <!-- 2.0 for modern browsers, 1.10 for .oldie -->
  <script>
    var oldieCheck = Boolean(document.getElementsByTagName('html')[0].className.match(/\soldie\s/g));
    if(!oldieCheck) {
      document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"><\/script>');
    } else {
      document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"><\/script>');
    }
  </script>
  <script>
    if(!window.jQuery) {
      if(!oldieCheck) {
        document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
      } else {
        document.write('<script src="js/libs/jquery-1.10.1.min.js"><\/script>');
      }
    }
  </script>

  <!--
  Include gumby.js followed by UI modules.
  Or concatenate and minify into a single file
  <script src="../js/libs/gumby.js"></script>
  <script src="../js/libs/ui/gumby.retina.js"></script>
  <script src="../js/libs/ui/gumby.fixed.js"></script>
  <script src="../js/libs/ui/gumby.skiplink.js"></script>
  <script src="../js/libs/ui/gumby.toggleswitch.js"></script>
  <script src="../js/libs/ui/gumby.checkbox.js"></script>
  <script src="../js/libs/ui/gumby.radiobtn.js"></script>
  <script src="../js/libs/ui/gumby.tabs.js"></script>-->
  <script src="../js/libs/ui/gumby.navbar.js"></script>
  <script src="../js/libs/ui/gumby.fittext.js"></script>
  <script src="../js/libs/ui/jquery.validation.js"></script>
  <script src="../js/libs/gumby.init.js"></script>

  <script src="../js/libs/gumby.min.js"></script>
  <script src="../js/plugins.js"></script>
  <script src="../js/main.js"></script>

  <!-- Change UA-XXXXX-X to be your site's ID -->
  <!--<script>
  window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
  Modernizr.load({
    load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
  });
  </script>-->

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
     chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

  </body>
</html>