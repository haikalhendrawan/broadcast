<ul class="navbar-nav sidebar accordion" id="accordionSidebar" style="background: linear-gradient(to right, rgba(94,231,223,0.5), rgba(180,144,202,0.5))">

    <!-- Logo dan Judul Aplikasi -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-dice-d6"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Test App</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" >

    <!--Menu Home-->
    <li class="nav-item">
        <a class="nav-link text-primary" href="home.php">
            <i class="fa fa-home "></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!--Pemisah Main Content-->
    <div class="sidebar-heading text-dark">
        Main Content
    </div>

    <!--Menu Broadcast List-->
    <li class="nav-item">
        <a class="nav-link text-primary" href="broadcastlist.php">
            <i class="fas fa-satellite-dish"></i>
            <span>All Broadcast</span>
        </a>
    </li>

    <!--Menu Buat Broadcast-->
    <li class="nav-item" id="navitemcreatebroadcast">
        <a class="nav-link text-primary" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities" role="button">
            <i class="fas fa-paper-plane"></i>
            <span>Create Broadcast</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Create:</h6>
                <a class="collapse-item" href="createwhatsappsingle.php">Single Broadcast</a>
                <a class="collapse-item" href="createwhatsapprecurring.php">Scheduled Broadcast</a>
            </div>
        </div>
    </li>

    <!--Menu Monitoring-->
    <li class="nav-item"id="navitemarchive">
        <a class="nav-link text-primary" href="#" data-toggle="collapse" data-target="#whatsappcollapse" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-archive"></i>
            <span>Archive</span>
        </a>
        <div id="whatsappcollapse" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Archive</h6>
                <a class="collapse-item" href="mybroadcast.php">My Broadcast</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!--Pemisah Admin-->
    <div class="sidebar-heading text-dark">
        Admin
    </div>

    <!--- Menu Reference-->
    <li class="nav-item">
        <a class="nav-link text-primary" href="activebroadcast.php">
            <i class="fa fa-business-time"></i>
            <span>Active Broadcast</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-primary" href="reference.php">
            <i class="fa fa-database"></i>
            <span>Reference</span>
        </a>
    </li>
  
    <!--Menu Fitur
    <li class="nav-item">
        <a class="nav-link" href="fitur.php">
            <i class="fas fa-comment-alt"></i>
            <span>Rekap Fitur</span>
        </a>   
    </li>-->

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!--Pemisah Other-->
    <div class="sidebar-heading text-dark">
        Other
    </div>

    <!-- Menu Feedback -->
    <li class="nav-item">
    <a class="nav-link text-primary" href="createfeedback.php">
        <i class="fas fa-comment-alt"></i>
        <span>Feedback</span>
    </a>   
    </li>
    <!-- Menu Leaderboard -->
    <!--<li class="nav-item">
        <a class="nav-link" href="charts.html">
        <i class="fas fa-chart-bar"></i>
        <span>Leaderboard</span></a>
    </li>-->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
