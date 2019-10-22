<?php session_start();
if (!isset($_SESSION["category"])) {
    $_SESSION["category"] = "Survivor";
}
if (!isset($_SESSION["otcategory"])) {
    $_SESSION["otcategory"] = "Killer";
}

require_once("includes/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <title>Dead by Daylight Buddy | <?= $_SESSION['category'] ?> Perks List</title>
</head>

<body>
    <?php require_once("includes/menu.php") ?>
    <script>
        function rate(perkId, vote) {
            $("#topkek").append('<div class="shadow-lg text-center p-3 m-auto fixed-bottom bg-success text-white"><i class="fas fa-sync fa-spin"></i> Thank you for your vote! Please wait while we update our information, we\'ll reload you automatically... <i class="fas fa-sync fa-spin"></i></div>');
            // A "please wait" div appears at fixed bottom
            $.ajax({
                type: 'POST',
                url: 'includes/votePerk.php',
                data: {
                    perkId: perkId,
                    vote: vote
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>

    <div class="main">
        <h1 class="text-center display-1"><a href="./">Dead by Daylight Buddy</a></h1>

        <div class="container mt-4" id="topkek">
            <p class="lead text-white text-center">List of all <strong><?= $_SESSION['category'] ?> Perks</strong>, ordered by their <strong>Ranking</strong>.</p>

            <!-- Row where all perks will be printed. -->
            <div class="row">
                <?php $sql = 'SELECT * FROM ' . strtolower($_SESSION["category"]) . 'perk ORDER BY Ranking DESC';
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                while ($obj = $stmt->fetchObject()) {
                    ?>
                    <div class="col-4 col-md-3 col-lg-2">
                        <div class="text-white border-bottom border-top rounded mb-2 text-center bg-dark">
                            <h5 class="m-2"><?= trim($obj->Name); ?></h5>
                            <img class="w-75 m-auto text-center" src="imagens/<?php echo strtolower($_SESSION["category"]) ?>/perks/<?= trim(str_replace("Hex: ", "", $obj->Name)); ?> 3.png" alt="<?= trim($obj->Name); ?> icon" data-toggle="tooltip" data-html="true" title="<?= htmlentities($obj->Description) ?>">

                            <!-- If the user is logged in, they will be able to see the VOTES div. -->
                            <?php if (isset($_SESSION['username'])) { ?>
                                <div id="votes" class="text-center mt-2">
                                    <?php
                                    $sql1 = "SELECT * FROM account_voted_on WHERE username LIKE '" . $_SESSION['username'] . "' AND perk = '" . addslashes(trim($obj->Name)) . "'";
                                    $stmt1 = $dbh->prepare($sql1);
                                    $stmt1->execute();

                                    // fas fa-thumbs-up -> To vote.
                                    // far fa-thumbs-up -> Voted.

                                    // If the user voted as the perk being good (1):
                                    if ($obj1 = $stmt1->fetchObject()) {
                                        if ($obj1->vote) {
                                            ?>
                                            <button class="btn btn-success"><i class="fas fa-thumbs-up" data-placement="bottom" data-toggle="tooltip" title="You voted this perk as being good."></i></button>

                                            <button onclick="rate(<?= $obj->Id ?>,0)" class="btn btn-danger"><i class="far fa-thumbs-down" data-placement="bottom" data-toggle="tooltip" title="Vote on this perk as being bad."></i></button>
                                        <?php
                                    }

                                    // If the user voted as the perk being bad (0):
                                    elseif (!$obj1->vote) { ?>
                                            <button onclick="rate(<?= $obj->Id ?>,1)" class="btn btn-success"><i class="far fa-thumbs-up" data-placement="bottom" data-toggle="tooltip" title="Vote on this perk as being good."></i></button>

                                            <button class="btn btn-danger"><i class="fas fa-thumbs-down" data-placement="bottom" data-toggle="tooltip" title="You voted this perk as being bad."></i></button>
                                        <?php }
                                }

                                // If the user didn't vote yet (null).
                                else { ?>
                                        <button onclick="rate(<?= $obj->Id ?>,1)" class="btn btn-success"><i class="far fa-thumbs-up" data-placement="bottom" data-toggle="tooltip" title="Vote on this perk as being good."></i></button>

                                        <button onclick="rate(<?= $obj->Id ?>,0)" class="btn btn-danger"><i class="far fa-thumbs-down" data-placement="bottom" data-toggle="tooltip" title="Vote on this perk as being bad."></i></button>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <div class="mb-2 mt-2">
                                <p data-toggle="tooltip" title="Votes from the DBDB community. Have you voted yet?" data-placement="bottom"><strong>Votes:</strong> <?= $obj->Votes ?>
                                </p>
                                <p data-toggle="tooltip" title="How many times people used this perk on their builds." data-placement="bottom"><strong>Used:</strong> <?= $obj->Used ?>
                                </p>
                                <p data-toggle="tooltip" title="Ranking = Votes + (Used * 0.5)" data-placement="bottom"><strong>Ranking:</strong> <?= $obj->Ranking ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
            $(document).ready(function() {
                $(function() {
                    $('[data-toggle="popover"]').popover()
                })

                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            })
        </script>

</body>

</html>