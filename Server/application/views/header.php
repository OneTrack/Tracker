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
        <link rel="stylesheet" href="/assets/css/jquery.ui.css">
    </head>
    
    <body id="body">
    <div >
    <ul class="nav nav-pills" style="padding-left: 5%">

     <li><a href="#body" style="color:#272727;font-size:25px;line-height: 28px;">OneTrack</a></li>
    	<ul class="nav navbar-nav navbar-right" style="padding-right: 5%;">
            <li><div id="right-panel-link" href="#right-panel">
            <?php if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in'])) { ?>
                <a href="javascript:void(0);" onclick='location.href="/user/logout"' style="color:#272727;" class="open-tab">Logout</a>
            <?php } else { ?>
                <a href="javascript:void(0);" style="color:#272727;" class="open-tab">Login</a>
                <a href="javascript:void(0);" style="color:#272727;" class="open-tab">SignUp</a>
            <?php } ?>
            </div>
            </li>
    	</ul>
    </ul>
    </div>
       
    <?php if(!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])) { ?> 
    <div id="right-panel" class="panel">
	<div id="tabs" role="tabpanel">
            <div style="padding-left:5%;">
    		<ul class="nav nav-pills" role="tablist">
    		<li role="presentation"><a href="#userlogin" aria-controls="userlogin" role="tab" data-toggle="pill">Login</a></li>
    		<li role="presentation"><a href="#registration" aria-controls="registration" role="tab" data-toggle="pill">Sign Up</a></li>
    		</ul>
            </div>
            <br>
            <div class="tab-content" style="padding-left:5%;padding-right:5%">
		<div role="tabpanel" class="tab-pane active" id="userlogin">
		    <form method='post' id="login" action='/user/login' >
                        <input type='email' class="form-control" placeholder='Email' name='email' />
		        <input type='password' class="form-control" placeholder='Password' name='password' />
		        <label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever"> &nbsp;Remember me</label>
		        <input type='submit' value='Login' class="btn btn-info btn-block" />
		    </form>
		    <a class="lost-pwd" href="#">Forgot Password ?</a><br>
		    <a href="javascript:void(0);" onclick='login_facebook();'><img class='login' src="/assets/images/signInFacebook.png" width="100px" /></a><br>
		    <a href="/user/gmail"><img class='login' src="/assets/images/gmailSignIn.jpg" width="100px" /></a>
		</div>
		<div role="tabpanel" class="tab-pane" id="registration">
		    <form method='post' id="register" action='/user/registration'>                           
		         <input class="form-control" type='text' placeholder='Email' name='email' size="23" />
		         <input class="form-control" type='text' placeholder='Name' name='name' size="23" />
		         <input class="form-control" type='password' placeholder='Password' id='password' name='password' size="23" />
		         <input class="form-control" type='password' placeholder='Confirm Password' id='confirm_password' name='confirm_password' size="23" />
                         <input type='submit' value='Register' class="btn btn-info btn-block" />
                    </form>
		</div>
            </div>
	</div>
    </div>
    <?php } ?>
    