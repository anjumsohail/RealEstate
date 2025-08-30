{{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div class="{{ $columnClass }}">
    <div class="row mb-3">
        <!-- City -->
        <div class="col-md-3 col-sm-6 mb-3">
            <label for="city_id" class="fw-bold">City:</label>
            <select wire:model.live="selectedCity" id="city_id" name="city_id" class="form-control">
                <option value="">-- Select City --</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}</option>
                @endforeach
                <!-- ... keep your other options -->
            </select>
        </div>

        <!-- Town/Area -->
        <div class="col-md-3 col-sm-6 mb-3">
            <label for="town_id" class="fw-bold">Town/Area:</label>
            <select wire:model.live="selectedTown" id="town_id" name="town_id" class="form-control"
                data-fv-notempty="true" data-fv-notempty-message="Please select area.">
                <option value="">-- Select Area --</option>
                @foreach ($towns as $town)
                    <option value="{{ $town->id }}" {{ old('town_id') == $town->id ? 'selected' : '' }}>
                        {{ $town->name }}</option>
                @endforeach
                <!-- ... keep your other options -->
            </select>
        </div>

        <!-- Project -->
        <div class="col-md-3 col-sm-6 mb-3">
            <label for="sector_id" class="fw-bold">Project/Society/Sectors:</label>
            <select wire:model.live="selectedSector" id="sector_id" name="sector_id" class="form-control"
                data-fv-notempty="true" data-fv-notempty-message="Select Project...">
                <option value="">-- Select Project --</option>
                @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>
                        {{ $sector->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Phase/Block -->
        <div class="col-md-3 col-sm-6 mb-3">
            <label for="block_id" class="fw-bold">Phase/Block:</label>
            <select wire:model.live="selectedBlock" id="block_id" name="block_id" class="form-control"
                data-fv-notempty="true" data-fv-notempty-message="Select Block.">
                <option value="">-- Select Block --</option>
                @foreach ($blocks as $block)
                    <option value="{{ $block->id }}" {{ old('block_id') == $block->id ? 'selected' : '' }}>
                        {{ $block->name }}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>
