    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <div class="row align-items-center mb-3">
                <!-- Left side -->
                <div class="col-md-6">
                    <label class="fw-bold me-2">Purpose:</label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="propfor" name="propfor" value="Sale"> For Sale
                    </label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="propfor" name="propfor" value="Rent"> For Rent
                    </label>
                </div>

                <!-- Right side -->
                <div class="col-md-6">
                    <label class="fw-bold me-2">Type:</label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="proptype" name="proptype" value="Plot"> Plot
                    </label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="proptype" name="proptype" value="Home"> Home
                    </label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="proptype" name="proptype" value="Apartment">
                        Apartment
                    </label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="proptype" name="proptype" value="Portion">
                        Portion
                    </label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="proptype" name="proptype" value="Cottage">
                        Cottage
                    </label>
                </div>
            </div>

            <div class="row g-2">
                <!-- Selection Start -->
                @livewire('selection-component', ['columnClass' => 'col-md-10'])
                <!-- Selection End -->
                <div class="col-md-2">
                    <button wire:click="search" class="btn btn-dark border-0 w-100 py-3">Search</button>


                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('log', event => {
            console.log(event.detail.message);
        });
    </script>
