<x-template>
    @section('styles')
        <style>
            .message
            {
                height: 84vh;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
        </style>
    @endsection
    <div class="message">
        <p class="h1">Please, select one item at least</p>
        <a href="{{ route('index') }}" class="btn btn-dark p-3 m-3 w-50 mx-auto">Back to Products</a>
    </div>
</x-template>