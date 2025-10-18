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

            <div class="row" x-data="{ userType: '{{ old('user_type', $user->user_type ?? '') }}' }" x-init="$watch('userType', value => {
                if (value !== 'Business') {
                    $refs.estatearea.querySelectorAll('input, select, textarea').forEach(el => {
                        if (el.type === 'checkbox' || el.type === 'radio') el.checked = false;
                        else el.value = '';
                    });
                }
            })">
                <!-- Start MainForm -->
                <form id="usrPrfComp" class="form-horizontal" action="{{ route('profile.update', $user) }}"
                    enctype="multipart/form-data" data-fv-framework="bootstrap"
                    data-fv-icon-valid="fa fa-check-circle fa-2x" data-fv-icon-invalid="fa fa-times-circle fa-2x"
                    data-fv-icon-validating="fa fa-refresh fa-2x" method="post">
                    <div id="content" class="boxes">

                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mid_title">Personal Details</div>
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <h5><strong>There were some problems with your input:</strong></h5>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="form-horizontal">

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="user_tye" class="col-lg-3 control-label">Register As:</label>
                                            <div class="col-lg-9 col-xs-10">
                                                <label class="radio col-lg-6 col-xs-6 inline">
                                                    <input type="radio" name="user[user_type]" id="user_type_business"
                                                        value="Business"
                                                        {{ old('user.user_type', $user->user_type) === 'Business' ? 'checked' : '' }}
                                                        x-model="userType">
                                                    <a data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                        title="" data-original-title="Register as Business">
                                                        Business <i class="fa fa-info-circle fa-1x "></i></a>

                                                </label>

                                                <label class="radio col-lg-6 col-xs-6 inline">
                                                    <input type="radio" name="user[user_type]" id="user_type_individual"
                                                        value="Individual"
                                                        {{ old('user.user_type', $user->user_type) === 'Individual' ? 'checked' : '' }}
                                                        x-model="userType">
                                                    <a data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                        title="" data-original-title="Register as Individual">
                                                        Individual <i class="fa fa-info-circle fa-1x "></i></a>
                                                </label>
                                                @error('user.user_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="email" class="col-sm-3 control-label label-strong">Email:</label>

                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="user[email]"
                                                    value="{{ old('user.email', $user->email) }}">
                                            </div>
                                            @error('user.email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="name" class="col-sm-3 control-label label-strong">Your
                                                Name:</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="user[name]"
                                                    value="{{ old('user.name', $user->name) }}">
                                            </div>
                                        </div>
                                        @error('user.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label for="mobile" class="col-sm-3 control-label label-strong">Mobile
                                                #:</label>

                                            <div class="col-sm-3">mobile
                                                <input type="text" name="user[mobile]" id="mobile"
                                                    placeholder="03001234567" required=""
                                                    value="{{ old('user.mobile', $user->mobile) }}" class="form-control"
                                                    data-fv-phone="true" data-fv-phone-country="PK"
                                                    data-fv-phone-message="The value is not valid %s phone number">
                                                @error('user.mobile')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>
                                            <label for="whatsapp" class="col-sm-3 control-label label-strong">Whatsapp
                                                #:</label>

                                            <div class="col-sm-3">
                                                <input type="text" name="user[whatsapp]" id="whatsapp"
                                                    required="" value="{{ old('user.whatsapp', $user->whatsapp) }}"
                                                    class="form-control" data-fv-phone="true" data-fv-phone-country="PK"
                                                    data-fv-phone-message="The value is not valid %s phone number">

                                            </div>
                                            @error('user.whatsapp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class=" control-group form-group">
                                        <div class="controls">
                                            <label for="landline" class="col-sm-3 control-label label-strong">Land Line
                                                #:</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="user[landline]" id="landline"
                                                    placeholder="02130000000"
                                                    value="{{ old('user.landline', $user->landline) }}"
                                                    class="form-control">

                                            </div>
                                            @error('user.landline')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

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
                                            <x-img name="user[profile_photo1]" :path="$user->profile_photo_path" width="100%"
                                                height="140" class="img-fluid rounded mb-2" alt="Profile Photo" />
                                        </div>
                                        <div>
                                            <p><small>Max file size 500 kb</small></p>
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-success">
                                                <span class="fileupload-new">Upload Image</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" class="formcontrol" name="user[profile_photo_path]"
                                                    id="profile_photo" accept="image/*"
                                                    onchange="document.getElementById('removePhotoBtn').style.display = this.files.length ? 'inline-block' : 'none';">
                                            </span>
                                            <button type="button" class="btn btn-danger" id="removePhotoBtn"
                                                style="display:none;"
                                                onclick=" const input = document.getElementById('profile_photo_path');  input.value = ''; this.style.display = 'none';">
                                                Remove </button>
                                        </div>
                                    </div>
                                </div>
                                @error('user.profile_photo_path')
                                    <div class="invalid-feedback">{{ $message }}
                                    </div>
                                @enderror


                            </div>
                        </div>
                        @if ($user->businessProfile)
                            <div id="estatearea" class="col-lg-12 boxes" x-ref="estatearea"
                                x-show="userType === 'Business'" x-transition style="display: none;">
                                <div id="content" class="col-lg-12 boxes">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="mid_title">Business / Company Details</div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label for="agenttype" class="col-lg-3 control-label">Nature
                                                        of
                                                        Business:</label>

                                                    @php
                                                        $selectedServices = old(
                                                            'business_nature',
                                                            $user->businessProfile->business_nature ?? [],
                                                        );
                                                    @endphp

                                                    <div class="col-lg-9 col-xs-10">
                                                        <div class="checkbox row">
                                                            <label class="col-lg-6 col-xs-6">
                                                                <input type="checkbox" name="profile[business_nature][]"
                                                                    value="Real Estate Agent"
                                                                    {{ in_array('Real Estate Agent', $selectedServices) ? 'checked' : '' }}>
                                                                Real Estate Agent
                                                            </label>

                                                            <label class="col-lg-6 col-xs-6">
                                                                <input type="checkbox" name="profile[business_nature][]"
                                                                    value="Construction / Renovation"
                                                                    {{ in_array('Construction / Renovation', $selectedServices) ? 'checked' : '' }}>
                                                                Construction / Renovation
                                                            </label>

                                                            <label class="col-lg-6 col-xs-6">
                                                                <input type="checkbox" name="profile[business_nature][]"
                                                                    value="Legal / Documentation"
                                                                    {{ in_array('Legal / Documentation', $selectedServices) ? 'checked' : '' }}>
                                                                Legal / Documentation
                                                            </label>

                                                            <label class="col-lg-6 col-xs-6">
                                                                <input type="checkbox" name="profile[business_nature][]"
                                                                    value="Home Interior / Exterior"
                                                                    {{ in_array('Home Interior / Exterior', $selectedServices) ? 'checked' : '' }}>
                                                                Home Interior / Exterior
                                                            </label>

                                                        </div>
                                                        @error('profile.business_nature')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label for="company"
                                                        class="col-sm-3 control-label label-strong">Company
                                                        Name:</label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="company"
                                                            name="profile[company_name]"
                                                            value="{{ old('profile.company_name', optional($user->businessProfile)->company_name ?? '') }}">
                                                        <p class="help-block"><small>For example, if your register
                                                                as
                                                                Estate
                                                                Agent,
                                                                please enter your Real Estate Agency/Company
                                                                Name</small>
                                                        </p>
                                                    </div>
                                                    @error('profile.company_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                            </div>

                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label for="designation"
                                                        class="col-sm-3 control-label label-strong">Your
                                                        Designation:</label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="designation"
                                                            name="profile[designation]"
                                                            placeholder="Property Consultant/Estate Agent etc"
                                                            value="{{ old('profile.designation', optional($user->businessProfile)->designation ?? '') }}">
                                                        <p class="help-block"><small>If your register as Agent,
                                                                please
                                                                enter
                                                                your
                                                                Designation or Job Title</small></p>
                                                    </div>
                                                    @error('profile.designation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class=" control-group form-group">
                                                <div class="controls">
                                                    <label for="address"
                                                        class="col-sm-3 control-label label-strong">Address:</label>

                                                    <div class="col-sm-9">
                                                        <input type="text" name="user[address]" id="address"
                                                            maxlength="100"
                                                            value="{{ old('user.address', $user->address) }}"
                                                            class="form-control" data-fv-notempty="true"
                                                            data-fv-notempty-message="The complete address is required.">
                                                    </div>
                                                    @error('user.address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label for="city_id"
                                                        class="col-sm-3 control-label label-strong">City:</label>

                                                    <div id="citydiv" class="col-sm-9">
                                                        <select name="profile[city_id]" id="city_id"
                                                            class="form-control" data-fv-notempty="true"
                                                            data-fv-notempty-message="Please select the city.">

                                                            <option value="">-- Select City --</option>
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    {{ old('profile.city_id', optional($user->businessProfile)->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('profile.city_id')
                                                            <div class="invalid-feedback d-block">{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label for="latitude" class="col-lg-3 control-label">Google
                                                        Latitude:</label>
                                                    <div class="col-lg-3">
                                                        <input type="text" class="form-control" id="latitude"
                                                            name="profile[latitude]"
                                                            value="{{ old('profile.latitude', optional($user->businessProfile)->latitude ?? '') }}"
                                                            placeholder="i.e 24.101010">
                                                        @error('profile.latitude')
                                                            <div class="invalid-feedback d-block">{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <label for="longitude" class="col-lg-3 control-label">Google
                                                        Longitude:</label>
                                                    <div class="col-lg-3">
                                                        <input type="text" class="form-control" id="longitude"
                                                            name="profile[longitude]"
                                                            value="{{ old('profile.longitude', optional($user->businessProfile)->longitude ?? '') }}"
                                                            placeholder="i.e 67.101010" maxlength="10">
                                                        @error('profile.longitude')
                                                            <div class="invalid-feedback d-block">{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label for="desc"
                                                        class="col-sm-3 control-label label-strong">Company
                                                        /
                                                        Estate
                                                        Description:</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" rows="5" id="company_description" name="profile[company_description]"
                                                            placeholder="Describe your estate profile in detail">
                                                {{ old('profile.company_description', optional($user->businessProfile)->company_description ?? '') }}
                                                </textarea>
                                                        @error('profile.company_description')
                                                            <div class="invalid-feedback d-block">{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label for="speciality"
                                                        class="col-sm-3 control-label label-strong">Services
                                                        Offered:</label>
                                                    <div class="col-sm-9">
                                                        @php
                                                            $selectedServices = old(
                                                                'profile.services',
                                                                $user->businessProfile->services ?? [],
                                                            );
                                                        @endphp

                                                        <select id="services" name="profile[services][]" multiple
                                                            class="form-control" data-fv-notempty="true"
                                                            data-fv-notempty-message="Select at least one service">

                                                            <option value="Sales Purchase"
                                                                {{ in_array('Sales Purchase', $selectedServices) ? 'selected' : '' }}>
                                                                Property Sales Purchase
                                                            </option>

                                                            <option value="Property Rental"
                                                                {{ in_array('Property Rental', $selectedServices) ? 'selected' : '' }}>
                                                                Property Rental
                                                            </option>

                                                            <option value="Real Estate Marketing"
                                                                {{ in_array('Real Estate Marketing', $selectedServices) ? 'selected' : '' }}>
                                                                Real Estate Marketing
                                                            </option>

                                                            <option value="Construction Renovation"
                                                                {{ in_array('Construction Renovation', $selectedServices) ? 'selected' : '' }}>
                                                                Construction Renovation
                                                            </option>

                                                            <option value="Architect"
                                                                {{ in_array('Architect', $selectedServices) ? 'selected' : '' }}>
                                                                Architect
                                                            </option>

                                                            <option value="Interior Designer"
                                                                {{ in_array('Interior Designer', $selectedServices) ? 'selected' : '' }}>
                                                                Interior Designer
                                                            </option>

                                                            <option value="Property Documentation"
                                                                {{ in_array('Property Documentation', $selectedServices) ? 'selected' : '' }}>
                                                                Property Documentation
                                                            </option>

                                                            <option value="Legal Advisor"
                                                                {{ in_array('Legal Advisor', $selectedServices) ? 'selected' : '' }}>
                                                                Legal Advisor
                                                            </option>

                                                        </select>

                                                        <p class="help-block">
                                                            <small>Hold Ctrl (Cmd on Mac) to select multiple
                                                                services</small>
                                                        </p>

                                                        @error('profile.services')
                                                            <div class="invalid-feedback d-block">{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="text-center boxes">
                                                        <div class="mid_title"> <b>Company Logo</b> <i
                                                                class="fa fa-fw fa-file-image-o"></i>
                                                        </div>
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail"
                                                                style="width: 250px; height: 150px;">



                                                                <x-img name="profile[logo]" :path="$user->businessProfile->logo"
                                                                    width="100%" height="140"
                                                                    class="img-fluid rounded mb-2" alt="Logo Photo" />

                                                            </div>

                                                            <div>
                                                                <p><small>Max file size 100 kb</small></p>
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-file btn-success">
                                                                    <span class="fileupload-new">Upload
                                                                        Image</span>
                                                                    <span class="fileupload-exists">Change</span>
                                                                    <input type="file" class="formcontrol"
                                                                        name="profile[logo]" id="logo"
                                                                        value="logo.jpg">
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileupload-exists"
                                                                    data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                            @error('profile.logo')
                                                                <div class="invalid-feedback d-block">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="text-center boxes">
                                                        <h4 class="mid_title"><i class="fa fa-fw fa-image"></i><strong>
                                                                Visiting Card
                                                                Photo</strong></h4>
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail"
                                                                style="width: 250px; height: 250px;">


                                                                <x-img name="profile[vcard]" :path="$user->businessProfile->vcard"
                                                                    width="100%" height="140"
                                                                    class="img-fluid rounded mb-2" alt="Vcard Photo" />
                                                            </div>

                                                            <div>
                                                                <p><small>Max file size 500 kb</small></p>
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-file btn-success">
                                                                    <span class="fileupload-new">Upload
                                                                        Image</span>
                                                                    <span class="fileupload-exists">Change</span>
                                                                    <input type="file" class="formcontrol"
                                                                        name="profile[vcard]" id="vcard"
                                                                        value="card.jpg">
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileupload-exists"
                                                                    data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('profile.vcard')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
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
                                                        <label for="speciality"
                                                            class="col-sm-3 control-label label-strong">Facebook
                                                            URL:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="facebook_url"
                                                                name="profile[facebook_url]"
                                                                placeholder="Type your facebook page url"
                                                                value="{{ old('profile.facebook_url', optional($user->businessProfile)->facebook_url ?? '') }}">
                                                        </div>
                                                    </div>
                                                    @error('profile.facebook_url')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label for="speciality"
                                                            class="col-sm-3 control-label label-strong">Twitter
                                                            URL:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="twitter_url"
                                                                name="profile[twitter_url]"
                                                                placeholder="Type your twitter page url"
                                                                value="{{ old('profile.twitter_url', optional($user->businessProfile)->twitter_url ?? '') }}">
                                                        </div>
                                                    </div>
                                                    @error('profile.twitter_url')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mid_title">- </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label for="speciality"
                                                            class="col-sm-3 control-label label-strong">Linkedin
                                                            URL:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="linkedin_url"
                                                                name="profile[linkedin_url]"
                                                                placeholder="Type your linkedin page url"
                                                                value="{{ old('profile.linkedin_url', optional($user->businessProfile)->linkedin_url ?? '') }}">
                                                        </div>
                                                    </div>
                                                    @error('profile.linkedin_url')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label for="speciality"
                                                            class="col-sm-3 control-label label-strong">Youtube
                                                            Channel:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="youtube_url"
                                                                name="profile[youtube_url]"
                                                                placeholder="Type your youtube page url"
                                                                value="{{ old('profile.youtube_url', optional($user->businessProfile)->youtube_url ?? '') }}">
                                                        </div>
                                                    </div>
                                                    @error('profile.youtube_url')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="hr5 margin-10"></div>
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <hr>
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <div class="col-xs-5 col-xs-offset-3">


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        @endif

                        <button type="submit" class="btn-system border-btn btn-medium btn-green">Update
                            Profile</button>



                </form>
            </div>
        </div>
    </section>
@endsection
