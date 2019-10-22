<button onclick="showMenu()" class="col-1 btn btn-info sidebar-btn fixed-top"><i class="fas fa-bars"></i></button>
<button onclick="hideMenu()" class="col-1 btn btn-danger sidebar-btn-close fixed-top d-none"><i class="fas fa-times"></i></button>

<script>
    function showMenu() {
        $(".sidebar").css("width", "50%");
        $(".sidebar").css("z-index", "10000");
        $(".sidebar-btn-close").css("z-index", "1000000");
        $(".sidebar-btn-close").removeClass("d-none");
        $(".sidebar-btn-close").css("margin-left", "50%");
        $(".sidebar-btn").addClass("d-none");
    }
    function hideMenu() {
        $(".sidebar").css("width", "0%");
        $(".sidebar-btn-close").addClass("d-none");
        $(".sidebar-btn").removeClass("d-none");
    }
</script>

<nav class="sidebar row overflow-auto text-white">
    <?php if (isset($_SESSION['username'])) { ?>
        <div class="rounded col-12 text-center m-auto">Logged in as <strong><?= $_SESSION['username']; ?></strong><br><strong><a href="includes/logout.php">Log out?</a></strong></div>
    <?php } ?>
    <?php if (!isset($_SESSION['username'])) { ?>
        <a class="col-12 text-center m-auto" href="login.php">
            <strong>Log in?</strong>
        </a>
    <?php } ?>
    <a class="col-12 row text-center m-auto" href="<?php echo strtolower($_SESSION["category"]) ?>s.php">
        <div class="col-12"><img src="imagens/<?= $_SESSION['category'] ?> List.png" alt="Survivor List menu icon image." class="w-50"></div>
        <div class="col-12"><?= $_SESSION['category'] ?> List</div>
    </a>
    <a class="col-12 row text-center m-auto" href="perkList.php">
        <div class="col-12"><img src="imagens/Perk List.png" alt="Survivor List menu icon image." class="w-50"></div>
        <div class="col-12">Perk List</div>
    </a>
    <a class="col-12 row text-center m-auto" href="buildList.php">
        <div class="col-12"><img src="imagens/Build List.png" alt="Build List menu icon image." class="w-50"></div>
        <div class="col-12">Build List</div>
    </a>
    <a class="col-12 row text-center m-auto" href="buildCreator.php">
        <div class="col-12"><img src="imagens/Build Creator.png" alt="Build Creator menu icon image." class="w-50"></div>
        <div class="col-12">Build Creator</div>
    </a>
    <a class="col-12 row text-center m-auto" href="includes/switchCategory.php">
        <div class="col-12"><img src="imagens/Switch to <?= $_SESSION["otcategory"] ?>.png" alt="Survivor List menu icon image." class="w-50"></div>
        <div class="col-12">Switch to <?= $_SESSION["otcategory"] ?></div>
    </a>
</nav>