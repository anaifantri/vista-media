<!-- View Location start -->
@foreach ($products as $location)
    @php
        $description = json_decode($location->description);
        $sectors = json_decode($location->sector);
        // $location_photos = [];
        // foreach ($locationPhotos as $photo) {
        //     if ($photo->location_id == $location->id) {
        //         array_push($location_photos, $photo);
        //     }
        // }
        $name = $location->code . '-' . $location->city_code . '-' . $location->address;

        if ($location->category == 'Signage') {
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
                    '&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
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
                '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
                $description->lat .
                ',' .
                $description->lng .
                '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
        }
    @endphp
    @include('quotations.location-extend-preview')
@endforeach
<!-- View Location end -->
