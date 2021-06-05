<div class="row fixed-top">
    <nav id="navbar-1" class="navbar pt-0 pr-1 d-none d-lg-flex navbar-expand-sm bg-none navbar-dark shadow-sm col-12">
        <ul class="text-white navbar-nav ml-auto bg-md-dark mr-2 mt-1 pr-1" id="nav-text-2">
                <li id="nav-company" class="nav-item mt-1 ml-auto mr-4 active"><h6 class="d-inline" id="username"><?php echo($_SESSION["username"]); ?></h6></li>
        </ul>
    </nav>
    <nav class="navbar p-1 navbar-expand-md  bg-light bg-none navbar-dark shadow-sm col-12">
        <a href="index.php" class="navbar-brand">
            <!-- Logo Image -->
            <img src="./img/logo2.png" width="200" alt="SportsREg" class="d-inline-block align-middle mr-1 ml-4">
            <!-- Logo Text -->
        </a>
        <button class="navbar-toggler mr-3 border-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="bg-color-1 navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse text-md-center navbar-collapse ml-auto">
            <ul class="navbar-nav ml-auto">
                <li id="nav-logout" class="nav-item mt-1 active mx-auto nav-text-1"><h5 class="d-inline pr-5" data-toggle="tooltip" title="Logout!">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">                
                    <button class="bg-transparent border-0 mr-5 mt-3" type="submit"  name="logout">
                            <i class="fa fa-sign-out d-none d-md-flex fa-lg nav-text-1 mt-2 ml-0" aria-hidden="true"></i><p class="d-flex text-white ml-5 py-0 my-0 d-md-none">Logout</p></h5></li>
                    </button>     
                </form>
                </ul>
        </div>
    </nav>

</div>
