
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ideagen</title>
    

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <script src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script> 
<script>
function goBack() {
    window.history.back();
}
</script>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                      <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?source=Home"><img alt="Brand" src="img/ideagen.png" height="125%";></a>        
                </div><!-- navbar-header-->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active" ><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button></li>
                            </ul>
                </div><!-- bs-example-navbar-collapse-1 -->
    </nav>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
if(isset($_GET['source'])){
    $source = $_GET['source'];
}
else {
    $source = "";
    
}

?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
               

                <?php

                if ($login->isUserLoggedIn() == true) {
                include("views/homeandprofile.php");
                }


                if ($login->isUserLoggedIn() == true && $_SESSION['CreateTemplate'] == 1) { ?>

  <li <?php if($source == "CreateReportTemplate"){echo "class='active'";} ?>>
                    <a href="?source=CreateReportTemplate"><span class="icon pull-left glyphicon glyphicon-pencil"></span>Create Report Template</a>
                </li> 

<?php
}
                if ($login->isUserLoggedIn() == true && $_SESSION['DeleteTemplate'] == 1 || $_SESSION['UpdateTemplate'] == 1) { ?>

<li <?php if($source == "ViewTemplate"){echo "class='active'";} ?>>
                    <a href="?source=ViewTemplate"><span class="icon pull-left glyphicon glyphicon-eye-open"></span>Report Template's</a>
                </li>
<?php
}



                if ($login->isUserLoggedIn() == true && $_SESSION['user_management'] == 1) { ?>

<li <?php if($source == "CreateUser"){echo "class='active'";} ?>>
                    <a href="?source=CreateUser"><span class="icon pull-left glyphicon glyphicon-edit"></span>Create User</a>
                </li>

                <li <?php if($source == "ViewUser"){echo "class='active'";} ?>>
                    <a href="?source=ViewUser"> <span class="icon pull-left glyphicon glyphicon-sunglasses"></span>View User</a>
                </li> 
<li <?php if($source == "CreateRole"){echo "class='active'";} ?>>
                    <a href="?source=CreateRole"> <span class="icon pull-left glyphicon glyphicon-plus-sign"></span>CreateRole</a>
                </li>
<li <?php if($source == "ViewRole"){echo "class='active'";} ?>>
                    <a href="?source=ViewRole"> <span class="icon pull-left glyphicon glyphicon glyphicon-ok-circle"></span>View Role</a>
                </li>
<li <?php if($source == "ViewArchiveUser"){echo "class='active'";} ?>>
                    <a href="?source=ViewArchiveUser"> <span class="icon pull-left glyphicon glyphicon glyphicon-ban-circle"></span>View Archived Users</a>
                </li><?php
}

                if ($login->isUserLoggedIn() == true && $_SESSION['CreateReport'] == 1) { ?>
<li <?php if($source == "CreateReports"){echo "class='active'";} ?>>
                    <a href="?source=CreateReports"><span class="icon pull-left glyphicon glyphicon-folder-open"></span>Create Report</a>
                </li>

  <li <?php if($source == "ViewSubmittedReports"){echo "class='active'";} ?>>
                    <a href="?source=ViewSubmittedReports"> <span class="icon pull-left glyphicon glyphicon-file"></span>View My Reports</a>
                </li> 
 <?php
}


                if ($login->isUserLoggedIn() == true && $_SESSION['EditReport'] == 1 || $_SESSION['DeleteReport'] == 1 || $_SESSION['CloseReport'] == 1 || $_SESSION['ChangeReport'] == 1) { ?>

                <li <?php if($source == "ViewReports"){echo "class='active'";} ?>>
                    <a href="?source=ViewReports"> <span class="icon pull-left glyphicon glyphicon-briefcase"></span>View Reports</a>
                </li>
 <?php
}

                    ?>


            </ul>
        </div><!-- /#sidebar-wrapper -->
        <!-- Page Content -->

        <div id="page-content-wrapper">
        <div class="container">
<div class="row">
<div class="col-lg-10">

<?php


switch($source){
    
    case 'Home';
    include"views/Home.php";
    break;
    
    case 'Profile';
    include"views/Profile.php";
    break;

    case 'ArchiveTemplate';
    include"views/ArchiveTemplate.php";
    break;

    case 'ViewRole';
    include"views/ViewRoles.php";
    break;

 case 'ReadReport';
    include"views/ReadReport.php";
    break;

case 'SubmitReport';
    include"views/SubmitReport.php";
    break;
    

    case 'CreateUser';
    include"views/CreateUser.php";
    break;

    case 'UpdateTemplate';
    include"views/UpdateTemplate.php";
    break;
    
    case 'ViewUser';
    include"views/ViewUsers.php";
    break;
    
    case 'CreateReportTemplate';
    include"views/template.php";
    break;

case 'TemplateName';
include"views/TemplateName.php";
break;
    
case 'ViewTemplate';
include"views/ViewTemplates.php";
break;

case 'Upload';
include"views/upload.php";
break;


case 'DeleteUpload';
include"views/DeleteUpload.php";
break;

    
case 'ViewArchiveTemplate';
include"views/ViewArchiveTemplates.php";
break;

case 'ActivateTemplate';
include"views/ActivateTemplate.php";
break;

    case 'ViewReports';
    include"views/ViewReports.php";
    break;
    
    case 'CreateReports';
    include"views/CreateReport.php";
    break;
    
    case 'ViewSubmittedReports';
    include"views/ViewSubmittedReports.php";
    break;
    
    case 'DeleteTemplate';
    include"views/DeleteTemplate.php";
    break;

    case 'register';
    include"register.php";
    break;
    
    case 'UpdateUser';
    include"views/updateuser.php";
    break;
    
    case 'DeleteUser';
    include"views/deleteuser.php";
    break;

    case 'DeleteReport';
    include"views/DeleteReport.php";
    break;

    case 'DeleteMyReport';
    include"views/DeleteMyReport.php";
    break;

    case 'CloseReport';
    include"views/CloseReport.php";
    break;

    case 'OpenReport';
    include"views/OpenReport.php";
    break;

case 'ArchiveUser';
    include"views/ArchiveUser.php";
    break;

case 'ActivateUser';
    include"views/ActivateUser.php";
    break;

case 'ViewArchiveUser';
    include"views/ViewArchiveUsers.php";
    break;
case 'CreateRole';
    include"views/CreateRole.php";
    break;

case 'UpdateRole';
    include"views/UpdateRole.php";
    break;

case 'DeleteRole';
    include"views/DeleteRole.php";
    break;

case 'ViewReportTemplate';
    include"views/ViewReportTemplate.php";
    break;
} 



if(isset($_GET['TemplateName'])){

include"views/TemplateName.php";

} else if(isset($_GET['ReportTemplate'])){

include"views/ReportTemplate.php";
} else if(isset($_GET['UpdateReport'])){

include"views/UpdateReport.php";
} 

?>
    </div>
</div>
</div>
       
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/sidebar_menu.js"></script>
</body>

</html>
