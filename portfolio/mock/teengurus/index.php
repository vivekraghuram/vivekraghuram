<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'header.php' ?>

<style type="text/css">
#midtext {position:absolute; bottom:0; left:0;}
</style>

<style type="text/css">

#navtext {position:absolute; bottom:0; right:0;}
#navpic {position:absolute; bottom:0; left:0;}

body {
	font-family: 'PT Sans Narrow', sans-serif;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ this container surrounds all other divs giving them their percentage-based width ~~ */
.container{
	width: 100%;
	background-color: #FFF;
	height:100%;
}

.containernarrow{
	width: 80%;
	max-width: 1440px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
	min-width: 1024px;/* a min-width may be desirable to keep this layout from getting too narrow. This keeps line length more readable in the side columns. IE6 does not respect this declaration. */
	background-color: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
}

.containerwide{
	width:100%;
	min-width:1024px;
	margin: 0 auto;
}

/* ~~the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo~~ */
.header {
	background-color: #FAFFFF;
	height:105px;
	position:relative;
	
	width: auto;
	max-width: 1440px;
	min-width: 1024px;
	margin: 0 auto;
}

/* ~~ This is the layout information. ~~ 

1) Padding is only placed on the top and/or bottom of the div. The elements within this div have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

*/
.content {
	padding: 10px 0;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script> 
<script src="jquery.localscroll.js" type="text/javascript"></script> 
<script src="jquery.scrollTo.js" type="text/javascript"></script> 

<script type="text/javascript">
$(document).ready(function() {
  $('#nav1').localScroll({duration:800});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#nav2').localScroll({duration:800});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#nav3').localScroll({duration:800});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#nav4').localScroll({duration:800});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#nav5').localScroll({duration:800});
});
</script>

<div class="container">

    

<!-- Main Page -->



	<div class="middle">
		<div class="middlenarrow" align="center" style="height:480px;">
        	<div align="left" id="midtext" style="margin-bottom:30px; margin-left:5px; font-size:24px; width:417px;" >TeenGurus.com provides a forum to connect teens with the community through micro-jobs such as tutoring and coaching, babysitting, and running errands and internships. Through these local micro-jobs, teenagers develop a strong work ethic and learn skills such as responsibility, accountability, and time management. </div>
            <div align="center" style="margin:0 auto; width:319px; height:442px; position:absolute; left:50%; margin-left:-160px; bottom:0;"><img src="Teen Gurus Logo 2.0.png" /></div>
            <div align="center" style="margin:0 auto; width:140px; height:180px; position:absolute; left:50%; margin-left:90px; bottom:0;"><img src="Teen Gurus Logo 4.0.png" width="140" height="180" /></div>
        	<div align="right" id="navtext" style="margin-right:5px;"><img src="Teen Gurus Logo 1.3.png" height="250" /></div>       
		</div><!--end middlenarrow-->
	</div><!--end middle-->
        
    	<div class="containerwide" style="background-color:#CECEBF; height:250px; position:relative;">
    		<div style="position:absolute; left:30%; top:7%;"><a href="http:\\www.google.com"><div class="circle" style="position:relative;"><div style="position:absolute; top:37%; left:17%;">BE A GURU</div></div></a></div>
        	<div style="position:absolute; right:30%; top:7%;"><a href="http:\\www.google.com"><div class="circle" style="position:relative;"><div style="position:absolute; top:37%; left:10%;">FIND A GURU</div></div></a></div>
    
    	</div><!--end containerwide-->
  
  
<!--About page-->  
    	<div class="containerwide" style="background-color:#333; height:1200px;">
        	<div class="middlenarrow" style="position:relative;">
            	<div id="nav2" style="position:absolute; right:5px; top:150px; font-size:20px; color:#FFF;"><a href="#top" class="linkwhite" name="howitworks">^ Back to Top ^</a></div>                
            	<div style="position:absolute; left:5px; top:180px; font-size:88px; color:#7ACB44;">How it Works</div>
        		<div style="position:absolute; left:40px; top:300px; font-size:36px; color:#FFF;">Our Model</div>
                <div style="position:absolute; left:100px; top:355px; font-size:20px; color:#FFF; width:750px;">Since TeenGurus serves to connect teens with local residents for jobs, we serve two markets: teens and employers.  Based on which job is being performed, the employers include students, parents, families, and businesses. TeenGurus.com provides a forum to connect teens with the community through micro-jobs such as tutoring and coaching, babysitting, and running errands.  Through these local micro-jobs, teenagers develop a strong work ethic and learn skills such as responsibility, accountability, and time management.  Having acquired these essential skills, the teens have a higher chance of being hired by local businesses for long-term jobs and internships.</div>
        		<div style="float:right; margin-top:340px; margin-right:50px;"><img src="Teen Gurus Logo 2.0.png" /></div>
                <div style="position:absolute; left:40px; top:540px; font-size:36px; color:#FFF;">The Guru Advantage</div>
                <div style="position:absolute; left:80px; top:580px; font-size:28px; color:#FFF;">For Teens</div>
        		<div style="position:absolute; left:100px; top:625px; font-size:20px; color:#FFF; width:750px;"> Teens create a public profile that lists their areas of expertise such as math, writing, or baseball, along with the age/level of the tutee they are willing to help. In order to teach or coach, teens must have certain credentials such as having an “A” in the particular course or participating in the school’s sport team. For non-tutor work, teens must list other relevant experiences or testimonials from the community. If the teen plans on interning in the future, a work permit is also required.</div>
                <div style="position:absolute; left:80px; top:760px; font-size:28px; color:#FFF;">For Employers</div>
				<div style="position:absolute; left:100px; top:800px; font-size:20px; color:#FFF; width:750px;"> In TeenGurus.com, interested employers such as students, families, and companies can find teen gurus for a specific job using different parameters such as relevant skills, ratings, and hours worked.  Teens charge $12-$30 per hour. </div>
        	</div>
        </div>
<!--End about page-->

<!--How it works page-->
		<div class="containerwide" style="background-color:#DFDFD0; height:1200px;">
        	<div class="middlenarrow" style="position:relative;">
            	<div id="nav3" style="position:absolute; right:5px; top:150px; font-size:20px; color:#555;"><a href="#top" class="linkgrey" name="aboutus">^ Back to Top ^</a></div>                
            	<div style="position:absolute; left:5px; top:180px; font-size:88px; color:#00CCFF;">About Us</div>
        		<div style="position:absolute; left:530px; top:300px; font-size:36px; color:#555;">Our Mantra</div>
                <div style="position:absolute; left:590px; top:355px; font-size:20px; color:#555; width:750px;"> While adults have been impacted by the current recession, teenagers have been hit even harder and their employment rates have plummeted. Even with the strong Silicon Valley economy, California’s teen unemployment rate is the highest in the nation and currently stands at 36.2%.   Many employers believe that the youth currently do not have the skills required for the jobs, but ironically working is the only way to develop these important skills. Teens are currently lacking in "the habits of paid work,” such as collaborating as a team, staying focused, and properly finishing tasks.</div>
        		<div style="float:left; margin-top:340px; margin-left:50px;"><img src="Teen Gurus Logo 4.0.png" height="450px"/></div>
                <div style="position:absolute; left:530px; top:530px; font-size:36px; color:#555;">Founders</div>
                <div style="position:absolute; left:570px; top:580px; font-size:28px; color:#555;">Vivek Raghuram</div>
        		<div style="position:absolute; left:590px; top:625px; font-size:20px; color:#555; width:750px;"> Vivek Raghuram is the CEO and co-founder of TeenGurus.  As a senior and an officer of Monta Vista DECA, he has gained valuable experience with managing and organizing teams and will connect TeenGurus to other Silicon Valley DECA chapters for expansion.  Vivek has gained work experience by interning at Smart Monitor, a local start-up. He brings a thorough knowledge of business, finance, and marketing as well as the leadership and organizational abilities to keep this company moving forward.    
</div>
                <div style="position:absolute; left:570px; top:760px; font-size:28px; color:#555;">Shailee Samar</div>
				<div style="position:absolute; left:590px; top:800px; font-size:20px; color:#555; width:750px;"> Shailee Samar is the Chief Marketing Officer CMO and co-founder of TeenGurus.  She brings the perfect mixture of leadership and experience gained from working with key community organizations such as the Cupertino City Council, local businesses, and Cupertino Chamber of Commerce.  She has collaborated with schools, City commissions, and PTAs across Bay Area and is currently a student representative to the School Site Council of Monta Vista High School.  Her connections will prove invaluable for implementing programs in schools, expanding to other cities, and securing internships.</div>
        	</div>
        </div>
        
<!--end how it works-->




	<div class="containerwide" style="background-color:#EEEEEE;">    
  		<div class="footer">
    			<div style="position:absolute; left:5px; font-size:18px; color:#555;">
                	<font color="#333" style="font-size:24px;"><a name="contactus">Contact:</a></font><br /><br />
                	&nbsp;Email: <a href="mailto:info@teengurus.com" class="linkgrey">info@teengurus.com</a><br /><br />
                    &nbsp;Phone: (408) 555-7956<br /><br />
                    &nbsp;21840 McClellan Road<br />
                    &nbsp;Cupertino, CA 95014 
                    </div>
                <div style="position:absolute; left:35%; margin-left:-50; font-size:18px; color:#555;">
                	<font color="#333" style="font-size:24px;">Connect:</font><br /><br />
                    &nbsp;<a href="http:\\www.facebook.com" class="linkgrey">Facebook</a><br /><br />
                    &nbsp;<a href="http:\\www.twitter.com" class="linkgrey">Twitter</a>                  
                    </div>
                <div id="nav4" style="position:absolute; left:65%; margin-left:-50; font-size:18px; color:#555;">
                	<font color="#333" style="font-size:24px;">Navigate:</font><br /><br />
                	&nbsp;<a href="#aboutus" class="linkgrey">About Us</a><br /><br />
                    &nbsp;<a href="#howitworks" class="linkgrey">How it Works</a><br /><br />
                    &nbsp;<a href="#contactus" class="linkgrey">Contact Us</a>
                    </div>
            	<div id="nav5" style="position:absolute; right:5px; color:#555; text-align:right;">
                	<a href="#top"><img src="Teen%20Gurus%20Logo%201.3.png" height="60" style="margin-top:10px;"/></a><br /><br />
                    &copy; 2012 Teen Gurus.<br />
                    All Rights Reserved.
                	
            </div><!-- keeps footer small end-->
    	<!-- end .footer --></div>
  	<!-- end .containerwide --></div>
<!-- end .container--></div>    

</body>
</html>
<em></em>