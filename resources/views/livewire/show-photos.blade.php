<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($propertyPictures->isNotEmpty())
        <div class="d-flex flex-wrap justify-content-center gap-3">
            @foreach ($propertyPictures as $picture)
                <div class="card shadow-sm p-2" style="width: 200px;">
                    <x-img id="{{ $picture->id }}" :path="$picture->image_path" width="100%" height="250"
                        class="img-fluid rounded mb-2" alt="{{ $picture->title }}" />
                    <div class="card-body text-center p-2">
                        <h6 class="card-title text-truncate mb-2">{{ $picture->title }}</h6>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal" wire:click="setDeleteId({{ $picture->id }})">
                            Remove
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-muted py-5">
            No pictures found for this property.
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this picture? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="confirmRemove" data-bs-dismiss="modal">
                        Yes, Remove
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-backdrop {
            z-index: -1 !important;
        }
    </style>
</div>
