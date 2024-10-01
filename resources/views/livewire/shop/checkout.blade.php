<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkout') }}</div>

                <div class="card-body">
                    @if ($formCheckout)
                        <form wire:submit.prevent="checkout" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <input wire:model="first_name" class="form-control" type="text"
                                            @error('first_name') is-invalid @enderror placeholder="First Name">
                                        @error('first_name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input wire:model="last_name" class="form-control" type="text"
                                            @error('last_name') is-invalid @enderror placeholder="Last Name">
                                        @error('last_name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <input wire:model="email" class="form-control" type="text"
                                            @error('email') is-invalid @enderror placeholder="Email">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input wire:model="phone" class="form-control" type="text"
                                            @error('phone') is-invalid @enderror placeholder="Phone">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <textarea wire:model="address" class="form-control" rows="5" cols="30"
                                            @error('address') is-invalid @enderror placeholder="Address"></textarea>
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <input wire:model="city" class="form-control" type="text"
                                            @error('city') is-invalid @enderror placeholder="City">
                                        @error('city')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input wire:model="postalCode" class="form-control" type="text"
                                            @error('postal_code') is-invalid @enderror placeholder="Postal Code">
                                        @error('postal_code')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary float-end">Submit</button>
                            </div>
                        </form>
                    @else
                        <button wire:click="$emit('payment', '{{ $snapToken }}')" class="btn btn-primary">Payment</button>
                        <script>
                            window.livewire.on('payment', (snapToken) => {
                                snap.pay(snapToken, {
                                    onSuccess: function (result) {
                                        window.livewire.emit('emptyCart');
                                        window.function.href = "/shop";
                                    },
                                    onPending: function (result) {
                                        location.reload();
                                    },
                                    onError: function (result) {
                                        location.reload();
                                    }
                                });

                            })
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
