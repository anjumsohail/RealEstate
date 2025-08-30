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
                <!-- Selection Start -->
                @livewire('selection-component', ['columnClass' => 'col-md-10'])
                <!-- Selection End -->
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
