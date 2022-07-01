function initialize() {
    $("form").on("keyup keypress", function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    const locationInputs = document.getElementsByClassName("map-input");
    const autocompletes = [];
    const geocoder = new google.maps.Geocoder();
    for (let i = 0; i < locationInputs.length; i++) {
        const input = locationInputs[i];
        const fieldKey = input.id.replace("-input", "");
        const isEdit =
            document.getElementById(fieldKey + "-latitude").value != "" &&
            document.getElementById(fieldKey + "-longitude").value != "";

        const latitude =
            parseFloat(document.getElementById(fieldKey + "-latitude").value) ||
            -33.8688;
        const longitude =
            parseFloat(
                document.getElementById(fieldKey + "-longitude").value
            ) || 151.2195;

        const map = new google.maps.Map(
            document.getElementById(fieldKey + "-map"),
            {
                center: { lat: 0.1369281, lng: 117.4354375 },
                zoom: 13,
            }
        );
        const marker = new google.maps.Marker({
            map: map,
            position: { lat: latitude, lng: longitude },
            draggable: true,
        });
        marker.setVisible(isEdit);

        const locationButton = document.createElement("button");

        locationButton.textContent = "Lokasi saat ini";
        locationButton.classList.add("custom-map-control-button");
        locationButton.type = "button";

        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(
            locationButton
        );
        locationButton.addEventListener("click", () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position = GeolocationPosition) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        map.setCenter(pos);
                        map.setZoom(17);
                        marker.setPosition(pos);
                        $("#address-latitude").val(pos.lat.toFixed(6));
                        $("#address-longitude").val(pos.lng.toFixed(6));
                    }
                );
            }
        });

        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.key = fieldKey;
        autocompletes.push({
            input: input,
            map: map,
            marker: marker,
            autocomplete: autocomplete,
        });
    }

    for (let i = 0; i < autocompletes.length; i++) {
        const input = autocompletes[i].input;
        const autocomplete = autocompletes[i].autocomplete;
        const map = autocompletes[i].map;
        const marker = autocompletes[i].marker;

        google.maps.event.addListener(
            autocomplete,
            "place_changed",
            function () {
                google.maps.event.addListener(
                    marker,
                    "dragend",
                    function (evt) {
                        $("#address-latitude").val(evt.latLng.lat().toFixed(6));
                        $("#address-longitude").val(
                            evt.latLng.lng().toFixed(6)
                        );

                        map.panTo(evt.latLng);
                    }
                );
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                geocoder.geocode(
                    { placeId: place.place_id },
                    function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    }
                );

                if (!place.geometry) {
                    window.alert(
                        "No details available for input: '" + place.name + "'"
                    );
                    input.value = "";
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            }
        );
    }
}

function setLocationCoordinates(key, lat, lng) {
    const latitudeField = document.getElementById(key + "-" + "latitude");
    const longitudeField = document.getElementById(key + "-" + "longitude");
    latitudeField.value = lat;
    longitudeField.value = lng;
}

function setCoordinate() {
    const latitudeField = document.getElementById("address-latitude").value;
    const longitudeField = document.getElementById("address-longitude").value;
    document.cookie = "lat=" + latitudeField;
    document.cookie = "lng=" + longitudeField;
    document.getElementById("address-latitude").value = latitudeField;
    document.getElementById("address-longitude").value = longitudeField;
    document.getElementById("latitude").value = latitudeField;
    document.getElementById("longitude").value = longitudeField;
    document.getElementById("btnCoordinate").innerHTML = "Edit Coordinate";
    document.getElementById("btnCoordinateRegister").innerHTML = "Edit Coordinate";
}

function deleteCoordinate() {
    document.cookie = "lat=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    document.cookie = "lng=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    document.getElementById("address-latitude").value = "";
    document.getElementById("address-longitude").value = "";
    document.getElementById("latitude").value = "";
    document.getElementById("longitude").value = "";
    document.getElementById("btnCoordinate").innerHTML = "Add Coordinate";
    document.getElementById("btnCoordinateRegister").innerHTML = "Tambah Coordinate";
}
