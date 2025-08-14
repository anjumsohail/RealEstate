@extends('layouts.main')

@section('content')
<div>
    <div style="display: flex;">
		<div style="width: 100%;">
			<div class="post-wrapper-heading">
				<i class="fa fa-fw fa-pencil-square-o"></i> User Profile
			</div>
		</div>
		
	</div>
</div>
<section class="generalwrapper dm-shadow clearfix">
  <!-- Container -->
  <div class="container-fluid">
	<div class="row">
		<div id="content" class="col-md-12">
			    <ul class="list-inline ">
					<li style="
    display: inline-block;
"><a href="https://www.pins.pk/user/account" class="btn-system btn-medium border-btn btn-green active">My Profile </a></li>
			<li><a href="https://www.pins.pk/user/properties" class="btn-system btn-medium border-btn btn-green">My Properties </a></li>
			
			</ul> 
		</div>
	</div>	

	<div class="row">
		<!-- Start Main Content Side -->
		<form id="usrPrfComp" class="form-horizontal" action="https://www.pins.pk/user/profile" enctype="multipart/form-data" data-fv-framework="bootstrap" data-fv-icon-valid="glyphicon glyphicon-ok" data-fv-icon-invalid="glyphicon glyphicon-remove" data-fv-icon-validating="glyphicon glyphicon-refresh" method="post">
		<div id="content" class="col-lg-12">

			<!-- Start Call Action -->
			<div class="boxes clearfix">
				<!-- Service Information Column -->
				<h3 class="title"><i class="fa fa-fw fa-user"></i> <b>Personal Information</b> <span class="pull-right">Register as : <b>Business</b> </span></h3>
				<div class="control-group form-group">
					<div class="controls text-center">
					
					<button type="submit" class="btn-system border-btn btn-small btn-green">Edit Profile</button>
				
					</div>
				</div>

                <div class="row">
                    <div class="col-lg-8">	
					<div class="row">											
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Full Name:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-4">
							<p class="text-info"><strong>Anjum</strong></p>
						</div>
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Profile ID:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-2">
							<p class="text-info">1600</p>
						</div>
					</div>
					<div class="row">											
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Email:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-9">
							<p class="text-info">itdanjum@gmail.com</p>
						</div>
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Created:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-9">
							<p class="text-info">2024-06-27 10:41:04</p>
						</div>
					</div>
					<div class="row">											
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Address:</strong></p>
						</div>
						<div class="col-sm-10 col-xs-9">
							<p class="text-info"> </p>
						</div>
					</div>
					<div class="row">											
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Mobile No.:</strong></p>
						</div>
						<div class="col-sm-2 col-xs-3">
							<p class="text-info">03212244779</p>
						</div>
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Whatsapp:</strong></p>
						</div>
						<div class="col-sm-2 col-xs-3">
							<p class="text-info">03212244779</p>
						</div>
						<div class="col-sm-2 col-xs-3">
							<p class="pull-right"><strong>Landline:</strong></p>
						</div>
						<div class="col-sm-2 col-xs-3">
							<p class="text-info"></p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="text-center">
						<div class="img-responsive">
							<img class="img-rounded img-thumbnail" src="https://www.pins.pk/uploads/agent/0.jpg" alt="Anjum?&gt;">
						</div>
					</div>
				</div>

                </div>
				<hr>
				<div class="col-lg-12">
					<h3 class="title"><i class="fa fa-fw fa-comments"></i> <strong>Your Social Links</strong></h3>
					<div class="row">											
						<div class="col-sm-2 col-xs-4">
							<p class="pull-right"><strong>Facebook URL:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-8">
							<p class="text-info"></p>
						</div>						
						<div class="col-sm-2 col-xs-4">
							<p class="pull-right"><strong>Twitter URL:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-8">
							<p class="text-info"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-xs-4">
							<p class="pull-right"><strong>LinkedIn URL:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-8">
							<p class="text-info"></p>
						</div>
						<div class="col-sm-2 col-xs-4">
							<p class="pull-right"><strong>Google+ URL:</strong></p>
						</div>
						<div class="col-sm-4 col-xs-8">
							<p class="text-info"></p>
						</div>
					</div>				
				</div>
                <hr>
												<div class="col-lg-12">
					<h3 class="title"><i class="fa fa-fw fa-home"></i> <strong>Business / Company Information</strong></h3>
					<div class="col-lg-8">	
					<div class="row">											
						<div class="col-sm-3 col-xs-5">
							<p class="pull-right"><strong>Company Name:</strong></p>
						</div>
						<div class="col-sm-9 col-xs-7">
							<p class="text-info"><strong></strong></p>
						</div>
					</div>
					<div class="control-group form-group">
						<div class="controls">
							<label for="agenttype" class="col-lg-3 control-label">Nature of Business:</label>
							<div class="col-sm-9 col-xs-12">
								<div class="post-tags-list">									
								<a href="javascript:void(0)"><input type="checkbox" name="agree" checked="" disabled=""> </a> 								</div>
							</div>	
						</div>
					</div>
					<div class="row">											
						<div class="col-sm-3 col-xs-3">
							<p class="pull-right"><strong>Your Title:</strong></p>
						</div>
						<div class="col-sm-9 col-xs-9">
							<p class="text-info">Property Consultant</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-xs-3">
							<p class="pull-right"><strong>Profile URL:</strong></p>
						</div>
						<div class="col-sm-9 col-xs-9">
							<p class="text-info"><a href="https://www.pins.pk/">https://www.pins.pk/</a></p>
						</div>
					</div>
					<div class="row">											
						<div class="col-sm-3 col-xs-3">
							<p class="pull-right"><strong>Description:</strong></p>
						</div>
						<div class="col-sm-9 col-xs-9">
							<p class="text-info"></p>
						</div>					
					</div>
					<div class="row">											
						<div class="col-sm-3 col-xs-3">
							<p class="pull-right"><strong>Services Offered:</strong></p>
						</div>
						<div class="col-sm-9 col-xs-9">
							<p class="text-info"></p>
						</div>
					</div>
					
                    
					</div>
                    <hr>
					<div class="col-lg-4">
						<div class="text-center">
							<h5 class="form-title"><i class="fa fa-fw fa-file-image-o"></i> <b>Company Logo</b></h5>
							<div class="form-group">					
									<div class="img-responsive">
										<img class="img-thumbnail" src="https://www.pins.pk/uploads/agent/logo.jpg" alt="?&gt;">
									</div>
							</div>
							<hr>
							<h5 class="form-title"><i class="fa fa-fw fa-file-image-o"></i>Visiting Card</h5>
							<div class="form-group">
									<div class="img-responsive">
										<img class="img-thumbnail" src="https://www.pins.pk/uploads/agent/card.jpg" style="width: 300px; height: 180px" alt="?&gt;">
									</div>
							</div>
						</div>	
					</div>
				</div>
								<div class="hr5 margin-10"></div>
				<div class="col-lg-12">
					<div class="text-center">
					<hr>
						<div class="control-group form-group">
							<div class="controls">
								<div class="col-xs-5 col-xs-offset-3">
									<button type="submit" class="btn-system border-btn btn-medium btn-green">Edit Profile</button>
								</div>
							</div>
						</div>
					</div>
					<div id="success" class="errmsg">
						<!-- For success/fail messages -->
											</div>
				</div>	
			</div>
			<!-- End Call Action -->
		</div>
		
		</form>	
	</div>
  </div>
  <!-- End Container -->
	
 </section>
@endsection
