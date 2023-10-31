
<?php searchbar();?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <form class="form-inline">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
    </form>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST" action="home.php">
        <div class="input-group">
            <input type="text" id="searchinput" name="searchinput" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-primary border-0" name="searchbutton" type="submit" style="background: linear-gradient(to right, rgba(94,231,223,0.5), rgba(180,144,202,0.5))">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->

    <!-- Show Date-->
    <ul class="navbar-nav ml-auto">
        <li class="container flex-center" style="background: linear-gradient(to right, rgba(94,231,223,0.5), rgba(180,144,202,0.5))">
        <h5 class=" mt-2 text-primary text-center">
            <i class= "fas fa-calendar  mr-2" ></i>
            <span><?php echo date("d M Y")?></span>
        </h5>
        </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- User Profile -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php usernameTopbar()?></span>
                <img class="img-profile rounded-circle"
                    src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a> -->
                <a class="dropdown-item" href="changepassword.php">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="route-logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>


</nav>
