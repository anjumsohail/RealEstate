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

        <section class="generalwrapper dm-shadow clearfix">
            <!-- Container -->
            <div class="container-fluid">
                <div class="row">
                    <div id="content" class="col-md-12">
                        <ul class="list-inline ">
                            <li style="display: inline-block;"><a href="{{ route('profile.view') }}"
                                    class="btn-system btn-medium border-btn btn-green active">My Profile </a></li>

                            <li><a href="{{ route('property.myproperties') }}"
                                    class="btn-system btn-medium border-btn btn-green">My Properties </a></li>

                        </ul>
                    </div>
                </div>

                <div class="row">
                    <!-- Start Main Content Side -->
                    <form id="usrPrfComp" class="form-horizontal" action="{{ route('profile.edit') }}"
                        enctype="multipart/form-data" data-fv-framework="bootstrap"
                        data-fv-icon-valid="glyphicon glyphicon-ok" data-fv-icon-invalid="glyphicon glyphicon-remove"
                        data-fv-icon-validating="glyphicon glyphicon-refresh" method="get">
                        <div id="content" class="col-lg-12">

                            <!-- Start Call Action -->
                            <div class="boxes clearfix">
                                <!-- Service Information Column -->
                                <h3 class="title"><i class="fa fa-fw fa-user"></i> <b>Personal Information</b> <span
                                        class="pull-right">Register as : <b>{{ $user->user_type ?: 'Guest' }}</b> </span>
                                </h3>
                                <div class="control-group form-group">
                                    <div class="controls text-center">

                                        <button type="submit" class="btn-system border-btn btn-small btn-green">Edit
                                            Profile</button>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Full Name:</strong></p>
                                            </div>
                                            <div class="col-sm-4 col-xs-4">
                                                <p class="text-info"><strong>{{ $user->name }}</strong></p>
                                            </div>
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Profile ID:</strong></p>
                                            </div>
                                            <div class="col-sm-4 col-xs-2">
                                                <p class="text-info">{{ $user->id ?: '' }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Email:</strong></p>
                                            </div>
                                            <div class="col-sm-4 col-xs-9">
                                                <p class="text-info">{{ $user->email ?: 'Guest' }}</p>
                                            </div>
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Created:</strong></p>
                                            </div>
                                            <div class="col-sm-4 col-xs-9">
                                                <p class="text-info">{{ $user->created_date ?: now()->format('Y-m-d') }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Address:</strong></p>
                                            </div>
                                            <div class="col-sm-10 col-xs-9">
                                                <p class="text-info"> {{ $user->address ?: 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Mobile No.:</strong></p>
                                            </div>
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="text-info">{{ $user->mobile ?: 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Whatsapp:</strong></p>
                                            </div>
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="text-info">{{ $user->whatsapp ?: 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="pull-right"><strong>Landline:</strong></p>
                                            </div>
                                            <div class="col-sm-2 col-xs-3">
                                                <p class="text-info">{{ $user->landline ?: 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="text-center">
                                            <div class="img-responsive">
                                                <img class="img-rounded img-thumbnail w-50"
                                                    src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                    alt="User profile photo">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-lg-12">
                                    <h3 class="title"><i class="fa fa-fw fa-comments"></i> <strong>Your Social
                                            Links</strong></h3>
                                    <div class="row">
                                        <div class="col-sm-2 col-xs-4">
                                            <p class="pull-right"><strong>Facebook URL:</strong></p>
                                        </div>
                                        <div class="col-sm-4 col-xs-8">
                                            <p class="text-info">{{ $user->facebook_url ?: 'N/A' }}</p>
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
                                            <p class="text-info">{{ $user->linkedin_url ?: 'N/A' }}</p>
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
                                    <h3 class="title"><i class="fa fa-fw fa-home"></i> <strong>Business / Company
                                            Information</strong></h3>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-5">
                                                <p class="pull-right"><strong>Company Name:</strong></p>
                                            </div>
                                            <div class="col-sm-9 col-xs-7">
                                                <p class="text-info"><strong>{{ $user->company_name ?: 'N/A' }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="row">
                                                <div class="col-sm-3 col-xs-5">
                                                    <p class="pull-right"><strong>Nature of Business:</strong></p>
                                                </div>
                                                <div class="col-sm-9 col-xs-7">
                                                    <p class="text-info">
                                                        <strong>{{ $user->business_nature ?: 'N/A' }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-3">
                                                <p class="pull-right"><strong>Your Title:</strong></p>
                                            </div>
                                            <div class="col-sm-9 col-xs-9">
                                                <p class="text-info">{{ $user->designation ?: 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-3">
                                                <p class="pull-right"><strong>Profile URL:</strong></p>
                                            </div>
                                            <div class="col-sm-9 col-xs-9">
                                                <p class="text-info"><a></a></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-3">
                                                <p class="pull-right"><strong>Description:</strong></p>
                                            </div>
                                            <div class="col-sm-9 col-xs-9">
                                                <p class="text-info">{{ $user->company_description ?: 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-3">
                                                <p class="pull-right"><strong>Services Offered:</strong></p>
                                            </div>
                                            <div class="col-sm-9 col-xs-9">
                                                <p class="text-info">{{ $user->services ?: 'N/A' }}</p>
                                            </div>
                                        </div>


                                    </div>
                                    <hr>

                                </div>
                                <div class="hr5 margin-10"></div>
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <hr>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <div class="col-xs-5 col-xs-offset-3">
                                                    <button type="submit"
                                                        class="btn-system border-btn btn-medium btn-green">Edit
                                                        Profile</button>
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
    </div>
@endsection
