<?php
	include 'includes/hybridauth/autoload.php';
	include 'config.php';

	use Hybridauth\Hybridauth;

	$hybridauth = new Hybridauth($hybridauthConfig);
	$adapters = $hybridauth->getConnectedAdapters();
	
	$isLoggedIn = false;
	
	try {
		
		$userInfoLinkedIn = $adapters['LinkedIn']->getUserProfile();
		$tokens = $adapters['LinkedIn']->getAccessToken();
	
		// if we can get here, toggle to being logged in
		$isLoggedIn = true;
		
	} catch(Throwable $e) {
		#print "Exception: <p> $e";
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP HybridAuth Sign In with LinkedIn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">

    <h1>PHP HybridAuth Sign In with LinkedIn</h1>
        
  
	<?php if ($isLoggedIn == true) : ?>
		<div class="alert alert-warning">
			You <strong>are</strong> signed in.
		</div>
		
		<p class="mt-5 mb-5">By default, we only have access to the scopes <em>r_liteprofile</em> and <em>r_emailaddress</em>.  These are the only fields we get:</p>

		<?php
			$userInfoLinkedIn = $adapters['LinkedIn']->getUserProfile();
			print "<p><strong>identifier:</strong> " . $userInfoLinkedIn->identifier . "</p>";
			print "<p><strong>photoURL:</strong> " . $userInfoLinkedIn->photoURL . "</p>";
			print "<p><strong>displayName:</strong> " . $userInfoLinkedIn->displayName . "</p>";
			print "<p><strong>firstName:</strong> " . $userInfoLinkedIn->firstName . "</p>";
			print "<p><strong>lastName:</strong> " . $userInfoLinkedIn->lastName . "</p>";
			print "<p><strong>email:</strong> " . $userInfoLinkedIn->email . "</p>";			
		?>

		<p class="mt-5"><a href="<?php print $hybridauthConfig['callback'] . "?logout=true"; ?>">Log Out</a></p>

	<?php else :?>

		<div class="alert alert-warning">
			You are <strong>not</strong> signed in.
		</div>

    	<a href="<?php print $hybridauthConfig['callback'];?>">Login with LinkedIn</a>
    
	<?php endif; ?>
    
</div>

</body>
</html>