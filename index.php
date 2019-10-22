<?php session_start();
if (!isset($_SESSION["category"])) {
	$_SESSION["category"] = "Survivor";
}
if (!isset($_SESSION["otcategory"])) {
	$_SESSION["otcategory"] = "Killer";
}

// Administration only: When the administrator logs in on the main page, forces the ratings update.
if (isset($_SESSION['username'])) {
	if ($_SESSION['username'] == "Kijiroshi_Admin") {
		require_once("includes/updateSurvivorRatings.php");
		require_once("includes/updatePerkRatings.php");
	}
}
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="wVhFqf4MEJaribsakj6m7uDpiDEpEm-Pdx0bdAvrbGg">
	<meta name="description" content="A platform that will help you in your Dead by Daylight experience. Check and create new builds here. Vote on builds and perks and see their ranking in real time!">

	<!-- OG Meta Tags -->
	<meta property="og:type" content="Gaming">
	<meta property="og:description" content="An online platform that will help you in your Dead by Daylight experience. Check and create new builds here.">
	<meta property="og:site_name" content="Dead by Daylight Buddy">
	<meta property="og:url" content="http://www.deadbydaylightbuddy.com">
	<meta property="og:title" content="Dead by Daylight Buddy">
	<meta property="og:image" content="http://deadbydaylightbuddy.com/imagens/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">

	<!-- Website favicon -->
	<link rel="icon" href="imagens/favicon.png">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139567309-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-139567309-1');
	</script>

	<!-- Google AdSense -->
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-2237502083248135",
			enable_page_level_ads: true
		});
	</script>



	<!-- Debugger CSS -->
	<!-- <link rel="stylesheet" href="css/debugger.css"> -->

	<title>Dead by Daylight Buddy - Create and Share Your Builds</title>
</head>

<body>
	<?php require_once("includes/connection.php") ?>
	<?php require_once("includes/menu.php") ?>
	<?php if (isset($_SESSION['username'])) {
		require_once("includes/updateLastLogin.php");
	} ?>

	<div class="main text-white">
		<h1 class="text-center display-1"><a href="./">Dead by Daylight Buddy</a></h1>
		<div class="container">
			<h2>-> We're going through a huge maintenance and update. We'll keep you updated on it. <-</h2> <h4>We know that DBD Buddy hasn't seen any new features or updates in a while, as we promised. Fortunately, we're gathering a huge overhaul to the website so it can ge updated in one single moment (so we're going to the Beta phase).</h4>
					<p class="lead">Welcome to <strong>Dead by Daylight Buddy</strong>, everything about your favorite game in one web platform combined!</p>
					<p>What can you expect here?</p>
					<ul>
						<li>All information about every single character in the game, both <strong>Killers</strong> and <strong>Survivors</strong>!</li>
						<li>Brief reminders of what items, addons and offerings provide to the ones that use them.</li>
						<li>It is completely <strong>P2P</strong>! Wait, not in that sense... A <strong>Player to Player</strong> experience! We know what you need when visiting us, and you know you can trust us to help you out.</li>
						<li><strong>Dead by Daylight Buddy</strong> is a work of passion and a tribute to a great game! This means that everything you see here was made with love and amaze for the official game. We have no intents on going <strong>profit first</strong>, as we don't really have any way to make profit.</li>
						<li>As so, by being a <strong>non commercial project</strong>, you won't need to worry about ads or information, opinions and rankings being corrupted by... corruption.</li>
					</ul>

					<p><strong>DBD Build Creator</strong>! Create your own build with our perk loadout and with our Perk Rank!</p>

					<p>Don't forget to leave your questions, opinions and suggestions! You can do so by emailing us at <strong>contactus@deadbydaylightbuddy.com</strong>, or by messaging <strong>u/Kijiroshi</strong> on Reddit.</p>

					<p>Good luck in the fog.</p>

		</div>

		<div class="container">
			<div class="rounded-top bg-white">
				<div class="text-dark text-center h3 m-0 p-2">Last Users Connected</div>
			</div>
			<div class="rounded-bottom bg-dark mb-4">
				<div class="row pt-2">
					<?php
					$sql = 'SELECT * FROM account ORDER BY lastLogin DESC';
					$stmt = $dbh->prepare($sql);
					$stmt->execute();
					while ($obj = $stmt->fetchObject()) {
						?>
						<div class="col-12 row">
							<div class="col-2 border offset-1 text-center"><?= $obj->username ?></div>
							<div class="col-3">Last login:
								<strong>
									<?php
									$seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($obj->lastLogin);

									$months = floor($seconds / (3600 * 24 * 30));
									$day = floor($seconds / (3600 * 24));
									$hours = floor($seconds / 3600);
									$mins = floor(($seconds - ($hours * 3600)) / 60);
									$secs = floor($seconds % 60);

									if ($seconds < 60)
										$time = $secs . " seconds ago";
									else if ($seconds < 60 * 60)
										$time = $mins . " minutes ago";
									else if ($seconds < 24 * 60 * 60)
										$time = $hours . " hours ago";
									else if ($seconds < 24 * 60 * 60 * 30)
										$time = $day . " days ago";
									else
										$time = $months . " months ago";

									if ($seconds == 0)
										echo "Right now!";
									else
										echo $time;
									?>
								</strong>
							</div>
							<div class="col-2 border text-center">Created <strong><?= $obj->buildsCreated ?></strong> builds</div>
							<div class="col-3 text-center">Voted on
								<strong>
									<?php
									$sql1 = "SELECT * FROM account_voted_on WHERE username LIKE '" . $obj->username . "';";
									$stmt1 = $dbh->prepare($sql1);
									$stmt1->execute();
									$perksVoted = 0;
									while ($obj1 = $stmt1->fetchObject()) {
										$perksVoted = $perksVoted + 1;
									}
									echo trim($perksVoted); ?></strong>/122 perks
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- None -->

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<!-- Popper.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>