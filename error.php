<?php session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="wVhFqf4MEJaribsakj6m7uDpiDEpEm-Pdx0bdAvrbGg" />

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

    <!-- Debugger CSS -->
    <!-- <link rel="stylesheet" href="css/debugger.css"> -->

    <title>Dead by Daylight Buddy - ERROR!</title>
</head>

<body style="background-image: none;">
    <?php require_once("includes/connection.php") ?>

    <div class="container">
        <div class="display-1 text-center h1">ERROR!</div>
        <div class="container">
            <strong>DEAD BY DAYLIGHT BUDDY</strong> found an error in your device. It is <strong>not possible</strong> to replicate www.deadbydaylightbuddy.com.
            <br>
            <br>
            <strong>Reasoning:</strong> today is <?= date("d-m-Y") ?> which means...
            <?php header("refresh:11; url=apresentacao.php"); ?>
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