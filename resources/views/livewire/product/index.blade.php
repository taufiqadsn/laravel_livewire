<div class="container">
    @if ($formVisible)
        @if (!$formUpdate)
            @livewire('product.create')
        @else
            @livewire('product.update')
        @endif
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('message'))
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    {{ __('Product') }}
                    <button wire:click="$toggle('formVisible')" class="btn btn-sm btn-success float-end">+ Create</button>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <select wire:model="paginate" name="" id=""
                                class="form-select form-control-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search" type="text" class="form-control form-control-sm"
                                placeholder="Search">
                        </div>
                    </div>

                    <hr>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach ($products as $product)
                                <?php $no++; ?>
                                <tr wire:key="product-{{ $product->id }}">
                                    <th scope="row">{{ $no }}</th>
                                    <td>{{ $product->title }}</td>
                                    <td>Rp{{ number_format($product->price, 2, ',', '.') }}</td>
                                    <td>
                                        <button wire:click="updateProduct({{ $product->id }})"
                                            class="btn btn-sm btn-info text-white">Edit</button>
                                        <button wire:click="deleteProduct({{ $product->id }})"
                                            class="btn btn-sm btn-danger" type="submit" data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirm">
                                            Delete
                                        </button>
                                        <div wire:ignore.self class="modal fade" id="deleteConfirm" tabindex="-1"
                                            aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteConfirmLabel">Delete Product
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (!empty($selectedProduct))
                                                            <strong>{{ $selectedProduct->title }} - Rp{{ number_format($selectedProduct->price, 2, ',', '.') }}</strong>
                                                        @endif
                                                        <br>
                                                        Are you sure want to delete this product?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">No</button>
                                                        <button wire:click="destroy()" type="button" class="btn btn-danger">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
