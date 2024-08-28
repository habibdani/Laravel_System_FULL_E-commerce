<section class="maps pt-[54px] -z-10">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&callback=initMap" async defer></script>

    <iframe id="map" src="https://maps.google.com/maps?q=Tangerang&t=&z=12&ie=UTF8&iwloc=&output=embed"
    frameborder="0" style="border:0; height: calc(100vh - 54px); width:100%;"></iframe>

    <script>
        function initMap() {
            var mapOptions = {
                center: { lat: -6.2657501, lng: 106.7012177 }, // Default center of the map
                zoom: 15 // Default zoom level
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }

        $(document).ready(function() {
            $('#address').change(function() {
                let ongkir = this.value.split("+")[0];
                let location = this.value.split("+")[1].split(" - ");
                let city = location[1];
                let area = location[0];
                let joinedLocation = city + '+' + area;

                // Update ongkir, jarak, and waktu
                document.getElementById('ongkir').innerHTML = ongkir;
                document.getElementById('jarak').innerHTML = "20 km";  // Dummy value, replace as needed
                document.getElementById('waktu').innerHTML = "47m";  // Dummy value, replace as needed

                // Update Google Map with the new location
                let url = `https://maps.google.com/maps?q=${joinedLocation}&t=&z=15&ie=UTF8&iwloc=&output=embed`;
                $('#map').attr('src', url);

                // console.log("test badge : masuk")
                // document.getElementById('ongkir').innerHTML = this.value.split("+")[0];
                // let location = this.value.split("+")[1].split(" - ");
                // let joinLocation = location[1] + '+' + location[0]
                // console.log(joinLocation)
                // let iframe = document.getElementById("map");
                // let url = `https://maps.google.com/maps?q=${location}&t=&z=13&ie=UTF8&iwloc=&output=embed`; // replace with your desired URL
                // iframe.src = url;
            });
        });
    </script>

</section>
