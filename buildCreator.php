<?php session_start();
if (!isset($_SESSION["category"])) {
	$_SESSION["category"] = "Survivor";
}
if (!isset($_SESSION["otcategory"])) {
	$_SESSION["otcategory"] = "Killer";
}
if (!isset($_SESSION["username"])) {
	header("Location: " . "login.php");
	$_SESSION['error'] = "You have to be logged in order to create a build.";
}
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Material Design Bootstrap -->
	<link href="css/mdb.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">

	<!-- Website favicon -->
	<link rel="icon" href="imagens/favicon.png">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<!-- Debugger CSS -->
	<!-- <link rel="stylesheet" href="css/debugger.css"> -->

	<title>Dead by Daylight Buddy | <?= $_SESSION['category'] ?> Build Creator</title>
</head>

<body>
	<?php require_once("includes/menu.php") ?>
	<?php require_once("includes/connection.php") ?>

	<div class="main">
		<h1 class="text-center display-1"><a href="./">Dead by Daylight Buddy</a></h1>
		<p class="lead text-white text-center">Create your own <strong><?= $_SESSION['category'] ?> Build</strong>, and then choose to <strong>share it</strong> or <strong>store it</strong>.</p>

		<div class="container">
			<div class="container d-flex text-white">
				<div class="text-center container col-3 border border-<?php if ($_SESSION["category"] == "Killer") {
																			echo "danger";
																		} else {
																			echo "success";
																		} ?>">

					<div id="characterSelected"><img id="<?php
															if ($_SESSION["category"] == "Killer") {
																echo "Trapper";
															} else {
																echo "Dwight Fairfield";
															}
															?>" class="img-fluid" src="imagens/<?php echo strtolower($_SESSION["category"]) ?>/<?php
																																				if ($_SESSION["category"] == "Killer") {
																																					echo "Trapper_fullbody.png";
																																				} else {
																																					echo "Dwight Fairfield_fullbody.png";
																																				}
																																				?>"></div>
					<button id="changingCharactersButton" class="btn btn-<?php if ($_SESSION["category"] == "Killer") {
																				echo "danger";
																			} else {
																				echo "success";
																			} ?>">Change <?php echo strtolower($_SESSION['category']) ?></button>
				</div>
				<div class="container border border-dark">
					<div class="col-12 text-white rounded bg-warning mb-4" id="result"></div>
					<input type="text" class="form-control" placeholder="Build Name (up until 50 characters)" aria-label="Build Name (up until 50 characters)" id="buildName" maxlength="50">
					<div class="row">
						<div class="col-6 col-md-4 col-lg-3 m-auto text-center" id="perk-option-1"><img id="None" src="imagens/Perk List.png"></div>
						<div class="col-6 col-md-4 col-lg-3 m-auto text-center" id="perk-option-2"><img id="None" src="imagens/Perk List.png"></div>
						<div class="col-6 col-md-4 col-lg-3 m-auto text-center" id="perk-option-3"><img id="None" src="imagens/Perk List.png"></div>
						<div class="col-6 col-md-4 col-lg-3 m-auto text-center" id="perk-option-4"><img id="None" src="imagens/Perk List.png"></div>
					</div>

					<!-- Mini description -->
					<div class="col-6">
						<label for="miniDescription">Small Description</label>
						<input type="text" class="form-control" placeholder="Small description. First thing a user sees." aria-label="Small description (50 characters)" id="miniDescription" maxlength="50">
					</div>

					<!-- Full description -->
					<div class="form-group shadow-textarea col-12 mt-4">
						<label for="fullDescription">Full description</label>
						<textarea class="form-control z-depth-1" id="fullDescription" rows="5" placeholder="Full description. Explain everything you have to about your build."></textarea>
					</div>

					<button id="submitBuild" class="float-right float-left btn btn-<?php if ($_SESSION["category"] == "Killer") {
																						echo "danger";
																					} else {
																						echo "success";
																					} ?>">Submit</button>
				</div>
			</div>

			<div class="row mt-4 mb-4 text-center p-4">
				<div class="col-12 border border-<?php if ($_SESSION["category"] == "Killer") {
														echo "danger";
													} else {
														echo "success";
													} ?> d-none m-4" id="changingCharactersDiv">
					<div class="lead text-<?php if ($_SESSION["category"] == "Killer") {
												echo "danger";
											} else {
												echo "success";
											} ?>">Choose</div>
					<div class="row">
						<?php $sql = 'SELECT * FROM ' . strtolower($_SESSION["category"]);
						$stmt = $dbh->prepare($sql);
						$stmt->execute();
						while ($obj = $stmt->fetchObject()) { ?>
							<div class="text-white col-6 col-md-3 col-lg-2 characterOption" id="
																														<?php if ($_SESSION["category"] == "Survivor") {
																															echo $obj->name;
																														} elseif ($_SESSION["category"] == "Killer") {
																															echo $obj->nickname;
																														} ?>"><img class="img-fluid" src="imagens/<?php echo  strtolower($_SESSION["category"]) ?>/
																														<?php if ($_SESSION["category"] == "Survivor") {
																															echo $obj->name;
																														} elseif ($_SESSION["category"] == "Killer") {
																															echo $obj->nickname;
																														} ?>_icon.png">
							</div>
						<?php } ?></div>
				</div>
				<?php
				$sql = 'SELECT * FROM ' . strtolower($_SESSION["category"]) . 'perk';
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
				while ($obj = $stmt->fetchObject()) {
					?>
					<div class="text-white col-3 col-md-3 col-lg-2 perk mb-4" id="<?= trim($obj->Name) ?>"><img class="w-100" src="imagens/<?php echo strtolower($_SESSION["category"]) ?>/perks/<?= trim(str_replace("Hex: ", "", $obj->Name)) ?> 3.png" data-toggle="tooltip" data-html="true" title="<?= htmlentities($obj->Description) ?>">
						<?php echo $obj->Name; ?></div>
				<?php } ?>

				<div class="container p-4 m-4"> </div>
				<div class="container p-4 m-4"> </div>
			</div>
		</div>

		<div class="fixed-bottom col-lg-4 offset-lg-7 text-white" id="buildPreview">
			<div class="row bg-dark rounded">
				<div class="col-12 m-auto text-center font-weight-bold">Preview Your Build</div>
				<div class="col-3 col-lg-3 m-auto text-center" id="preview-perk-option-1"><img src="imagens/Perk List.png"></div>
				<div class="col-3 col-lg-3 m-auto text-center" id="preview-perk-option-2"><img src="imagens/Perk List.png"></div>
				<div class="col-3 col-lg-3 m-auto text-center" id="preview-perk-option-3"><img src="imagens/Perk List.png"></div>
				<div class="col-3 col-lg-3 m-auto text-center" id="preview-perk-option-4"><img src="imagens/Perk List.png"></div>
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

		<!-- MDB core JavaScript -->
		<script type="text/javascript" src="js/mdb.min.js"></script>

		<script>
			// Hide the buildPreview div BEFORE the page loads so it doesn't show up in the meantime (so much)
			$("#buildPreview").hide();
			// Hide the buildPreview div BEFORE the page loads so it doesn't show up in the meantime (so much)

			$(window).on('load', function() {
				// Bootstrap scripts
				$(function() {
					$('[data-toggle="popover"]').popover()
				});

				$(function() {
					$('[data-toggle="tooltip"]').tooltip()
				})
				// Bootstrap scripts

				// Submitting a build
				$('#submitBuild').click(function() {
					$.ajax({
						type: 'POST',
						url: 'includes/submitBuild.php',
						data: {
							perk1: $("#perk-option-1").children("img").attr("id"),
							perk2: $("#perk-option-2").children("img").attr("id"),
							perk3: $("#perk-option-3").children("img").attr("id"),
							perk4: $("#perk-option-4").children("img").attr("id"),
							character: $("#characterSelected").children("img").attr("id"),
							category: "<?php echo strtolower($_SESSION['category']) ?>",
							miniDescription: $("#miniDescription").val(),
							fullDescription: $("#fullDescription").val(),
							buildName: $("#buildName").val()
						},
						success: function(response) {
							$('#result').html(response);
						}
					});
				});
				// Submitting a build

				// Changing character
				$("#changingCharactersButton").click(function() {
					if ($("#changingCharactersDiv").hasClass("d-none")) {
						$("#changingCharactersDiv").removeClass("d-none");
					} else {
						$("#changingCharactersDiv").addClass("d-none");
					}
				});

				$(".characterOption").click(function() {
					var selected = this.id;
					$("#characterSelected").text('');
					$("#characterSelected").append('<img id="' + selected + '" class="img-fluid" src="imagens/<?php echo strtolower($_SESSION["category"]) ?>/' + selected + '_fullbody.png">');
				});
				// Changing character

				// Clicking on a perk removes the perk and adds the default image
				var picked1 = "option1";
				var picked2 = "option2";
				var picked3 = "option3";
				var picked4 = "option4";

				$("#perk-option-1").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#preview-perk-option-1").text('');
					$("#preview-perk-option-1").append('<img id="None" src="imagens/Perk List.png">');
					picked1 = "option1";
				});

				$("#perk-option-2").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#preview-perk-option-2").text('');
					$("#preview-perk-option-2").append('<img id="None" src="imagens/Perk List.png">');
					picked2 = "option2";
				});

				$("#perk-option-3").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#preview-perk-option-3").text('');
					$("#preview-perk-option-3").append('<img id="None" src="imagens/Perk List.png">');
					picked3 = "option3";
				});

				$("#perk-option-4").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#preview-perk-option-4").text('');
					$("#preview-perk-option-4").append('<img id="None" src="imagens/Perk List.png">');
					picked4 = "option4";
				});

				$("#preview-perk-option-1").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#perk-option-1").text('');
					$("#perk-option-1").append('<img id="None" src="imagens/Perk List.png">');
					picked1 = "option1";
				});

				$("#preview-perk-option-2").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#perk-option-2").text('');
					$("#perk-option-2").append('<img id="None" src="imagens/Perk List.png">');
					picked2 = "option2";
				});

				$("#preview-perk-option-3").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#perk-option-3").text('');
					$("#perk-option-3").append('<img id="None" src="imagens/Perk List.png">');
					picked3 = "option3";
				});

				$("#preview-perk-option-4").click(function() {
					$(this).text('');
					$(this).append('<img id="None" src="imagens/Perk List.png">');
					$("#perk-option-4").text('');
					$("#perk-option-4").append('<img id="None" src="imagens/Perk List.png">');
					picked4 = "option4";
				});
				// Clicking on a perk removes the perk and adds the default image

				// Clicking on a perk from the list adds it to a empty perk option
				$(".perk").click(function() {
					if ($("#perk-option-1").text() == "") {
						picked1 = this.id;
					} else if ($("#perk-option-2").text() == "") {
						picked2 = this.id;
					} else if ($("#perk-option-3").text() == "") {
						picked3 = this.id;
					} else if ($("#perk-option-4").text() == "") {
						picked4 = this.id;
					}

					if (picked1 != picked2 && picked1 != picked3 && picked1 != picked4 && picked2 != picked3 && picked2 != picked4 && picked3 != picked4) {
						if ($("#perk-option-1").text() == "") {
							$("#perk-option-1").addClass("perk-selected");
							$("#preview-perk-option-1").addClass("perk-selected");
						} else if ($("#perk-option-2").text() == "") {
							$("#perk-option-2").addClass("perk-selected");
							$("#preview-perk-option-2").addClass("perk-selected");
						} else if ($("#perk-option-3").text() == "") {
							$("#perk-option-3").addClass("perk-selected");
							$("#preview-perk-option-3").addClass("perk-selected");
						} else if ($("#perk-option-4").text() == "") {
							$("#perk-option-4").addClass("perk-selected");
							$("#preview-perk-option-4").addClass("perk-selected");
						}

						$(".perk-selected").text('');
						$(".perk-selected").append('<img class="w-100" id="' + this.id + '" src="imagens/<?php echo strtolower($_SESSION['category']) ?>/perks/' + this.id.replace("Hex: ", "") + ' 3.png"><br><p class="text-center">' + this.id + '</p>');

						$("#perk-option-1").removeClass("perk-selected");
						$("#perk-option-2").removeClass("perk-selected");
						$("#perk-option-3").removeClass("perk-selected");
						$("#perk-option-4").removeClass("perk-selected");

						$("#preview-perk-option-1").removeClass("perk-selected");
						$("#preview-perk-option-2").removeClass("perk-selected");
						$("#preview-perk-option-3").removeClass("perk-selected");
						$("#preview-perk-option-4").removeClass("perk-selected");
					} else {
						alert("You have already picked " + this.id + " in your build!");
					}
				})
				// Clicking on a perk from the list adds it to a empty perk option

				// Build preview functions
				$(document).scroll(function() {
					var y = $(this).scrollTop();
					if (y > 200) {
						$("#buildPreview").fadeIn();
					} else {
						$('#buildPreview').fadeOut();
					}
				});
				// Build preview functions
			});
		</script>
</body>

</html>