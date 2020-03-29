
<?php
include('configuration.php');
session_start();


if(isset($_POST['submit'])) {

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $confirm_Password = md5($_POST['confirm_Password']);
  if ($password == $confirm_Password) {
    error_reporting(E_ALL ^ E_DEPRECATED); //remove system errors
    $_SESSION['username'] = "$username";
  
    
    $q="INSERT INTO user(username,email,password,confirm_Password) VALUES('$username','$email','$password','$confirm_Password');";

    $query = mysqli_query($conn,$q);
    
    if($query)
      {
        echo "Thank You For Sign Up";
       
       header("Location: page2.php");
      }
    else
    {
      echo "<div class='error'>Username is already taken</div>";
    }
  } else {
    echo "<div class='error'>OOPS! Password mismatched</div>";   
  }
}

?>


<!DOCTYPE html>
<html>
<head>
<title> SignUp Form</title>
 <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/theme.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->

<script type="text/javascript" src = "js/myclass.js"></script>

</head>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2192562861007419',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.1' // The Graph API version to use for the call
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>


<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->



<body class="sign">

  <div class="signup-bg">
  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2&appId=2192562861007419&autoLogAppEvents=1"></script>
	<!-- main -->
	<div class="main-w3layouts wrapper">
	
		<div class="main-agileinfo">
			<div class="agileits-top">
        <div class="alert alert-warning"><?php echo isset($error);?></div>
				<form method="POST">
					<input class="text" type="text" id = "username" name="username" placeholder="Username" required="" value="<?php if(isset($username) & !empty($username)){echo $username;}?>">
					<input class="text email" type="email" name="email" placeholder="Email" required="" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>">
					<input class="text" type="password" name="password" placeholder="Password" required="" value="<?php if(isset($_POST['password'])){echo $_POST['password'];}?>">
					<input class="text w3lpass" type="password" name="confirm_Password" placeholder="Confirm Password" required="" value="<?php if(isset($_POST['confirm_Password'])){echo $_POST['confirm_Password'];}?>">
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="submit" name="submit">

          
				</form> 

        <div class="fb-google">
              
            <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
           <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="true"></div>
            <div id="status" ></div>
      </div>
				<p>Already have an Account? <a href="login1.php"> Login Now!</a></p>
        <p><a href="login1.php"> Back</a></p>
			
		</div>
 <script>

      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      }
    </script>
	<ul class="colorlib-bubbles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
	</div>
	<!-- //main -->
</div>

</body>
</html>

