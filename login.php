<?php session_start();
if (!isset($_SESSION["category"])) {
    $_SESSION["category"] = "Survivor";
}
if (!isset($_SESSION["otcategory"])) {
    $_SESSION["otcategory"] = "Killer";
}

if (isset($_SESSION['username'])) {
    header("Location: " . 'index.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login into Dead by Daylight Buddy and create your own build.">

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

    <title>Dead by Daylight Buddy | Login</title>
</head>

<body>
    <?php require_once("includes/menu.php") ?>

    <div class="main text-white">
        <h1 class="text-center display-1"><a href="./">Dead by Daylight Buddy - Login</a></h1>
        <div class="container">
            <p class="lead">By registering in <strong>Dead by Daylight Buddy</strong> you will be able to create builds, rank characters and perks!</p>

            <div class="row mt-4 mb-4">
                <div class="col bg-info p-4 rounded-left">
                    <div class="lead text-center">Login</div>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <label for="userLogin">Your username</label>
                            <input type="username" class="form-control" id="userLogin" name="userLogin" placeholder="Enter username" minlength="4" required>
                        </div>
                        <div class="form-group">
                            <label for="passLogin">Your password</label>
                            <input type="password" class="form-control" id="passLogin" name="passLogin" placeholder="Password" minlength="4" required>
                        </div>
                        <button type="submit" class="btn btn-dark">Login</button>
                    </form>
                    <?php if (isset($_SESSION['error'])) {
                        ?>
                        <div class="bg-danger mt-4 p-1 rounded text-center">Error! <?= $_SESSION['error'] ?></div>
                        <?php
                        unset($_SESSION['error']);
                    } ?>
                </div>

                <div class="col bg-dark p-4 rounded-right">
                    <div class="lead text-center">Register</div>
                    <form action="includes/register.php" method="post">
                        <div class="form-group">
                            <label for="newUser">New username</label>
                            <input type="username" class="form-control" id="newUser" name="newUser" placeholder="Enter username" minlength="5" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="newUser">New email</label>
                            <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Enter email" minlength="5" maxlength="50" required>
                            <small>We won't share your email with anyone. We won't contact you if not solicited.</small>
                        </div>
                        <div class="form-group">
                            <label for="newPass">New password</label>
                            <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Password" minlength="5" maxlength="40" required>
                        </div>
                        <button type="submit" class="btn btn-info">Register</button>
                        <?php if (isset($_SESSION['errorReg'])) {
                            ?>
                            <div class="bg-danger mt-4 p-1 rounded text-center">Error! <?= $_SESSION['errorReg'] ?></div>
                            <?php
                            unset($_SESSION['errorReg']);
                        } ?>
                    </form>
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

        <script>
            $(function() {
                $('#userLogin').on('keypress', function(e) {
                    if (e.which == 32)
                        return false;
                });
            });

            $(function() {
                $('#newUser').on('keypress', function(e) {
                    if (e.which == 32)
                        return false;
                    if (e == preg_match('/^[a-zA-Z\p{Cyrillic}\d\s\-]+$/u', $str))
                        return false;
                });
                $('#newUser').on("cut copy paste", function(e) {
                    e.preventDefault();
                });
            });
        </script>
</body>

</html>