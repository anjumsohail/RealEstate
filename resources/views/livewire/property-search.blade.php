    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <div class="row align-items-center mb-3">
                <!-- Left side -->
                <div class="col-md-6">
                    <label class="fw-bold me-2">Purpose:</label>
                    <label class="radio-inline">
                        <input type="radio" name="propfor" value="Sale" onclick="getSaleProp(this.value);"> For Sale
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="propfor" value="Rent" onclick="getSaleProp(this.value);"> For Rent
                    </label>
                </div>

                <!-- Right side -->
                <div class="col-md-6">
                    <label class="fw-bold me-2">Type:</label>
                    <label class="radio-inline">
                        <input type="radio" name="proptype" value="Plot" onclick="getTypeProp(this.value);"> Plot
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="proptype" value="Home" onclick="getTypeProp(this.value);"> Home
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="proptype" value="Apartment" onclick="getTypeProp(this.value);">
                        Apartment
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="proptype" value="Portion" onclick="getTypeProp(this.value);">
                        Portion
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="proptype" value="Cottage" onclick="getTypeProp(this.value);">
                        Cottage
                    </label>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-10">


                    <div class="row mb-3">
                        <!-- City -->
                        <div class="col-md-3 col-sm-6 mb-3">
                            <label for="cityid" class="fw-bold">City:</label>
                            <select wire:model.live="selectedCity" id="cityid" class="form-control">
                                <option value="">-- Select City --</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                                <!-- ... keep your other options -->
                            </select>
                        </div>

                        <!-- Town/Area -->
                        <div class="col-md-3 col-sm-6 mb-3">
                            <label for="townid" class="fw-bold">Town/Area:</label>
                            <select wire:model.live="selectedTown" id="townid" class="form-control"
                                data-fv-notempty="true" data-fv-notempty-message="Please select area.">
                                <option value="">-- Select Area --</option>
                                @foreach ($towns as $town)
                                    <option value="{{ $town->id }}">{{ $town->name }}</option>
                                @endforeach
                                <!-- ... keep your other options -->
                            </select>
                        </div>

                        <!-- Project -->
                        <div class="col-md-3 col-sm-6 mb-3">
                            <label for="sectorid" class="fw-bold">Project/Society/Sectors:</label>
                            <select wire:model.live="selectedSector" id="sectorid" class="form-control"
                                data-fv-notempty="true" data-fv-notempty-message="Select Project...">
                                <option value="">-- Select Project --</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Phase/Block -->
                        <div class="col-md-3 col-sm-6 mb-3">
                            <label for="blockid" class="fw-bold">Phase/Block:</label>
                            <select wire:model="selectedBlock" class="form-control" data-fv-notempty="true"
                                data-fv-notempty-message="Select Block.">
                                <option value="">-- Select Block --</option>
                                @foreach ($blocks as $block)
                                    <option value="{{ $block->id }}">{{ $block->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('log', event => {
            console.log(event.detail.message);
        });
    </script>
