<?php

    session_start();
    
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
    		
    			$to = 'vivekrag95@gmail.com';  
            	$subject = 'HACK ATTEMPT';
            	$header = 'From: vivekrag95@gmail.com';
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
        if (isset($_POST['busname'])) {
        
            // Building a whitelist array with keys which will send through the form, no others would be accepted later on
            $whitelist = array('token','busname','problem','email','phone','details','name');
            
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
			$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
			$message .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
			$message .= "<tr><td><strong>Business:</strong> </td><td>" . strip_tags($_POST['busname']) . "</td></tr>";
			$message .= "<tr><td><strong>Problem:</strong> </td><td>" . strip_tags($_POST['problem']) . "</td></tr>";
			$message .= "<tr><td><strong>Details:</strong> </td><td>" . strip_tags($_POST['details']) . "</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";
			
			
			
			
			//  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
			
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
            if (preg_match($pattern, trim(strip_tags($_POST['email'])))) { 
                $cleanedFrom = trim(strip_tags($_POST['email'])); 
            } else { 
                return "The email address you entered was invalid. Please try again!"; 
            } 
			
			
            
            
            //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
             
			$to = 'vivekrag95@gmail.com';
			
			$subject = 'Work Request';
			
			$headers = "From: " . $cleanedFrom . "\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if (mail($to, $subject, $message, $headers)) {
              echo 'Your message has been sent.';
            } else {
              echo 'There was a problem sending the email.';
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
        
        }
    } else {
    
   		if (!isset($_SESSION[$form.'_token'])) {
   		
   		} else {
   			echo "Hack-Attempt detected. Got ya!.";
   			writeLog('Formtoken');
   	    }
   
   	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TeenGurus</title>
<link type="text/css" rel="stylesheet" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'><!--Open Sans-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--<script src="js/jquery.min.js" type="text/javascript"></script>-->

<script src="js/jquery.scrollTo.js" type="text/javascript"></script>
<script src="js/jquery.localScroll.js" type="text/javascript"></script>
<script src="js/jquery.scrollorama.js" type="text/javascript"></script>

<script type="text/javascript">
		jQuery(function( $ ){
			/**
			 * Most jQuery.localScroll's settings, actually belong to jQuery.ScrollTo, check it's demo for an example of each option.
			 * @see http://flesler.demos.com/jquery/scrollTo/
			 * You can use EVERY single setting of jQuery.ScrollTo, in the settings hash you send to jQuery.LocalScroll.
			 */
			
			// The default axis is 'y', but in this demo, I want to scroll both
			// You can modify any default like this
			$.localScroll.defaults.axis = 'xy';
			
			// Scroll initially if there's a hash (#something) in the url 
			$.localScroll.hash({
				target: '#content', // Could be a selector or a jQuery object too.
				queue:true,
				duration:1500
			});
			
			/**
			 * NOTE: I use $.localScroll instead of $('#navigation').localScroll() so I
			 * also affect the >> and << links. I want every link in the page to scroll.
			 */
			$.localScroll({
				//target: '#content', // could be a selector or a jQuery object too.
				queue:true,
				duration:1500,
				hash:true,
				/*onBefore:function( e, anchor, $target ){
					// The 'this' is the settings object, can be modified
				},
				onAfter:function( anchor, settings ){
					// The 'this' contains the scrolled element (#content)
				}*/
			});
		});
	</script>
    
<script type="text/javascript">
		jQuery(function( $ ){

			$.localScroll.defaults.axis = 'xy';		

			$.localScroll.hash({
				target: '#window', 
				queue:true,
				duration:1500
			});
			
			$.localScroll({
				target: '#window', 
				queue:true,
				duration:1500,
				hash:true,

			});
		});
	</script>


<script>
		$(window).on("load resize", function(){
			var div = $("#header");
			var divwidth = div.width();
			document.getElementById("header").style.marginLeft= 0-divwidth/2 + "px";
			var windheight = $(window).height();
			var windwidth = $(window).width();
			document.getElementById("container1").style.height=windheight+100+"px";
			document.getElementById("container3").style.height=windheight+"px";
			document.getElementById("container5").style.height=windheight+"px";
			document.getElementById("container7").style.height=windheight+"px";
			document.getElementById("container9").style.height=windheight+"px";                 			
			});
			
		var solutions = ["Lorem", "Ipsum", "Dolor"];
		var count = 1;
			setInterval(function(){    
    		$("#solutiontype").fadeOut(400, function(){        
        		$(this).html(solutions[count]);        
        		count++;        
        		if(count == solutions.length)            
            		count = 0;        
        		$(this).fadeIn(400);    
   				});
			}, 2500);

		
</script>

<script>
	function modalOne(){$("body").toggleClass("modalup1");};
		
	function modalTwo(){$("body").toggleClass("modalup2");};
		
	function modalThree(){$("body").toggleClass("modalup3");};
	
	function modalFour(){$("body").toggleClass("modalup4");};

</script>


</head>

<?php
   // generate a new token for the $_SESSION superglobal and put them in a hidden field
	$newToken = generateFormToken('form1');   
?>

<body>



<!--------------------------------------------------Navigation------------------------------------------------------------>
	<div class="header" id="header" >
    	<a href="#container1"><div class="headerlink">Home</div></a>
        <a href="#container2"><div class="headerlink">Solutions</div></a>
        <a href="#container4"><div class="headerlink">Pricing</div></a>
        <a href="#container6"><div class="headerlink">The Team</div></a>
        <a href="#container8"><div class="headerlink">Contact</div></a>
    </div>

<!--------------------------------------------------Modal Boxes------------------------------------------------------------>  
    <div id="modalone">
    	<div style="width:100%; height:70px; font-size:280%; padding-top:8px; text-align:center; background-color:rgb(0,163,217);">Technology Solutions</div>
        <div class="modalcontent">
            <ul>
                <li>Details go here</li>
            </ul>
        </div>
    	<a href="javascript:modalOne()">
        	<div class="solidbluebutton" style="position:absolute; right:10px; bottom:10px; width:100px; height:36px; font-size:18px; padding-top:3px; border-width:1px; border-color: rgb(0,163,217); border-style:solid;">Close</div>
        </a>
    </div>
    
    <div id="modaltwo">
        <div style="width:100%; height:70px; font-size:300%; padding-top:8px; text-align:center; background-color:rgb(97,169,48);">Marketing Solutions</div>
        <div class="modalcontent">
        	<ul>
            	<li>Details go here</li>
            </ul>
        </div>
    	<a href="javascript:modalTwo()">
    		<div class="solidgreenbutton" style="position:absolute; right:10px; bottom:10px; width:100px; height:36px; font-size:18px; padding-top:3px; border-width:1px; border-color: rgb(97,169,48); border-style:solid;">Close</div>
        </a>
    </div>
    
    <div id="modalthree">
    	<div style="width:100%; height:70px; font-size:300%; padding-top:8px; text-align:center; background-color:rgb(198,79,0);">Human Solutions</div>
        <div class="modalcontent">
            <ul>
            	<li>Details go here</li>
            </ul>
        </div>
    	<a href="javascript:modalThree()">
    	<div class="solidorangebutton" style="position:absolute; right:10px; bottom:10px; width:100px; height:36px; font-size:18px; padding-top:3px; border-width:1px; border-color: rgb(198,79,0); border-style:solid;">Close</div>
        </a>
    </div>
    
<!----------------------------------------------------Content-------------------------------------------------------------->  
<div id="content">   
<!---------------------------------------------------CONTAINER 1----------------------------------------------------------->

    <div class="container1" id="container1" style="background-image:url(images/mountains-skysmallest.jpg); margin-top:-100px;">
    	<div style="position:absolute; top:50%; left:50%; margin-left:-250px; margin-top:-75px; width:500px; height:150px;">
        	<img src="images/Teen Gurus Logo 7.0.png" width="100" style="position:relative; margin-left:200px;" />
            <h1 style="text-shadow:0px 0px 3px #999; text-align:right; font-size:275%; margin-right:105px;"><span id="solutiontype">Dolor</span> Solutions.</h1>
        </div> 
        
        <a href="#container2">
        	<div class="solidgreenbutton" style="height:40px; width:170px; margin-left:-85px; position:absolute; bottom:0%; left:50%;">
            	<div style="position:relative; font-size:20px; top:5px;">Find Out How</div>
            </div>
        </a> 
    </div>
<!-- end container1-->


<!---------------------------------------------------CONTAINER 2----------------------------------------------------------->
    <div class="container2" id="container2">
        
        <a href="#one">
        	<div class="hollowbluebutton" style="height:40px; width:150px; margin-left:-275px; position:absolute; bottom:30px; left:50%;">
            	<div style="position:relative; font-size:20px; top:5px;">Lorem</div>
            </div>
        </a>
        
    	<a href="#two">
        	<div class="hollowgreenbutton" style="height:40px; width:150px; margin-left:-85px; position:absolute; bottom:30px; left:50%;">
            	<div style="position:relative; font-size:20px; top:5px;">Ipsum</div>
            </div>
        </a>
        
        <a href="#three">
        	<div class="holloworangebutton" style="height:40px; width:150px; margin-left:105px; position:absolute; bottom:30px; left:50%;">
            	<div style="position:relative; font-size:20px; top:5px;">Dolor</div>
            </div>
        </a>      
    
    	<div class="window" id="window">
        	<div id="subwindow" style="white-space:nowrap; width:auto">
                <div class="windowcontent" id="one">
                	<img src="images/minimac2.png" style="position:absolute; left:50px; top:75px; z-index:0;" />
                    <img src="images/Email.png" style="position:absolute; left:463px; top:399px; width:220px; height:auto; z-index:1;" />
                	<img src="images/call.png" style="position:absolute; left:95px; top:387px; width:237px; height:auto; z-index:1;" />
                    <div style="position:absolute; left:742px; top:173px; width:160px; height:auto;"><h1 style="color:rgb(0,204,255); font-size:250%; text-align:center;">Lorem<br/>Solutions</h1></div>
                    <a href="javascript:modalOne()">
                    <div class="solidbluebutton" style="position:absolute; left:753px; top:292px; width:150px; height:40px; font-size:22px; padding-top:3px;">Details</div>
                    </a>
                </div><!--end one-->
                
                <div class="windowcontent" id="two">
                	<img src="images/flyer.fw.png" style="position:absolute; left:100px; top:55px; z-index:0;" />
                    <img src="images/facebook.png" style="position:absolute; left:390px; top:290px; width:137px; height:auto; z-index:1; " />
                    <img src="images/twitter.png" style="position:absolute; left:484px; top:318px; width:127px; height:auto; z-index:2;" />
                    <img src="images/google.png" style="position:absolute; left:442px; top:369px; width:86px; height:auto; z-index:3;" />
                    <img src="images/MVDECA Business Card Back.png" style="position:absolute; left:147px; top:441px; width:234px; height:auto; z-index:4; box-shadow:0 1px 2px rgba(50,50,50,0.5);" />
                    <img src="images/Vivek Raghuram.png" style="position:absolute; left:296px; top:461px; width:234px; height:auto; z-index:5; box-shadow:0 1px 2px rgba(50,50,50,0.5);" />
                    <div style="position:absolute; left:742px; top:173px; width:160px; height:auto;"><h1 style="color:rgb(113,198,55); font-size:250%; text-align:center;">Ipsum<br/>Solutions</h1></div>
                    <a href="javascript:modalTwo()">
                    <div class="solidgreenbutton" style="position:absolute; left:753px; top:292px; width:150px; height:40px; font-size:22px; padding-top:3px;">Details</div>
                    </a>
                </div><!--end two-->
                
                <div class="windowcontent" id="three">
                	<img src="images/store.png" style="position:absolute; left:90px; top:208px; width:256px; height:auto; z-index:0;" />
                	<img src="images/Document.png" style="position:absolute; left:246px; top:347px; width:auto; height:166px; z-index:1;" />
                    <img src="images/admin.png" style="position:absolute; left:330px; top:148px; width:auto; height:244px; z-index:2;" />
                    <img src="images/user.png" style="position:absolute; left:432px; top:226px; width:auto; height:244px; z-index:3;" />
                	<div style="position:absolute; left:742px; top:173px; width:160px; height:auto;"><h1 style="color:rgb(255,102,0); font-size:250%; text-align:center;">Dolor<br/>Solutions</h1></div>
                    <a href="javascript:modalThree()">
                    <div class="solidorangebutton" style="position:absolute; left:753px; top:292px; width:150px; height:40px; font-size:22px; padding-top:3px;">Details</div>
                    </a>
                </div><!--end three-->
                
            </div>
        </div>
	</div>
<!-- end container2-->

<!---------------------------------------------------CONTAINER 3----------------------------------------------------------->

	<div class="container3" id="container3" style="	background-image:url(images/citysmallest.jpg);">
        	<div class="imgtext">REVOLUTIONIZE YOUR BUSINESS</div>
    </div>

<!---------------------------------------------------CONTAINER 4----------------------------------------------------------->

	<div class="container2" id="container4">
    	<div class="slider1"><!--start containment capsule of the model stuff-->
    		<div class="modelgoals">
    			<font style="font-size:250%;">Our Goals</font>
            	<div style="padding-left:8px;">
            		<font style="font-size:200%"> We had a few goals when starting this project:</font><br/>
            		<!--<h2 style="font-size:12px;">(Ranked in order)</h2>-->
            		<font style="font-size:21px; line-height:185%;">
            		- Help the Community<br />
            		- Employ Locals<br />
            		- Improve Local Business<br />
            		- Utilize Talents<br />
            		- Gain Experience<br />
            		- Learn<br />
            		- Network<br />
            		<font style="color:rgb(85,212,0); font-weight:600;">- Spread Lorem</font>
            		</font>
            	</div>
        	</div>
        	<div style="margin-left:15px; float:left;">
        		<div class="modelexp" style="margin-top:0px; padding-top:20px;">
            		<p style="font-size:21px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras bibendum varius augue. Mauris metus neque, rutrum eu mollis nec, consequat sit amet sem. Aliquam lobortis est a lacus convallis, non dictum purus faucibus. Sed in feugiat <font style="color:rgb(255,102,0);">metus</font>.</p>
        		</div>
            	<div class="modelexp" style="margin-top:20px;"><br /><br />
            		<p style="font-size:21px;"><font style="color:rgb(255,102,0);">Aenean</font> fermentum, velit sed tempus facilisis, ante justo molestie urna, ac imperdiet metus risus a quam. Nam vitae velit pellentesque, pellentesque est non, lacinia diam. Sed sed pellentesque est, non bibendum mi.</p>
        		</div>
        	</div>
        	<div class="modelgoals" style="margin-left:15px;">
            	<font style="font-size:225%;">We earn it by <font style="color:rgb(255,102,0);">loreming</font> you</font>
                <br /><br />
            	<div style="width:100%; text-align:center;"><font style="text-align:center; color:rgb(0,204,255); font-weight:600; font-size:200%;">Lorem Ipsum = Price</font><br /></div><br />
            	<font style="font-size:180%;">Only pay as much as you use the generator. We can always suggest a price but in the end it is your decision.</font>
                <br />
                <div style="height:1px; background-color:#999; width:290px; position:absolute; bottom:100px; margin-left:-3px;">&nbsp;</div>
                <a href="#container8">
                <div class="button">
                	<font style="font-size:195%;">So with no risk, why not give us a shot?</font>
                    <!--<img src="images/arrow.png" style="position:absolute; right:10px; top:60px; border:none;" height="24"/>-->
                </div>
                </a>
    		</div>
        </div><!--end containment capsule of the model stuff and da slider!!!!! woooot-->
    	
    </div>
<!--end container 4-->


<!---------------------------------------------------CONTAINER 5----------------------------------------------------------->

	<div class="container3" id="container5" style="	background-image:url(images/mountainsmallest.jpg);">
        	<div class="imgtext">CONQUER ANY CHALLENGE</div>
    </div>
    
    
<!---------------------------------------------------CONTAINER 6----------------------------------------------------------->
   
    <div class="container2" id="container6">
		<div class="teamsupercontainer">    
            <div class="teamcontainer" style="left:0%;">
                <div class="teamimage">
                    <img src="images/vivek.png" />
                </div>
                <div class="teamsub" id="id1match">
                    <h1 style="color:rgb(255,102,0);">Vivek Raghuram</h1>
                    <h2 style="color:rgb(255,102,0);">CEO</h2> 
                    <p>He is a freshmen at UC Berkeley. He is experienced in marketing, graphic design and web design and development as well as management of a program to teach over 400 students business and marketing.</p>  
                </div>
            </div>
            
            <div class="teamcontainer" style="left:50%; margin-left:-125px;">
                <div class="teamimage" id="di1">
                    <img src="images/shailee.png" />
                </div>
                <div class="teamsub" id="id1match">
                    <h1 style="color:rgb(113,198,55);">Shailee Samar</h1>
                    <h2 style="color:rgb(113,198,55);">CMO</h2> 
                    <p>She is a Senior at Monta Vista High School. Her experience includes marketing and public relations work not only with campus organizations but also with schools across the district, several local businesses and the Cupertino Chamber of Commerce.</p> 
                </div>
            </div>
            
            <div class="teamcontainer" style="right:0%;">
                <div class="teamimage" id="di1">
                    <img src="images/ani.png" />
                </div>
                <div class="teamsub" id="id1match">
                    <h1 style="color:rgb(0,204,255);">Ani Kunaparaju</h1>
                    <h2 style="color:rgb(0,204,255);">CTO</h2> 
                    <p>He is a Junior at Monta Vista High School. His experience includes the development and management of several websites utilizing a variety of web technologies such as Lorem Ipsum.</p>
                </div>
            </div>
        </div>
    </div>
    
 
<!---------------------------------------------------CONTAINER 7----------------------------------------------------------->

    <div class="container3" id="container7" style="	background-image:url(images/nycitysmallest.jpg);">
        	<div class="imgtext">EXPAND YOUR POSSIBILITIES</div>
    </div>
    

<!---------------------------------------------------CONTAINER 8----------------------------------------------------------->

    <div class="container2" id="container8">
    	<div id="formholder" style="position:absolute; width:800px; top:80px; left:50%; margin-left:-400px; color:inherit;"><!--contact madlib-->
        	<font style="font-size:295%;">
            Hey there,<br />
          <form action="index.php" method="post" id="change-form">
        	  <input type="hidden" name="token" value="<?php echo $newToken; ?>">

			&emsp;My business is called <input type="text" name="busname" class="madlib" />. I'm looking for help with <input type="text" name="problem" class="madlib" style="width:300px;"/>. I am interested in using your services. Please contact me at my email, <input type="text" name="email" class="madlib" />, or my phone number, <input type="text" name="phone" class="madlib" />, so that we can discuss the details of this project. Here are some extra details I want you to know about: <input type="text" name="details" class="madlib" /> I look forward to hearing from you. <br />
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Sincerely,<br />
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="text" name="name" class="madlib" />
            <br />
			<input type="submit" value="Submit!" class="hollowgreenbutton" style="height:40px; width:140px; text-align:center; font-family:'Open Sans' sans serif; font-weight:300; font-size:50%; position:absolute; right:0px;" />
           </form>
			</font>
        </div>
    </div>
<!--end container 8-->
    
    
    
<!---------------------------------------------------CONTAINER 9----------------------------------------------------------->
 
    <div class="container3" id="container9" style="	background-image:url(images/sunriserefugesmallest.jpg);">
        	<div class="imgtext">EMBRACE OPPORTUNITY</div>
    </div>
<!--end container 9-->
    
</div><!--end container-->

</body>
</html>
