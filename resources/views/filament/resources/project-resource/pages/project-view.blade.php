<x-filament::page>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
		
		<!-- Favicon -->
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
		
		<!-- Toastr Css -->
		<link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
		<!-- Toastify css -->
		<link rel="stylesheet" href="{{asset('assets/plugins/toastify/src/toastify.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		<div class="card">
		<div class="card-body">
		<div class="col-lg-6 col-xl-8">
				<h3> {{$record->name}}</h3>
		</div>
		</div><div>
</div>

		</div>
					<div class="row">
						<div class="col-lg-6 col-xl-8">
							<div class="card">
								<div class="card-body">
									<div class="project-title">
										<h3>Description</h3>
									</div>
									<br>
								{{$record->description}};
									<p></p>
								</div>
							</div>
				
							<div class="card">
								<div class="card-body">
				                    <h5 class="card-title m-b-20">Uploaded image files</h5>
									
								
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<h5 class="card-title m-b-20">Uploaded files</h5>
									<ul class="files-list">
										
									</ul>
								</div>
							</div>
							<div class="project-task">
							
								
							</div>
						</div>
						<div class="col-lg-4 col-xl-4">
							<div class="card">
								<div class="card-body">
									<h6 class="card-title m-b-15">Project details</h6>
									<table class="table table-striped table-border">
										<tbody>
											<tr>
												<td>Client</td>
												<td class="text-right">{{$record->client->firstname }}</td>
											</tr>
											<tr>
												<td>Start Date:</td>
												<td class="text-right">{{$record->start_date}}</td>
											</tr>
											<tr>
												<td>Due Date:</td>
												<td class="text-right">{{$record->end_date}}</td>
											</tr>
											<tr>
												<td>Priority:</td>
												<td class="text-right">
													<div class="btn-group">
														<a>{{$record->priority}} </a>
													</div>
												</td>
											</tr>
											
											<tr>
												<td>Status:</td>
												<td class="text-right">{{$record->status}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="card project-user">
								<div class="card-body">
									<h6 class="card-title m-b-20">Assigned Leader </h6>
									<ul class="list-box">
									
										<li>@foreach($record->users as $user)
											<a href="profile.html">
												<div class="list-item">
													<div class="list-left">
														<span class="avatar"><img alt="" src="assets/img/profiles/avatar-01.jpg"></span>
													</div>
													<div class="list-body">
														<span class="message-author">{{$user->name}}</span>
														<div class="clearfix"></div>
														<span class="message-content">Team Users</span>
													</div>
												</div>
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
							
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<ul class="team-members ">
				
				<!-- Assign Leader Modal -->
				<div id="assign_leader" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Assign Leader to this project</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="input-group m-b-30">
									<input placeholder="Search to add a leader" class="form-control search-input" type="text">
									<span class="input-group-append">
										<button class="btn btn-primary">Search</button>
									</span>
								</div>
								<div>
									<ul class="chat-user-list">
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets/img/profiles/avatar-09.jpg"></span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">Richard Miles</div>
														<span class="designation">Web Developer</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets/img/profiles/avatar-10.jpg"></span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">John Smith</div>
														<span class="designation">Android Developer</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar">
														<img alt="" src="assets/img/profiles/avatar-16.jpg">
													</span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">Jeffery Lalor</div>
														<span class="designation">Team Leader</span>
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Assign Leader Modal -->
				
				<!-- Assign User Modal -->
				<div id="assign_user" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Assign the user to this project</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="input-group m-b-30">
									<input placeholder="Search a user to assign" class="form-control search-input" type="text">
									<span class="input-group-append">
										<button class="btn btn-primary">Search</button>
									</span>
								</div>
								<div>
									<ul class="chat-user-list">
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets/img/profiles/avatar-09.jpg"></span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">Richard Miles</div>
														<span class="designation">Web Developer</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets/img/profiles/avatar-10.jpg"></span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">John Smith</div>
														<span class="designation">Android Developer</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar">
														<img alt="" src="assets/img/profiles/avatar-16.jpg">
													</span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">Jeffery Lalor</div>
														<span class="designation">Team Leader</span>
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Assign User Modal -->
				
				<!-- Edit Project Modal -->
				<div id="edit_project" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Project</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Project Name</label>
												<input class="form-control" value="Project Management" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Client</label>
												<select class="select">
													<option>Global Technologies</option>
													<option>Delta Infotech</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Start Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>End Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label>Rate</label>
												<input placeholder="$50" class="form-control" value="$5000" type="text">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>&nbsp;</label>
												<select class="select">
													<option>Hourly</option>
													<option selected>Fixed</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Priority</label>
												<select class="select">
													<option selected>High</option>
													<option>Medium</option>
													<option>Low</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Add Project Leader</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Team Leader</label>
												<div class="project-members">
													<a class="avatar" href="#" data-toggle="tooltip" title="Jeffery Lalor">
														<img alt="" src="assets/img/profiles/avatar-16.jpg">
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Add Team</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Team Members</label>
												<div class="project-members">
													<a class="avatar" href="#" data-toggle="tooltip" title="John Doe">
														<img alt="" src="assets/img/profiles/avatar-02.jpg">
													</a>
													<a class="avatar" href="#" data-toggle="tooltip" title="Richard Miles">
														<img alt="" src="assets/img/profiles/avatar-09.jpg">
													</a>
													<a class="avatar" href="#" data-toggle="tooltip" title="John Smith">
														<img alt="" src="assets/img/profiles/avatar-10.jpg">
													</a>
													<a class="avatar" href="#" data-toggle="tooltip" title="Mike Litorus">
														<img alt="" src="assets/img/profiles/avatar-05.jpg">
													</a>
													<span class="all-team">+2</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea rows="4" class="form-control" placeholder="Enter your message here"></textarea>
									</div>
									<div class="form-group">
										<label>Upload Files</label>
										<input class="form-control" type="file">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Project Modal -->


            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
	<!-- Bootstrap Core JS -->
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<!-- Slimscroll JS -->
	<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
	<!-- Datetimepicker JS -->
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
	<!-- Ck Editor -->
	<script src="{{asset('assets/plugins/ckeditor/ckeditor.js')}}"></script>
	<!-- Toastr JS -->
	<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
	<!-- Toastify JS -->
	<script src="{{asset('assets/plugins/toastify/src/toastify.js')}}"></script>
	<!-- Custom JS -->
	<script src="{{asset('assets/js/app.js')}}"></script>

	<script src="{{asset('assets/js/select2.min.js')}}"></script>

    </body>
</html>

</x-filament::page>
