<x-template>
    @section('styles')
    <style>
        .card.selected {
            background-color: #212529;
            color: white;
        }
    </style>
    @endsection
    <div class="container" style="height: 84vh">
        <div class="row">
            <form action="{{ route('count') }}" method="GET" class="mx-auto text-center" id="checkoutForm">
                @csrf
                @foreach ($items as $item)
                    <div class="col-3 m-5 mb-3" style="display: inline-block">
                        <div class="card" data-item-id="{{ $item->id }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $item->type }}</h5>
                                <p class="card-text">Shipped From: <b>{{ $item->country->name }}</b></p>
                                <p class="card-text">Price: <b>${{ $item->price }}</b></p>
                                <input type="checkbox" class="item-checkbox" name="items[]" value="{{ $item->id }}"> Select This Item
                            </div>
                        </div>
                    </div>
                @endforeach
                <input type="submit" class="btn btn-dark p-3 m-5 w-50" value="Checkout">
            </form>
        </div>
    </div>
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
        // Add click event listener to checkboxes
        $('.item-checkbox').on('change', function () {
            var itemId = $(this).val();
            var card = $('.card[data-item-id="' + itemId + '"]');
    
            // Toggle a 'selected' class on the card
            if ($(this).prop('checked')) {
                card.addClass('selected');
            } else {
                card.removeClass('selected');
            }
        });
    });
    </script>
    @endsection
</x-template>