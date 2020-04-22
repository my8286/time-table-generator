<?php
include('../../plugins/timetable/connection.php');
session_start();
if(isset($_SESSION['hodsc']))
{
	if(isset($_SESSION['designationSC'],$_SESSION['first_nameSC'],$_SESSION['last_nameSC'],$_SESSION['deptSC']))
	{
		$dept=$_SESSION['deptSC'];
		$con= mysqli_connect(constant('host'),constant('user'),constant('password'),constant('db')); 
		if(isset($_POST['logout']))
		{
			session_unset(); 
			session_destroy();
			header("Location:../../index.php");
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Government Ploytechnic Mumbai</title>
	<link rel="icon" href="../../dist/img/card.png" type="image/gif">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<style>
	.red{
		color:red;
	}
	/* The Modal (background) */
	.password-modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 10; /* Sit on top */
	padding-top: 250px; /* Location of the box */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.password-modal-content {
	background-color: #fefefe;
	margin: auto;
	padding: 20px;
	border: 1px solid #888;
	width: 20%;
	}
	</style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <a href="../../hodsc.php" class="logo"><b> GP </b>Mumbai</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu" >
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a>
								<i class="ion ion-person"></i>
								<span class="hidden-xs"><?php echo strtoupper($_SESSION['first_nameSC'])." ".strtoupper($_SESSION['last_nameSC']);?></span>
							</a>
						</li>
						<!---logout--->
					    <li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle">
								<form method="post" style="margin-top:-55%;padding-top:39%"> 
									<button type="submit" name="logout" style="background-color:transparent" ><i class="fa fa-bell-o"></i></button>
								</form>
							</a>    
						</li>
					</ul>
				</div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../hodsc.php"><i class="fa fa-circle-o"></i> Home</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="teacherform.php"><i class="fa fa-circle-o"></i> Teacher </a></li>
                <li><a href="subjectform.php"><i class="fa fa-circle-o"></i> Subject</a></li>
                <li><a href="roomform.php"><i class="fa fa-circle-o"></i> Room</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../sctables/simple.php"><i class="fa fa-circle-o"></i> Simple </a></li>
                
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Table
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../hodsc.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Subject</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Subject Table </h3>
				<!---  <button onclick="takePrint()" class="pull-right btn bg-blue" style="float:right"><span class="glyphicon glyphicon-print"></span> Print</i></button>-->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
						<th>Year</th>
                        <th>Type</th>
						<th>TH Time</th>
                        <th>PR Time</th>
						<th>Semester</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					$i=0;
					$q=mysqli_query($con,"select *from subject where dept='$dept' ORDER BY year ASC") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{ ?>
                      <tr>
						<td><?php echo ++$i;?></td>
                        <td class="subject" data-id="<?php echo $row['subject_id'];?>" data-id2="subject_name" contenteditable><?php echo strtoupper($row['subject_name']);?></td>
                        <td class="subject" data-id="<?php echo $row['subject_id'];?>" data-id2="subject_code" contenteditable><?php echo strtoupper($row['subject_code']);?></td>
                        <td class="subject" data-id="<?php echo $row['subject_id'];?>" data-id2="year" contenteditable><?php echo strtoupper($row['year']);?></td>
                        <td class="subject" data-id="<?php echo $row['subject_id'];?>" data-id2="type" contenteditable><?php if($row['type']=='both')echo ucfirst($row['type']); else echo strtoupper($row['type']);?></td>
                        <td class="subject" data-id="<?php echo $row['subject_id'];?>" data-id2="theory_time" contenteditable><?php if($row['theory_time']==0) echo '<i class="fa fa-ellipsis-h red"></i>'; else echo $row['theory_time'];?></td>
						<td class="subject" data-id="<?php echo $row['subject_id'];?>" data-id2="practical_time" contenteditable><?php if($row['practical_time']==0) echo '<i class="fa fa-ellipsis-h red"></i>'; else echo $row['practical_time'];?></td>
						<td class="subject" data-id="<?php echo $row['subject_id'];?>" data-id2="semester" contenteditable><?php echo ucfirst($row['semester']);?></td>
					</tr>
				<?php
					}?>				
                      
                    </tbody>
                  <!--  <tfoot>
                      <tr>
                        <th>Enrollment No.</th>
                        <th>Full Name</th>
                        <th>Practical</th>
                        <th>Theory</th>
                        <th>Percentage</th>
                      </tr>
                    </tfoot>-->
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>IF</b> GPM
        </div>
        <strong>Copyright &copy; 2017-2018, <a href="">Manish Kumar Yadav</a> & Team.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
	
	<!-- confirmation modal -->
	<div id="myPass" class="password-modal">
	  <!-- Modal content -->
	  <div class="password-modal-content">
		<form action="#" onsubmit="return update('subject')" method="post">
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" class="form-control" placeholder="Enter password ">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" name="submit" value="OK" class="form-control btn btn-primary">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<button onclick="passCancel('myPass')" class="form-control btn btn-primary">cancel</button>
					</div>
				</div>

			</div>
		</form>
	  </div>
	</div>

    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js" type="text/javascript"></script>
	<!-- page script -->
	<script src="../../dist/js/allpages.js" type="text/javascript"></script>
	<!-- page script -->
	<script src="../../dist/js/allpages.js" type="text/javascript"></script>
	<!-- update script -->
	<script src="../../dist/js/update.js" type="text/javascript"></script>
    <!-- page script current  -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
	  function deptVal()
	  {
		  return '<?php echo $dept;?>';
	  }
	  function userPass()
	  {
		return '<?php echo $_SESSION['passwordHOD'];?>';
	  }
    </script>

  </body>
</html>
<?php
 }
}
else
{
	header("Location:../../index.php");
}

	
?>