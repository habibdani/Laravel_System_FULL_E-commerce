
document.addEventListener('DOMContentLoaded', function() {

    // script button to alamat ubah tampilan pengiriman
    function updateButtonText() {
        const locationValue = sessionStorage.getItem('locationValueAttribute');
        const pilihAlamatButton = document.getElementById('pilihAlamatok');

        if (locationValue) {
            try {
                const locationData = JSON.parse(locationValue);
                if (locationData.city) {
                    pilihAlamatButton.innerHTML = `<svg width="15" height="20" viewBox="0 0 15 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.33133 0.664062C3.43041 0.664062 0.256836 3.8381 0.256836 7.73912C0.256836 11.4942 6.67565 20.2674 6.94896 20.6389L7.20403 20.986C7.23386 21.0268 7.28136 21.0507 7.33133 21.0507C7.38208 21.0507 7.42927 21.0268 7.45941 20.986L7.71432 20.6389C7.98779 20.2674 14.4064 11.4942 14.4064 7.73912C14.4064 3.8381 11.2324 0.664062 7.33133 0.664062ZM7.33133 5.20485C8.72904 5.20485 9.86561 6.34146 9.86561 7.73912C9.86561 9.13606 8.72899 10.2734 7.33133 10.2734C5.93444 10.2734 4.79706 9.13606 4.79706 7.73912C4.79706 6.34146 5.93439 5.20485 7.33133 5.20485Z" fill="white"/>
                    </svg>&nbsp; Dikirim ke ${locationData.city}`;
                }
            } catch (e) {
                console.error("Error parsing locationValueAttribute from sessionStorage", e);
                pilihAlamatButton.textContent = "Pilih Alamat";
            }
        } else {
            pilihAlamatButton.textContent = "Pilih Alamat";
        }
    }

    // Call the function to update the button text when the page loads
    updateButtonText();

    // Fungsi untuk menampilkan slide berdasarkan nomor
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

    document.getElementById('btn-slide-1').addEventListener('click', function() {
        showSlide(1);
    });

// payment
    function handleSlideAndPaymentActions() {
        showSlide(3); // Menampilkan slide 3

        const storedLocation = sessionStorage.getItem('locationValueAttribute');
        if (storedLocation) {
            const locationData = JSON.parse(storedLocation);
            const cityValue = locationData.city; // Ambil nilai city

            // Mengubah isian dari input #kota jika ada nilai city
            const kotaInput = document.getElementById('kota');
            if (kotaInput && cityValue) {
                kotaInput.value = cityValue; // Mengisi input dengan city
            }
        }

        const buttonPayment = document.getElementById('payment');
        if (buttonPayment) {
            buttonPayment.classList.add('hidden'); // Menyembunyikan tombol payment jika ada
        }
        const buttonTotalBayar = document.getElementById("totalbayar");
        buttonTotalBayar.classList.remove('hidden');

    }

    function checkFormInputs() {
        const namaUser = document.getElementById('nama-user').value.trim();
        const alamatLengkap = document.getElementById('alamat-lengkap').value.trim();
        const kota = document.getElementById('kota').value.trim();
        const kodePos = document.getElementById('kode-pos').value.trim();
        const nomorTelp = document.getElementById('nomor-telp').value.trim();
        const email = document.getElementById('email').value.trim();

        // Cek apakah semua input terisi
        if (namaUser && alamatLengkap && kota && kodePos && nomorTelp && email) {
            const totalBayarElement = document.getElementById('totalbayar');
            if (totalBayarElement) {
                totalBayarElement.removeAttribute('disabled'); // Hapus atribut disabled
                totalBayarElement.classList.remove('bg-[#F4F4F4]', 'text-[#ADADAD]'); // Hapus class abu-abu
                totalBayarElement.classList.add('bg-[#E01535]', 'text-white'); // Tambahkan class merah
            }
        } else {
            const totalBayarElement = document.getElementById('totalbayar');
            if (totalBayarElement) {
                totalBayarElement.setAttribute('disabled', 'true'); // Tambahkan atribut disabled
                totalBayarElement.classList.add('bg-[#F4F4F4]', 'text-[#ADADAD]'); // Tambahkan class abu-abu
                totalBayarElement.classList.remove('bg-[#E01535]', 'text-white'); // Hapus class merah
            }
        }
    }

    // Tambahkan event listener onchange pada setiap input
    document.getElementById('nama-user').addEventListener('change', checkFormInputs);
    document.getElementById('alamat-lengkap').addEventListener('change', checkFormInputs);
    document.getElementById('kota').addEventListener('change', checkFormInputs);
    document.getElementById('kode-pos').addEventListener('change', checkFormInputs);
    document.getElementById('nomor-telp').addEventListener('change', checkFormInputs);
    document.getElementById('email').addEventListener('change', checkFormInputs);
    // Panggil checkFormInputs pada load pertama kali jika sudah ada nilai sebelumnya
    document.addEventListener('DOMContentLoaded', checkFormInputs);

    // Tambahkan event listener untuk id btn-slide-3
    document.getElementById('btn-slide-3').addEventListener('click', handleSlideAndPaymentActions);

    // Tambahkan event listener untuk id payment
    document.getElementById('payment').addEventListener('click', handleSlideAndPaymentActions);

    document.getElementById('confirm-button').addEventListener('click', async function() {


        // Collect data from inputs and SessionStorage
        const clientName = document.getElementById('nama-user').value;
        const clientPhoneNumber = document.getElementById('nomor-telp').value;
        const clientEmail = document.getElementById('email').value;
        const shippingAreaId = sessionStorage.getItem('shipping_area_id');
        const shippingDistrictId = sessionStorage.getItem('shipping_district_id');
        const shippingSubdistrictId = 3; // Hardcoded temporarily
        const address = document.getElementById('alamat-lengkap').value;
        const kodePos = document.getElementById('kode-pos').value;
        const additionalPricePercentage = document.getElementById('totalbayar') ? document.getElementById('totalbayar').value : null;
        const commissionPercentage = null; // Hardcoded temporarily
        const ktpImage = "path/to/ktp_image.jpg"; // Hardcoded temporarily
        const bankName = "Bank ABC"; // Hardcoded
        const bankAccountNumber = "1234567890"; // Hardcoded
        const bankAccountHolderName = "John Doe"; // Hardcoded

        // Generate booking_items array dynamically from SessionStorage
        const bookingItems = [];
        const productCardCount = sessionStorage.getItem('productCardCount') || 0;

        for (let i = 0; i < productCardCount; i++) {
            const productVariantId = sessionStorage.getItem(`productvariantIdValue-${i}`);
            const price = sessionStorage.getItem(`productvariantPriceValue-${i}`);
            const qty = sessionStorage.getItem(`productQuantity-${i}`);
            const productVariantItemId = sessionStorage.getItem(`productVariantItemIdvalue-${i}-0`);
            const note = sessionStorage.getItem(`productVariantNode-${i}`) || "";

            bookingItems.push({
                product_variant_id: productVariantId,
                price: parseFloat(price),
                qty: parseInt(qty, 10),
                product_variant_item_id: productVariantItemId,
                note: note
            });
        }

        // Prepare payload
        const payload = {
            client_type_id: 1, // Hardcoded
            client_name: clientName,
            client_phone_number: clientPhoneNumber,
            client_email: clientEmail,
            shipping_area_id: shippingAreaId,
            shipping_district_id: shippingDistrictId,
            shipping_subdistrict_id: shippingSubdistrictId,
            address: address,
            code_pos: kodePos,
            additional_price_percentage: additionalPricePercentage ? parseFloat(additionalPricePercentage) : null,
            commission_percentage: commissionPercentage,
            booking_items: bookingItems,
            ktp_image: ktpImage,
            bank_name: bankName,
            bank_account_number: bankAccountNumber,
            bank_account_holder_name: bankAccountHolderName
        };

        console.log(payload);
        // Send API request
        try {
            const response = await fetch('http://127.0.0.1:8001/api/create-orders', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${sessionStorage.getItem('authToken')}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();
            console.log('Order created successfully:', result);
            // Additional actions after successful order creation
            // Jalankan showSlide4 dan sembunyikan overlay
            showSlide4(4);
            document.getElementById('overlay').classList.add('hidden');
        } catch (error) {
            console.error('Error creating order:', error);
        }

    });


    function showSlide4(slideNumber) {
        document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));
        document.getElementById('slide-' + slideNumber).classList.remove('hidden');

        document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
            btn.classList.remove('text-white', 'bg-[#E01535]');
            btn.classList.add('text-[#9D9D9D]', 'bg-transparent');
        });
        document.getElementById('overlay-sidebar').classList.remove('hidden');
    }

    document.getElementById('toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle');
        const toggleIcon = toggleBtn.querySelector('img');
        const mapContainer = document.getElementById('map-container');
        const considebar = document.getElementById('container-sidebar');

        // Ambil URL gambar dari atribut data
        const visibleIcon = toggleBtn.getAttribute('data-visible-icon');
        const hiddenIcon = toggleBtn.getAttribute('data-hidden-icon');

        if (sidebar.classList.contains('sidebar-visible')) {
            // Sembunyikan sidebar dan perbesar peta ke lebar penuh
            sidebar.classList.remove('sidebar-visible');
            sidebar.classList.add('sidebar-hidden');
            considebar.classList.add('z-0');
            considebar.classList.remove('z-20');
            toggleBtn.classList.remove('toggle-visible');
            toggleBtn.classList.add('toggle-hidden');
            toggleIcon.src = hiddenIcon; // Mengganti src dengan gambar tersembunyi
        } else {
            // Tampilkan sidebar dan kembalikan peta ke lebar 3/4
            sidebar.classList.remove('sidebar-hidden');
            sidebar.classList.add('sidebar-visible');
            considebar.classList.add('z-20');
            considebar.classList.remove('z-0');
            toggleBtn.classList.remove('toggle-hidden');
            toggleBtn.classList.add('toggle-visible');
            toggleIcon.src = visibleIcon; // Mengganti src dengan gambar terlihat
        }
    });

    document.getElementById('pilihAlamat').addEventListener('click', function() {
        showSlide(2);

        // Mengambil elemen dan memeriksa apakah elemen tersebut ada
        const ongkirElement = document.getElementById('ongkir-display');
        const jarakElement = document.getElementById('jarak');
        const waktuElement = document.getElementById('waktu');

        if (!ongkirElement || !jarakElement || !waktuElement) {
            console.error('One or more elements are missing');
            return; // Menghentikan eksekusi jika elemen tidak ditemukan
        }

        // Mengambil nilai dari elemen yang ada
        const ongkirValue = ongkirElement.getAttribute('price-value');
        const jarakValue = jarakElement.getAttribute('jarak-value');
        const waktuValue = waktuElement.getAttribute('waktu-value');
        const locateValue = ongkirElement.getAttribute('location-value'); // JSON string

        // Membuat form secara dinamis
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = '/view-shop';

        // Menambahkan CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // console.log('rrrrrrrrrrr    ',csrfToken);
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);

        // Menambahkan input tersembunyi untuk setiap data
        const ongkirInput = document.createElement('input');
        ongkirInput.type = 'hidden';
        ongkirInput.name = 'ongkir';
        ongkirInput.value = ongkirValue;
        form.appendChild(ongkirInput);

        const jarakInput = document.createElement('input');
        jarakInput.type = 'hidden';
        jarakInput.name = 'jarak';
        jarakInput.value = jarakValue;
        form.appendChild(jarakInput);

        const waktuInput = document.createElement('input');
        waktuInput.type = 'hidden';
        waktuInput.name = 'waktu';
        waktuInput.value = waktuValue;
        form.appendChild(waktuInput);

        const locateInput = document.createElement('input');
        locateInput.type = 'hidden';
        locateInput.name = 'locate';
        locateInput.value = locateValue; // JSON string
        form.appendChild(locateInput);

        // Logging untuk memastikan form dibuat dengan benar
        console.log('Submitting form to /view-shop');

        // Menambahkan form ke body dan mengirimkannya
        document.body.appendChild(form);
        form.submit();
    });

    // Fungsi untuk menangani perubahan quantity
    function handleQuantityChange(productVariantId) {
        const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
        const decreaseButton = document.getElementById(`sidebar-decrease-${productVariantId}`);
        const increaseButton = document.getElementById(`sidebar-increase-${productVariantId}`);

        // Tambahkan event listener untuk tombol decrease
        decreaseButton.addEventListener('click', () => {
            let currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) { // Jangan kurang dari 1
                qtyInput.value = currentQty - 1;
            }
            updateTotalPrice(productVariantId); // Memanggil fungsi untuk mengupdate total harga
        });

        // Tambahkan event listener untuk tombol increase
        increaseButton.addEventListener('click', () => {
            let currentQty = parseInt(qtyInput.value);
            qtyInput.value = currentQty + 1;
            updateTotalPrice(productVariantId); // Memanggil fungsi untuk mengupdate total harga
        });

        // Tambahkan event listener untuk perubahan langsung di input field
        qtyInput.addEventListener('input', () => {
            let currentQty = parseInt(qtyInput.value);
            if (isNaN(currentQty) || currentQty < 1) {
                qtyInput.value = 1; // Set minimal 1 jika input tidak valid
            }
            updateTotalPrice(productVariantId); // Memanggil fungsi untuk mengupdate total harga
        });
    }

    // Fungsi untuk mengupdate total harga (sesuaikan dengan perhitungan harga Anda)
    function updateTotalPrice(productVariantId) {
        const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
        const priceElement = document.getElementById(`price-product-sidebar-${productVariantId}`);

        // Cek apakah elemen-elemen tersebut ada di halaman
        if (qtyInput && priceElement) {
            const qty = parseInt(qtyInput.value);
            const price = parseInt(priceElement.getAttribute('value-price-product-sidebar'));

            const totalPrice = qty * price; // Hitung total harga berdasarkan qty
            priceElement.innerText = `Rp. ${totalPrice.toLocaleString()}`; // Update display harga
        } else {
            console.warn(`Elemen dengan ID sidebar-quantity-${productVariantId} atau price-product-sidebar-${productVariantId} tidak ditemukan.`);
        }
    }

    // Pastikan fungsi ini dipanggil hanya jika productVariantId sudah didefinisikan
    if (typeof productVariantId !== 'undefined') {
        updateTotalPrice(productVariantId);
    }

 });

document.addEventListener('DOMContentLoaded', function() {

    // Fungsi untuk menghitung total item dan total harga
    function updateCartSummary() {
        const itemList = document.querySelectorAll('.list-order-item .sidebar-product-card');
        const totalItemElement = document.getElementById('totalitem');
        const totalPriceElement = document.getElementById('totalprice');
        const jumlahItemDiv = document.getElementById('jumlahitem');
        const ongkirElement = document.getElementById('ongkir-display');
        const totalBayarElement = document.getElementById('totalbayar');
        const pyment = document.getElementById('payment');

        let totalItem = 0;
        let totalPrice = 0;

        // Loop untuk menghitung total item dan harga
        itemList.forEach(item => {
            const qtyInput = item.querySelector('input[type="number"]');
            const qty = qtyInput ? parseInt(qtyInput.value) : 1;

            // Cari span harga berdasarkan ID dan ambil attribute value-price-product-sidebar-XX
            const priceElement = item.querySelector('span[id^="price-product-sidebar-"]');
            const price = priceElement ? parseInt(priceElement.getAttribute('value-price-product-sidebar-' + priceElement.id.split('-').pop())) : 0;

            totalItem += qty;
            totalPrice += qty * price;
        });

        // Update jumlah item dan total harga
        totalItemElement.innerText = totalItem;
        totalPriceElement.innerText = ` ${totalPrice.toLocaleString()}`;

        // Update juga attribute 'value' untuk totalitem dan totalprice
        totalItemElement.setAttribute('value', totalItem);
        totalPriceElement.setAttribute('value', totalPrice);

        // Ambil ongkir dari elemen #ongkir-display
        const ongkir = ongkirElement ? parseInt(ongkirElement.getAttribute('ongkir-value')) || 0 : 0;

        // Hitung total bayar (totalPrice + ongkir)
        const totalBayar = totalPrice + ongkir;

        // Update teks dan atribut value dari totalBayarElement
        totalBayarElement.innerText = `Total Bayar : Rp. ${totalBayar.toLocaleString()}`;
        totalBayarElement.innerHTML = `
            <span class="mx-auto">Total Bayar : Rp. ${totalBayar.toLocaleString()}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
            </svg>
        `;
        totalBayarElement.setAttribute('value', totalBayar);

        // Tampilkan atau sembunyikan div jumlah item
        if (totalItem > 0) {
            pyment.removeAttribute('disabled', 'disabled'); // Tambahkan atribut disabled
            pyment.classList.add('bg-[#E01535]', 'text-white');
            pyment.classList.remove('bg-[#F4F4F4]', 'text-[#ADADAD]');
        } else {
            pyment.setAttribute('disabled', 'disabled'); // Tambahkan atribut disabled
            pyment.classList.remove('bg-[#E01535]', 'text-white');
            pyment.classList.add('bg-[#F4F4F4]', 'text-[#ADADAD]');
        }
    }

    // Setiap kali ada perubahan di dalam list-order-item, jalankan updateCartSummary
    const listOrderItem = document.querySelector('.list-order-item');
    const observer = new MutationObserver(updateCartSummary);

    // Mengamati perubahan pada child elements di dalam list-order-item
    observer.observe(listOrderItem, { childList: true });

    // Jalankan fungsi sekali saat pertama kali halaman dimuat
    updateCartSummary();
});

document.getElementById('totalbayar').addEventListener('click', function() {
    // Ambil nilai dari tombol #totalbayar
    const totalBayarValue = document.getElementById('totalbayar').getAttribute('value');

    // Format harga ke dalam format Rupiah
    const formattedPrice = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(totalBayarValue);

    // Masukkan nilai harga ke dalam popup
    document.getElementById('popup-price').innerText = formattedPrice;

    // Tampilkan overlay dan popup
    document.getElementById('overlay').classList.remove('hidden');
})

document.getElementById('cancel-button').addEventListener('click', function() {
    // Sembunyikan overlay dan popup
    document.getElementById('overlay').classList.add('hidden');
});

document.addEventListener('DOMContentLoaded', function () {
    // Targetkan elemen list order item yang memuat produk di sidebar
    const listOrderContainer = document.querySelector('.list-order-item');

    // Buat MutationObserver untuk mendeteksi perubahan DOM (penambahan produk)
    const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.classList && node.classList.contains('sidebar-product-card')) {
                    // Produk baru ditambahkan, ambil productVariantId dari ID elemen
                    const productVariantId = node.querySelector('[id^="sidebar-product-id"]').id.split('sidebar-product-id-')[1];

                    const updateTotalPrice = () => {
                        const priceElements = document.querySelectorAll('[id^="sidebar_price_product_"]');
                        let totalPrice = 0;
                        priceElements.forEach(priceElement => {
                            const priceValue = parseFloat(priceElement.getAttribute('sidebar_value_price')) || 0;
                            totalPrice += priceValue;
                        });

                        // Perbarui elemen total harga
                        const totalPriceElement = document.getElementById('totalprice');
                        totalPriceElement.setAttribute('value', totalPrice);
                        totalPriceElement.textContent = `Rp. ${totalPrice.toLocaleString('id-ID')}`;
                    };

                    // Fungsi untuk memperbarui harga total berdasarkan qty dan satuan harga
                    const updatePriceDisplay = () => {
                        const qtyInput = document.getElementById(`sidebar_quantity_${productVariantId}`);
                        const quantity = parseInt(qtyInput.value);
                        const priceElement = document.getElementById(`sidebar_price_product_${productVariantId}`);
                        const unitPrice = parseFloat(priceElement.getAttribute('sidebar_price_satuan'));
                        const totalPrice = unitPrice * quantity;

                        // Update attribute dan tampilan harga
                        priceElement.setAttribute('sidebar_value_price', totalPrice);
                        const priceTextElement = document.getElementById(`sidebar-price-text-${productVariantId}`);
                        priceTextElement.textContent = `Rp. ${totalPrice.toLocaleString('id-ID')}`;

                        updateTotalPrice();
                    };

                    // Tambahkan event listener untuk tombol decrease
                    const decreaseButton = document.getElementById(`sidebar-decrease-${productVariantId}`);
                    if (decreaseButton) {
                        decreaseButton.addEventListener('click', () => {
                            const qtyInput = document.getElementById(`sidebar_quantity_${productVariantId}`);
                            let qty = parseInt(qtyInput.value);
                            if (qty > 1) {
                                qty -= 1;
                                qtyInput.value = qty;
                                updatePriceDisplay(); // Update harga setelah pengurangan qty
                            }
                        });
                    }

                    // Tambahkan event listener untuk tombol increase
                    const increaseButton = document.getElementById(`sidebar-increase-${productVariantId}`);
                    if (increaseButton) {
                        increaseButton.addEventListener('click', () => {
                            const qtyInput = document.getElementById(`sidebar_quantity_${productVariantId}`);
                            let qty = parseInt(qtyInput.value);
                            qty += 1;
                            qtyInput.value = qty;
                            updatePriceDisplay(); // Update harga setelah penambahan qty
                        });
                    }

                    // Tambahkan event listener untuk tombol delete
                    const deleteButton = document.getElementById(`sidebar-product-deleted-${productVariantId}`);
                    if (deleteButton) {
                        deleteButton.addEventListener('click', () => {
                            const productCard = document.getElementById(`sidebar-product-id-${productVariantId}`).closest('.sidebar-product-card');
                            if (productCard) {
                                productCard.remove();
                                updateTotalPrice();
                            }
                        });
                    }

                    // Inisialisasi tampilan harga saat produk pertama kali ditambahkan
                    updatePriceDisplay();
                }
            });
        });
    });

    // Konfigurasi observer untuk memantau childList (penambahan produk)
    observer.observe(listOrderContainer, { childList: true });
});

// Simpan nilai ongkir, jarak, durasi, tipe pembelian, alamat, ongkir-value, location-value, dan produk sidebar ke Session Storage
function saveDataToSessionStorage() {
    // Ambil elemen-elemen yang mungkin ada atau tidak ada di halaman
    const ongkirDisplay = document.getElementById('ongkir-display');
    const jarak = document.getElementById('jarak');
    const waktu = document.getElementById('waktu');
    const tipePembelian = document.getElementById('tipe-pembelian');
    const tiepClient = document.getElementById('type-client');
    const tipePengiriman = document.getElementById('pengiriman');
    const alamat = document.getElementById('alamat');
    const listOrderContainer = document.getElementById('list-order-container');
    const listOrderItems = document.querySelectorAll('.list-order-item .sidebar-product-card');

    // Cek dan simpan jika elemen-elemen tersebut ada
    if (ongkirDisplay) {
        const ongkirValue = ongkirDisplay.innerText;
        const ongkirValueAttribute = ongkirDisplay.getAttribute('ongkir-value');
        const locationValueAttribute = ongkirDisplay.getAttribute('location-value');

        sessionStorage.setItem('ongkir_value', ongkirValue);
        sessionStorage.setItem('ongkir_value_attribute', ongkirValueAttribute);
        sessionStorage.setItem('location_value_attribute', locationValueAttribute);
    }
    if (jarak) {
        sessionStorage.setItem('jarak_value', jarak.innerText);
    }
    if (waktu) {
        sessionStorage.setItem('waktu_value', waktu.innerText);
    }
    if (tipePembelian) {
        sessionStorage.setItem('tipe_pembelian', tipePembelian.value);
    }
    if (tiepClient) {
        sessionStorage.setItem('tiep_client', tiepClient.value);
    }
    if (tipePengiriman) {
        sessionStorage.setItem('tipe_pengiriman', tipePengiriman.value);
    }
    if (alamat) {
        sessionStorage.setItem('alamat_value', alamat.value);
    }
    if (listOrderContainer) {
        sessionStorage.setItem('List_product_sidebar_HTML', listOrderContainer.innerHTML);
    }
    // Cek dan simpan jumlah sidebar-product-card
    const productCardCount = listOrderItems.length;
    sessionStorage.setItem('product_card_count', productCardCount);

    // Simpan data dari tiap-tiap sidebar-product-card
    listOrderItems.forEach((productCard, index) => {
        const imgElement = productCard.querySelector('img');
        const productIdElement = productCard.querySelector(`[id^="sidebar-product-id-"]`);
        const priceElement = productCard.querySelector(`[id^="sidebar_price_product_"]`);
        const priceDisplayElement = productCard.querySelector(`[id^="sidebar-price-text-"]`);
        const quantityElement = productCard.querySelector(`[id^="sidebar_quantity_"]`);

        // Simpan data gambar
        if (imgElement) {
            sessionStorage.setItem(`productImageSrc-${index}`, imgElement.src);
        }

        // Simpan ID produk dan text-nya
        const productVariantIdValue = productIdElement.getAttribute('value-sidebar-product-id');
        if (productVariantIdValue) {
            sessionStorage.setItem(`product_variant_id_${index}`, productVariantIdValue);
            sessionStorage.setItem(`product_variant_name_${index}`, productIdElement.innerText);
        }

        // Ambil semua elemen varian di dalam productCard
        const variantLabels = productCard.querySelectorAll('[id^="sidebar_label_variant_item_type_"]');

        if (variantLabels.length > 0) {
            variantLabels.forEach((label, variantIndex) => {
                const variantTypeId = label.getAttribute('sidebar_variant_item_type_id');
                const variantTypeName = label.textContent.trim().split(':')[0].trim(); // Nama varian sebelum ":"

                // Ambil elemen span di dalam label untuk mendapatkan item varian
                const variantValueElem = label.querySelector('span[id^="sidebar_variant_item_"]');
                if (variantValueElem) {
                    const variantItemId = variantValueElem.getAttribute('sidebar_variant_item_id');
                    const variantItemName = variantValueElem.textContent.trim();

                    // Simpan data varian ke dalam sessionStorage dengan kunci unik
                    sessionStorage.setItem(`variant_type_name_${index}_${variantIndex}`, variantTypeName);
                    sessionStorage.setItem(`variant_type_id_${index}_${variantIndex}`, variantTypeId);
                    sessionStorage.setItem(`variant_item_id_${index}_${variantIndex}`, variantItemId);
                    sessionStorage.setItem(`variant_item_name_${index}_${variantIndex}`, variantItemName);
                }
            });
        }

        // Simpan harga produk dan text-nya
        if (priceElement) {
            const priceValue = priceElement.getAttribute(`sidebar_value_price`);
            sessionStorage.setItem(`product_variant_price_value_${index}`, priceValue);
            sessionStorage.setItem(`product_price_text_${index}`, priceDisplayElement.innerText);
        }

        // Simpan kuantitas produk
        if (quantityElement) {
            sessionStorage.setItem(`product_varaint_quantity_${index}`, quantityElement.value);
        }
    });

    // Log hasil penyimpanan
    console.log('Data produk telah disimpan ke sessionStorage.');
}

// Muat data dari Session Storage
function loadDataFromSessionStorage() {
    const ongkirValue = sessionStorage.getItem('ongkirValue');
    const jarakValue = sessionStorage.getItem('jarakValue');
    const waktuValue = sessionStorage.getItem('waktuValue');
    const tipePembelian = sessionStorage.getItem('tipePembelian');
    const alamatValue = sessionStorage.getItem('alamatValue');
    const ongkirValueAttribute = sessionStorage.getItem('ongkirValueAttribute');
    const locationValueAttribute = sessionStorage.getItem('locationValueAttribute');

    if (ongkirValue) {
        document.getElementById('ongkir-display').innerText = ongkirValue;
    }
    if (jarakValue) {
        document.getElementById('jarak').innerText = jarakValue;
    }
    if (waktuValue) {
        document.getElementById('waktu').innerText = waktuValue;
    }

    // Pastikan opsi sudah tersedia sebelum mengatur nilai select "Tipe Pembelian"
    if (tipePembelian) {
        const tipePembelianElement = document.getElementById('tipe-pembelian');
        const checkTipeInterval = setInterval(() => {
            if (tipePembelianElement.options.length > 0) {
                tipePembelianElement.value = tipePembelian;
                clearInterval(checkTipeInterval);
                console.log('Data select "Tipe Pembelian" dimuat: ', tipePembelian);
            }
        }, 100);
    }

    // // ubah option pengiriman
    if (alamatValue) {
        const alamatElement = document.getElementById('alamat');
        const checkAlamatInterval = setInterval(() => {
            if (alamatElement.options.length > 0) {
                alamatElement.value = alamatValue;
                clearInterval(checkAlamatInterval);
            }
        }, 500);
    }

    // Set ulang atribut ongkir-value dan location-value
    if (ongkirValueAttribute) {
        document.getElementById('ongkir-display').setAttribute('ongkir-value', ongkirValueAttribute);
    }
    if (locationValueAttribute) {
        document.getElementById('ongkir-display').setAttribute('location-value', locationValueAttribute);
    }

    // Muat kembali elemen produk yang disimpan di sessionStorage
    const savedProductSidebarHTML = sessionStorage.getItem('productSidebarHTML');
    if (savedProductSidebarHTML) {
        const listOrderContainer = document.getElementById('list-order-container');
        listOrderContainer.innerHTML = savedProductSidebarHTML;
    }

    // Tampilkan data produk yang disimpan
    const productCardCount = sessionStorage.getItem('productCardCount');
    console.log('Jumlah produk dalam sidebar:', productCardCount);

    for (let i = 0; i < productCardCount; i++) {
        const productImageSrc = sessionStorage.getItem(`productImageSrc-${i}`);
        const productIdValue = sessionStorage.getItem(`productIdValue-${i}`);
        const productIdText = sessionStorage.getItem(`productIdText-${i}`);
        const productPriceValue = sessionStorage.getItem(`productPriceValue-${i}`);
        const productPriceText = sessionStorage.getItem(`productPriceText-${i}`);
        const productQuantity = sessionStorage.getItem(`productQuantity-${i}`);

        // Tampilkan variant option jika ada
        let variantIndex = 0;
        while (sessionStorage.getItem(`variantOptionValue-${i}-${variantIndex}`)) {
            const variantOptionValue = sessionStorage.getItem(`variantOptionValue-${i}-${variantIndex}`);
            const variantOptionText = sessionStorage.getItem(`variantOptionText-${i}-${variantIndex}`);

            variantIndex++;
        }
    }
}

function renderProductsFromSessionStorage() {
    // Kosongkan container terlebih dahulu
    const listOrderContainer = document.getElementById('list-order-container');
    listOrderContainer.innerHTML = '';

    // Ambil jumlah produk yang disimpan di sessionStorage
    const productCardCount = sessionStorage.getItem('productCardCount');
    if (productCardCount) {
        for (let i = 0; i < productCardCount; i++) {
            // Ambil data produk dari sessionStorage
            const productImageSrc = sessionStorage.getItem(`productImageSrc-${i}`);
            const productIdValue = sessionStorage.getItem(`productIdValue-${i}`);
            const productIdText = sessionStorage.getItem(`productIdText-${i}`);
            const productPriceValue = sessionStorage.getItem(`productPriceValue-${i}`);
            const productPriceText = sessionStorage.getItem(`productPriceText-${i}`);
            const productQuantity = sessionStorage.getItem(`productQuantity-${i}`);

            // Ambil data varian produk dari sessionStorage
            const variants = [];
            let variantIndex = 0;
            while (sessionStorage.getItem(`variantOptionValue-${i}-${variantIndex}`)) {
                const variantOptionValue = sessionStorage.getItem(`variantOptionValue-${i}-${variantIndex}`);
                const variantOptionText = sessionStorage.getItem(`variantOptionText-${i}-${variantIndex}`);
                variants.push({
                    label: `Varian ${variantIndex + 1}`,  // Anda bisa mengganti label sesuai kebutuhan
                    variantItemId: variantOptionValue,
                    value: variantOptionText
                });
                variantIndex++;
            }

            // Panggil fungsi addProductToSidebar untuk menambahkan elemen produk ke container
            addProductToSidebar(productIdValue, productImageSrc, productIdText, productPriceText, productPriceValue, productQuantity, variants);
        }

    } else {
        console.warn('Tidak ada produk yang disimpan di sessionStorage');
    }
}

// Tambahkan produk baru ke dalam sidebar dan simpan ke sessionStorage
function addProductToSidebar(productVariantId, productImage, productVariantName, priceDisplay, price, qty, variants) {
    const newProductCard = document.createElement('div');
    newProductCard.setAttribute('value', productVariantId); // Menambahkan data attribute
    newProductCard.classList.add('sidebar-product-card', 'flex', 'items-start', 'justify-between', 'p-3', 'h-1/3', 'w-full', 'bg-[#F4F4F4]', 'rounded-md');

    newProductCard.innerHTML = `
        <img src="${productImage}" alt="Produk" class="w-[75px] h-[75px] object-cover rounded-md">
        <div class="ml-3 space-y-1 flex-1">
            <p id="sidebar-product-id-${productVariantId}" value-sidebar-product-id-${productVariantId}="" class="text-sm font-semibold truncate border-b-2 border-[#D9D9D9] pb-[1px]">
                ${productVariantName}
            </p>
            <p class="text-[#707070] font-normal text-[12px]">detail:</p>
            <div id="detail-product-sidebar-${productVariantId}" class="sidebar-list-varaint-label space-y-1">
                ${variants.map((variant, idx) => `
                    <p id="sidebar-label-type-${idx + 1}" class="sidebar-variant-label text-[12px] font-normal text-[#292929]">${variant.label}:
                        <span id="sidebar-option-type-${idx + 1}" value-sidebar-option-type-${idx + 1}="${variant.variantItemId}">${variant.value}</span>
                    </p>
                `).join('')}
            </div>
            <div class="bg-white w-5/6 p-1 rounded-md">
                <p class="text-[12px] font-normal ">Total Harga:
                    <span id="price-product-sidebar-${productVariantId}" value-price-product-sidebar-${productVariantId}="${price}" class="text-[12px] font-semibold">${priceDisplay}</span>
                </p>
            </div>
            <div class="flex pr-4 justify-between pt-2 w-full items-center mb-2">
                <div class=" flex items-center border bg-[#E01535] rounded-md py-1">
                    <button id="sidebar-decrease-${productVariantId}" class="p-2 h-full text-gray-700 focus:outline-none">
                        <svg width="13" height="4" viewBox="0 0 13 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="12.3574" y="0.718262" width="2.77002" height="11.8347" transform="rotate(90 12.3574 0.718262)" fill="white"/>
                        </svg>
                    </button>
                    <input id="sidebar-quantity-${productVariantId}" type="text" value="${qty}" class="w-7 bg-[#E01535] text-center font-semibold border-none focus:outline-none text-white" />
                    <button id="sidebar-increase-${productVariantId}" class="px-2 h-full text-gray-700 focus:outline-none">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="12.1514" y="4.71851" width="2.77002" height="11.8347" transform="rotate(90 12.1514 4.71851)" fill="white"/>
                            <rect x="7.61914" y="12.0208" width="2.77002" height="11.8347" transform="rotate(-180 7.61914 12.0208)" fill="white"/>
                        </svg>
                    </button>
                </div>
                <button id="sidebar-product-deleted-${productVariantId}" class="px-2 inline-flex items-center bg-white text-white py-2 rounded focus:outline-none">
                    <img src="/storage/icons/sampah.svg" alt="sampah" class="h-4 w-4">
                    <span class="font-roboto text-[16px] font-semibold leading-4.5 tracking-wide text-left"></span>
                </button>
            </div>
        </div>
    `;

    const listOrderContainer = document.getElementById('list-order-container');
    listOrderContainer.appendChild(newProductCard);

    saveDataToSessionStorage();

    console.log('Produk baru ditambahkan ke sidebar');
}

// Panggil loadDataFromSessionStorage saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadDataFromSessionStorage);

// Simpan data ke Session Storage sebelum halaman ditutup
window.onbeforeunload = saveDataToSessionStorage;

// Event listener untuk menyimpan nilai select "Tipe Pembelian" dan "Alamat" setiap kali berubah
document.getElementById('tipe-pembelian').addEventListener('change', saveDataToSessionStorage);
document.getElementById('alamat').addEventListener('change', saveDataToSessionStorage);


window.onload = function() {
    setTimeout(() => {
        renderProductsFromSessionStorage();
    }, 500); // Beri jeda sedikit untuk memastikan DOM sudah siap sepenuhnya
};

document.addEventListener("DOMContentLoaded", function() {
    const dataOngkir = document.getElementById("dataongkir");
    const buttonToSlide = document.getElementById("buttonpilihAlamat");
    const jarakElement = document.getElementById("jarak");

    // Fungsi untuk mengecek nilai jarak-value
    function checkJarakValue() {
        const jarakValue = jarakElement.getAttribute("jarak-value");

        // Jika jarak-value kosong
        if (!jarakValue || jarakValue === "") {
            // dataOngkir.classList.add("hidden"); // Tambahkan kelas hidden
            // buttonToSlide.classList.remove("hidden"); // Tampilkan tombol
        } else {
            // dataOngkir.classList.remove("hidden"); // Hapus kelas hidden
            // buttonToSlide.classList.add("hidden"); // Sembunyikan tombol juga
        }
    }

    // Jalankan pengecekan saat pertama kali halaman dimuat
    checkJarakValue();

    // Jika jarak-value berubah, kita bisa gunakan MutationObserver (opsional jika ada perubahan dinamis)
    const observer = new MutationObserver(checkJarakValue);
    observer.observe(jarakElement, { attributes: true, attributeFilter: ['jarak-value'] });
});

// hidden tombbol di bebrapa halaman
document.addEventListener("DOMContentLoaded", function() {
    const buttonPilihAlamat = document.getElementById("bottonpilihAlamat");
    const buttonGotoShop = document.getElementById("bottonGoShop");
    const buttonTotalBayar = document.getElementById("totalbayar");
    const buttonpyment = document.getElementById('payment');
    const currentUrl = window.location.pathname;

    // Periksa apakah URL adalah '/view-maps' atau '/'
    if (currentUrl === '/view-maps') {
      // Tambahkan class 'hidden' jika di halaman /view-maps
      buttonPilihAlamat.classList.add('hidden');
      buttonGotoShop.classList.remove('hidden');
      buttonTotalBayar.classList.add('hidden');
      buttonpyment.classList.add('hidden');
    } else if (currentUrl === '/') {
      // Hapus class 'hidden' jika di halaman /
      buttonPilihAlamat.classList.remove('hidden');
      buttonGotoShop.classList.add('hidden');
      buttonTotalBayar.classList.add('hidden');
      buttonpyment.classList.remove('hidden');
    }else if(currentUrl === '/view-product'){
      buttonPilihAlamat.classList.add('hidden');
      buttonGotoShop.classList.remove('hidden');
      buttonTotalBayar.classList.add('hidden');
      buttonpyment.classList.add('hidden');
    }
  });


  document.addEventListener("DOMContentLoaded", function() {
    const selectAlamat = document.getElementById("alamat");

    // Periksa apakah sessionStorage memiliki key 'locationValueAttribute'
    const storedLocation = sessionStorage.getItem('locationValueAttribute');

    if (storedLocation) {
      // Parse nilai yang disimpan dalam sessionStorage
      const locationData = JSON.parse(storedLocation);

      // Loop melalui semua option di select element
      for (let i = 0; i < selectAlamat.options.length; i++) {
        const option = selectAlamat.options[i];

        // Cocokkan option berdasarkan data-city, data-price, dan data-district_id
        if (
          option.getAttribute('data-city') === locationData.city &&
          option.getAttribute('data-price') === locationData.price &&
          option.getAttribute('data-district_id') === locationData.district_id
        ) {
          option.selected = true;
          break;
        }
      }
    }
  });
