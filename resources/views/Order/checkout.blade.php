<x-template>
    <div class="container" style="height: 7vh">
        
    </div>
    <div class="card">
        <div class="card-body mx-4">
            <div class="container">
                <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
                @foreach ($checkout as $key => $value)
                    @if (is_array($value))
                        <div class="row">
                            <div class="float-end fw-bold">
                                <p>Discounts:</p>
                            </div>
                        </div>
                        @foreach ($value as $discountKey => $discountValue)
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>{{ $discountKey }}</p>
                                </div>
                                <div class="col-xl-2">
                                    <p class="float-end">${{ $discountValue }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-xl-10">
                                <p>{{ $key }}</p>
                            </div>
                            <div class="col-xl-2">
                                <p class="float-end">${{ $value }}</p>
                            </div>
                        </div>
                        <hr>
                    @endif
                @endforeach

                <div class="row text-black">
                    <div class="col-xl-12">
                        <p class="float-end fw-bold">Total: ${{ $total }}</p>
                    </div>
                    <hr style="border: 2px solid black;">
                </div>
            </div>
        </div>
        <a href="{{ route('index') }}" class="btn btn-dark p-3 m-3 w-50 mx-auto">Back to Products</a>
    </div>
</x-template>
