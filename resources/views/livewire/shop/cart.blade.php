<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart['products'] as $product)
                                <tr>
                                    <th>{{ $product->title }}</th>
                                    <th>Rp{{ number_format($product->price, 2, ',', '.') }}</th>
                                    <th>
                                        <button wire:click="removeFromCart({{ $product->id }})" class="btn btn-sm btn-danger">Remove</button>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <a href="{{ route('shop.checkout') }}"  class="btn btn-primary float-end">Checkout</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
