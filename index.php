<?php

    session_start();
	
	$Display = true;
    
    function getRealIp() {
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
         $ip=$_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
         $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
         $ip=$_SERVER['REMOTE_ADDR'];
       }
       return $ip;
    }

    function writeLog($where) {
    
    	$ip = getRealIp(); // Get the IP from superglobal
    	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
    	$date = date("d M Y");
    	
    	// create a logging message with php heredoc syntax
    	$logging = <<<LOG
    		\n
    		<< Start of Message >>
    		There was a hacking attempt on your form. \n 
    		Date of Attack: {$date}
    		IP-Adress: {$ip} \n
    		Host of Attacker: {$host}
    		Point of Attack: {$where}
    		<< End of Message >>
LOG;
// Awkward but LOG must be flush left
    
            // open log file
    		if($handle = fopen('hacklog.log', 'a')) {
    		
    			fputs($handle, $logging);  // write the Data to file
    			fclose($handle);           // close the file
    			
    		} else {  // if first method is not working, for example because of wrong file permissions, email the data
    		
    			$to = 'me@vivekraghuram.com';  
            	$subject = 'HACK ATTEMPT';
            	$header = 'From: me@vivekraghuram.com';
            	if (mail($to, $subject, $logging, $header)) {
            		echo "Sent notice to admin.";
            	}
    
    		}
    }

    function verifyFormToken($form) {
        
        // check if a session is started and a token is transmitted, if not return an error
    	if(!isset($_SESSION[$form.'_token'])) { 
    		return false;
        }
    	
    	// check if the form is sent with token in it
    	if(!isset($_POST['token'])) {
    		return false;
        }
    	
    	// compare the tokens against each other if they are still the same
    	if ($_SESSION[$form.'_token'] !== $_POST['token']) {
    		return false;
        }
    	
    	return true;
    }
    
    function generateFormToken($form) {
    
        // generate a token from an unique value, took from microtime, you can also use salt-values, other crypting methods...
    	$token = md5(uniqid(microtime(), true));  
    	
    	// Write the generated token to the session variable to check it against the hidden field when the form is sent
    	$_SESSION[$form.'_token'] = $token; 
    	
    	return $token;
    }
    
    // VERIFY LEGITIMACY OF TOKEN
    if (verifyFormToken('form1')) {
    
        // CHECK TO SEE IF THIS IS A MAIL POST
        if (isset($_POST['name'])) {
        
            // Building a whitelist array with keys which will send through the form, no others would be accepted later on
            $whitelist = array('token','name','email','message');
            
            // Building an array with the $_POST-superglobal 
            foreach ($_POST as $key=>$item) {
                    
                    // Check if the value $key (fieldname from $_POST) can be found in the whitelisting array, if not, die with a short message to the hacker
            		if (!in_array($key, $whitelist)) {
            			
            			writeLog('Unknown form fields');
            			die("Hack-Attempt detected. Please use only the fields in the form");
            			
            		}
            }
            
            
    
    
            
            
            
            // PREPARE THE BODY OF THE MESSAGE

			$message = '<html><body>';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
			$message .= "<tr><td><strong>Contact:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
			$message .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";
			
			
			
			
			/*  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
			
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
            if (preg_match($pattern, trim(strip_tags($_POST['email'])))) { 
                $cleanedFrom = trim(strip_tags($_POST['email'])); 
            } else { 
                return "The email address you entered was invalid. Please try again!"; 
            } 
			
			*/
            
            
            //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
             
			$to = 'me@vivekraghuram.com';
			
			$subject = 'Work Contact';
			
			$headers = "From: me@vivekraghuram.com\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if (mail($to, $subject, $message, $headers)) {
				//echo header("Location: http://www.vivekraghuram.com/index.php");
              //echo 'Your message has been sent.';
			  $Display = false;
            } else {
              echo 'There was a problem sending the email.';
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            //die();
			
        
        }
    } else {
    
   		if (!isset($_SESSION[$form.'_token'])) {
   		
   		} else {
   			echo "Hack-Attempt detected. Got ya!.";
   			writeLog('Formtoken');
   	    }
   
   	}

?>

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

	<title>Vivek Raghuram</title>
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
	<link rel="stylesheet" href="css/gumby.css">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/libs/modernizr-2.6.2.min.js"></script>
</head>

<?php
   // generate a new token for the $_SESSION superglobal and put them in a hidden field
	$newToken = generateFormToken('form1');   
?>

<body>
<!-------------------------------------------INTRO CONTENT--------------------------------------------------->    

	<div class="wrapper highest">
        <div class="row">
            <div class="twelve columns centered" style="text-align:center;">
                <h1 class="xxlarge hoverblue" >Welcome</h1>
                <h3 class="hovergreen" >You've reached the personal website of Vivek Raghuram</h3>
                <h1 class="xlarge hoverblue" >Scroll Down</h1>
                <h1 class="xlarge skiplink" ><a href="#" gumby-goto="#lg" gumby-offset="-60"><i class="icon-down-open-mini hovergreen"></i></a></h1>
            </div>
        </div>
    </div>


<!-------------------------------------------NAVBAR-------------------------------------------------->
	<div class="navbar" id="nav1" gumby-fixed="top">
		<div class="row">
			<a class="toggle" gumby-trigger="#nav1 > .row > ul" href="#"><i class="icon-menu"></i></a>
			<ul class="twelve columns">
				<li class="skiplink"><a href="#" gumby-goto="#lg" gumby-offset="-60">Logos</a></li>
				<li class="skiplink"><a href="#" gumby-goto="#bc" gumby-offset="-60">Business Cards</a></li>
				<li class="skiplink"><a href="#" gumby-goto="#wb" gumby-offset="-60">Websites</a></li>
                <li class="skiplink"><a href="#" gumby-goto="#ct" gumby-offset="-60">Contact</a></li>
			</ul>
		</div>
	</div><!--END NAVBAR-->
    
<!-----------------------------------------CONTENT------------------------------------------------>    
    <div class="wrapper dark" id="lg">
    	<div class="row">
        	<div class="six columns centered">
                <img src="img/logo550.png">
            </div>
        </div>
    	<div class="row">
        	<div class="four columns">
            	<h2>Recognition</h2>
                <p>A memorable logo is critical to brand recognition. It should stick in a viewer's mind. A great logo will become synonymous with your brand.</p>
            </div>
            <div class="four columns">
            	<h2>Versatility</h2>
                <p>Well designed logos should be technically versatile for use on all kinds of material in all kinds of locations. Wherever it goes it should scream your brand.</p>
            </div>
            <div class="four columns">
            	<h2>Harmony</h2>
                <p>Your brand is a story and your logo is the summary. It should harmonize with all aspects of the brand and contribute to its strength.</p>
            </div>
        </div>
    </div>


	<div class="wrapper" id="bc">
    	<div class="row">
        	<div class="six columns centered">
                <img src="img/business cards550.png">
            </div>
        </div>
    	<div class="row">
        	<div class="four columns">
            	<h2 class="onwhite">Impression</h2>
                <p class="onwhite">You have only one chance to make a first impression. A great business card should make it powerful, make it last.</p>
            </div>
            <div class="four columns">
            	<h2 class="onwhite">Differentiation</h2>
                <p class="onwhite">Be distinctive. Have your business card stand out from all the others in a stack. Be noticed.</p>
            </div>
            <div class="four columns">
            	<h2 class="onwhite">Consistency</h2>
                <p class="onwhite">Build your brand, your story, from the very first moment. You business card should be consistent in design and message with your brand.</p>
            </div>
        </div>
    </div>

	<div class="wrapper dark" id="wb">
    	<div class="row">
        	<div class="eight columns centered">
                <img src="img/iMacscreenshot650.png">
            </div>
        </div>
    	<div class="row">
        	<div class="four columns">
            	<h2>Simplicity</h2>
                <p>Your website should be clear and straightforward. It should get the job done in a beautifully simple way.</p>
            </div>
            <div class="four columns">
            	<h2>Responsiveness</h2>
                <p>Whether viewed on a smartphone or tablet or laptop, your website should respond accordingly and still deliver the same outstanding experience.</p>
            </div>
            <div class="four columns">
            	<h2>Unity</h2>
                <p>Your story, your brand, should echo throughout the site giving the viewer a clear picture of you and your organization.</p>
            </div>
        </div>
    </div>
    
    <div class="wrapper" id="ct">
    	<div class="row">
        	<div class="ten columns centered" style="text-align:center;">
            	<h1 class="xlarge hoverblue">Who's telling your story?</h1>
                <p class="btn medium default">
                	<a href="#"  class="toggle" gumby-trigger="#drawer1">About</a>
                </p>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<p class="btn medium default">
                	<a href="project.html" >Projects</a>
                </p>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<p class="btn medium default">
                	<a href="portfolio.html" >Portfolio</a>
                </p>
                <div class="row">
                	<div class="twelve columns centered">
                        <div class="drawer" id="drawer1" style="text-align:center;">
                        	<h2 class="onwhite">About</h2>
                            <p class="onwhite">I am currently a student attending UC Berkeley. I am fascinated by the convergence of marketing and technology and using those tools I want to tell the stories of brands. Hopefully I can help you tell your story. Fill out the form below and I can give you a quote. If you represent a non-profit with a noble cause and I have the time, I don't mind working for free.</p>
                    	</div>
                    </div>
                </div>
			<?php
			if ($Display){
			?>
                <form action="index.php" method="post" id="change-form">
                   	<input type="hidden" name="token" value="<?php echo $newToken; ?>" />
                	<ul>
                    	<li class="field"><input class="text input" name="name" type="text" placeholder="How may I address you?" /></li>
                        <li class="field"><input class="email input" name="email" type="text" placeholder="How may I contact you?" /></li>
                        <li class="field"><textarea class="input textarea" name="message" placeholder="How may I help you?" rows="4"></textarea></li>
                        <li style="text-align:center;"><input type="submit" value="Submit" class="btn medium primary" style="width:100px; color:white;"/></li>
                    </ul>
                </form>
			<?
			} else {
			?>
			<div class="row">
				<h2 class="onwhite hovergreen">Your message has sent!</h2>
				<br><br>
			</div>
			<? 
			}
			?>
            </div>
        </div>
       	<div class="row">
            <div class="six columns centered">
                <div class="four columns" style="text-align:center; margin-bottom:5px;">
                    <div class="medium secondary btn"><a href="http://vivekraghuram.tumblr.com/">tumblr</a></div>
                </div>
                <div class="four columns" style="text-align:center; margin-bottom:5px;">
                    <div class="medium secondary btn"><a href="mailto:me@vivekraghuram.com">email</a></div>
                </div>
                <div class="four columns" style="text-align:center; margin-bottom:5px;">
                    <div class="medium secondary btn"><a href="http://www.linkedin.com/profile/view?id=130087505&trk=nav_responsive_tab_profile">linkedin</a></div>
                </div>
            </div>
        </div>
    </div>
    






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
  Or concatenate and minify into a single file-->
  <script src="js/libs/gumby.js"></script>
  <!--<script src="js/libs/ui/gumby.retina.js"></script>-->
  <script src="js/libs/ui/gumby.fixed.js"></script>
  <!--<script src="js/libs/ui/gumby.skiplink.js"></script>
  <script src="js/libs/ui/gumby.toggleswitch.js"></script>
  <script src="js/libs/ui/gumby.checkbox.js"></script>
  <script src="js/libs/ui/gumby.radiobtn.js"></script>
  <script src="js/libs/ui/gumby.tabs.js"></script>-->
  <script src="js/libs/ui/gumby.navbar.js"></script>
  <script src="js/libs/ui/gumby.fittext.js"></script>
  <!--<script src="js/libs/ui/jquery.validation.js"></script>
  <script src="js/libs/gumby.init.js"></script>-->

  <script src="js/libs/gumby.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

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