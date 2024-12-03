
document.addEventListener('DOMContentLoaded', function() {

    // script button to alamat ubah tampilan pengiriman
    function updateButtonText() {
        const locationValue = sessionStorage.getItem('city_value');
        const pilihAlamatButton = document.getElementById('pilihAlamatok');

        if (locationValue) {
            try {
                const locationValue = sessionStorage.getItem('city_value');
                    pilihAlamatButton.innerHTML = `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg> &nbsp NEXT &nbsp  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>`;
            } catch (e) {
                console.error("Error parsing ongkir_value_attribute from sessionStorage", e);
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

    document.getElementById('createorder').addEventListener('click', async function () {
        try {
            // Collect data from inputs and SessionStorage
            const clientName = sessionStorage.getItem('client_name')?.trim();
            const clientPhoneNumber = sessionStorage.getItem('client_nomor_telp')?.trim();
            const clientEmail = sessionStorage.getItem('client_email')?.trim();
            const kodePos = sessionStorage.getItem('client_codepos')?.trim();
            const clientAlamat = sessionStorage.getItem('client_alamat')?.trim();
            const shippingAreaId = sessionStorage.getItem('shipping_area_id');
            const shippingDistrictId = sessionStorage.getItem('district_id');
            const shippingSubdistrictId = sessionStorage.getItem('subdistrict_id');
            const totalPriceValue = sessionStorage.getItem(`total_price_value`);
            const ongkir = sessionStorage.getItem('ongkir_value_attribute');
            const shipping_id = sessionStorage.getItem('tipe_pembelian');
            const additionalPricePercentage = parseFloat(sessionStorage.getItem('total_price_value')) || 0;

            // Hardcoded fields
            const commissionPercentage = null; // Placeholder for commission
            const ktpImage = "path/to/ktp_image.jpg"; // Placeholder
            const bankName = "Bank ABC"; // Placeholder
            const bankAccountNumber = "1234567890"; // Placeholder
            const bankAccountHolderName = "John Doe"; // Placeholder

            // Validate mandatory fields
            if (!clientName || !clientPhoneNumber || !clientEmail || !clientAlamat || !kodePos || !shippingAreaId || !shippingDistrictId) {
                alert('Please fill in all required fields.');
                return;
            }

            // Generate booking_items array dynamically from SessionStorage
            const bookingItems = [];
            const productCardCount = parseInt(sessionStorage.getItem('product_card_count')) || 0;

            for (let i = 0; i < productCardCount; i++) {
                const productVariantId = sessionStorage.getItem(`product_variant_id_${i}`);
                const productVariantName = sessionStorage.getItem(`product_variant_name_${i}`);
                const price = parseFloat(sessionStorage.getItem(`product_variant_price_value_${i}`)) || 0;
                const qty = parseInt(sessionStorage.getItem(`product_varaint_quantity_${i}`)) || 0;

                if (!productVariantId || qty <= 0 || price <= 0) {
                    console.warn(`Skipping invalid booking item: ${i}`);
                    continue; // Skip invalid items
                }

                const productVariantItemCount = parseInt(sessionStorage.getItem(`product_variant_item_count_${i}`)) || 0;

                if (productVariantItemCount > 0) {
                    for (let j = 0; j < productVariantItemCount; j++) {
                        const productVariantItemIdRaw = sessionStorage.getItem(`variant_item_id_${i}_${j}`);
                        const productVariantItemId = productVariantItemIdRaw ? parseInt(productVariantItemIdRaw, 10) : null;
                        const note = sessionStorage.getItem(`variant_item_name_${i}_${j}`);

                        bookingItems.push({
                            product_variant_id: productVariantId,
                            product_variant_name: productVariantName,
                            price,
                            qty,
                            product_variant_item_id: productVariantItemId,
                            note: note || null
                        });
                    }
                } else {
                    bookingItems.push({
                        product_variant_id: productVariantId,
                        product_variant_name: productVariantName,
                        price,
                        qty,
                        product_variant_item_id: null,
                        note: null
                    });
                }
            }
            // Log the booking items for debugging
            console.log("Booking Items:", bookingItems);

            // Prepare the payload
            const payload = {
                client_type_id: 1, // Placeholder
                client_name: clientName,
                client_phone_number: clientPhoneNumber,
                client_email: clientEmail,
                shipping_area_id: shippingAreaId,
                shipping_district_id: shippingDistrictId,
                shipping_subdistrict_id: shippingSubdistrictId,
                address: clientAlamat,
                ongkir: ongkir,
                shipping_id: shipping_id,
                code_pos: kodePos,
                additional_price_percentage: additionalPricePercentage || null,
                commission_percentage: commissionPercentage,
                booking_items: bookingItems,
                total_price_booking: totalPriceValue,
                ktp_image: ktpImage,
                bank_name: bankName,
                bank_account_number: bankAccountNumber,
                bank_account_holder_name: bankAccountHolderName
            };

            console.log("Payload:", payload);
            sessionStorage.setItem('order_data',JSON.stringify({payload}));

            // Send the API request
            const response = await fetch('http://127.0.0.1:8001/api/create-orders', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${sessionStorage.getItem('authToken')}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                throw new Error('Failed to create order. Please try again.');
            }

            const result = await response.json();
            console.log('Order created successfully:', result);

            // Additional actions after successful order creation
            alert('Order created successfully!');
            showSlide(4); // Display slide 4
            document.getElementById('overlay').classList.add('hidden'); // Hide overlay
            // Pemanggilan fungsi
            // Panggil fungsi untuk mengirim email
            sendEmail();
        } catch (error) {
            console.error('Error creating order:', error);
            alert('Error creating order. Please try again.');
        }
    });

    async function sendEmail() {
        const clientEmail = sessionStorage.getItem('client_email');
        const orderData = sessionStorage.getItem('order_data'); // Data harus berupa JSON string
        const nomorwa = sessionStorage.getItem('waNomor');
        const linkwa = sessionStorage.getItem('waLink');
        const namaRekening = sessionStorage.getItem('namaRekening');
        const nomorRekening = sessionStorage.getItem('nomorRekening');

        if (!clientEmail || !orderData) {
            console.error("❌ Email atau data pesanan tidak ditemukan di sessionStorage.");
            return;
        }

        const requestBody = {
            to: clientEmail, // Email tujuan
            subject: "Informasi Pesanan Anda", // Subjek email
            data: orderData, // Pastikan data JSON
            nomorwa: nomorwa,
            linkwa: linkwa,
            namaRekening: namaRekening,
            nomorRekening: nomorRekening,
        };

        try {
            const response = await fetch('http://127.0.0.1:8001/api/send-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(requestBody),
            });

            if (response.ok) {
                console.log("✅ Email berhasil dikirim:", requestBody);
            } else {
                console.error("❌ Gagal mengirim email:", errorResponse);
            }
        } catch (error) {
            console.error("❌ Terjadi kesalahan saat mengirim email:", error.message);
        }
    }


// payment
    function handleSlideAndPaymentActions() {
        showSlide(3); // Menampilkan slide 3

        const storedLocation = sessionStorage.getItem('city_value');
        if (storedLocation) {
            // Mengubah isian dari input #kota jika ada nilai city
            const kotaInput = document.getElementById('kota');
            kotaInput.value = storedLocation; // Mengisi input dengan city
        }

        const buttonPayment = document.getElementById('payment');
        if (buttonPayment) {
            buttonPayment.classList.add('hidden'); // Menyembunyikan tombol payment jika ada
        }

        const buttonTotalBayar = document.getElementById('totalbayar');
        if (buttonTotalBayar) {
            buttonTotalBayar.classList.remove('hidden'); // Menampilkan tombol total bayar
            updateTotalBayarText(); // Memperbarui teks total bayar
        }
    }

    function checkFormInputs() {
        const namaUser = sessionStorage.getItem('client_name');
        const alamatLengkap = sessionStorage.getItem('client_alamat');
        const kota = sessionStorage.getItem('city_value');
        const kodePos = sessionStorage.getItem('client_codepos');
        const nomorTelp = sessionStorage.getItem('client_nomor_telp');
        const email = sessionStorage.getItem('client_email');

        const totalBayarElement = document.getElementById('totalbayar');
        if (totalBayarElement) {
            if (namaUser && alamatLengkap && kota && kodePos && nomorTelp && email) {
                // Semua input terisi
                totalBayarElement.classList.remove('bg-[#F4F4F4]', 'text-[#ADADAD]'); // Hapus class abu-abu
                totalBayarElement.classList.add('bg-[#32CD32]', 'text-white'); // Tambahkan class merah
            } else {
                // Ada input yang kosong
                totalBayarElement.classList.add('bg-[#F4F4F4]', 'text-[#ADADAD]'); // Tambahkan class abu-abu
                totalBayarElement.classList.remove('bg-[#32CD32]', 'text-white'); // Hapus class merah
            }

            // Memperbarui teks total bayar setiap kali form di-check
            updateTotalBayarText();
        }
    }

    setInterval(() => {
        checkFormInputs();
        updateInfoFromSessionStorage();
    }, 1500);

    function updateTotalBayarText() {


        const totalBayarElement = document.getElementById('totalbayar');
        if (totalBayarElement) {
            // Update teks pada tombol total bayar
            totalBayarElement.textContent = `Konfirmasi Pembayaran`;
        }
    }

    // Panggil fungsi untuk memeriksa input dan memperbarui total bayar
    document.addEventListener('DOMContentLoaded', () => {
        handleSlideAndPaymentActions();
        checkFormInputs(); // Pastikan form di-check saat halaman selesai dimuat
    });

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
            considebar.classList.add('z-20');
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


    // Fungsi untuk mengupdate total harga (sesuaikan dengan perhitungan harga Anda)
    function updateTotalPricPerProduct(productVariantId) {
        const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
        const priceElement = document.getElementById(`price-product-sidebar-${productVariantId}`);

        // Cek apakah elemen-elemen tersebut ada di halaman
        if (qtyInput && priceElement) {
            const qty = parseInt(qtyInput.value);
            const price = parseInt(priceElement.getAttribute('value-price-product-sidebar'));

            const totalPricPerProduct = qty * price; // Hitung total harga berdasarkan qty
            priceElement.innerText = `Rp. ${totalPricPerProduct.toLocaleString()}`; // Update display harga
        } else {
            console.warn(`Elemen dengan ID sidebar-quantity-${productVariantId} atau price-product-sidebar-${productVariantId} tidak ditemukan.`);
        }
    }

    // Pastikan fungsi ini dipanggil hanya jika productVariantId sudah didefinisikan
    if (typeof productVariantId !== 'undefined') {
        updateTotalPricPerProduct(productVariantId);
    }

    // function updateInfo(totalPriceValue, productCardCount) {
    // // Update infototalbayar
    //     // const infoTotalBayar = document.getElementById('infototalbayar');
    //     // if (infoTotalBayar) {
    //     //     infoTotalBayar.innerText = `Total Bayar: Rp. ${totalPriceValue.toLocaleString('id-ID')}`;
    //     // }

    //     // Update infowaktupemesanan
    //     const infoWaktuPemesanan = document.getElementById('infowaktupemesanan');
    //     if (infoWaktuPemesanan) {
    //         const currentDate = new Date();
    //         const options = { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
    //         const formattedDate = currentDate.toLocaleDateString('id-ID', options);
    //         infoWaktuPemesanan.innerText = formattedDate;
    //     }

    //     // Update infocounttotalproduct
    //     const infoCountTotalProduct = document.getElementById('infocounttotalproduct');
    //     if (infoCountTotalProduct) {
    //         infoCountTotalProduct.innerText = productCardCount;
    //     }
    // }

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
        const check = sessionStorage.getItem('product_card_count');
        const check1 = sessionStorage.getItem('district_id');
        // Tampilkan atau sembunyikan div jumlah item
        if (check > 0 && check1 > 0) {
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
    const totalPriceValue = parseFloat(sessionStorage.getItem('total_price_value')) || 0;
    const ongkirValue = parseFloat(sessionStorage.getItem('ongkir_value_attribute')) || 0;
    const totalBayar = ongkirValue + totalPriceValue;

    // Format harga ke dalam format Rupiah
    const formattedPrice = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(totalBayar);

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
    const listOrderContainer = document.querySelector('.list-order-item');

    const initializeProductActions = (productVariantId) => {
        console.log(`Inisialisasi aksi untuk productVariantId: ${productVariantId}`);

        // Fungsi untuk memperbarui harga total perproduct berdasarkan qty dan satuan harga
        const updatePriceDisplay = (productVariantId) => {
            // Ambil elemen input jumlah kuantitas
            const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
            const priceElement = document.getElementById(`sidebar_price_product_${productVariantId}`);
            const priceTextElement = document.getElementById(`sidebar-price-text-${productVariantId}`);

            // Validasi elemen
            if (!qtyInput || !priceElement || !priceTextElement) {
                console.warn(`Elemen untuk productVariantId ${productVariantId} tidak lengkap`);
                return;
            }

            // Ambil nilai kuantitas dan harga satuan
            const quantity = parseInt(qtyInput.value) || 0;
            const unitPrice = parseFloat(priceElement.getAttribute('sidebar_price_satuan')) || 0;

            // Hitung harga total
            const totalPrice = unitPrice * quantity;

            // Perbarui atribut dan tampilan harga total
            priceElement.setAttribute('sidebar_value_price', totalPrice);
            priceTextElement.textContent = `Rp. ${totalPrice.toLocaleString('id-ID')}`;

            // Perbarui nilai di sessionStorage
            // Cari key sessionStorage berdasarkan productVariantId
            for (let i = 0; i < sessionStorage.length; i++) {
                const key = sessionStorage.key(i);
                if (key.startsWith('product_variant_id_')) {
                    const storedProductVariantId = sessionStorage.getItem(key);
                    if (storedProductVariantId === productVariantId) {
                        const index = key.split('_').pop(); // Ambil index dari key

                        // Perbarui product_price_text_ dan product_variant_price_value_
                        sessionStorage.setItem(`product_price_text_${index}`, `Rp. ${totalPrice.toLocaleString('id-ID')}`);
                        sessionStorage.setItem(`product_variant_price_value_${index}`, totalPrice);

                        console.log(`Harga diperbarui untuk productVariantId ${productVariantId}: Rp. ${totalPrice.toLocaleString('id-ID')}`);
                        break;
                    }
                }
            }

            // Perbarui total harga semua produk
            updateTotalPriceAll();
        };

        // Fungsi untuk memperbarui total harga semua produk
        const updateTotalPriceAll = () => {
            const priceElements = document.querySelectorAll('[id^="sidebar_price_product_"]');
            let totalPrice = 0;

            // Iterasi semua elemen harga produk di sidebar
            priceElements.forEach(priceElement => {
                const priceValue = parseFloat(priceElement.getAttribute('sidebar_value_price')) || 0;
                totalPrice += priceValue; // Tambahkan harga ke total
            });

            const totalPriceElement = document.getElementById('totalallprice');
            if (totalPriceElement) {
                // Update nilai pada elemen HTML
                totalPriceElement.textContent = ` ${totalPrice.toLocaleString('id-ID')}`;
                totalPriceElement.setAttribute('value', totalPrice);

                // Perbarui sessionStorage
                sessionStorage.setItem('total_price_value', totalPrice);
            } else {
                console.warn('Elemen totalallprice tidak ditemukan!');
            }
        };

        // Tambahkan event listener untuk tombol decrease
        const decreaseButton = document.getElementById(`sidebar-decrease-${productVariantId}`);
        if (decreaseButton) {
            decreaseButton.addEventListener('click', () => {
                const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
                let qty = parseInt(qtyInput.value) || 1;

                if (qty > 1) {
                    qty -= 1;
                    qtyInput.value = qty;

                    // Update harga total atau lainnya
                    updatePriceDisplay(productVariantId);

                    // Cari kunci product_variant_quantity_ berdasarkan productVariantId
                    let matchedKey = null;

                    // Iterasi semua kunci sessionStorage untuk menemukan yang cocok
                    for (let i = 0; i < sessionStorage.length; i++) {
                        const key = sessionStorage.key(i);
                        if (key.startsWith('product_variant_id_')) {
                            const storedProductVariantId = sessionStorage.getItem(key);
                            if (storedProductVariantId === productVariantId) {
                                // Temukan nomor yang sesuai (contoh: "0" dari "product_variant_id_0")
                                const index = key.split('_').pop();
                                matchedKey = `product_varaint_quantity_${index}`;
                                break;
                            }
                        }
                    }

                    if (matchedKey) {
                        // Perbarui nilai kuantitas di sessionStorage
                        sessionStorage.setItem(matchedKey, qty);
                    }
                } else {
                    console.log(`Kuantitas minimal tercapai untuk ${productVariantId}`);
                }
            });
        }

        // Tambahkan event listener untuk tombol increase
        const increaseButton = document.getElementById(`sidebar-increase-${productVariantId}`);
        if (increaseButton) {
            increaseButton.addEventListener('click', () => {
                const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
                let qty = parseInt(qtyInput.value) || 0;
                qty += 1;
                qtyInput.value = qty;

                // Update harga total atau lainnya
                updatePriceDisplay(productVariantId);

                // Cari kunci product_variant_quantity_ berdasarkan productVariantId
                let matchedKey = null;

                // Iterasi semua kunci sessionStorage untuk menemukan yang cocok
                for (let i = 0; i < sessionStorage.length; i++) {
                    const key = sessionStorage.key(i);
                    if (key.startsWith('product_variant_id_')) {
                        const storedProductVariantId = sessionStorage.getItem(key);
                        if (storedProductVariantId === productVariantId) {
                            // Temukan nomor yang sesuai (contoh: "0" dari "product_variant_id_0")
                            const index = key.split('_').pop();
                            matchedKey = `product_varaint_quantity_${index}`;
                            break;
                        }
                    }
                }

                if (matchedKey) {
                    // Perbarui nilai kuantitas di sessionStorage
                    sessionStorage.setItem(matchedKey, qty);
                    console.log(`Kuantitas increased untuk ${productVariantId}: ${qty}, disimpan ke sessionStorage sebagai ${matchedKey}`);
                }
            });
        }

        // Tambahkan event listener untuk tombol delete
        const deleteButton = document.getElementById(`sidebar-product-deleted-${productVariantId}`);
        if (deleteButton) {
            deleteButton.addEventListener('click', () => {
                const productCard = document.getElementById(`sidebar-product-id-${productVariantId}`)?.closest('.sidebar-product-card');
                if (productCard) {
                    productCard.remove();
                    updateTotalPriceAll();
                }

                // Cari indeks terkait berdasarkan productVariantId
                let index = null;
                for (let i = 0; i < sessionStorage.length; i++) {
                    const key = sessionStorage.key(i);
                    if (key.startsWith('product_variant_id_') && sessionStorage.getItem(key) === productVariantId) {
                        index = key.split('_').pop(); // Ambil indeks dari key (misal "0" dari "product_variant_id_0")
                        break;
                    }
                }

                // Jika indeks ditemukan, hapus semua kunci yang terkait
                if (index !== null) {
                    const keysToRemove = [
                        `product_variant_id_${index}`,
                        `product_varaint_quantity_${index}`,
                        `product_price_text_${index}`,
                        `product_variant_name_${index}`,
                        `productImageSrc-${index}`,
                        `product_variant_price_value_${index}`,
                        `product_variant_price_value_satuan_${index}`,
                        `product_variant_item_count_${index}`
                    ];

                    // Ambil jumlah item berdasarkan product_variant_item_count_
                    const itemCount = parseInt(sessionStorage.getItem(`product_variant_item_count_${index}`)) || 1;

                    // Hapus kunci varian (item_id, item_name, type_id, type_name) berdasarkan jumlah item
                    for (let i = 0; i < itemCount; i++) {
                        keysToRemove.push(
                            `variant_item_id_${index}_${i}`,
                            `variant_item_name_${index}_${i}`,
                            `variant_type_id_${index}_${i}`,
                            `variant_type_name_${index}_${i}`
                        );
                    }

                    // Hapus setiap kunci dari sessionStorage
                    keysToRemove.forEach(key => {
                        if (sessionStorage.getItem(key)) {
                            sessionStorage.removeItem(key);
                            console.log(`Key dihapus: ${key}`);
                        }
                    });

                    location.reload();
                } else {
                    console.warn(`Tidak ditemukan indeks terkait untuk productVariantId ${productVariantId}`);
                }
            });

            // Inisialisasi tampilan harga saat produk pertama kali ditambahkan
            updatePriceDisplay();
        }

    };

    const initializeAllProducts = () => {
        const productElements = document.querySelectorAll('[id^="detail-product-sidebar-"]');
        productElements.forEach(element => {
            const idParts = element.id.split('-');
            const productVariantId = idParts[idParts.length - 1]; // Ambil angka di akhir ID
            initializeProductActions(productVariantId);
        });
    };

    // Awal inisialisasi semua produk yang ada di halaman
    initializeAllProducts();

    // Observer untuk mendeteksi penambahan produk baru
    const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.classList && node.classList.contains('sidebar-product-card')) {
                    const productElement = node.querySelector('[id^="detail-product-sidebar-"]');
                    if (productElement) {
                        const idParts = productElement.id.split('-');
                        const productVariantId = idParts[idParts.length - 1];
                        initializeProductActions(productVariantId);
                    }
                }
            });
        });
    });

    if (listOrderContainer) {
        observer.observe(listOrderContainer, { childList: true });
        // console.log('MutationObserver diaktifkan pada .list-order-item');
    } else {
        console.error('Container .list-order-item tidak ditemukan.');
    }
});

// Simpan nilai ongkir, jarak, durasi, tipe pembelian, alamat, ongkir-value, location-value, dan produk sidebar ke Session Storage
function saveDataToSessionStorage() {
    // Ambil elemen-elemen yang diperlukan

    const ongkirDisplay = sessionStorage.getItem('ongkir_value');
    const ongkir = sessionStorage.getItem('ongkir_value_attribute');
    const ongkirDetail = sessionStorage.getItem('location_value_attribute');
    const jarak = sessionStorage.getItem('jarak_value_attribute');
    const jarakDisplay = sessionStorage.getItem('jarak_value');
    const waktu = sessionStorage.getItem('waktu_value_attribute');
    const waktuDisplay = sessionStorage.getItem('waktu_value');
    const tipePembelian = sessionStorage.getItem('tipe_pembelian');
    const typeClient = sessionStorage.getItem('type_client');
    const tipePengiriman = sessionStorage.getItem('tipe_pengiriman');
    const alamat = sessionStorage.getItem('alamat_value');
    const totalPriceElement = sessionStorage.getItem('total_price_value');

    const listOrderContainer = document.getElementById('list-order-container');
    const listOrderItems = document.querySelectorAll('.list-order-item .sidebar-product-card');

    // Cek dan simpan jika elemen-elemen tersebut ada
    if (ongkir) {
        sessionStorage.setItem('ongkir_value', ongkirDisplay);
        sessionStorage.setItem('ongkir_value_attribute', ongkir);
        sessionStorage.setItem('location_value_attribute', ongkirDetail);
    } else {
        sessionStorage.setItem('ongkir_value', 'Rp. 0');
        sessionStorage.setItem('ongkir_value_attribute', '');
        sessionStorage.setItem('location_value_attribute', '');
    }

    // Simpan data jarak
    if (jarak) {
        sessionStorage.setItem('jarak_value', jarakDisplay );
        sessionStorage.setItem('jarak_value_attribute', jarak );
    }else{
        sessionStorage.setItem('jarak_value', '0 km');
        sessionStorage.setItem('jarak_value_attribute', '');
    }

    // Simpan data durasi
    if (waktu) {
        sessionStorage.setItem('waktu_value', waktuDisplay);
        sessionStorage.setItem('waktu_value_attribute', waktu);
    }else{
        sessionStorage.setItem('waktu_value', '0 mnt');
        sessionStorage.setItem('waktu_value_attribute', '');
    }

    // Simpan data tipe pembelian
    if (tipePembelian) {
        sessionStorage.setItem('tipe_pembelian', tipePembelian );
    }else{
        sessionStorage.setItem('tipe_pembelian', 2);
    }

    // Simpan data type client
    if (typeClient) {
        sessionStorage.setItem('type_client', typeClient);
    }else{
        sessionStorage.setItem('type_client', 1);
    }

    // Simpan data tipe pengiriman
    if (tipePengiriman) {
        sessionStorage.setItem('tipe_pengiriman', tipePengiriman);
    }else{
        sessionStorage.setItem('tipe_pengiriman', 1);
    }

    // Simpan data alamat
    if (alamat) {
        sessionStorage.setItem('alamat_value', alamat);
    }else{
        sessionStorage.setItem('alamat_value', '');
    }

    if (listOrderContainer) {
        sessionStorage.setItem('List_product_sidebar_HTML', listOrderContainer.innerHTML);
    }
    // Cek dan simpan jumlah sidebar-product-card
    const productCardCount = listOrderItems.length;

    sessionStorage.setItem('product_card_count', productCardCount);

    if(totalPriceElement){
        sessionStorage.setItem('total_price_value',totalPriceElement);
    }else{
        sessionStorage.setItem('total_price_value',0);
    }

    // Simpan data dari tiap-tiap sidebar-product-card
    listOrderItems.forEach((productCard, index) => {
        const imgElement = productCard.querySelector('img');
        const productIdElement = productCard.querySelector(`[id^="sidebar-product-id-"]`);
        const priceElement = productCard.querySelector(`[id^="sidebar_price_product_"]`);
        const priceDisplayElement = productCard.querySelector(`[id^="sidebar-price-text-"]`);
        const priceElementSatuan = priceElement.getAttribute('sidebar_price_satuan');
        const quantityElement = productCard.querySelector(`[id^="sidebar-quantity-"]`);

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
            // const variantTypeId = label.getAttribute('sidebar_variant_item_type_id');

            sessionStorage.setItem(`product_variant_item_count_${index}`, variantLabels.length);

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
        } else {
            // Jika tidak ada varian, simpan jumlah sebagai 0
            sessionStorage.setItem(`product_variant_item_count_${index}`, 0);
        }

        // Simpan harga produk dan text-nya
        if (priceElement) {
            const priceValue = priceElement.getAttribute(`sidebar_value_price`);
            sessionStorage.setItem(`product_variant_price_value_${index}`, priceValue);
            sessionStorage.setItem(`product_price_text_${index}`, priceDisplayElement.innerText);
            sessionStorage.setItem(`product_variant_price_value_satuan_${index}`, priceElementSatuan);
        }

        // Simpan kuantitas produk
        if (quantityElement) {
            sessionStorage.setItem(`product_varaint_quantity_${index}`, quantityElement.value);
        }
    });

    // Log hasil penyimpanan
    console.log('Data sessionStorage diperbarui.');
}

function renderProductsFromSessionStorage() {
    // Kosongkan container terlebih dahulu
    console.log("Mulai render produk dari sessionStorage...");

    // Ambil data dari sessionStorage
    const data = {
        ongkirDisplay: sessionStorage.getItem('ongkir_value'), //ongkirValue
        ongkir: sessionStorage.getItem('ongkir_value_attribute'), //ongkirValueAttribute
        ongkirDetail: sessionStorage.getItem('location_value_attribute'), // locationValueAttribute
        jarak: sessionStorage.getItem('jarak_value_attribute'), //jarakValueAttribute
        jarakDisplay: sessionStorage.getItem('jarak_value'), // jarakValue
        waktuDisplay: sessionStorage.getItem('waktu_value'), // wak
        waktu: sessionStorage.getItem('waktu_value_attribute'),
        tipePembelian: sessionStorage.getItem('tipe_pembelian'),
        typeClient: sessionStorage.getItem('type_client'),
        tipePengiriman: sessionStorage.getItem('tipe_pengiriman'),
        alamat: sessionStorage.getItem('alamat_value'),
        totalPriceElement: sessionStorage.getItem('total_price_value'),
        totalItemValue: sessionStorage.getItem('product_card_count'),
    };

    // Fungsi untuk memperbarui elemen berdasarkan ID
    const updateElement = (id, value, attributes = {}) => {
        const element = document.getElementById(id);
        if (element && value) {
            if (element.tagName === 'SELECT') {
                // Untuk elemen select, pilih opsi berdasarkan value
                const options = element.options;
                let optionFound = false;

                for (let i = 0; i < options.length; i++) {
                    if (options[i].value === value) {
                        options[i].selected = true;
                        optionFound = true;
                        break;
                    }
                }

                if (!optionFound) {
                    console.warn(`Option dengan value ${value} tidak ditemukan untuk #${id}`);
                }
            } else {
                // Untuk elemen non-select
                element.innerText = value;
            }
                Object.entries(attributes).forEach(([attr, attrValue]) => {
                if (attrValue) {
                    element.setAttribute(attr, attrValue);
                }
            });
            console.log(`Elemen #${id} diperbarui: ${value}`, attributes);
        }
    };

    // Perbarui elemen Ongkir, Jarak, dan Waktu
    updateElement('ongkir-display', data.ongkirDisplay, {
        'ongkir-value': data.ongkir,
        'location-value': data.ongkirDetail,
    });
    // perbarui elemnt jarak
    updateElement('jarak', data.jarakDisplay, {
        'jarak-value': data.jarak,
    });
    // perbarui element waktu
    updateElement('waktu', data.waktuDisplay, {
        'waktu-value': data.waktu,
    });
    //perbarui element pembelian
    updateElement('tipe-pembelian', data.tipePembelian, {
        'value': data.tipePembelian,
    });
    // perbarui element alamat & form kota
    updateElement('alamat', data.alamat, {
        'value': data.alamat,
    });
    updateElement('kota', data.alamat, {
        'value': data.alamat,
    });
    // Perbarui data total item dan total harga
    updateElement('totalitem', data.totalItemValue, {
        'value': data.totalItemValue,
    });
    updateElement('keranjang', data.totalItemValue);
    const totalAllPriceDisplay = `${parseInt(data.totalPriceElement ?? 0).toLocaleString('id-ID')}`;
    updateElement('totalallprice', totalAllPriceDisplay, {
        'value': data.totalPriceElement,
    });

    const listOrderContainer = document.getElementById('list-order-container');
    if (!listOrderContainer) {
        console.error('Container #list-order-container tidak ditemukan');
        return;
    }
    listOrderContainer.innerHTML = '';

        // mulai render card product
    if (!data.totalItemValue || isNaN(data.totalItemValue)) {
        console.warn('Tidak ada produk yang disimpan di sessionStorage');
        return;
    }
    if (data.totalItemValue) {
        for (let i = 0; i < data.totalItemValue; i++) {
            // Ambil data produk dari sessionStorage
            const productImageSrc = sessionStorage.getItem(`productImageSrc-${i}`);
            const productIdValue = sessionStorage.getItem(`product_variant_id_${i}`);
            const productIdText = sessionStorage.getItem(`product_variant_name_${i}`);
            const productPriceValue = sessionStorage.getItem(`product_variant_price_value_${i}`);
            const productPriceValueSatuan = sessionStorage.getItem(`product_variant_price_value_satuan_${i}`);
            const productPriceText = sessionStorage.getItem(`product_price_text_${i}`);
            const productQuantity = sessionStorage.getItem(`product_varaint_quantity_${i}`);

            console.log(`Rendering produk ke-${i}:`, {
                productImageSrc,
                productIdValue,
                productIdText,
                productPriceValue,
                productPriceValueSatuan,
                productPriceText,
                productQuantity
            });

            // Ambil data varian produk dari sessionStorage
            const variants = [];
            let variantIndex = 0;
            while (sessionStorage.getItem(`variant_type_id_${i}_${variantIndex}`)) {
                const variantTypeName = sessionStorage.getItem(`variant_type_name_${i}_${variantIndex}`);
                const variantTypeId = sessionStorage.getItem(`variant_type_id_${i}_${variantIndex}`);
                const variantItemId = sessionStorage.getItem(`variant_item_id_${i}_${variantIndex}`);
                const variantItemName = sessionStorage.getItem(`variant_item_name_${i}_${variantIndex}`);

                variants.push({
                    label: variantTypeName,  // Anda bisa mengganti label sesuai kebutuhan
                    variantTypeId: variantTypeId,
                    variantItemId: variantItemId,
                    value: variantItemName
                });

                console.log(`Varian produk ke-${i}, varian ke-${variantIndex}:`, {
                    variantTypeName,
                    variantTypeId,
                    variantItemId,
                    variantItemName
                });

                variantIndex++;
            }

            // Panggil fungsi addProductToSidebar untuk menambahkan elemen produk ke container
            addProductToSidebar(
                productIdValue,
                productImageSrc,
                productIdText,
                productPriceText,
                productPriceValue,
                productQuantity,
                variants,
                productPriceValueSatuan
            );
        }

    } else {
        console.warn('Tidak ada produk yang disimpan di sessionStorage');
    }
}

// Tambahkan produk baru ke dalam sidebar dan simpan ke sessionStorage
function addProductToSidebar(productVariantId, productImage, productVariantName, priceDisplay, price, qty, variants, productPriceValueSatuan) {
    const listOrderContainer = document.getElementById('list-order-container');

    const newProductCard = document.createElement('div');
    newProductCard.setAttribute('value', productVariantId); // Menambahkan data attribute
    newProductCard.classList.add('sidebar-product-card', 'flex', 'items-start', 'justify-between', 'p-3', 'h-1/3', 'w-full', 'bg-[#F4F4F4]', 'rounded-md');

    newProductCard.innerHTML = `
        <img src="${productImage}" alt="Produk" class="w-[75px] h-[75px] object-cover rounded-md">
        <div class="ml-3 space-y-1 flex-1">
            <p id="sidebar-product-id-${productVariantId}" value-sidebar-product-id="${productVariantId}" class="text-sm font-semibold truncate border-b-2 border-[#D9D9D9] pb-[1px]">
                ${productVariantName}
            </p>
            <p class="text-[#707070] font-normal text-[12px]">Detail:</p>
            <div id="detail-product-sidebar-${productVariantId}" class="sidebar-list-varaint-label space-y-1">
                ${variants.length > 0 ? variants.map(variant => `
                <p id="sidebar_label_variant_item_type_${productVariantId}_${variant.variantTypeId}" class="text-[12px] font-normal text-[#292929]" sidebar_variant_item_type_id="${variant.variantTypeId}">
                    ${variant.label}:
                    <span id="sidebar_variant_item_${productVariantId}_${variant.variantItemId}" sidebar_variant_item_id="${variant.variantItemId}">
                        ${variant.value}
                    </span>
                </p>
                `).join('') : '<p class="text-[12px] font-normal text-[#707070]">Tidak ada varian</p>'}
            </div>
            <div id="sidebar_price_product_${productVariantId}" sidebar_value_price="${price}" sidebar_price_satuan="${productPriceValueSatuan}" class="bg-white w-5/6 p-1 rounded-md">
                <p class="text-[12px] font-normal">Total Harga:
                    <span id="sidebar-price-text-${productVariantId}" class="text-[12px] font-semibold">${priceDisplay}</span>
                </p>
            </div>
            <div class="flex pr-4 justify-between pt-2 w-full items-center mb-2">
                <div class=" flex items-center border bg-[#E01535] rounded-md py-1">
                    <button id="sidebar-decrease-${productVariantId}" class="p-2 h-full text-gray-700 focus:outline-none">
                        <svg width="13" height="4" viewBox="0 0 13 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="12.3574" y="0.718262" width="2.77002" height="11.8347" transform="rotate(90 12.3574 0.718262)" fill="white"/>
                        </svg>
                    </button>
                    <input id="sidebar-quantity-${productVariantId}" type="text" disabled value="${qty}" class="w-7 bg-[#E01535] text-center font-semibold border-none focus:outline-none text-white" />
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

    listOrderContainer.appendChild(newProductCard);

    console.log('Produk baru ditambahkan ke sidebar');

}

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
        const alamt = sessionStorage.setItem('alamat_value');
        if (!alamt || alamt === "") {
            dataOngkir.classList.add("hidden"); // Tambahkan kelas hidden
            buttonToSlide.classList.remove("hidden"); // Tampilkan tombol
        } else {
            dataOngkir.classList.remove("hidden"); // Hapus kelas hidden
            buttonToSlide.classList.add("hidden"); // Sembunyikan tombol juga
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
      buttonpyment.classList.remove('hidden');
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

// function form data client
document.addEventListener('DOMContentLoaded', () => {
    const inputs = [
        { id: 'nama-user', key: 'client_name' },
        { id: 'alamat-lengkap', key: 'client_alamat' },
        { id: 'kode-pos', key: 'client_codepos' },
        { id: 'nomor-telp', key: 'client_nomor_telp' },
        { id: 'email', key: 'client_email' }
    ];

    inputs.forEach(input => {
        const element = document.getElementById(input.id);

        if (element) {
            // Periksa dan isi nilai dari sessionStorage
            const savedValue = sessionStorage.getItem(input.key);
            if (savedValue) {
                element.value = savedValue;
            }

            // Simpan nilai ke sessionStorage setiap kali input berubah
            element.addEventListener('keyup', () => {
                const value = element.value.trim();
                sessionStorage.setItem(input.key, value);
            });
        } else {
            console.warn(`Element with ID ${input.id} not found.`);
        }
    });
});


// Simpan data sebelum halaman ditutup atau direfresh
window.onbeforeunload = function () {
    try {
        saveDataToSessionStorage();
        console.log('Data telah disimpan ke sessionStorage sebelum halaman ditutup.');
    } catch (error) {
        console.error('Gagal menyimpan data sebelum halaman ditutup:', error);
    }
};

const updatePaymentButtonState = () => {
    const buttonpayment = document.getElementById('payment');
    const buttonpilihalamat = document.getElementById('pilihAlamatok');
    const productCardCount = parseInt(sessionStorage.getItem('product_card_count')) || 0;
    const districtId = parseInt(sessionStorage.getItem('district_id')) || 0;
    const bingkaibuttonalamt = document.getElementById('bottonpilihAlamat');
    const bingkaibuttonpayment = document.getElementById('bingkaibuttonpyment');
    const checkclientemail = sessionStorage.getItem('client_email');
    // Dapatkan URL halaman saat ini
    const currentUrl = window.location.href;

    // Periksa kondisi utama (productCardCount dan districtId)
    if (productCardCount === 0) {
        // Sembunyikan tombol alamat jika productCardCount = 0
        bingkaibuttonalamt.classList.add('hidden');
        bingkaibuttonpayment.classList.add('hidden');
    } else if (productCardCount > 0 && districtId > 0 && checkclientemail) {
        // Aktifkan tombol payment jika kedua kondisi terpenuhi
        buttonpayment.removeAttribute('disabled');
        buttonpayment.classList.add('bg-[#E01535]', 'text-white');
        buttonpayment.classList.remove('bg-[#F4F4F4]', 'text-[#ADADAD]', 'hidden');

        // Sembunyikan tombol alamat
        bingkaibuttonalamt.classList.add('hidden');

        // Tampilkan tombol Payment
        bingkaibuttonpayment.classList.remove('hidden');
    } else {
        // Sembunyikan semua tombol jika kondisi tidak terpenuhi
        bingkaibuttonalamt.classList.add('hidden');
        bingkaibuttonpayment.classList.add('hidden');
    }

    // Periksa posisi route halaman
    if (currentUrl === "http://127.0.0.1:8001/") {
        // Sembunyikan bingkaibuttonpayment
        bingkaibuttonalamt.classList.remove('hidden');
        bingkaibuttonpayment.classList.add('hidden');
    } else if (currentUrl.startsWith("http://127.0.0.1:8001/view-maps?client_type_id=1")) {
        // Sembunyikan bingkaibuttonalamt
        bingkaibuttonalamt.classList.add('hidden');
    }
};

setInterval(() => {
    updatePaymentButtonState();
}, 1000);

const updateTotalPriceAllAfterRender = () => {
    const productCardCount = parseInt(sessionStorage.getItem('product_card_count')) || 0;
    let totalPrice = 0;

    // Iterasi semua produk berdasarkan product_card_count
    for (let i = 0; i < productCardCount; i++) {
        const priceKey = `product_variant_price_value_${i}`;
        const priceValue = parseFloat(sessionStorage.getItem(priceKey)) || 0;
        totalPrice += priceValue; // Tambahkan harga ke total
    }

    const totalPriceElement = document.getElementById('totalallprice');
    if (totalPriceElement) {
        // Update nilai pada elemen HTML
        totalPriceElement.textContent = ` ${totalPrice.toLocaleString('id-ID')}`;
        totalPriceElement.setAttribute('value', totalPrice);

        // Perbarui sessionStorage
        sessionStorage.setItem('total_price_value', totalPrice);
    } else {
        console.warn('Elemen totalallprice tidak ditemukan!');
    }
};

function removeDuplicateProductVariantIds() {
    const productVariantIds = {}; // Object untuk melacak product_variant_id_ yang sudah ditemukan

    // Iterasi melalui semua kunci di sessionStorage
    for (let i = 0; i < sessionStorage.length; i++) {
        const key = sessionStorage.key(i);

        // Hapus kunci jika nilainya kosong atau null
        const value = sessionStorage.getItem(key);
        if (value === null || value.trim() === "") {
            sessionStorage.removeItem(key);
            console.log(`Key kosong dihapus: ${key}`);
            continue; // Lanjutkan ke iterasi berikutnya
        }

        // Periksa apakah kunci diawali dengan "product_variant_id_"
        if (key.startsWith('product_variant_id_')) {
            const index = key.split('_').pop(); // Ambil indeks dari kunci
            const productVariantId = value;

            if (productVariantIds[productVariantId]) {
                // Jika productVariantId sudah ditemukan sebelumnya, hapus data dengan indeks tertinggi
                const previousIndex = productVariantIds[productVariantId];
                const maxIndex = Math.max(previousIndex, index);

                // Hapus kunci yang terkait dengan indeks tertinggi
                const keysToRemove = [
                    `product_variant_id_${maxIndex}`,
                    `product_varaint_quantity_${maxIndex}`,
                    `product_price_text_${maxIndex}`,
                    `product_variant_name_${maxIndex}`,
                    `productImageSrc-${maxIndex}`,
                    `product_variant_price_value_${maxIndex}`,
                    `product_variant_price_value_satuan_${maxIndex}`,
                    `product_variant_item_count_${maxIndex}`
                ];

                // Ambil jumlah item berdasarkan product_variant_item_count_
                const itemCount = parseInt(sessionStorage.getItem(`product_variant_item_count_${maxIndex}`)) || 1;

                for (let j = 0; j < itemCount; j++) {
                    keysToRemove.push(
                        `variant_item_id_${maxIndex}_${j}`,
                        `variant_item_name_${maxIndex}_${j}`,
                        `variant_type_id_${maxIndex}_${j}`,
                        `variant_type_name_${maxIndex}_${j}`
                    );
                }

                // Hapus semua kunci terkait
                keysToRemove.forEach(key => {
                    if (sessionStorage.getItem(key)) {
                        sessionStorage.removeItem(key);
                        console.log(`Key dihapus: ${key}`);
                    }
                });

                console.log(`Duplikasi dihapus untuk productVariantId: ${productVariantId}, indeks: ${maxIndex}`);
            } else {
                // Simpan indeks productVariantId pertama kali ditemukan
                productVariantIds[productVariantId] = index;
            }
        }
    }
}

// Panggil fungsi setelah halaman dimuat ulang
document.addEventListener('DOMContentLoaded', () => {
    removeDuplicateProductVariantIds();
    updateTotalPriceAllAfterRender();
    updatePaymentButtonState();
});


function updateInfoFromSessionStorage() {
    // Ambil total_price_value dari sessionStorage
    const totalPriceValue = parseFloat(sessionStorage.getItem('total_price_value')) || 0;
    const ongkirValue = parseFloat(sessionStorage.getItem('ongkir_value_attribute')) || 0;
    const totalBayar = ongkirValue + totalPriceValue;

    // Ambil product_card_count dari sessionStorage
    const productCardCount = parseInt(sessionStorage.getItem('product_card_count'), 10) || 0;

    // Update infototalbayar
    const infoTotalBayar = document.getElementById('infototalbayar');
    if (infoTotalBayar) {
        infoTotalBayar.innerText = `Total Bayar: Rp. ${totalBayar.toLocaleString('id-ID')}`;
    }

    // Update infowaktupemesanan
    const infoWaktuPemesanan = document.getElementById('infowaktupemesanan');
    if (infoWaktuPemesanan) {
        const currentDate = new Date();
        const options = { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
        const formattedDate = currentDate.toLocaleDateString('id-ID', options);
        infoWaktuPemesanan.innerText = formattedDate;
    }

    // Update infocounttotalproduct
    const infoCountTotalProduct = document.getElementById('infocounttotalproduct');
    if (infoCountTotalProduct) {
        infoCountTotalProduct.innerText = `${productCardCount}`;
    }

    // Update rekap informasi penerima
    const clientName = sessionStorage.getItem('client_name') || '';
    const clientAlamat = sessionStorage.getItem('client_alamat') || '';
    const cityValue = sessionStorage.getItem('city_value') || '';
    const clientCodePos = sessionStorage.getItem('client_codepos') || '';
    const clientNomorTelp = sessionStorage.getItem('client_nomor_telp') || '';
    const clientEmail = sessionStorage.getItem('client_email') || '';

    document.getElementById('rekapnamaclient').innerText = ` ${clientName}`;
    document.getElementById('rekapalamatlengkapclient').innerText = ` ${clientAlamat}`;
    document.getElementById('rekapkoltaclient').innerText = ` ${cityValue}`;
    document.getElementById('rekapkodeposclient').innerText = ` ${clientCodePos}`;
    document.getElementById('rekapnomortelpclient').innerText = ` ${clientNomorTelp}`;
    document.getElementById('rekapemailclient').innerText = ` ${clientEmail}`;

    // Update rekap produk
    const rekapProdukContainer = document.getElementById('rekapproductpemesanan');
    const listProductSidebarHTML = sessionStorage.getItem('List_product_sidebar_HTML') || '';

    if (rekapProdukContainer) {
        rekapProdukContainer.innerHTML = listProductSidebarHTML;
    }
}





// Jalankan fungsi untuk memperbarui informasi





