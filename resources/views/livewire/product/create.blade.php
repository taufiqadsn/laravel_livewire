<div class="row justify-content-center mb-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="store" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <div class="form-row">
                            <div class="col mb-3">
                                <input wire:model="title" class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Title" type="text">
                                @error('title')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <input wire:model="price" class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Price" type="text">
                                @error('price')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-row">
                            <div class="col">
                                <input wire:model="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Description" type="text">
                                @error('description')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-3" x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <label class="input-group-text" for="image">Image</label>
                                    <input wire:model="image" class="form-control @error('image') is-invalid @enderror"
                                        type="file" id="image">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <div class="ms-2">
                                        <div wire:loading wire:target="image">Uploading...</div>
                                        <div class="mt-2" x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="image" height="200">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="btn-group" role="group" aria-label="Button Form">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        <button wire:click="$emit('formClose')" type="button"
                            class="btn btn-sm btn-secondary">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
