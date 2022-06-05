

<?php
  session_start();

  ?>
<nav class="navbar navbar-expand-lg  py-2 topnav2" style="background-color:#007bff;">


    <a class="navbar-brand" href="#">
        <img src="/bally.png" width="200" height="60" alt="">
    </a>

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <?php
                if (isset($_SESSION['valid_user'])) {

                    $old_user = $_SESSION['valid_user'];

                    echo '<h3>' . $old_user["username"] . '</h3>';
                    echo '<a href="/views/user/logout.php">Log out</a><br />';
                }

                ?>

            </li>


            <li class="nav-item">
                <?php
                if (!isset($_SESSION['valid_user'])) {
                    echo ' <a  href="/user/login">Login</a>';
                }
                ?>

            </li>

            <li class="nav-item">
                <?php
                if (!isset($_SESSION['valid_user'])) {
                    echo '<a style="background-color: #;" href="/user/create">Register</a>';
                }
                ?>
            </li>
        </ul>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">


        </ul>
    </div>

</nav>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark py-0 topnav " style="background-color:#3699ff;">
    <!-- Container wrapper -->
    <div class="container-fluid">

        <!-- Navbar brand -->

        <a href="/games"><i class="far fa-futbol"></i>          Games</a>
        <a href="/teams"><i class="fas fa-users"></i>          Teams</a>
        <a href="/players"><i class="fas fa-users"></i>          Players</a>
        <a href="/mail"> <i class="far fa-address-book"></i>         Contact</a>

        <!-- Toggle button -->


        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Link -->

            </ul>

        </div>
    </div>
    <!-- Container wrapper -->
</nav>

<script>
    async function removeday(e) {
        e.preventDefault();
        document.body.innerHTML+= '<br>'+ await(await fetch('?remove=1')).text();
    }
</script>
<!-- Navbar -->