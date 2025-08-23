@extends('layouts.main')

@section('content')
    <section class="post-wrapper-top dm-shadow clearfix">
        <div class="container-fluid">
            <div class="col-lg-6">
                <div class="post-wrapper-heading">
                    <i class="fa fa-fw fa-pencil-square-o"></i>Complete Your Profile
                </div>
            </div>
        </div>
    </section>
    <section class="generalwrapper dm-shadow clearfix">
        <!-- Container -->
        <div class="container-fluid">

            <div class="row">
                <!-- Start MainForm -->
                <form id="usrPrfComp" class="form-horizontal" action="https://www.pins.pk/user/profile"
                    enctype="multipart/form-data" data-fv-framework="bootstrap"
                    data-fv-icon-valid="fa fa-check-circle fa-2x" data-fv-icon-invalid="fa fa-times-circle fa-2x"
                    data-fv-icon-validating="fa fa-refresh fa-2x" method="post">
                    <div id="content" class="boxes">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mid_title">Personal Details</div>
                                <div class="form-horizontal">
                                    <input type="hidden" name="file_path" id="file_path" value="0.jpg"
                                        class="form-control">
                                    <input type="hidden" name="logo_path" id="logo_path" value="logo.jpg"
                                        class="form-control">
                                    <input type="hidden" name="card_path" id="card_path" value="card.jpg"
                                        class="form-control">
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="agentcat" class="col-lg-3 control-label">Register As:</label>
                                            <div class="col-lg-9 col-xs-10">
                                                <label class="radio col-lg-6 col-xs-6 inline">
                                                    <input type="radio" name="agentcat" id="postas1"
                                                        onclick="ShowHideEstate(1);" value="Business" checked=""> <a
                                                        data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                        title=""
                                                        data-original-title="Register as &lt;b&gt;Business&lt;/b&gt; &lt;em&gt;Profile&lt;/em&gt;&lt;br/&gt; add your real estate business, advertise your services and grow your sales. Busines user will get an online &lt;b&gt;Property Showroom&lt;/b&gt;">
                                                        Business <i class="fa fa-info-circle fa-1x "></i></a>
                                                </label>

                                                <label class="radio col-lg-6 col-xs-6 inline">
                                                    <input type="radio" name="agentcat" id="postast2"
                                                        onclick="ShowHideEstate(2);" value="Individual"> <a
                                                        data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                        title=""
                                                        data-original-title="Register as &lt;b&gt;Individua&lt;/b&gt; &lt;em&gt;Profile&lt;/em&gt;&lt;br/&gt; means you are single buyer or seller having no real estate business. Add your own propery for sale or buy!">
                                                        Individual <i class="fa fa-info-circle fa-1x "></i></a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="user_email"
                                                class="col-sm-3 control-label label-strong">Email:</label>

                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" disabled="" id="user_email"
                                                    name="user_email" value="itdanjum@gmail.com">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="user_name" class="col-sm-3 control-label label-strong">Your
                                                Name:</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_name" name="user_name"
                                                    maxlength="40" value="Anjum" data-fv-notempty="true"
                                                    data-fv-notempty-message="Your complete name is required.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="mobileno" class="col-sm-3 control-label label-strong">Mobile
                                                #:</label>

                                            <div class="col-sm-3">
                                                <input type="text" name="mobileno" id="mobileno"
                                                    placeholder="03001234567" required="" value="03212244779"
                                                    class="form-control" data-fv-phone="true" data-fv-phone-country="PK"
                                                    data-fv-phone-message="The value is not valid %s phone number">


                                            </div>
                                            <label for="whatsapp" class="col-sm-3 control-label label-strong">Whatsapp
                                                #:</label>

                                            <div class="col-sm-3">
                                                <input type="text" name="whatsapp" id="whatsapp" required=""
                                                    value="03212244779" class="form-control" data-fv-phone="true"
                                                    data-fv-phone-country="PK"
                                                    data-fv-phone-message="The value is not valid %s phone number">

                                            </div>

                                        </div>
                                    </div>
                                    <div class=" control-group form-group">
                                        <div class="controls">
                                            <label for="agentphone" class="col-sm-3 control-label label-strong">Land Line
                                                #:</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="agentphone" id="agentphone"
                                                    placeholder="02130000000" value="" class="form-control">


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <!-- Service Information Column -->
                                <div class="text-center boxes">
                                    <div class="mid_title"> Photograph <i class="fa fa-fw fa-image"></i></div>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                            <img class="img-rounded" src="https://www.pins.pk/uploads/agent/0.jpg"
                                                style="width: 140px; height: 140px" alt="">
                                        </div>
                                        <div>
                                            <p><small>Max file size 500 kb</small></p>
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-success">
                                                <span class="fileupload-new">Upload Image</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" class="formcontrol" name="photopath"
                                                    id="photopath" value="0.jpg">
                                            </span>
                                            <a href="#" class="btn btn-danger fileupload-exists"
                                                data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="success" class="errmsg">
                                    <!-- For success/fail messages -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="estatearea" style="display:block">
                        <div id="content" class="col-lg-12 boxes">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mid_title">Business / Company Details</div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="agenttype" class="col-lg-3 control-label">Nature of
                                                Business:</label>

                                            <div class="col-lg-9 col-xs-10">
                                                <div class="checkbox">
                                                    <label class="col-lg-6 col-xs-6">
                                                        <input type="checkbox" name="services[]"
                                                            value="Real Estate Agent">
                                                        Real Estate Agent
                                                    </label>
                                                    <label class="col-lg-6 col-xs-6">
                                                        <input type="checkbox" name="services[]"
                                                            value="Construction / Renovation"> Construction / Renovation
                                                    </label>
                                                    <label class="col-lg-6 col-xs-6">
                                                        <input type="checkbox" name="services[]"
                                                            value="Legal / Documentation"> Legal / Documentation
                                                    </label>
                                                    <label class="col-lg-6 col-xs-6">
                                                        <input type="checkbox" name="services[]"
                                                            value="Home Interior / Exterior"> Home Interior / Exterior
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="comp_name" class="col-sm-3 control-label label-strong">Company
                                                Name:</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="comp_name"
                                                    name="comp_name" maxlength="100" value="">
                                                <p class="help-block"><small>For example, if your register as Estate Agent,
                                                        please enter your Real Estate Agency/Company Name</small></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="urlid" class="col-sm-3 control-label label-strong">Profile
                                                (URL):</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" disabled="" id="urlid"
                                                    name="urlid" maxlength="50" value="">
                                                <p class="help-block">Youe Profile Link: <strong> </strong></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="agentdesig" class="col-sm-3 control-label label-strong">Your
                                                Designation:</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="agentdesig"
                                                    name="agentdesig" maxlength="30"
                                                    placeholder="Property Consultant/Estate Agent etc"
                                                    value="Property Consultant">
                                                <p class="help-block"><small>If your register as Agent, please enter your
                                                        Designation or Job Title</small></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class=" control-group form-group">
                                        <div class="controls">
                                            <label for="address"
                                                class="col-sm-3 control-label label-strong">Address:</label>

                                            <div class="col-sm-9">
                                                <input type="text" name="address" id="address" maxlength="100"
                                                    value="" class="form-control" data-fv-notempty="true"
                                                    data-fv-notempty-message="The complete address is required.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="cityid"
                                                class="col-sm-3 control-label label-strong">City:</label>

                                            <div id="citydiv" class="col-sm-9">
                                                <select name="cityid" id="cityid" class="form-control"
                                                    data-fv-notempty="true"
                                                    data-fv-notempty-message="Please select the city.">
                                                    <option value="14">Bahawalpur</option>
                                                    <option value="5">Faisalabad</option>
                                                    <option value="7">Gawadar</option>
                                                    <option value="18">Gujranwala</option>
                                                    <option value="10">Gujranwala</option>
                                                    <option value="2">Hyderabad</option>
                                                    <option value="8">Islamabad</option>
                                                    <option value="19">Jhelum</option>
                                                    <option value="1">Karachi</option>
                                                    <option value="4">Lahore</option>
                                                    <option value="6">Multan</option>
                                                    <option value="15">Nawabshah</option>
                                                    <option value="16">Nowshera</option>
                                                    <option value="20">Peshawar</option>
                                                    <option value="21">Quetta</option>
                                                    <option value="22">Rahim Yar Khan</option>
                                                    <option value="9">Rawalpindi</option>
                                                    <option value="17">Sialkot</option>
                                                    <option value="3">Sukker</option>
                                                    <option value="11">Taxila</option>
                                                    <option value="12">Wah Cantt</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="latitude" class="col-lg-3 control-label">Google Latitude:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="latitude"
                                                    name="latitude" value="24.860700" placeholder="i.e 24.101010"
                                                    maxlength="10">
                                            </div>
                                            <label for="longitude" class="col-lg-3 control-label">Google
                                                Longitude:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="longitude"
                                                    name="longitude" value="67.001100" placeholder="i.e 67.101010"
                                                    maxlength="10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="desc" class="col-sm-3 control-label label-strong">Company /
                                                Estate
                                                Description:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" id="agentdesc" name="agentdesc"
                                                    placeholder="Describe your estate profile in detail"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="speciality" class="col-sm-3 control-label label-strong">Services
                                                Offered:</label>
                                            <div class="col-sm-9">
                                                <select id="framework" name="framework[]" multiple=""
                                                    class="form-control" data-fv-notempty="true"
                                                    data-fv-notempty-message="Select atleast one service">
                                                    <option value="Sales &amp; Purchase">Property Sales &amp; Purchase
                                                    </option>
                                                    <option value="Property Rental">Property Rental</option>
                                                    <option value="Real Estate Marketing">Real Estate Marketing</option>
                                                    <option value="Construction &amp; Renovation">Construction &amp;
                                                        Renovation
                                                    </option>
                                                    <option value="Architect">Architect</option>
                                                    <option value="Interior Designer">Interior Designer</option>
                                                    <option value="Property Documentation">Property Documentation</option>
                                                    <option value="Legal Advisor">Legal Advisor</option>
                                                </select>
                                                <p class="help-block"><small>Hold ctrl button; to select multiple
                                                        services</small></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="text-center boxes">
                                        <div class="mid_title"> <b>Company Logo</b> <i
                                                class="fa fa-fw fa-file-image-o"></i>
                                        </div>
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail"
                                                style="width: 200px; height: 150px;">
                                                <img class="img-rounded" src="https://www.pins.pk/uploads/agent/logo.jpg"
                                                    style="width: 140px; height: 140px" alt="">

                                            </div>
                                            <div>
                                                <p><small>Max file size 100 kb</small></p>
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-success">
                                                    <span class="fileupload-new">Upload Image</span>
                                                    <span class="fileupload-exists">Change</span>
                                                    <input type="file" class="formcontrol" name="logopath"
                                                        id="logopath" value="logo.jpg">
                                                </span>
                                                <a href="#" class="btn btn-danger fileupload-exists"
                                                    data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="success" class="errmsg">
                                        <!-- For success/fail messages -->
                                    </div>
                                    <hr>
                                    <div class="text-center boxes">
                                        <h4 class="mid_title"><i class="fa fa-fw fa-image"></i><strong> Visiting Card
                                                Photo</strong></h4>
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail"
                                                style="width: 350px; height: 250px;">
                                                <img class="img-rounded" src="https://www.pins.pk/uploads/agent/card.jpg"
                                                    style="width: 350px; height: 250px" alt="">
                                            </div>
                                            <div>
                                                <p><small>Max file size 500 kb</small></p>
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-success">
                                                    <span class="fileupload-new">Upload Image</span>
                                                    <span class="fileupload-exists">Change</span>
                                                    <input type="file" class="formcontrol" name="cardphoto"
                                                        id="cardphoto" value="card.jpg">
                                                </span>
                                                <a href="#" class="btn btn-danger fileupload-exists"
                                                    data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="success" class="errmsg">
                                        <!-- For success/fail messages -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Business area -->
                    <div id="content" class="col-lg-12 boxes">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mid_title">Your Social Links</div>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label for="speciality" class="col-sm-3 control-label label-strong">Facebook
                                            URL:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fb_url" name="fb_url"
                                                placeholder="Type your facebook page url" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label for="speciality" class="col-sm-3 control-label label-strong">Twitter
                                            URL:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="twitter_url"
                                                name="twitter_url" placeholder="Type your twitter page url"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label for="speciality" class="col-sm-3 control-label label-strong">Linkedin
                                            URL:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="linkedin_url"
                                                name="linkedin_url" placeholder="Type your linkedin page url"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label for="speciality" class="col-sm-3 control-label label-strong">Youtube
                                            Channel:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="gplus_url" name="gplus_url"
                                                placeholder="Type your youtube page url" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mid_title">Your Suggestions</div>
                                <p class="help-block">Please share your feedback or suggesstion for improvement, it will be
                                    highly appreciated</p>
                                <div class=" control-group form-group">
                                    <div class="controls">
                                        <div class="col-xs-12">
                                            <textarea class="form-control" rows="5" id="agentfeed" name="agentfeed"
                                                placeholder="Your feedback or suggestions"></textarea>
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
                                                <button type="submit"
                                                    class="btn-system border-btn btn-medium btn-green">Update
                                                    Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
