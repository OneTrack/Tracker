<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    	<!-- meta charec set -->
        <meta charset="utf-8">
		<!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- Page Title -->
        <title>One Track</title>		
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Google Font -->
	
		<!-- CSS
		================================================== -->
		<!-- Fontawesome Icon font -->
        
		<!-- Twitter Bootstrap css -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		<!-- jquery.fancybox  -->
        <link rel="stylesheet" href="/assets/css/jquery.fancybox.css">
		<!-- animate -->
        <link rel="stylesheet" href="/assets/css/animate.css">
		<!-- Main Stylesheet -->
        <link rel="stylesheet" href="/assets/css/main.css">
		<!-- media-queries -->
        <link rel="stylesheet" href="/assets/css/media-queries.css">
        <!-- slider css -->
        <link rel="stylesheet" href="/assets/css/slide.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    </head>
    
    <body id="body">
    <div >
    <ul class="nav nav-pills" style="padding-left: 5%">
     <li><a href="#body" style="color:#272727;font-size:25px;line-height: 28px;">OneTrack</a></li>
    	<ul class="nav navbar-nav navbar-right" style="padding-right: 5%;">
    		<li><div id="right-panel-link" href="#right-panel">
    		<a href="#userlogin" style="color:#272727;" class="open-tab">Login</a>
    		<a href="#registration" style="color:#272727;" class="open-tab">SignUp</a>
    		</div>
    		</li>
    	</ul>
    </ul>
    </div>
    <div id="right-panel" class="panel">
	<div id="tabs" role="tabpanel">
			<div style="padding-left:5%;">
    		<ul class="nav nav-pills" role="tablist">
    		<li role="presentation"><a href="#userlogin" aria-controls="userlogin" role="tab" data-toggle="pill">Login</a></li>
    		<li role="presentation"><a href="#registration" aria-controls="registration" role="tab" data-toggle="pill">Sign Up</a></li>
    		</ul>
    		</div><br>
    		<div class="tab-content" style="padding-left:5%;padding-right:5%">
		<div role="tabpanel" class="tab-pane active" id="userlogin">
		    <form method='post' id="login" action='/user/login'/>
		        <input type='email' class="form-control" placeholder='Email' name='email'><br>
		        <input type='password' class="form-control" placeholder='Password' name='password'><br>
		        <label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever"> &nbsp;Remember me</label>
		        <input type='submit' value='Login' class="btn btn-info btn-block" />
		     </form>
		    <a class="lost-pwd" href="#">Forgot Password ?</a><br>
		    <a href="/user/facebook"><img class='login' src="/assets/images/signInFacebook.png" width="100px" /></a><br>
		    <a href="/user/gmail"><img class='login' src="/assets/images/gmailSignIn.jpg" width="100px" /></a>
		</div>
		<div role="tabpanel" class="tab-pane" id="registration">
		    <form method='post' id="register" action='/user/registration'/>                           
		         <input class="form-control" type='text' placeholder='Email' name='email' size="23"><br>
		         <input class="form-control" type='text' placeholder='Name' name='name' size="23"><br>
		         <input class="form-control" type='password' placeholder='Password' id='password' name='password' size="23"><br>
		         <input class="form-control" type='password' placeholder='Confirm Password' id='confirm_password' name='confirm_password' size="23"><br>
		         <input type='submit' value='Register' class="btn btn-info btn-block" />
		</div>
		</div>
	</div>
<!-- button id="close-panel-bt">Close</button> -->
</div>
    <!--div class="cd-panel from-right">

		< <div class="cd-panel-container">
			<div class="cd-panel-content">
			<form method='post' action='/user/login'/>
                            <input type='text' class="field" placeholder='Email/Username' name='email' size="23"/>
                            <input type='password' class="field" placeholder='Password' name='password' size="23" />
                            <label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
                            <div class="clear"></div>
                            <input type='submit' value='Login' class="bt_login" />
                        </form>
                        <a class="lost-pwd" href="#">Forgot Password</a><br>
                        <a href="/user/facebook"><img class='login' src="/assets/images/signInFacebook.png" width="100px" /></a><br>
                        <a href="/user/gmail"><img class='login' src="/assets/images/gmailSignIn.jpg" width="100px" /></a>
			</div> -->
		<!-- cd-panel-container -->
	 <!-- cd-panel -->
        <!-- preloader>
            <div id="preloader">
                <img src="/assets/images/preloader.gif" alt="Preloader">
            </div>
		<!-- end preloader -->
            <!--div id="toppanel">
                <div id="panel">				
                    <div class="right">
                        <form method='post' action='/user/login'/>
                            <h1>Member Login</h1>
                            <input type='text' class="field" placeholder='Email/Username' name='email' size="23"/>
                            <input type='password' class="field" placeholder='Password' name='password' size="23" />
                            <label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
                            <div class="clear"></div>
                            <input type='submit' value='Login' class="bt_login" />
                        </form>
                        <a class="lost-pwd" href="#">Forgot Password</a><br>
                        <a href="/user/facebook"><img class='login' src="/assets/images/signInFacebook.png" width="100px" /></a><br>
                        <a href="/user/gmail"><img class='login' src="/assets/images/gmailSignIn.jpg" width="100px" /></a>
                    </div>
                    <div class="left right">			
                        
                        <form method='post' action='/user/registration'/>
                                <h1>Not a member yet? Sign Up!</h1>                            
                                <input class="field" type='text' placeholder='Email' name='email' size="23" />
                                <input class="field" type='text' placeholder='Name' name='name' size="23" />
                                <input class="field" type='password' placeholder='Password' name='password' size="23" />
                                <input class="field" type='password' placeholder='Confirm Password' name='confirm_password' size="23" />
                                <input type='submit' value='Register' class="bt_register" />
                        </form>
                    </div>					
                <div>
                </div>
                </div>
                <div class="tab">
                    <ul class="login">
                        <li class="right">&nbsp;</li>
                        <li>Hello Guest!</li>
                        <li class="sep">|</li>
                        <li id="toggle">
                            <a id="open" class="open" href="#" style="width: 115px;">Log In | SignUp</a>
                            <a id="close" style="display: none;" class="close" href="#">Close</a>			
                        </li>
                        <li class="left">&nbsp;</li>
                    </ul> 
                </div>
            </div>-->