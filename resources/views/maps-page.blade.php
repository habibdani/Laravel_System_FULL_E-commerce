<!-- resources/views/maps-page.blade.php -->
@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header-default') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.maps') @endcomponent

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load Leaflet.js for map rendering -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Leaflet map
            var map = L.map('map-container').setView([-6.2657501, 106.7012177], 13);

            // Load and display OpenStreetMap tiles
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
            }).addTo(map);

            document.getElementById('toggle').addEventListener('click', function() {
                const mapContainer2 = document.getElementById('map-container');
                const sidebar2 = document.getElementById('sidebar');

                if (sidebar2.classList.contains('sidebar-visible')) {
                    // Ubah lebar peta menjadi w-full
                    mapContainer2.classList.remove('w-full');
                    mapContainer2.classList.add('w-3/4');
                    map.invalidateSize();
                } else {
                    // Ubah lebar peta kembali ke w-3/4
                    mapContainer2.classList.remove('w-3/4');
                    mapContainer2.classList.add('w-full');
                    map.invalidateSize();
                }
            });

            window.addEventListener('load', function() {
                showSlide(1);
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.remove('sidebar-hidden');
                sidebar.classList.add('sidebar-visible');

                const toggleBtn = document.getElementById('toggle');
                toggleBtn.classList.remove('toggle-hidden');
                toggleBtn.classList.add('toggle-visible');

                const btnSlide1 = document.getElementById('btn-slide-1');
                btnSlide1.classList.add('text-white', 'bg-[#E01535]');
                btnSlide1.classList.remove('text-[#9D9D9D]', 'bg-transparent');

                const mapContainer4 = document.getElementById('map-container');
                mapContainer4.classList.remove('w-full');
                mapContainer4.classList.add('w-3/4');
                map.invalidateSize();
            });

            const defaultOrigin = [-6.2657501, 106.7012177];

            var originIconUrl = @json(asset('storage/icons/place-red.svg'));
            var destinationIconUrl = @json(asset('storage/icons/place-green.svg'));

            // Definisikan ikon untuk asal dan tujuan dengan warna yang berbeda
            var originIcon = L.icon({
                iconUrl: originIconUrl,
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
            });

            var destinationIcon = L.icon({
                iconUrl: destinationIconUrl,
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
            });

            // Tambahkan marker untuk origin menggunakan ikon bawaan Leaflet
            L.marker(defaultOrigin, { icon: originIcon }).addTo(map)
                .bindPopup('PT.Andal Prima')
                .openPopup();

            $('#alamat').change(function() {
                const selectedOption = $(this).find('option:selected');
                const cityName = selectedOption.data('city'); // Get the city name

                // Geocode the city name to get latitude and longitude
                geocodeCity(cityName).then(coords => {
                    const destination = coords;

                    // Tambahkan marker untuk destination menggunakan ikon bawaan Leaflet
                    if (window.destinationMarker) {
                        map.removeLayer(window.destinationMarker); // Remove the previous destination marker
                    }
                    window.destinationMarker = L.marker([destination.lat, destination.lon], { icon: destinationIcon }).addTo(map)
                        .bindPopup(cityName)
                        .openPopup();

                    // Fetch route data from OSRM using the geocoded latitude and longitude
                    var url = `http://router.project-osrm.org/route/v1/driving/${defaultOrigin[1]},${defaultOrigin[0]};${destination.lon},${destination.lat}?overview=full&geometries=geojson`;
                    console.log(url);

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.routes[0].geometry);

                             // Hapus rute sebelumnya jika ada
                            if (window.currentRoute) {
                                map.removeLayer(window.currentRoute);
                            }

                            var route = data.routes[0].geometry;
                             // Tambahkan rute baru ke peta
                             window.currentRoute = L.geoJSON(route, {
                                style: {
                                    color: '#0f99ff', // Warna garis rute
                                    weight: 6,        // Ketebalan garis rute
                                    opacity: 0.7      // Transparansi garis rute
                                }
                            }).addTo(map);

                            // Fit the map view to the route
                            map.fitBounds(window.currentRoute.getBounds());

                            // Extract distance and duration
                            var distance = data.routes[0].distance / 1000; // in kilometers
                            var duration = data.routes[0].duration / 60; // in minutes
                            console.log(`Distance: ${distance.toFixed(2)} km, Duration: ${duration.toFixed(2)} mnt`);

                            // Update UI elements with distance and duration
                            $('#jarak').text(`${distance.toFixed(2)} km`);
                            $('#waktu').text(`${duration.toFixed(0)} mnt`);
                        })
                        .catch(error => console.error('Error fetching route:', error));
                }).catch(error => console.error('Error geocoding city:', error));
            });

            // Function to geocode city name to get coordinates
            function geocodeCity(cityName) {
                var nominatimUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(cityName)}&format=json&limit=1`;

                return fetch(nominatimUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lon = data[0].lon;
                            return { lat: lat, lon: lon };
                        } else {
                            throw new Error('Location not found');
                        }
                    });
            }
        });
    </script>
@endsection
