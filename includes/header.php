<style>

.navbar-nav > li > a:hover {
    background-color: transparent !important;
    color: #DA2535  !important;
}
    .navbar {
    margin-bottom: 0px !important ;
    }
    .nav_link{
        transition: .3s;
    }

hr{
    margin-top: 0px ;
    margin-bottom: 0px ;
}
@media (min-width: 768px) {
  .navbar-collapse.collapse {
    display: flex !important;
    justify-content: center;
  }
}



</style>

<?php if ($_SESSION['login']) { ?>
    <nav class="navbar">
        <div class="container">
            
            <div class="navbar-collapse collapse justify-content-center">
                <ul id="menu-top" class="nav navbar-nav ">
                    <li><a href="dashboard.php" class="nav_link">Dashboard</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle nav_link" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">My Profile</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                        </ul>
                    </li>
                    <li><a href="issued-books.php"class="nav_link" >Issued Books</a></li>
                    <li><a href="logout.php" class="nav_link">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <hr>
    <?php } else { ?>
        <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <span class="navbar-text" style="color: #000">Central Library - NITJ</span>
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul id="menu-top" class="nav navbar-nav navbar-right">
                    <li><a href="#" class="">Admin Login</a></li>
                    <li><a href="index2.php">Student Login</a></li>
                    <li><a href="signup.php" class="">Student Registeration</a></li>
                </ul>
            </div>
        </div>
    </nav>
        <hr>

    <?php } ?>




