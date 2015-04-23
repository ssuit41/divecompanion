<?php
//Start session
if(!isset($_SESSION))
{
session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A website to assist divers with gathering predive information and
	discussing various aspects of diving." />
    <meta name="keywords" content="dive, dive help, dive site, dive information, dive assistant" />
    <title>Dive Companion</title>
    <link rel="stylesheet" type="text/css" href="/divecompanion/css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/divecompanion/css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/divecompanion/css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/divecompanion/css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/divecompanion/css/nav.css" media="screen" />
    <link href="/divecompanion/css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/divecompanion/style.css" type="text/css">
    
     <!-- BEGIN: load jquery -->
    <script src="/divecompanion/js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/divecompanion/js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="/divecompanion/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="/divecompanion/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="/divecompanion/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="/divecompanion/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="/divecompanion/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="/divecompanion/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="/divecompanion/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="/divecompanion/js/table/table.js"></script>
    <script src="/divecompanion/js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    
</head>
<body>
<div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft"><h2 class="cmp_name">Dive Companion</h2>
                    <!--<img src="img/logo.png" alt="Logo" />--></div>
                <div class="floatright">
                    <div class="floatleft">
                          <?php  if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']) { ?>
                        <img src="/divecompanion/img/img-profile.jpg" alt="Profile Pic" />
                        <?php } ?>
                        </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li> 
                           <?php  if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']) {
	                               echo 'Hello ' . $_SESSION['user_name'] ;  ?>
	                       
                            </li>
                           <!-- <li><a href="#">Config</a></li>-->
                            <li><a href="/divecompanion/users/signout.php">Logout</a></li>
                           <?php   } else {?>
                           <li><a href="/divecompanion/users/signin.php">Log In</a></li>
                            <li><a href="/divecompanion/users/signup.php">Sing Up</a></li>
                        <?php } ?>
                        </ul>
                        <br />
                        <!--<span class="small grey">Last Login: 3 hours ago</span>-->
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="/divecompanion/home.php"><span>Home</span></a> </li>
                <li class="ic-form-style"><a href="/divecompanion/forums/forum.php"><span>Forum</span></a> </li>
                <li class="ic-notifications	"><a href="/divecompanion/account.php"><span>Account</span></a></li>
				<li class="ic-charts"><a href="/divecompanion/wiki/addData.php"><span>Add Data</span></a></li>
                <li class="ic-grid-tables"><a href="/divecompanion/forums/create_category.php"><span>Create Category</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>

 <div class="grid_12">
<div class="searchbar">
	<form method="post" action="/divecompanion/wiki/diveSearch.php" id="searchform">
	<span class="slabel">Latitude: </span><input type="number" name="lat">
	<span class="slabel">Longitude: </span><input type="number" name="long">
	<span class="slabel">Distance: </span><input type="number" name="distance">
	<span class="head_searchbtn"><input class="btn btn-maroon" type="submit" name="submit" value="Search"></span>
	</form>
</div>
 </div>	
<!--<h1>Dive Companion</h1>
 <div id="menu">
    <a class="item" href="/divecompanion/home.php">Home</a> -
	<a class="item" href="/divecompanion/forums/forum.php">Forum</a> -
	<a class="item" href="/divecompanion/account.php">Account</a> -
	<a class="item" href="/divecompanion/wiki/addData.php">Add Data</a> -
	<a class="item" href="/divecompanion/forums/create_category.php">Create Category</a>
</div>
<div id="searchbar">
	<form method="post" action="/divecompanion/wiki/diveSearch.php" id="searchform">
	<input type="number" name="lat">
	<input type="number" name="long">
	<input type="number" name="distance">
	<input type="submit" name="submit" value="Search">
	</form>
</div>
<div id="aside">-->
	<?php /*?><?php
	if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
	{
	echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a href="/divecompanion/users/signout.php">Sign out</a>';
	}
	else
	{
	echo '<a href="/divecompanion/users/signin.php">Sign in</a> or <a href="/divecompanion/users/signup.php">create an account</a>.';
	}?><?php */?>
<!--</div>

<div id="section">-->