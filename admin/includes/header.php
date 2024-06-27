<style>
    #menu-top a{/* Adjust the font size as per your requirement */
    font-weight: 600; /* Adjust the font weight as per your requirement */
    color: #000; 
}
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

</style>

    <nav class="navbar" style= "min-height: 0px">
        <div class="container" style="padding-left:74px">
           
            <div class="navbar-collapse collapse justify-content-center">
                <ul id="menu-top" class="nav navbar-nav">
                    <li><a href="dashboard.php" class="nav_link">Dashboard</a></li>
                    <li>
                                <a href="#" class="dropdown-toggle nav_link" id="ddlmenuItem" data-toggle="dropdown"> Categories <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-category.php">Add Category</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-categories.php">Manage Categories</a></li>
                                </ul>
                    </li>
                    <li>
                                <a href="#" class="dropdown-toggle nav_link" id="ddlmenuItem" data-toggle="dropdown"> Authors <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-author.php">Add Author</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-authors.php">Manage Authors</a></li>
                                </ul>
                    </li>
                    <li>
                                <a href="#" class="dropdown-toggle nav_link" id="ddlmenuItem" data-toggle="dropdown"> Notifications <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-notification.php">Add Notifications</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-notification.php">Manage Notifications</a></li>
                                </ul>
                    </li>
                    <li>
                                <a href="#" class="dropdown-toggle nav_link" id="ddlmenuItem" data-toggle="dropdown"> Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-book.php">Add Book</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Manage Books</a></li>
                                </ul>
                    </li>
                    <!-- <li>
                                <a href="#" class="dropdown-toggle nav_link" id="ddlmenuItem" data-toggle="dropdown"> Issue Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-book.php">Issue New Book</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-books.php">Manage Issued Books</a></li>
                                </ul>
                    </li> -->
                    <li><a href="reg-students.php" class="nav_link">Reg Students</a></li>
                    
                    <li><a href="change-password.php" class="nav_link">Change Password</a></li>
                    
                    <li><a href="logout.php" class="nav_link">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <hr style="margin-top: 0px ; margin-bottom: 0px">