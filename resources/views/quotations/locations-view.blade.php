<!-- View Location start -->
@foreach ($products as $product)
    @php
        $description = json_decode($product->description);
        $sectors = json_decode($product->sector);
        $name = $product->code . '-' . $product->city_code . '-' . $product->address;

        if ($product->category == 'Signage') {
            $mapsLink =
                'https://maps.googleapis.com/maps/api/staticmap?center=' .
                $description->lat[0] .
                ',' .
                $description->lng[0] .
                '&zoom=17&size=480x355&maptype=terrain';
            $mapsMarkers = '';
            $googleKey = '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
            for ($i = 0; $i < count($description->lat); $i++) {
                $mapsMarkers =
                    $mapsMarkers .
                    '&markers=icon:https://' .
                    $company->website .
                    '/img/marker-red.png%7C' .
                    $description->lat[$i] .
                    ',' .
                    $description->lng[$i];
            }
            $src = $mapsLink . $mapsMarkers . $googleKey;
        } else {
            $src =
                'https://maps.googleapis.com/maps/api/staticmap?center=' .
                $description->lat .
                ',' .
                $description->lng .
                '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://' .
                $company->website .
                '/img/marker-red.png%7C' .
                $description->lat .
                ',' .
                $description->lng .
                '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
        }
    @endphp
    @include('quotations.location-preview')
@endforeach
<!-- View Location end -->
