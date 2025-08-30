    <section class="post-wrapper-top dm-shadow clearfix">
        <div class="container">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="post-wrapper-heading">
                    <i class="fa fa-fw fa-pencil-square-o"></i> Add Property for Sale
                </div>
            </div>
        </div>


        <form id="usrpropAdd" class="form-horizontal fv-form fv-form-bootstrap" wire:submit.prevent="save"
            enctype="multipart/form-data" data-fv-framework="bootstrap" data-fv-icon-valid="glyphicon glyphicon-ok"
            data-fv-icon-invalid="glyphicon glyphicon-remove" data-fv-icon-validating="glyphicon glyphicon-refresh"
            method="post" novalidate="novalidate">
            @csrf
            <section>
                <div id="content" class="col-lg-12 col-md-10 col-sm-12 col-xs-12">
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
                                        class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-form-label text-end">Purpose:</label>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" wire:model="purpose" id="purpose1" value="Sale"
                                                {{ old('purpose') == 'Sale' ? 'checked' : '' }}>
                                            For
                                            Sale
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" wire:model="purpose" id="purpose2" value="Rent"
                                                {{ old('purpose') == 'Rent' ? 'checked' : '' }}> For Rent
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="row">
                                    <label for="category"
                                        class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-form-label text-end">Category:</label>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <label class="radio-inline">
                                            <input wire:model.live="category" type="radio" value="Residential"
                                                {{ old('category') == 'Residential' ? 'checked' : '' }}>
                                            Residential
                                        </label>

                                        <label class="radio-inline">
                                            <input wire:model.live="category" type="radio" id="category2"
                                                value="Commercial"
                                                {{ old('category') == 'Commercial' ? 'checked' : '' }}>
                                            Commercial
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="row">
                                    <label for="proptype"
                                        class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-form-label text-end">Type:</label>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <label id="ltype1" class="radio-inline">
                                            <input type="radio" wire:model.live="proptype" id="proptype1"
                                                value="Plot" {{ old('proptype') == 'Plot' ? 'checked' : '' }}> Plot
                                        </label>
                                        @if ($category === 'Residential')
                                            <label id="ltype2" class="radio-inline">
                                                <input type="radio" wire:model.live="proptype" id="proptype2"
                                                    value="Home" {{ old('proptype') == 'Home' ? 'checked' : '' }}>
                                                Home
                                            </label>

                                            <label id="ltype3" class="radio-inline">
                                                <input type="radio" wire:model.live="proptype" id="proptype3"
                                                    value="Apartment"
                                                    {{ old('proptype') == 'Apartment' ? 'checked' : '' }}> Apartment
                                            </label>

                                            <label id="ltype4" class="radio-inline">
                                                <input type="radio" wire:model.live="proptype" id="proptype4"
                                                    value="Portion" {{ old('proptype') == 'Portion' ? 'checked' : '' }}>
                                                Portion
                                            </label>

                                            <label id="ltype5" class="radio-inline">
                                                <input type="radio" wire:model.live="proptype" id="proptype5"
                                                    value="Cottage" {{ old('proptype') == 'Cottage' ? 'checked' : '' }}>
                                                Cottage
                                            </label>
                                        @endif

                                        @if ($category === 'Commercial')
                                            <label id="ltype6" class="radio-inline">
                                                <input type="radio" wire:model.live="proptype" id="proptype6"
                                                    value="Shop" {{ old('proptype') == 'Shop' ? 'checked' : '' }}>
                                                Shop
                                            </label>

                                            <label id="ltype7" class="radio-inline">
                                                <input type="radio" wire:model.live="proptype" id="proptype7"
                                                    value="Office" {{ old('proptype') == 'Office' ? 'checked' : '' }}>
                                                Office
                                            </label>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="control-group form-group has-feedback">
                                <div class="row">
                                    <label for="title" class="col-lg-3 col-form-label text-end">Title of
                                        Property:</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="title" wire:model="title"
                                            placeholder="120 Yards House for Sale" value="{{ old('title') }}"
                                            class="form-control" data-fv-notempty="true"
                                            data-fv-notempty-message="Please enter title of property."
                                            data-fv-field="title"><i class="form-control-feedback"
                                            data-fv-icon-for="title" style="display: none;"></i>
                                        <small class="help-block" data-fv-validator="notEmpty" data-fv-for="title"
                                            data-fv-result="NOT_VALIDATED" style="display: none;">Please enter title
                                            of
                                            property.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group form-group has-feedback">
                                <div class="row">
                                    <label for="description" class="col-lg-3 col-form-label text-end">Property
                                        Description:</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="4" id="description" wire:model="description"
                                            placeholder="Describe property details in your words" data-fv-notempty="true"
                                            data-fv-notempty-message="The Project Description is required." data-fv-field="description">{{ old('description') }}</textarea><i class="form-control-feedback"
                                            data-fv-icon-for="description" style="display: none;"></i>
                                        <small class="help-block" data-fv-validator="notEmpty"
                                            data-fv-for="description" data-fv-result="NOT_VALIDATED"
                                            style="display: none;">The Project Description
                                            is
                                            required.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group form-group has-feedback" style="display:block">
                                <div class="row">
                                    <label for="address" class="col-lg-3 col-form-label text-end">Area /
                                        Location:</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="3" id="address" wire:model="address"
                                            placeholder="Mention Society/Project name with Phase,Sector,Block etc" value="" required=""
                                            data-fv-notempty="true" data-fv-notempty-message="Please enter location of property with area."
                                            data-fv-field="address">{{ old('address') }}</textarea><i class="form-control-feedback"
                                            data-fv-icon-for="address" style="display: none;"></i>
                                        <small class="help-block" data-fv-validator="notEmpty" data-fv-for="address"
                                            data-fv-result="NOT_VALIDATED" style="display: none;">Please enter
                                            location of
                                            property with area.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group form-group has-feedback">
                                <div class="row">
                                    <label for="area_size"
                                        class="col-lg-3 col-md-3 col-xs-3 col-form-label text-end">Size/Area:</label>
                                    <div class="col-lg-3 col-md-3  col-xs-9">
                                        <input type="text" wire:model="area_size" id="area_size"
                                            placeholder="120/240" value="{{ old('area_size') }}" required=""
                                            class="form-control" data-fv-integer="true" min="0"
                                            max="20000" data-fv-integer-message="The value is not an integer"
                                            data-fv-field="area_size"><i class="form-control-feedback"
                                            data-fv-icon-for="area_size" style="display: none;"></i>
                                        <small class="help-block" data-fv-validator="greaterThan"
                                            data-fv-for="area_size" data-fv-result="NOT_VALIDATED"
                                            style="display: none;">Please enter a value
                                            greater
                                            than or equal to %s</small><small class="help-block"
                                            data-fv-validator="integer" data-fv-for="area_size"
                                            data-fv-result="NOT_VALIDATED" style="display: none;">The
                                            value is not an integer</small><small class="help-block"
                                            data-fv-validator="lessThan" data-fv-for="area_size"
                                            data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                            enter a value less than or equal to %s</small><small class="help-block"
                                            data-fv-validator="notEmpty" data-fv-for="area_size"
                                            data-fv-result="NOT_VALIDATED" style="display: none;">Please enter a
                                            value</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="size_unit"
                                        class="col-lg-3 col-md-3 col-xs-3 col-form-label text-end">Unit of
                                        Size:</label>
                                    <div class="col-lg-3 col-md-3 col-xs-9">
                                        <select wire:model="size_unit" id="size_unit" class="form-control"
                                            data-fv-notempty="true" data-fv-notempty-message="Please select category."
                                            data-fv-field="size_unit">
                                            <option value="">-- Select Size Unit --</option>
                                            <option value="Sqy" {{ old('size_unit') == 'Sqy' ? 'selected' : '' }}>
                                                Sq
                                                Yards
                                            </option>
                                            <option value="Sqf" {{ old('size_unit') == 'Sqf' ? 'selected' : '' }}>
                                                Sq
                                                Feet
                                            </option>
                                            <option value="Marla"
                                                {{ old('size_unit') == 'Marla' ? 'selected' : '' }}>
                                                Marla
                                            </option>
                                            <option value="Kanal"
                                                {{ old('size_unit') == 'Kanal' ? 'selected' : '' }}>
                                                Kanal
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <!-- Selection Start -->
                            @livewire('selection-component', ['columnClass' => 'col-md-12'])
                            <!-- Selection End -->

                            <div class="mid_title">Property Features</div>
                            <div class="control-group form-group has-feedback">
                                <div class="row">
                                    <label for="positioning"
                                        class="col-lg-3 col-md-3 col-form-label text-end">Positioning:</label>
                                    <div class="col-lg-3 col-md-3">
                                        <select wire:model="positioning" id="positioning" required=""
                                            class="form-control" data-fv-notempty="true"
                                            data-fv-notempty-message="Please select the Category."
                                            data-fv-field="positioning">

                                            <option value="">-- Select positioning --</option>
                                            <option value="East Open"
                                                {{ old('positioning') == 'East Open' ? 'selected' : '' }}>East Open
                                            </option>
                                            <option value="West Open"
                                                {{ old('positioning') == 'West Open' ? 'selected' : '' }}>West Open
                                            </option>
                                            <option value="North Open"
                                                {{ old('positioning') == 'North Open' ? 'selected' : '' }}>North Open
                                            </option>
                                            <option
                                                value="South Open"{{ old('positioning') == 'South Open' ? 'selected' : '' }}>
                                                South Open</option>
                                        </select><i class="form-control-feedback" data-fv-icon-for="positioning"
                                            style="display: none;"></i>
                                        <small class="help-block" data-fv-validator="notEmpty"
                                            data-fv-for="positioning" data-fv-result="NOT_VALIDATED"
                                            style="display: none;">Please select the
                                            Category.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group form-group has-feedback">
                                <div class="row">
                                    <label for="front_face"
                                        class="col-lg-3 col-md-3 col-form-label text-end">Facing:</label>
                                    <div class="col-lg-3 col-md-3">
                                        <select wire:model="front_face" id="front_face" class="form-control"
                                            data-fv-notempty="true" data-fv-notempty-message="Please select category."
                                            data-fv-field="front_face">
                                            <option value="">-- Selet Front-Face --</option>
                                            <option value="Plots"
                                                {{ old('front_face') == 'Plots' ? 'selected' : '' }}>
                                                Plots
                                            </option>
                                            <option value="Homes"
                                                {{ old('front_face') == 'Homes' ? 'selected' : '' }}>
                                                Homes
                                            </option>
                                            <option value="Commercial"
                                                {{ old('front_face') == 'Commercial' ? 'selected' : '' }}>Commercial
                                            </option>
                                            <option value="Mosque"
                                                {{ old('front_face') == 'Mosque' ? 'selected' : '' }}>
                                                Mosque</option>
                                            <option value="Park"
                                                {{ old('front_face') == 'Park' ? 'selected' : '' }}>
                                                Park
                                            </option>
                                            <option value="Playgound"
                                                {{ old('front_face') == 'Playground' ? 'selected' : '' }}>Playgound
                                            </option>
                                            <option value="Graveyard"
                                                {{ old('front_face') == 'Graveyard' ? 'selected' : '' }}>Graveyard
                                            </option>
                                            <option value="Apartment"
                                                {{ old('front_face') == 'Apartment' ? 'selected' : '' }}>Apartment
                                            </option>
                                            <option value="Green Belt"
                                                {{ old('front_face') == 'Green Belt' ? 'selected' : '' }}>Green Belt
                                            </option>
                                            <option value="Jinnah Avenue"
                                                {{ old('front_face') == 'Jinnah Avenue' ? 'selected' : '' }}>Jinnah
                                                Avenue
                                            </option>
                                            <option value="Main Road"
                                                {{ old('front_face') == 'Main Road' ? 'selected' : '' }}>Main Road
                                            </option>
                                            <option value="Wide Road"
                                                {{ old('front_face') == 'Wide Road' ? 'selected' : '' }}>Wide Road
                                            </option>
                                            <option value="Compound"
                                                {{ old('front_face') == 'Compound' ? 'selected' : '' }}>
                                                Compound</option>
                                        </select><i class="form-control-feedback" data-fv-icon-for="front_face"
                                            style="display: none;"></i> <small class="help-block"
                                            data-fv-validator="notEmpty" data-fv-for="front_face"
                                            data-fv-result="NOT_VALIDATED" style="display: none;">Please
                                            select category.</small>
                                    </div>

                                    <label for="back_site" class="col-lg-3 col-md-3 col-form-label text-end">Back
                                        Site:</label>
                                    <div class="col-lg-3 col-md-3">
                                        <select wire:model="back_site" id="back_site" class="form-control"
                                            data-fv-notempty="true" data-fv-notempty-message="Please select category."
                                            data-fv-field="back_site">
                                            <option value="">-- Select Back Face --</option>
                                            <option value="Apartment"
                                                {{ old('back_site') == 'Apartment' ? 'selected' : '' }}>
                                                Apartment</option>
                                            <option value="Commercial"
                                                {{ old('back_site') == 'Commercial' ? 'selected' : '' }}>Commercial
                                            </option>
                                            <option value="Compound"
                                                {{ old('back_site') == 'Compound' ? 'selected' : '' }}>
                                                Compound</option>
                                            <option value="Graveyard"
                                                {{ old('back_site') == 'Graveyard' ? 'selected' : '' }}>
                                                Graveyard</option>
                                            <option value="Green Belt"
                                                {{ old('back_site') == 'Green Belt' ? 'selected' : '' }}>Green Belt
                                            </option>
                                            <option value="Homes"
                                                {{ old('back_site') == 'Homes' ? 'selected' : '' }}>
                                                Homes
                                            </option>
                                            <option value="Jinnah Avenue"
                                                {{ old('back_site') == 'Jinnah Avenue' ? 'selected' : '' }}>Jinnah
                                                Avenue
                                            </option>
                                            <option value="Main Road"
                                                {{ old('back_site') == 'Main Road' ? 'selected' : '' }}>
                                                Main Road</option>
                                            <option value="Mosque"
                                                {{ old('back_site') == 'Mosque' ? 'selected' : '' }}>
                                                Mosque
                                            </option>
                                            <option value="Park" {{ old('back_site') == 'Park' ? 'selected' : '' }}>
                                                Park
                                            </option>
                                            <option value="Playgound"
                                                {{ old('back_site') == 'Playground' ? 'selected' : '' }}>Playgound
                                            </option>
                                            <option value="Plots"
                                                {{ old('back_site') == 'Plots' ? 'selected' : '' }}>
                                                Plots
                                            </option>
                                            <option value="Wide Road"
                                                {{ old('back_site') == 'Wide Road' ? 'selected' : '' }}>
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
                                <div class="row">
                                    <label for="demand_price" class="col-md-3 col-form-label text-end">Demanded
                                        demand_price:</label>
                                    <div class="col-md-3">
                                        <input type="text" wire:model="demand_price" id="demand_price"
                                            placeholder="Amount" value="{{ old('demand_price') }}" required=""
                                            class="form-control" data-fv-integer="true" min="0"
                                            max="100000000" data-fv-integer-message="The value is not an integer"
                                            data-fv-field="demand_price"><i class="form-control-feedback"
                                            data-fv-icon-for="demand_price" style="display: none;"></i>

                                    </div>
                                    <label for="pricetype" class="col-md-3 col-form-label text-end">Demand
                                        Type:</label>
                                    <div class="col-md-3">
                                        <select wire:model="pricetype" id="pricetype" required=""
                                            class="form-control" data-fv-notempty="true"
                                            data-fv-notempty-message="Please select the Price Category."
                                            data-fv-field="pricetype">
                                            <option value="">-- Select Price Type --</option>
                                            <option value="Total Price"
                                                {{ old('pricetype') == 'Total Price' ? 'selected' : '' }}>Total
                                                Price
                                            </option>
                                            <option value="Own Price"
                                                {{ old('pricetype') == 'Own Price' ? 'selected' : '' }}>
                                                Own Price</option>
                                            <option value="Booking Price"
                                                {{ old('pricetype') == 'Booking Price' ? 'selected' : '' }}>Booking
                                                Price
                                            </option>
                                            <option value="Rent" {{ old('pricetype') == 'Rent' ? 'selected' : '' }}>
                                                Rent
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                            {{-- For Home --}}
                            @if ($proptype === 'Home')
                                <div class="control-group form-group has-feedback">
                                    <div class="row">
                                        <label for="consage"
                                            class="col-lg-3 col-md-3 col-form-label text-end">Construction:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="consage" id="consage" class="form-control">
                                                <option value="">-- Select Construction --</option>
                                                <option value="New"
                                                    {{ old('consage') == 'New' ? 'selected' : '' }}>New</option>
                                                <option value="Old"
                                                    {{ old('consage') == 'Old' ? 'selected' : '' }}>Old</option>
                                            </select>
                                        </div>

                                        <label for="conscond"
                                            class="col-lg-3 col-md-3 col-form-label text-end">Condition:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="conscond" id="conscond" class="form-control">
                                                <option value="">-- Select Condition --</option>
                                                <option value="Normal"
                                                    {{ old('conscond') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                                <option value="Demolish"
                                                    {{ old('conscond') == 'Demolished' ? 'selected' : '' }}>Demolish
                                                </option>
                                                <option value="Renovated"
                                                    {{ old('conscond') == 'Renovated' ? 'selected' : '' }}>Renovated
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="housetype" class="col-lg-3 col-md-3 col-form-label text-end">Home
                                            Type:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="housetype" id="housetype" class="form-control">
                                                <option value="">-- Select Floors --</option>
                                                <option value="None"
                                                    {{ old('housetype') == 'None' ? 'selected' : '' }}>None</option>
                                                <option value="Single"
                                                    {{ old('housetype') == 'Single' ? 'selected' : '' }}>Single
                                                </option>
                                                <option value="Ground+1"
                                                    {{ old('housetype') == 'Ground+1' ? 'selected' : '' }}>Ground+1
                                                </option>
                                                <option value="Ground+2"
                                                    {{ old('housetype') == 'Ground+2' ? 'selected' : '' }}>Ground+2
                                                </option>
                                                <option value="Ground+3"
                                                    {{ old('housetype') == 'Ground+3' ? 'selected' : '' }}>Ground+3
                                                </option>
                                            </select>
                                        </div>

                                        <label for="bedrooms" class="col-lg-3 col-md-3 col-form-label text-end">No of
                                            Room:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="bedrooms" id="bedrooms" class="form-control">
                                                <option value="">-- Select Bedrooms --</option>
                                                @for ($i = 0; $i <= 10; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('bedrooms') == $i ? 'selected' : '' }}>
                                                        {{ $i == 0 ? 'None' : $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            {{-- For Apartment, Portion, Cottage --}}
                            @if (in_array($proptype, ['Apartment', 'Portion', 'Cottage']))
                                <div class="control-group form-group has-feedback">
                                    <div class="row">
                                        <label for="consage"
                                            class="col-lg-3 col-md-3 col-form-label text-end">Construction:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="consage" id="consage" class="form-control">
                                                <option value="">-- Select Construction --</option>
                                                <option value="New"
                                                    {{ old('consage') == 'New' ? 'selected' : '' }}>New</option>
                                                <option value="Old"
                                                    {{ old('consage') == 'Old' ? 'selected' : '' }}>Old</option>
                                            </select>
                                        </div>

                                        <label for="conscond"
                                            class="col-lg-3 col-md-3 col-form-label text-end">Condition:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="conscond" id="conscond" class="form-control">
                                                <option value="">-- Select Condition --</option>
                                                <option value="Normal"
                                                    {{ old('conscond') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                                <option value="Demolish"
                                                    {{ old('conscond') == 'Demolished' ? 'selected' : '' }}>Demolish
                                                </option>
                                                <option value="Renovated"
                                                    {{ old('conscond') == 'Renovated' ? 'selected' : '' }}>Renovated
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="housetype" class="col-lg-3 col-md-3 col-form-label text-end">Home
                                            Type:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="housetype" id="housetype" class="form-control">
                                                <option value="">-- Select HouseType --</option>
                                                <option value="None"
                                                    {{ old('housetype') == 'None' ? 'selected' : '' }}>None</option>
                                                <option value="Single"
                                                    {{ old('housetype') == 'Single' ? 'selected' : '' }}>Single
                                                </option>
                                                <option value="Ground+1"
                                                    {{ old('housetype') == 'Ground+1' ? 'selected' : '' }}>Ground+1
                                                </option>
                                                <option value="Ground+2"
                                                    {{ old('housetype') == 'Ground+2' ? 'selected' : '' }}>Ground+2
                                                </option>
                                                <option value="Ground+3"
                                                    {{ old('housetype') == 'Ground+3' ? 'selected' : '' }}>Ground+3
                                                </option>
                                            </select>
                                        </div>

                                        <label for="floor"
                                            class="col-lg-3 col-md-3 col-form-label text-end">Floor:</label>
                                        <div class="col-lg-3 col-md-3">
                                            <select wire:model="floor" id="floor" class="form-control">
                                                <option value="">-- Select Floors --</option>
                                                @foreach (['None', 'Ground', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'] as $floor)
                                                    <option value="{{ $floor }}"
                                                        {{ old('floor') == $floor ? 'selected' : '' }}>
                                                        {{ $floor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif


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
                                <livewire:property-images />
                            </div>
                        </div>
                        <div class="mid_title">Property Latitude / Longitude</div>
                        @livewire('map-picker')

                        <div class="mid_title">Seller Details</div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label for="postas"
                                    class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-form-label text-end">Post
                                    Property
                                    As:</label>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" wire:model="postas" value="Individual"
                                            {{ old('postas') == 'Individual' ? 'checked' : '' }}>
                                        Individual
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" wire:model="postas" value="Business"
                                            {{ old('postas', 'Business') == 'Business' ? 'checked' : '' }}>
                                        Real Estate Agent
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label for="social"
                                    class="col-lg-5 col-md-5 col-sm-6 col-xs-12 col-form-label text-end">Auto
                                    Social
                                    Media Sharing:</label>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" wire:model="social" id="sharing" value="Y"
                                            {{ old('sharing') == 'Y' ? 'checked' : '' }} checked="">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" wire:model="social" id="sharing" value="N"
                                            {{ old('sharing') == 'N' ? 'checked' : '' }}> No
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="row">
                                <label class="col-lg-12 col-form-label text-end">User: Anjum</label>
                            </div>
                        </div>
                        <hr>
                        <!-- For success/fail messages -->
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="submit" class="btn-system border-btn btn-small btn-green">Submit
                                New
                                Property</button>

                        </div>
                    </div>
                </div>
                </div>
            </section>
        </form>
    </section>
    <script>
        document.addEventListener("livewire:load", () => {
            Livewire.on('log', (event) => {
                console.log("Livewire Debug:", event.detail.message);
            });
        });
    </script>
