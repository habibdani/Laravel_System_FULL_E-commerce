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

    // Toggle map and sidebar
    document.getElementById('toggle').addEventListener('click', function() {
        const mapContainer = document.getElementById('map-container');
        const sidebar = document.getElementById('sidebar');

        if (sidebar.classList.contains('sidebar-visible')) {
            mapContainer.classList.remove('w-full');
            mapContainer.classList.add('w-3/4');
        } else {
            mapContainer.classList.remove('w-3/4');
            mapContainer.classList.add('w-full');
        }
        map.invalidateSize();
    });

    // Slide logic
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

    // Default map marker and icons
    const defaultOrigin = [-6.2657501, 106.7012177];
    const originIconUrl = '/storage/icons/place-red.svg';
    const destinationIconUrl = '/storage/icons/place-green.svg';

    const originIcon = L.icon({
        iconUrl: originIconUrl,
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    const destinationIcon = L.icon({
        iconUrl: destinationIconUrl,
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    L.marker(defaultOrigin, { icon: originIcon }).addTo(map)
        .bindPopup('PT.Andal Prima')
        .openPopup();

    // Change handler for 'alamat' select element
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

            const url = `http://router.project-osrm.org/route/v1/driving/${defaultOrigin[1]},${defaultOrigin[0]};${destination.lon},${destination.lat}?overview=full&geometries=geojson`;
            console.log(url);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (window.currentRoute) {
                        map.removeLayer(window.currentRoute);
                    }

                    const route = data.routes[0].geometry;
                    window.currentRoute = L.geoJSON(route, {
                        style: {
                            color: '#0f99ff',
                            weight: 6,
                            opacity: 0.7
                        }
                    }).addTo(map);

                    map.fitBounds(window.currentRoute.getBounds());

                    const distance = data.routes[0].distance / 1000;
                    const duration = data.routes[0].duration / 60;
                    console.log(`Distance: ${distance.toFixed(2)} km, Duration: ${duration.toFixed(2)} mnt`);

                    $('#jarak').text(`${distance.toFixed(2)} km`).attr('jarak-value', distance.toFixed(2));
                    $('#waktu').text(`${duration.toFixed(0)} mnt`).attr('waktu-value', duration.toFixed(0));
                })
                .catch(error => console.error('Error fetching route:', error));
        }).catch(error => console.error('Error geocoding city:', error));
    });

    // Function to geocode city name to coordinates
    function geocodeCity(cityName) {
        const nominatimUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(cityName)}&format=json&limit=1`;

        return fetch(nominatimUrl)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const lat = data[0].lat;
                    const lon = data[0].lon;
                    return { lat: lat, lon: lon };
                } else {
                    throw new Error('Location not found');
                }
            });
    }

    document.getElementById('alamat').addEventListener('change', function () {
        // Ambil elemen terpilih
        const selectedOption = this.options[this.selectedIndex];

        // Ambil nilai data dari option yang terpilih
        const shippingAreaId = selectedOption.getAttribute('data-shipping-area-id');
        const districtId = selectedOption.getAttribute('data-district_id');
        const ongkirValue = ongkirDisplay.innerText;
        const ongkirValueAttribute = ongkirDisplay.getAttribute('ongkir-value');
        const locationValueAttribute = ongkirDisplay.getAttribute('location-value');
        const jarakValue = jarak.innerText.trim();
        const jarakValueAttribute = jarak.getAttribute('jarak-value');
        const waktuValue = waktu.innerText.trim();
        const waktuValueAttribute = waktu.getAttribute('waktu-value');
        // Cek apakah key sudah ada di SessionStorage
        if (sessionStorage.getItem('shipping_area_id') && sessionStorage.getItem('district_id')) {
            // Jika ada, update nilainya
            sessionStorage.setItem('shipping_area_id', shippingAreaId);
            sessionStorage.setItem('district_id', districtId);
            sessionStorage.setItem('ongkir_value', ongkirValue);
            sessionStorage.setItem('ongkir_value_attribute', ongkirValueAttribute || '');
            sessionStorage.setItem('location_value_attribute', locationValueAttribute || '');
            sessionStorage.setItem('jarak_value', jarakValue || '0 km');
            sessionStorage.setItem('jarak_value_attribute', jarakValueAttribute || '');
            sessionStorage.setItem('waktu_value', waktuValue || '0 mnt');
            sessionStorage.setItem('waktu_value_attribute', waktuValueAttribute || '');
        } else {
            // Jika belum ada, simpan nilai baru
            sessionStorage.setItem('shipping_area_id', shippingAreaId);
            sessionStorage.setItem('district_id', districtId);
            sessionStorage.setItem('ongkir_value', ongkirValue);
            sessionStorage.setItem('ongkir_value_attribute', ongkirValueAttribute || '');
            sessionStorage.setItem('location_value_attribute', locationValueAttribute || '');
            sessionStorage.setItem('jarak_value', jarakValue || '0 km');
            sessionStorage.setItem('jarak_value_attribute', jarakValueAttribute || '');
            sessionStorage.setItem('waktu_value', waktuValue || '0 mnt');
            sessionStorage.setItem('waktu_value_attribute', waktuValueAttribute || '');
        }
    });

    // Function to render shipping list and auto-select based on sessionStorage
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
            const iframe = document.getElementById("map");

            // Check if sessionStorage has 'ongkir_value_attribute'
            const storedLocation = sessionStorage.getItem('ongkir_value_attribute');
            if (storedLocation) {
                const locationData = JSON.parse(storedLocation);
                for (let i = 0; i < selectAlamat.options.length; i++) {
                    const option = selectAlamat.options[i];
                    if (
                        option.getAttribute('data-city') === locationData.city &&
                        option.getAttribute('data-price') === locationData.price &&
                        option.getAttribute('data-district_id') === locationData.district_id &&
                        option.getAttribute('data-shipping-area-id') === locationData.shipping_area_id
                    ) {
                        option.selected = true;
                        break;
                    }
                }
            } else {
                // Set default option if no sessionStorage value found
                selectAlamat.selectedIndex = 0;
            }

            selectAlamat.addEventListener('change', function() {
                const selectedOption = selectAlamat.options[selectAlamat.selectedIndex];
                const price = selectedOption.dataset.price;
                const city = selectedOption.dataset.city;
                const district_id = selectedOption.dataset.district_id;
                const shipping_area_id = selectedOption.dataset.shippingAreaId;

                const formattedPrice = `Rp.${parseInt(price).toLocaleString('id-ID')}`;

                const jsonData = {
                    price: price,
                    city: city,
                    district_id: district_id,
                    shipping_area_id: shipping_area_id
                };

                ongkirDisplay.textContent = formattedPrice;
                ongkirDisplay.setAttribute('ongkir-value', price);
                ongkirDisplay.setAttribute('location-value', JSON.stringify(jsonData));

                // Save the selected value to sessionStorage
                sessionStorage.setItem('ongkir_value_attribute', JSON.stringify(jsonData));
                sessionStorage.setItem('location_value_attribute', JSON.stringify(jsonData));
                sessionStorage.setItem('city_value',city);
                sessionStorage.setItem('alamat_value', district_id);

                const jarakValue = jarak.innerText.trim();
                const jarakValueAttribute = jarak.getAttribute('jarak-value');
                sessionStorage.setItem('jarak_value', jarakValue);
                sessionStorage.setItem('jarak_value_attribute', jarakValueAttribute);

                const ongkirValue = ongkirDisplay.innerText;
                const ongkirValueAttribute = ongkirDisplay.getAttribute('ongkir-value');
                const locationValueAttribute = ongkirDisplay.getAttribute('location-value');
                sessionStorage.setItem('ongkir_value', ongkirValue);
                sessionStorage.setItem('ongkir_value_attribute', ongkirValueAttribute);
                sessionStorage.setItem('location_value_attribute', locationValueAttribute);

                const waktuValue = waktu.innerText.trim();
                const waktuValueAttribute = waktu.getAttribute('waktu-value');
                sessionStorage.setItem('waktu_value', waktuValue);
                sessionStorage.setItem('waktu_value_attribute', waktuValueAttribute);

                const url = `https://maps.google.com/maps?q=${encodeURIComponent(city)}&t=&z=13&ie=UTF8&iwloc=&output=embed`;
                iframe.src = url;
            });

            const shippingDistricts = await fetchShippingDistricts();

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

    // Initial render of shipping list
    renderListShipping();
});
