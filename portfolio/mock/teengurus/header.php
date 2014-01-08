<?php
	$sid = session_id();
	if($sid) {
?>
	<link href='index.css' rel='stylesheet' type='text/css' />

<!--Adding Default CSS Document-->
<link href='css/thrColFixHdr.css' rel='stylesheet' type='text/css' />

<!--BEGIN ADDING FONT-->
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
<!--END FONT ADDITION-->

<!--Call Latest JQuery plugin -->
<script src='http://code.jquery.com/jquery-latest.js'></script>
<!--END CALL Latest JQuery plugin-->

<!--Create fade and hover Jquery usage-->
	<script>
        $('#navigation').mouseover(function(){
            $('#arrow-up').show();
        })
        $('#navigation').mouseout(function(){
            $('#arrow-up').hide();
        })
    </script>
<!--End Jquery -->

<!--Begin the Tipue Search Addition Code-->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400|Open+Sans:300,400' rel='stylesheet'>
    <link href='tipuesearch/tipuesearch.css' rel='stylesheet'>
    <script src='tipuesearch/tipuesearch_set.js'></script>
    <script src='tipuesearch/tipuesearch.js'></script>
<!--Integration Created-->

</head>
<body>

<div class='top_greenbar'>
<!--The top green accent bar that creates the effect-->
</div>

<!--Begin the content portion of the NO SESSION header-->
<div class='content_arena'>

    <!--Insert the logo of TeenGurus-->
    <div class='logo_container'>
    <img width='115px' src='images/logo.png' alt='TeenGurus, LLC'>
    </div>	

	<div style="float:left; margin-top:35px; margin-left:40px;">
    <img src="images/accounts/nopic_thumbnail.png" width="50px"/>
    <div style="margin-top:-50px; margin-bottom:0px; margin-left:60px; font-size:100%/0.9; width:150px;">Vivek Raghuram</div><br />
    <p style="margin-top:-30px; margin-left:45px; font-size:14px;">Sign Out</p>
    </div>

    <!--Creating the navbar when no session login is present-->
    <div class='navigation'>

    <!--Default navbar functions carry throughout, but change depending on session value-->
    	<a class='navbar' href='#'>	THE GURUS </a>
        <a class='navbar' href='#'>	HOW WE WORK </a>
    <!--End default navigation bar functions -- only occur on null session id-->
    </div>
    
    <!--Insert the Search functionality-->
    <!--Integration of Tipue Search occurs here-->
    <div class='search_form_log'>
        <form action='search.html'>
        <div style='float: left;'><input type='text' name='q' id='tipue_search_input'></div>
        <div style='float: left; margin-left: 13px;'><input type='button' id='tipue_search_button' onclick='this.form.submit();'></div>
        </form>
    </div>
</div>

<?php
	}
	else {
?>
	<link href='index.css' rel='stylesheet' type='text/css' />
    
    <!--Adding Default CSS Document-->
	<link href='css/thrColFixHdr.css' rel='stylesheet' type='text/css' />
	<!--End Default CSS Document-->
    
    <!--BEGIN ADDING FONT-->
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
    <!--END FONT ADDITION-->
    
    <!--Call Latest JQuery plugin -->
    <script src='http://code.jquery.com/jquery-latest.js'></script>
    <!--END CALL Latest JQuery plugin-->
    
    <!--Create fade and hover Jquery usage-->
        <script>
            $('#navigation').mouseover(function(){
                $('#arrow-up').show();
            })
            $('#navigation').mouseout(function(){
                $('#arrow-up').hide();
            })
        </script>
    <!--End Jquery -->
    
    <!--Begin the Tipue Search Addition Code-->
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400|Open+Sans:300,400' rel='stylesheet'>
        <link href='tipuesearch/tipuesearch.css' rel='stylesheet'>
        <script src='tipuesearch/tipuesearch_set.js'></script>
        <script src='tipuesearch/tipuesearch.js'></script>
    <!--Integration Created-->
    
    </head>
    <body>
    <div class='top_greenbar'>
    <!--The top green accent bar that creates the effect-->
    </div>
    
    <!--Begin the content portion of the NO SESSION header-->
    <div class='content_arena'>
    
        <!--Insert the logo of TeenGurus-->
        <div class='logo_container'>
        <img width='115px' src='images/logo.png' alt='TeenGurus, LLC'>
        </div>	
    
        <!--Insert the Search functionality-->
        <!--Integration of Tipue Search occurs here-->
        <div class='search_form'>
            <form action='search.html'>
            <div style='float: left;'><input type='text' name='q' id='tipue_search_input'></div>
            <div style='float: left; margin-left: 13px;'><input type='button' id='tipue_search_button' onclick='this.form.submit();'></div>
            </form>
        </div>
        
        <!--Creating the navbar when no session login is present-->
        <div class='navigation nosession'>
        <!--Login button functionality: Occurs when no session starting process has occurred-->
            <a class='navbar' href='#'>	LOGIN</a>
        <!--Display default functions-->
        <!--Default navbar functions carry throughout, but change depending on session value-->
            <a class='navbar' href='#'>	THE GURUS </a>
            <a class='navbar' href='#'>	HOW WE WORK </a>
        <!--End default navigation bar functions -- only occur on null session id-->
        </div>
    </div>
<?php } ?>