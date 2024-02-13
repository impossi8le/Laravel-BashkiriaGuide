<!-- Loop through each place and display it -->
@foreach($places as $place)
    <div class="row row-cols-2 mb-3">
        <div class="col col-6">
            <img src="{{ asset('storage/' . $place->img) }}" alt="" class="w-100">
        </div>
        <div class="col col-6 d-flex flex-column justify-content-between">
            <p class="fs-3 fw-bold mb-3">{{ $place->name }}</p>
            <p class="fs-5 mb-3">{{ mb_substr($place->address, 0, 50) }}{{ strlen($place->address) > 50 ? '...' : '' }}</p>
            <div class="  mb-3">
                @foreach($place->attributes as $attribute)
                    <img loading="lazy" src="{{ asset('storage/' . $attribute->img) }}" alt="{{ $attribute->name }}" class="attribute-img" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="{{ $attribute->name }}" style="width: 3vh; height: 3vh; ">
                @endforeach
            </div>            
            <a href="{{ route('app.places.show', $place->id) }}" class="btn btn-primary w-100">
                Подробнее
            </a>
        </div>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
        <!-- Other place details here -->
    </div>
@endforeach