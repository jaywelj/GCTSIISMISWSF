<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="assets/img/GCTS LOGO1.png">
	<title>Student Account Archive | OCPS</title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- Datatables -->
	<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>
<?php
require 'header.php';
?>
<body class="nav-md">
	<div class="container body" id="div1">
		<div class="main_container">
			<!-- side navigation -->
			<?php 
			require 'sidebar.php';
			?>
			<!-- /side navigation -->
			<!-- top navigation -->
			<?php 
			require 'navbar.php';
			?>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage Archived Student Accounts<small></small></h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Student Accounts <small>StudentAccounts</small></h2>
									<ul class="nav navbar-right">
										<!-- <button class="btn btn-default btn-info" data-toggle="modal" data-target="#add_data_Modal" type="button">ADD STUDENT ACCOUNT</button> -->
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable-buttons" class="table table-striped table-bordered">

										<thead>
											<tr>
												<th></th>
												<th>Student Number</th>
												<th>First Name</th>
												<th>Middle Name</th>
												<th>Last Name</th>
												<th>Image</th>
											</tr>
										</thead>


										<tbody>
											<?php  
											include("connectionString.php");  
											$queryStudent = "SELECT * FROM tbl_studentaccountarchive ORDER BY tbl_studentaccountarchive.studentNumber DESC";
											$resultStudent = mysqli_query($connect, $queryStudent); 

											$queryPersonalInfo = "SELECT * FROM tbl_personalinfoarchive ORDER BY tbl_personalinfoarchive.studentNumber DESC";
											$resultPersonalInfo = mysqli_query($connect, $queryPersonalInfo);
											while($row = mysqli_fetch_array($resultStudent) AND $res = mysqli_fetch_array($resultPersonalInfo))   
												{
  
											 
																								 	# code...
												  
												?>  
												<tr>
													<td width="14%" >
														<center>

															<a title="Revive" class="btn btn-info" href="manageAccountStudentAccountReturn.php?id=<?php echo$row['studentNumber']; ?>" onClick="return confirm('Are you sure you want to return?')"><span class="fa fa-share-square"></span></a>

															<a title="Delete" class="btn btn-danger" title="Delete" href="manageAccountStudentAccountArchivedDelete.php?id=<?php echo $row['studentNumber']; ?>" onClick="return confirm('Are you sure you want to delete?')"><span class="glyphicon glyphicon-trash"></span></a>

														</center>
													</td>
													<td> <?php echo $row['studentNumber'];?> </td>
													<td> <?php echo $res['firstName'];?> </td>
													<td> <?php echo $res['middleName'];?> </td>
													<td> <?php echo $res['lastName'];?> </td>
													<td> 
														<center>	
															<?php


															$VarcharStudentProfileImage = $res['studentDisplayPic'];
															if(empty($VarcharStudentProfileImage))
															{
																echo '
																<img src="assets/img/default-user.png" height="200" width="200" style="object-fit:cover;">
																';
															}
															else{
																echo '<img src="data:image/jpeg;base64,'.base64_encode($res['studentDisplayPic'] ).'" height="200" width="200" style="object-fit:cover;" />';
															}

															?>
														</td>
														</center>
													</tr>  
													<?php
												}
											
												?> 
											</tbody>
											<tfoot>
											<tr>
												<th></th>
												<th>Student Number</th>
												<th>First Name</th>
												<th>Middle Name</th>
												<th>Last Name</th>
												<th>Image</th>
											</tr>
										</tfoot>
										</table>
									</div>
								</div>
							</div>
							<!--Other Tables othertables/-->
						</div>
					</div>
				</div>
				<!-- /page content -->
				<!--Modal view-->
				<form method="post" enctype="multipart/form-data">
					<div id="view_data_Modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #800; color:#fff; margin-right: -1px;">
									<button type="button" class="close" data-dismiss="modal" style="color: #fff" >&times;</button>
									<h4 class="modal-title text-center">STUDENT ACCOUNT DETAILS</h4>
								</div>
								<div class="modal-body" id="studentAccountDetails"    style=" padding: 5px 50px 5px 50px;">

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--/Modal view-->
				<!--Modal Edit-->
				<form method="post" enctype="multipart/form-data">
					<div id="edit_data_Modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #800; color:#fff; margin-right: -1px;">
									<button type="button" class="close" data-dismiss="modal" style="color: #fff" >&times;</button>
									<h4 class="modal-title text-center">EDIT STUDENT ACCOUNT DETAILS</h4>
								</div>
								<div class="modal-body" id="editStudentAccountDetails"    style=" padding: 25px 50px 5px 50px;">

								</div>
								<div class="modal-footer">
									<input type="submit" name="btnUpdate" id="btnUpdate" value="Update" class="btn btn-success"/>
									<button type="button" class="btn btn-danger  pull-right" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--/Modal Edit-->
				<!--Modal Add-->
				<form method="post" enctype="multipart/form-data">
					<div id="add_data_Modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #800; color:#fff; margin-right: -1px;">
									<button type="button" class="close" data-dismiss="modal" style="color: #fff" >&times;</button>
									<h4 class="modal-title text-center">ADD NEW ACCOUNT</h4>
								</div>
								<div class="modal-body" style=" padding: 25px 50px 5px 50px;">
									<label>Student Number</label>
									<input type="text" name="txtbxStudentNumber" id="txtbxStudentNumber" class="form-control" />
									<br />
									<label>First Name</label>
									<input type="text" name="txtbxStudentFirstName" id="txtbxStudentFirstName" class="form-control" />
									<br />
									<label>Middle Name</label>
									<input type="text" name="txtbxStudentMiddleName" id="txtbxStudentMiddleName" class="form-control" />
									<br />
									<label>Last Name</label>
									<input type="text" name="txtbxStudentLastName" id="txtbxStudentLastName" class="form-control" />
									<br />
									<?php

								// php select option value from database
									include("connectionString.php");

								// mysql select query
									$queryCourse2 = "SELECT * FROM tbl_course";

								// for method 1/
									$resultCourse2 = mysqli_query($connect, $queryCourse2);

									?>
									<label>Course</label>
									<select name="selectStudentCourse" id="selectStudentCourse" class="form-control">
										<option value="NULL" selected>Select A Course</option>
										<?php while($row = mysqli_fetch_array($resultCourse2)):;?>
											<option value="<?php echo $row[0];?>"><?php echo $row[0];?> - <?php echo $row[1];?></option>
										<?php endwhile;?>
									</select>
									<br />
									<label>Year</label>
									<input type="number" name="txtbxStudentYear" id="txtbxStudentYear" class="form-control" />
									<br />
									<label>Section</label>
									<input type="number" name="txtbxStudentSection" id="txtbxStudentSection" class="form-control" />
									<br />
									<label>Password</label>
									<input type="password" name="txtbxStudentPassword" id="txtbxStudentPassword" class="form-control" />
									<br />
									<label>Image</label>
									<input type="file" name="fileStudentImage" id="fileStudentImage" class="form-control" />
									<br />
								</div>
								<div class="modal-footer">
									<input type="submit" name="btnAdd" id="btnAdd" value="Add Account" class="btn btn-success " />
									<button type="button" class="btn btn-danger  pull-right" data-dismiss="modal">Close</button> 
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--/Modal Edit-->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- jQuery -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../vendors/fastclick/lib/fastclick.js"></script>
		<!-- NProgress -->
		<script src="../vendors/nprogress/nprogress.js"></script>
		<!-- iCheck -->
		<script src="../vendors/iCheck/icheck.min.js"></script>
		<!-- Datatables -->
		<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
		<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
		<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
		<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
		<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
		<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
		<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
		<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
		<script src="../vendors/jszip/dist/jszip.min.js"></script>
		<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
		<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

		<!-- Custom Theme Scripts -->
		<script src="../build/js/custom.min.js"></script>

		<script>
			$(document).ready(function(){
				$(document).on('click','.btn-view',function(){
					var studentNumber = $(this).attr("id");
					$.ajax({
						url:"viewStudentAccountDetails.php",
						method:"post",
						data:{studentNumber:studentNumber},
						success:function(data){
							$('#studentAccountDetails').html(data);
							$('#view_data_Modal').modal('show');
						}
					});
				});
				$(document).on('click','.btn-edit',function(){
					var studentNumber = $(this).attr("id");
					$.ajax({
						url:"editStudentAccountDetails.php",
						method:"post",
						data:{studentNumber:studentNumber},
						success:function(data){
							$('#editStudentAccountDetails').html(data);
							$('#edit_data_Modal').modal('show');
						}
					});
				});
			});
		</script>

	</body>
	</html>