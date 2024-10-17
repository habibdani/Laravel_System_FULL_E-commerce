import { fetchShippings } from './api/fetchShippings';
import { fetchShippingDistricts } from './api/fetchShippingDistricts';

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
            mapContainer2.classList.remove('w-full');
            mapContainer2.classList.add('w-3/4');
            map.invalidateSize();
        } else {
            mapContainer2.classList.remove('w-3/4');
            mapContainer2.classList.add('w-full');
            map.invalidateSize();
        }
    });

    function showSlide(slideNumber) {
        document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));
        document.getElementById('slide-' + slideNumber).classList.remove('hidden');

        document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
            btn.classList.remove('text-white', 'bg-[#E01535]');
            btn.classList.add('text-[#9D9D9D]', 'bg-transparent');
        });

        document.getElementById('btn-slide-' + slideNumber).classList.add('text-white', 'bg-[#E01535]');
        document.getElementById('btn-slide-' + slideNumber).classList.remove('text-[#9D9D9D]', 'bg-transparent');
    }

    document.addEventListener('DOMContentLoaded', function() {
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

        const considebar = document.getElementById('container-sidebar');
        considebar.classList.add('z-20');
        considebar.classList.remove('z-0');

        // const buttontotalbayar = document.getElementById('totalbayar');
        // buttontotalbayar.classList.add('hidden');

        const bottonpilihAlamat = document.getElementById('bottonpilihAlamat');
        const pilihAlamatok = document.getElementById('pilihAlamatok');
        bottonpilihAlamat.classList.add('hidden');
        pilihAlamatok.classList.add('hidden');
    });


    const defaultOrigin = [-6.2657501, 106.7012177];

    var originIconUrl = '/storage/icons/place-red.svg';
    var destinationIconUrl = '/storage/icons/place-green.svg';

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

    L.marker(defaultOrigin, { icon: originIcon }).addTo(map)
        .bindPopup('PT.Andal Prima')
        .openPopup();

    $('#alamat').change(function() {
        const selectedOption = $(this).find('option:selected');
        const cityName = selectedOption.data('city');

        geocodeCity(cityName).then(coords => {
            const destination = coords;

            if (window.destinationMarker) {
                map.removeLayer(window.destinationMarker);
            }
            window.destinationMarker = L.marker([destination.lat, destination.lon], { icon: destinationIcon }).addTo(map)
                .bindPopup(cityName)
                .openPopup();

            var url = `http://router.project-osrm.org/route/v1/driving/${defaultOrigin[1]},${defaultOrigin[0]};${destination.lon},${destination.lat}?overview=full&geometries=geojson`;
            console.log(url);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log(data.routes[0].geometry);

                    if (window.currentRoute) {
                        map.removeLayer(window.currentRoute);
                    }

                    var route = data.routes[0].geometry;
                    window.currentRoute = L.geoJSON(route, {
                        style: {
                            color: '#0f99ff',
                            weight: 6,
                            opacity: 0.7
                        }
                    }).addTo(map);

                    map.fitBounds(window.currentRoute.getBounds());

                    var distance = data.routes[0].distance / 1000;
                    var duration = data.routes[0].duration / 60;
                    console.log(`Distance: ${distance.toFixed(2)} km, Duration: ${duration.toFixed(2)} mnt`);

                    $('#jarak').text(`${distance.toFixed(2)} km`).attr('jarak-value', distance.toFixed(2));
                    $('#waktu').text(`${duration.toFixed(0)} mnt`).attr('waktu-value', duration.toFixed(0));
                })
                .catch(error => console.error('Error fetching route:', error));
        }).catch(error => console.error('Error geocoding city:', error));
    });

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

    async function renderListShipping() {
        try {
            const shippings = await fetchShippings();

            const selectElement = document.getElementById('tipe-pembelian');
            shippings.forEach(shipping => {
                const option = document.createElement('option');
                option.value = shipping.id;
                option.textContent = shipping.type_pembelian;
                selectElement.appendChild(option);
            });

            const selectAlamat = document.getElementById('alamat');
            const ongkirDisplay = document.getElementById('ongkir-display');
            const jarakDisplay = document.getElementById('jarak');
            const iframe = document.getElementById("map");

            selectAlamat.addEventListener('change', function() {
                const selectedOption = selectAlamat.options[selectAlamat.selectedIndex];
                const price = selectedOption.dataset.price;
                const city = selectedOption.dataset.city;
                const district_id = selectedOption.dataset.district_id;
                const shipping_area_id = selectedOption.dataset.shipping_area_id;

                const formattedPrice = `Rp.${parseInt(price).toLocaleString('id-ID')}`;

                const jsonData = {
                    price: price,
                    city: city,
                    district_id: district_id,
                    shipping_area_id: shipping_area_id,
                };

                ongkirDisplay.textContent = formattedPrice;
                // ongkirDisplay.setAttribute('price-value', formattedPrice);
                ongkirDisplay.setAttribute('ongkir-value', price);
                ongkirDisplay.setAttribute('location-value', JSON.stringify(jsonData));

                const url = `https://maps.google.com/maps?q=${encodeURIComponent(city)}&t=&z=13&ie=UTF8&iwloc=&output=embed`;
                iframe.src = url;
            });

            const shippingDistricts = await fetchShippingDistricts();
            // console.log('Shipping Districts:', shippingDistricts);

            shippingDistricts.forEach(district => {
                const option = document.createElement('option');
                option.value = district.district_id;
                option.dataset.shippingAreaId = district.shipping_area_id;
                option.dataset.price = district.price;
                option.dataset.city = district.city;
                option.dataset.district_id = district.district_id;
                option.textContent = district.alamat;
                selectAlamat.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading data:', error);
        }
    }

    renderListShipping();
});

