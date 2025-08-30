<div>
    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">


        <span class="btn btn-file btn-success">
            <span class="fileupload-new">Upload Image</span>
            <span class="fileupload-exists">Change</span>
            <input wire:model="pictures" name="pictures" type="file" class="formcontrol" placeholder="Browse image.."
                multiple accept="image/*">

        </span>
        <div wire:loading wire:target="pictures">Uploading...</div>
        <a href="#" wire:click.prevent="removeAll" class="btn btn-danger fileupload-exists"> Remove All</a>
        @error('pictures.*')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        {{ count($pictures) }}
    </div>

    {{-- Preview Grid --}}
    <div class="row">
        @foreach ($pictures as $index => $picture)
            <div class="col-6 col-sm-4 col-md-3">
                <div class="p-2 border rounded shadow d-flex flex-column align-items-center">

                    {{-- Thumbnail Preview --}}
                    @if ($picture)
                        <div class="thumb-box">
                            <img src="{{ $picture->temporaryUrl() }}" class="img-fluid rounded thumb-img"
                                alt="Preview">
                        </div>

                        {{-- Title Input --}}
                        <input type="text" wire:model.defer="picture_titles.{{ $index }}"
                            placeholder="Enter title" class="form-control form-control-sm mt-2">

                        {{-- Remove Button --}}
                        <button type="button" wire:click="removePicture({{ $index }})"
                            class="btn btn-sm btn-danger mt-2">
                            Remove
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener("livewire:load", () => {
        Livewire.on('console-log', (data) => {
            console.log("Console Log Event:", data);
        });
    });
</script>
