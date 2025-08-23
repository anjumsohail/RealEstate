@extends('layouts.main')

@section('content')
    <section>
        <div class="row">
            <!-- Start Main Content Side -->
            <div class="col-md-12">
                <!-- Start Call Action -->
                <div class="boxes clearfix">
                    <!-- Service Information Column -->
                    <div id="tabbed_widget0" class="tabbable clearfix">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab01" data-toggle="tab">Property For Sale </a></li>
                            <li><a href="#tab02" data-toggle="tab">Property Required </a></li>
                        </ul>
                        <div class="tab-content tabbed_widget0 clearfix">
                            <div class="tab-pane active" id="tab01">
                                <!-- Service Information Column -->
                                <div class="hr1 margin-10"></div>
                                <div id="tabbed_widget" class="tabbable clearfix">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1" data-toggle="tab">Approved</a></li>
                                        <li><a href="#tab2" data-toggle="tab">Not Approved</a></li>
                                    </ul>
                                    <div class="tab-content tabbed_widget clearfix">
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="mid_title"> Approved and Published Properties</h3>
                                            <div class="table-responsive">
                                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline"
                                                    role="grid">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="dataTables_length" id="dataTables-example_length">
                                                                <label><select name="dataTables-example_length"
                                                                        aria-controls="dataTables-example"
                                                                        class="form-control input-sm">
                                                                        <option value="10">10</option>
                                                                        <option value="25">25</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select> records per page</label></div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div id="dataTables-example_filter" class="dataTables_filter">
                                                                <label>Search:<input type="search"
                                                                        class="form-control input-sm"
                                                                        aria-controls="dataTables-example"></label></div>
                                                        </div>
                                                    </div>
                                                    <table
                                                        class="table table-bordered table-striped table-condensed dataTable no-footer"
                                                        id="dataTables-example" aria-describedby="dataTables-example_info">
                                                        <thead class="table-heading">
                                                            <tr role="row">
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="SNo: activate to sort column ascending"
                                                                    style="width: 41.1481px;">SNo</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Property Title: activate to sort column ascending"
                                                                    style="width: 299.148px;">Property Title</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Type: activate to sort column ascending"
                                                                    style="width: 57.1481px;">Type</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Size: activate to sort column ascending"
                                                                    style="width: 72.1481px;">Size</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Project: activate to sort column ascending"
                                                                    style="width: 165.148px;">Project</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Block: activate to sort column ascending"
                                                                    style="width: 139.148px;">Block</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Demand Price: activate to sort column ascending"
                                                                    style="width: 135.148px;">Demand Price</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Demand As: activate to sort column ascending"
                                                                    style="width: 110.148px;">Demand As</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Post Date: activate to sort column ascending"
                                                                    style="width: 104.148px;">Post Date</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Post Status: activate to sort column ascending"
                                                                    style="width: 109.148px;">Post Status</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Sale Status: activate to sort column ascending"
                                                                    style="width: 107.148px;">Sale Status</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="dataTables-example" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Action: activate to sort column ascending"
                                                                    style="width: 227.148px;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr class="odd">
                                                                <td data-title="Code" class=" ">1</td>
                                                                <td data-title="Property Title" class=" "><strong>240
                                                                        House for Sale Rufi Homes..</strong></td>
                                                                <td data-title="Type" class=" ">Home</td>
                                                                <td data-title="Size" class=" ">240 Sqy</td>
                                                                <td data-title="Project" class=" ">New Rizvia Society
                                                                </td>
                                                                <td data-title="Block" class=" ">Rizvia CHS 34-A</td>
                                                                <td data-title="Demand Price" align="right"
                                                                    class=" "><strong>28,000,000</strong></td>
                                                                <td data-title="Demand as" class=" "><em>Total
                                                                        Price</em></td>
                                                                <td data-title="Post Dated" class=" ">27/06/2024</td>
                                                                <td data-title="Post Status" class=" "><strong
                                                                        class="text-success">Approved<strong></strong></strong>
                                                                </td>
                                                                <td data-title="Sale Status" class=" ">Available</td>
                                                                <td style="width:14%" class=" "><a
                                                                        class="btn btn-xs btn-system border-btn btn-black"
                                                                        href="https://www.pins.pk/property/images/2626"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Add Images"><i
                                                                            class="fa fa-image"></i></a><a
                                                                        class="btn btn-xs btn-system border-btn btn-green"
                                                                        href="https://www.pins.pk/property/240-sqy-home-for-sale-new-rizvia-society-scheme-33-karachi-1600-2626"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="View Property"><i
                                                                            class="fa fa-search"></i></a><a
                                                                        class="btn btn-xs btn-system border-btn btn-purple"
                                                                        href="https://www.pins.pk/property/edit/2626"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Edit Property"><i
                                                                            class="fa fa-pencil-square-o"></i></a><a
                                                                        class="btn btn-xs btn-system border-btn btn-red"
                                                                        onclick="return confirmSubmit();"
                                                                        href="https://www.pins.pk/property/delete/2626"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Remove Property"><i
                                                                            class="fa fa-times-circle-o"></i></a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="dataTables_info" id="dataTables-example_info"
                                                                role="alert" aria-live="polite" aria-relevant="all">
                                                                Showing 1 to 1 of 1 entries</div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="dataTables_paginate paging_simple_numbers"
                                                                id="dataTables-example_paginate">
                                                                <ul class="pagination">
                                                                    <li class="paginate_button previous disabled"
                                                                        aria-controls="dataTables-example" tabindex="0"
                                                                        id="dataTables-example_previous"><a
                                                                            href="#">Previous</a></li>
                                                                    <li class="paginate_button active"
                                                                        aria-controls="dataTables-example" tabindex="0">
                                                                        <a href="#">1</a></li>
                                                                    <li class="paginate_button next disabled"
                                                                        aria-controls="dataTables-example" tabindex="0"
                                                                        id="dataTables-example_next"><a
                                                                            href="#">Next</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h3 class="mid_title"> Inactive Properties (Waiting for Approval)</h3>
                                            <p class="alert alert-success"><i class="fa fa-exclamation-circle"></i> You
                                                have no inactive Property ! Would you like market your property here add now
                                                <b><a href="https://www.pins.pk/property/post">Post Your Property</a></b>
                                                Its Free ! </p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr1 margin-10"></div>
                                <a class="btn-system border-btn btn-small btn-green"
                                    href="https://www.pins.pk/property/post">+ Add Property for Sale</a>
                            </div>
                            <div class="tab-pane" id="tab02">
                                <h3 class="mid_title"> My Required Property Listing</h3>
                                <p class="alert alert-success"><i class="fa fa-exclamation-circle"></i> You have no active
                                    or approved Property ! Would you like advertise your property required here add now
                                    <b><a href="https://www.pins.pk/property/required/post">Add Property Required</a></b>
                                    Its Free ! </p>
                                <hr>

                                <div class="hr1 margin-10"></div>
                                <a class="btn-system border-btn btn-small btn-purple"
                                    href="https://www.pins.pk/property/required/post">+ Add Property Required</a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Call Action -->

                <!-- Divider -->
                <div class="hr1 margin-10"></div>
            </div>
        </div>
    </section>
@endsection
