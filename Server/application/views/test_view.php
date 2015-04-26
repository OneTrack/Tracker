<script src="/assets/js/jquery-1.11.1.min.js"></script>

<script src="/assets/js/custom.js"></script>


<h>Registration</h>
<form method='post' action='/user/registration'/>
<p>
<input type='text' placeholder='Email' name='email'/>
</p>
<p>
<input type='text' placeholder='Name' name='name'/>
</p>
<p>
<input type='password' placeholder='Password' name='password'/>
</p>
<p>
<input type='password' placeholder='Confirm Password' name='confirm_password'/>
</p>
<p>
<input type='submit' value='Submit'/>
</p>
</form>


<h>Login</h>
<form method='post' action='/user/login'/>
<p>
<input type='text' placeholder='Email' name='email'/>
</p>
<p>
<input type='password' placeholder='Password' name='password'/>
</p>
<p>
<input type='submit' value='Submit'/>
</p>
</form>

<h1>Facebook Login</h1>

<a onclick='login_facebook();' href="javascript:void(0);">Login with Facebook</a>
