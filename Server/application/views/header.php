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
		<!-- Modernizer Script for old Browsers -->
    </head>
    
    <body id="body">
        <!-- preloader -->
            <div id="preloader">
                <img src="/assets/images/preloader.gif" alt="Preloader">
            </div>
		<!-- end preloader -->
            <div id="toppanel">
                <div id="panel">				
                    <div class="right">
                        <form  action="#" method="post">
                            <h1>Member Login</h1>
                            <label class="grey" for="log">Username:</label>
                            <input class="field" type="text" name="log" id="log" value="" size="23" />
                            <label class="grey" for="pwd">Password:</label>
                            <input class="field" type="password" name="pwd" id="pwd" size="23" />
                            <label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
                            <div class="clear"></div>
                            <input type="button" name="submit" value="Login" class="bt_login" />
                            <a class="lost-pwd" href="#">Forgot Password</a>
                        </form>
                    </div>
                    <div class="left right">			
                        <!-- Register Form -->
                        <form action="#" method="post">
                                <h1>Not a member yet? Sign Up!</h1>				
                                <label class="grey" for="signup">Username:</label>
                                <input class="field" type="text" name="signup" id="signup" value="" size="23" />
                                <label class="grey" for="email">Email:</label>
                                <input class="field" type="text" name="email" id="email" size="23" />
                                <input type="submit" name="submit" value="Register" class="bt_register" />
                        </form>
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
            </div>