@extends('layouts.main')

@section('content')
    <section class="post-wrapper-top dm-shadow clearfix">
        <div class="container">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="post-wrapper-heading">
                    <i class="fa fa-fw fa-pencil-square-o"></i> Add Property for Sale
                </div>
            </div>
        </div>
    </section>

    <form id="usrpropAdd" class="form-horizontal fv-form fv-form-bootstrap"
        action="{{ route('property-advertisements.store') }}" enctype="multipart/form-data" data-fv-framework="bootstrap"
        data-fv-icon-valid="glyphicon glyphicon-ok" data-fv-icon-invalid="glyphicon glyphicon-remove"
        data-fv-icon-validating="glyphicon glyphicon-refresh" method="post" novalidate="novalidate">
        @csrf
        <section>
            <div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="boxes">
                    <!-- Service Information Column -->
                    <div class="form-horizontal clearfix">
                        <div id="success" class="errmsg">
                            <!-- For success/fail messages -->
                        </div>
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <strong>There were some problems with your input:</strong>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mid_title">Property Details </div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label for="purpose"
                                    class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">Purpose:</label>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose" id="purpose1" value="Sale"
                                            {{ old('purpose') == 'Sale' ? 'checked' : '' }}>
                                        For
                                        Sale
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose" id="purpose2" value="Rent"
                                            {{ old('purpose') == 'Rent' ? 'checked' : '' }}> For Rent
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label for="category"
                                    class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">Category:</label>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="category" id="category1" onclick="ShowHidePropCat(1);"
                                            value="Residential" {{ old('category') == 'Residential' ? 'checked' : '' }}>
                                        Residential
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="category" id="category2" onclick="ShowHidecategory(2);"
                                            value="Commercial" {{ old('category') == 'Commercial' ? 'checked' : '' }}>
                                        Commercial
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label for="proptype"
                                    class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">Type:</label>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                    <label id="ltype1" class="radio-inline">
                                        <input type="radio" name="proptype" id="proptype1" onclick="ShowHidePropType(1);"
                                            value="Plot" {{ old('proptype') == 'Plot' ? 'checked' : '' }}> Plot
                                    </label>
                                    <label id="ltype2" class="radio-inline">
                                        <input type="radio" name="proptype" id="proptype2" onclick="ShowHidePropType(2);"
                                            value="Home" {{ old('proptype') == 'Home' ? 'checked' : '' }}> Home
                                    </label>
                                    <label id="ltype3" class="radio-inline">
                                        <input type="radio" name="proptype" id="proptype3" onclick="ShowHidePropType(3);"
                                            value="Apartment" {{ old('proptype') == 'Apartment' ? 'checked' : '' }}>
                                        Apartment
                                    </label>
                                    <label id="ltype4" class="radio-inline">
                                        <input type="radio" name="proptype" id="proptype4" onclick="ShowHidePropType(4);"
                                            value="Portion" {{ old('proptype') == 'Portion' ? 'checked' : '' }}> Portion
                                    </label>
                                    <label id="ltype5" class="radio-inline">
                                        <input type="radio" name="proptype" id="proptype5" onclick="ShowHidePropType(5);"
                                            value="Cottage" {{ old('proptype') == 'Cottage' ? 'checked' : '' }}> Cottage
                                    </label>
                                    <label id="ltype6" class="radio-inline" style="display:none">
                                        <input type="radio" name="proptype" id="proptype6" value="Shop"
                                            {{ old('proptype') == 'Shop' ? 'checked' : '' }}> Shop
                                    </label>
                                    <label id="ltype7" class="radio-inline" style="display:none">
                                        <input type="radio" name="proptype" id="proptype7" value="Office"
                                            {{ old('proptype') == 'Office' ? 'checked' : '' }}> Office
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group has-feedback">
                            <div class="row">
                                <label for="title" class="col-lg-3 control-label">Title of Property:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="title" name="title"
                                        placeholder="120 Yards House for Sale" value="{{ old('title') }}"
                                        class="form-control" data-fv-notempty="true"
                                        data-fv-notempty-message="Please enter title of property."
                                        data-fv-field="title"><i class="form-control-feedback" data-fv-icon-for="title"
                                        style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="notEmpty" data-fv-for="title"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please enter title of
                                        property.</small>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group has-feedback">
                            <div class="row">
                                <label for="description" class="col-lg-3 control-label">Property Description:</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" rows="4" id="description" name="description"
                                        placeholder="Describe property details in your words" data-fv-notempty="true"
                                        data-fv-notempty-message="The Project Description is required." data-fv-field="description">{{ old('description') }}</textarea><i class="form-control-feedback"
                                        data-fv-icon-for="description" style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="notEmpty" data-fv-for="description"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">The Project Description is
                                        required.</small>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group has-feedback" style="display:none">
                            <div class="row">
                                <label for="city_id" class="col-lg-3 control-label">city_id:</label>
                                <div class="col-lg-6">
                                    <select name="city_id" id="city_id" class="form-control" data-fv-integer="true"
                                        min="1" max="100" data-fv-integer-message="Please select city."
                                        data-fv-notempty="true" data-fv-notempty-message="Please select City."
                                        onclick="getArea(this.value);" onchange="getArea(this.value);"
                                        data-fv-field="city_id">
                                        <option value="0">Select City</option>
                                        <option value="1">Karachi</option>
                                        <option value="2">Hyderabad</option>
                                        <option value="3">Sukker</option>
                                        <option value="4">Lahore</option>
                                        <option value="5">Faisalabad</option>
                                        <option value="6">Multan</option>
                                        <option value="7">Gawadar</option>
                                        <option value="8">Islamabad</option>
                                        <option value="9">Rawalpindi</option>
                                        <option value="10">Gujranwala</option>
                                        <option value="11">Taxila</option>
                                        <option value="12">Wah Cantt</option>
                                        <option value="14">Bahawalpur</option>
                                        <option value="15">Nawabshah</option>
                                        <option value="16">Nowshera</option>
                                        <option value="17">Sialkot</option>
                                        <option value="18">Gujranwala</option>
                                        <option value="19">Jhelum</option>
                                        <option value="20">Peshawar</option>
                                        <option value="21">Quetta</option>
                                        <option value="22">Rahim Yar Khan</option>
                                    </select><i class="form-control-feedback" data-fv-icon-for="city_id"
                                        style="display: none;"></i> <small class="help-block"
                                        data-fv-validator="greaterThan" data-fv-for="city_id"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                        enter a value greater than or equal to %s</small><small class="help-block"
                                        data-fv-validator="integer" data-fv-for="city_id" data-fv-result="NOT_VALIDATED"
                                        style="display: none;">Please select City.</small><small class="help-block"
                                        data-fv-validator="lessThan" data-fv-for="city_id" data-fv-result="NOT_VALIDATED"
                                        style="display: none;">Please enter a value less than or equal to %s</small><small
                                        class="help-block" data-fv-validator="notEmpty" data-fv-for="city_id"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please select City.</small>
                                </div>

                            </div>
                        </div>
                        <div class="control-group form-group" style="display:none">
                            <div class="row">
                                <label for="areaid" class="col-lg-3 control-label">Area:</label>
                                <div id="areadiv" class="col-lg-6">

                                    <select class="form-control" data-fv-integer="true" min="1" max="100"
                                        data-fv-integer-message="Please select Area." disabled="">
                                        <option value="0">Select Area by City</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group" style="display:none">
                            <div class="row">
                                <label for="projid" class="col-lg-3 control-label">Project/Society:</label>
                                <div id="projectdiv" class="col-lg-6">
                                    <select class="form-control" disabled="">
                                        <option>Select Project by Area</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group" style="display:none">
                            <div class="row">
                                <label for="blkid" class="col-lg-3 control-label">Block/Sector:</label>
                                <div id="blockdiv" class="col-lg-6">
                                    <select class="form-control" disabled="">
                                        <option>Select Block by Project</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group has-feedback" style="display:block">
                            <div class="row">
                                <label for="address" class="col-lg-3 control-label">Area &amp; Location:</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" rows="3" id="address" name="address"
                                        placeholder="Mention Society/Project name with Phase,Sector,Block etc" value="" required=""
                                        data-fv-notempty="true" data-fv-notempty-message="Please enter location of property with area."
                                        data-fv-field="address"></textarea><i class="form-control-feedback" data-fv-icon-for="address"
                                        style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="notEmpty" data-fv-for="address"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please enter location of
                                        property with area.</small>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group has-feedback">
                            <div class="row">
                                <label for="area_size" class="col-lg-3 col-md-3 col-xs-3 control-label">Size/Area:</label>
                                <div class="col-lg-3 col-md-3  col-xs-9">
                                    <input type="text" name="area_size" id="area_size" placeholder="120/240"
                                        value="{{ old('area_size') }}" required="" class="form-control"
                                        data-fv-integer="true" min="0" max="20000"
                                        data-fv-integer-message="The value is not an integer" data-fv-field="area_size"><i
                                        class="form-control-feedback" data-fv-icon-for="area_size"
                                        style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="greaterThan" data-fv-for="area_size"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please enter a value greater
                                        than or equal to %s</small><small class="help-block" data-fv-validator="integer"
                                        data-fv-for="area_size" data-fv-result="NOT_VALIDATED" style="display: none;">The
                                        value is not an integer</small><small class="help-block"
                                        data-fv-validator="lessThan" data-fv-for="area_size"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                        enter a value less than or equal to %s</small><small class="help-block"
                                        data-fv-validator="notEmpty" data-fv-for="area_size"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small>
                                </div>
                            </div>
                            <div class="row">
                                <label for="size_unit" class="col-lg-3 col-md-3 col-xs-3 control-label">Unit of
                                    Size:</label>
                                <div class="col-lg-3 col-md-3 col-xs-9">
                                    <select name="size_unit" id="size_unit" class="form-control" data-fv-notempty="true"
                                        data-fv-notempty-message="Please select category." data-fv-field="size_unit">
                                        <option value="Sqy" {{ old('size_unit') == 'Sqy' ? 'selected' : '' }}>Sq Yards
                                        </option>
                                        <option value="Sqf" {{ old('size_unit') == 'Sqf' ? 'selected' : '' }}>Sq Feet
                                        </option>
                                        <option value="Marla" {{ old('size_unit') == 'Marla' ? 'selected' : '' }}>Marla
                                        </option>
                                        <option value="Kanal" {{ old('size_unit') == 'Kanal' ? 'selected' : '' }}>Kanal
                                        </option>
                                    </select>

                                    <i class="form-control-feedback" data-fv-icon-for="size_unit"
                                        style="display: none;"></i> <small class="help-block"
                                        data-fv-validator="notEmpty" data-fv-for="size_unit"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                        select category.</small>
                                </div>
                            </div>
                        </div>
                        <div class="mid_title">Property Features</div>
                        <div class="control-group form-group has-feedback">
                            <div class="row">
                                <label for="positioning" class="col-lg-3 col-md-3 control-label">Positioning:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="positioning" id="positioning" required="" class="form-control"
                                        data-fv-notempty="true" data-fv-notempty-message="Please select the Category."
                                        data-fv-field="positioning">
                                        <option value="East Open"
                                            {{ old('positioning') == 'East Open' ? 'selected' : '' }}>East Open</option>
                                        <option value="West Open"
                                            {{ old('positioning') == 'West Open' ? 'selected' : '' }}>West Open</option>
                                        <option value="North Open"
                                            {{ old('positioning') == 'North Open' ? 'selected' : '' }}>North Open</option>
                                        <option
                                            value="South Open"{{ old('positioning') == 'South Open' ? 'selected' : '' }}>
                                            South Open</option>
                                    </select><i class="form-control-feedback" data-fv-icon-for="positioning"
                                        style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="notEmpty" data-fv-for="positioning"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please select the
                                        Category.</small>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group has-feedback">
                            <div class="row">
                                <label for="front_face" class="col-lg-3 col-md-3 control-label">Facing:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="front_face" id="front_face" class="form-control"
                                        data-fv-notempty="true" data-fv-notempty-message="Please select category."
                                        data-fv-field="front_face">
                                        <option value="Plots" {{ old('front_face') == 'Plots' ? 'selected' : '' }}>Plots
                                        </option>
                                        <option value="Homes" {{ old('front_face') == 'Homes' ? 'selected' : '' }}>Homes
                                        </option>
                                        <option value="Commercial"
                                            {{ old('front_face') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                        <option value="Mosque" {{ old('front_face') == 'Mosque' ? 'selected' : '' }}>
                                            Mosque</option>
                                        <option value="Park" {{ old('front_face') == 'Park' ? 'selected' : '' }}>Park
                                        </option>
                                        <option value="Playgound"
                                            {{ old('front_face') == 'Playground' ? 'selected' : '' }}>Playgound</option>
                                        <option value="Graveyard"
                                            {{ old('front_face') == 'Graveyard' ? 'selected' : '' }}>Graveyard</option>
                                        <option value="Apartment"
                                            {{ old('front_face') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                                        <option value="Green Belt"
                                            {{ old('front_face') == 'Green Belt' ? 'selected' : '' }}>Green Belt</option>
                                        <option value="Jinnah Avenue"
                                            {{ old('front_face') == 'Jinnah Avenue' ? 'selected' : '' }}>Jinnah Avenue
                                        </option>
                                        <option value="Main Road"
                                            {{ old('front_face') == 'Main Road' ? 'selected' : '' }}>Main Road</option>
                                        <option value="Wide Road"
                                            {{ old('front_face') == 'Wide Road' ? 'selected' : '' }}>Wide Road</option>
                                        <option value="Compound" {{ old('front_face') == 'Compound' ? 'selected' : '' }}>
                                            Compound</option>
                                    </select><i class="form-control-feedback" data-fv-icon-for="front_face"
                                        style="display: none;"></i> <small class="help-block"
                                        data-fv-validator="notEmpty" data-fv-for="front_face"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                        select category.</small>
                                </div>

                                <label for="back_site" class="col-lg-3 col-md-3 control-label">Back Site:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="back_site" id="back_site" class="form-control" data-fv-notempty="true"
                                        data-fv-notempty-message="Please select category." data-fv-field="back_site">
                                        <option value="Apartment" {{ old('back_site') == 'Apartment' ? 'selected' : '' }}>
                                            Apartment</option>
                                        <option value="Commercial"
                                            {{ old('back_site') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                        <option value="Compound" {{ old('back_site') == 'Compound' ? 'selected' : '' }}>
                                            Compound</option>
                                        <option value="Graveyard" {{ old('back_site') == 'Graveyard' ? 'selected' : '' }}>
                                            Graveyard</option>
                                        <option value="Green Belt"
                                            {{ old('back_site') == 'Green Belt' ? 'selected' : '' }}>Green Belt</option>
                                        <option value="Homes" {{ old('back_site') == 'Homes' ? 'selected' : '' }}>Homes
                                        </option>
                                        <option value="Jinnah Avenue"
                                            {{ old('back_site') == 'Jinnah Avenue' ? 'selected' : '' }}>Jinnah Avenue
                                        </option>
                                        <option value="Main Road" {{ old('back_site') == 'Main Road' ? 'selected' : '' }}>
                                            Main Road</option>
                                        <option value="Mosque" {{ old('back_site') == 'Mosque' ? 'selected' : '' }}>Mosque
                                        </option>
                                        <option value="Park" {{ old('back_site') == 'Park' ? 'selected' : '' }}>Park
                                        </option>
                                        <option value="Playgound"
                                            {{ old('back_site') == 'Playground' ? 'selected' : '' }}>Playgound</option>
                                        <option value="Plots" {{ old('back_site') == 'Plots' ? 'selected' : '' }}>Plots
                                        </option>
                                        <option value="Wide Road" {{ old('back_site') == 'Wide Road' ? 'selected' : '' }}>
                                            Wide Road</option>
                                    </select><i class="form-control-feedback" data-fv-icon-for="back_site"
                                        style="display: none;"></i> <small class="help-block"
                                        data-fv-validator="notEmpty" data-fv-for="back_site"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                        select category.</small>
                                </div>

                            </div>
                        </div>

                        <div class="control-group form-group has-feedback">
                            <div id="home1" class="row" style="display:none">
                                <label for="housetype" class="col-lg-3 col-md-3 control-label">Home Type:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="housetype" id="housetype" required="" class="form-control"
                                        data-fv-notempty="true" data-fv-notempty-message="Please select the house type."
                                        data-fv-field="housetype">
                                        <option value="None">None</option>
                                        <option value="Single">Single</option>
                                        <option value="Ground+1">Ground+1</option>
                                        <option value="Ground+2">Ground+2</option>
                                        <option value="Ground+3">Ground+3</option>
                                    </select><i class="form-control-feedback" data-fv-icon-for="housetype"
                                        style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="notEmpty" data-fv-for="housetype"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please select the house
                                        type.</small>
                                </div>
                            </div>
                            <div id="home2" class="row" style="display:none">
                                <label for="floor" class="col-lg-3 col-md-3 control-label">Floor:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="floor" id="floor" class="form-control" data-fv-notempty="false"
                                        data-fv-notempty-message="Please select the Floor.">
                                        <option value="None">None</option>
                                        <option value="Ground">Ground</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                        <option value="4th">4th</option>
                                        <option value="5th">5th</option>
                                        <option value="6th">6th</option>
                                        <option value="7th">7th</option>
                                        <option value="8th">8th</option>
                                        <option value="9th">9th</option>
                                        <option value="10th">10th</option>
                                        <option value="11th">11th</option>
                                        <option value="12th">12th</option>
                                        <option value="13th">13th</option>
                                        <option value="14th">14th</option>
                                        <option value="15th">15th</option>
                                        <option value="16th">16th</option>
                                        <option value="17th">17th</option>
                                        <option value="18th">18th</option>
                                        <option value="19th">19th</option>
                                        <option value="20th">20th</option>
                                    </select>
                                </div>
                            </div>
                            <div id="home3" class="row" style="display:none">
                                <label for="bedrooms" class="col-lg-3 col-md-3 control-label">No of Room:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="bedrooms" id="bedrooms" class="form-control" data-fv-notempty="false"
                                        data-fv-notempty-message="Please select the Rooms.">
                                        <option value="0">None</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                            <div id="home4" class="row" style="display:none">
                                <label for="consage" class="col-lg-3 col-md-3 control-label">Construction:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="consage" id="consage" class="form-control" data-fv-notempty="false"
                                        data-fv-notempty-message="Please construction status.">
                                        <option value="New">New</option>
                                        <option value="Old">Old</option>
                                    </select>
                                </div>
                            </div>
                            <div id="home5" class="row" style="display:none">
                                <label for="conscond" class="col-lg-3 col-md-3 control-label">Condition:</label>
                                <div class="col-lg-3 col-md-3">
                                    <select name="conscond" id="conscond" class="form-control" data-fv-notempty="false"
                                        data-fv-notempty-message="Please construction condition.">
                                        <option value="Normal">Normal</option>
                                        <option value="Demolish">Demolish</option>
                                        <option value="Renovated">Renovated</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="control-group form-group has-feedback">
                            <div class="row">
                                <label for="demand_price" class="col-md-3 control-label">Demanded demand_price:</label>
                                <div class="col-md-3">
                                    <input type="text" name="demand_price" id="demand_price" placeholder="Amount"
                                        value="{{ old('demand_price') }}" required="" class="form-control"
                                        data-fv-integer="true" min="0" max="100000000"
                                        data-fv-integer-message="The value is not an integer"
                                        data-fv-field="demand_price"><i class="form-control-feedback"
                                        data-fv-icon-for="demand_price" style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="greaterThan" data-fv-for="demand_price"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please enter a value greater
                                        than or equal to %s</small><small class="help-block" data-fv-validator="integer"
                                        data-fv-for="price" data-fv-result="NOT_VALIDATED" style="display: none;">The
                                        value
                                        is not an integer</small><small class="help-block" data-fv-validator="lessThan"
                                        data-fv-for="price" data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                        enter a value less than or equal to %s</small><small class="help-block"
                                        data-fv-validator="notEmpty" data-fv-for="price" data-fv-result="NOT_VALIDATED"
                                        style="display: none;">Please enter a value</small>
                                </div>
                                <label for="pricetype" class="col-md-3 control-label">Demand Type:</label>
                                <div class="col-md-3">
                                    <select name="pricetype" id="pricetype" required="" class="form-control"
                                        data-fv-notempty="true"
                                        data-fv-notempty-message="Please select the Price Category."
                                        data-fv-field="pricetype">
                                        <option value="Total Price">Total Price</option>
                                        <option value="Own Price">Own Price</option>
                                        <option value="Booking Price">Booking Price</option>
                                        <option value="Rent">Rent</option>
                                    </select><i class="form-control-feedback" data-fv-icon-for="pricetype"
                                        style="display: none;"></i>
                                    <small class="help-block" data-fv-validator="notEmpty" data-fv-for="pricetype"
                                        data-fv-result="NOT_VALIDATED" style="display: none;">Please select the Price
                                        Category.</small>
                                </div>

                            </div>
                        </div>
                        <div class="mid_title">Property Image</div>
                        <div class="boxes">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <p> Add image(s) to your property. Ads with image have greater visibility !
                                </p>
                                <div class="fileupload-preview thumbnail">

                                </div>
                                <div>
                                    <p><small>Max file size 2000 kb</small></p>
                                </div>
                                <div>
                                    <span class="btn btn-file btn-success">
                                        <span class="fileupload-new">Upload Image</span>
                                        <span class="fileupload-exists">Change</span>
                                        <input type="file" class="formcontrol" name="property_image"
                                            id="property_image" placeholder="Browse image..">
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists"
                                        data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="mid_title">Seller Details</div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label for="postas" class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label">Post
                                    Property
                                    As:</label>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="postas" id="postast2"
                                            value="Individual">Individual
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="postas" id="postas1" value="Business"
                                            checked="">Real Estate Agent
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label for="social" class="col-lg-5 col-md-5 col-sm-6 col-xs-12 control-label">Auto
                                    Social
                                    Media Sharing:</label>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="social" id="postast2" value="Y"
                                            checked="">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="social" id="postas1" value="N"> No
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label class="col-lg-12 control-label">User: Anjum</label>
                            </div>
                        </div>
                        <hr>
                        <!-- For success/fail messages -->
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="submit" class="btn-system border-btn btn-small btn-green">Submit New
                                Property</button>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
