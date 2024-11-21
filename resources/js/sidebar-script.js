
document.addEventListener('DOMContentLoaded', function() {

    // script button to alamat ubah tampilan pengiriman
    function updateButtonText() {
        const locationValue = sessionStorage.getItem('city_value');
        const pilihAlamatButton = document.getElementById('pilihAlamatok');

        if (locationValue) {
            try {
                const locationValue = sessionStorage.getItem('city_value');
                    pilihAlamatButton.innerHTML = `<svg width="15" height="20" viewBox="0 0 15 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.33133 0.664062C3.43041 0.664062 0.256836 3.8381 0.256836 7.73912C0.256836 11.4942 6.67565 20.2674 6.94896 20.6389L7.20403 20.986C7.23386 21.0268 7.28136 21.0507 7.33133 21.0507C7.38208 21.0507 7.42927 21.0268 7.45941 20.986L7.71432 20.6389C7.98779 20.2674 14.4064 11.4942 14.4064 7.73912C14.4064 3.8381 11.2324 0.664062 7.33133 0.664062ZM7.33133 5.20485C8.72904 5.20485 9.86561 6.34146 9.86561 7.73912C9.86561 9.13606 8.72899 10.2734 7.33133 10.2734C5.93444 10.2734 4.79706 9.13606 4.79706 7.73912C4.79706 6.34146 5.93439 5.20485 7.33133 5.20485Z" fill="white"/>
                    </svg>&nbsp; Dikirim ke ${locationValue}`;
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
            updateTotalPricPerProduct(productVariantId); // Memanggil fungsi untuk mengupdate total harga
        });

        // Tambahkan event listener untuk tombol increase
        increaseButton.addEventListener('click', () => {
            let currentQty = parseInt(qtyInput.value);
            qtyInput.value = currentQty + 1;
            updateTotalPricPerProduct(productVariantId); // Memanggil fungsi untuk mengupdate total harga
        });

        // Tambahkan event listener untuk perubahan langsung di input field
        qtyInput.addEventListener('input', () => {
            let currentQty = parseInt(qtyInput.value);
            if (isNaN(currentQty) || currentQty < 1) {
                qtyInput.value = 1; // Set minimal 1 jika input tidak valid
            }
            updateTotalPricPerProduct(productVariantId); // Memanggil fungsi untuk mengupdate total harga
        });
    }

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
    const listOrderContainer = document.querySelector('.list-order-item');

    const initializeProductActions = (productVariantId) => {
        console.log(`Inisialisasi aksi untuk productVariantId: ${productVariantId}`);

        // Fungsi untuk memperbarui harga total berdasarkan qty dan satuan harga
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

            // Perbarui total harga semua produk
            updateTotalPriceAll();
        };

        // Fungsi untuk memperbarui total harga semua produk
        const updateTotalPriceAll = () => {
            const priceElements = document.querySelectorAll('[id^="sidebar_price_product_"]');
            let totalPrice = 0;

            priceElements.forEach(priceElement => {
                const priceValue = parseFloat(priceElement.getAttribute('sidebar_value_price')) || 0;
                totalPrice += priceValue;
            });

            const totalPriceElement = document.getElementById('totalprice');
            if (totalPriceElement) {
                totalPriceElement.textContent = `${totalPrice.toLocaleString('id-ID')}`;
                totalPriceElement.value = totalPrice;
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
                    updatePriceDisplay(productVariantId);
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
                updatePriceDisplay(productVariantId);
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
            });
            const sessionKey = `productImageSrc-${productVariantId}`;
            sessionStorage.removeItem(sessionKey);
        }
        // Inisialisasi tampilan harga saat produk pertama kali ditambahkan
        updatePriceDisplay();
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
        console.log('MutationObserver diaktifkan pada .list-order-item');
    } else {
        console.error('Container .list-order-item tidak ditemukan.');
    }
});



// Simpan nilai ongkir, jarak, durasi, tipe pembelian, alamat, ongkir-value, location-value, dan produk sidebar ke Session Storage

function saveDataToSessionStorage() {
    // Ambil elemen-elemen yang diperlukan

    const ongkirDisplay = document.getElementById('ongkir-display');
    const jarak = document.getElementById('jarak');
    const waktu = document.getElementById('waktu');
    const tipePembelian = document.getElementById('tipe-pembelian');
    const typeClient = document.getElementById('type-client');
    const tipePengiriman = document.getElementById('pengiriman');
    const alamat = document.getElementById('alamat');
    const listOrderContainer = document.getElementById('list-order-container');
    const listOrderItems = document.querySelectorAll('.list-order-item .sidebar-product-card');
    const totalPriceElement = document.getElementById('totalprice');

    // Cek dan simpan jika elemen-elemen tersebut ada
    if (ongkirDisplay) {
        const ongkirValue = ongkirDisplay.innerText;
        const ongkirValueAttribute = ongkirDisplay.getAttribute('ongkir-value');
        const locationValueAttribute = ongkirDisplay.getAttribute('location-value');

        sessionStorage.setItem('ongkir_value', ongkirValue);
        sessionStorage.setItem('ongkir_value_attribute', ongkirValueAttribute || '');
        sessionStorage.setItem('location_value_attribute', locationValueAttribute || '');
        console.log(`Ongkos kirim disimpan: ${ongkirValue}, ${ongkirValueAttribute}, ${locationValueAttribute}`);
    } else {
        console.warn('Elemen ongkir-display tidak ditemukan.');
    }
    // Simpan data jarak
    if (jarak) {
        const jarakValue = jarak.innerText.trim();
        const jarakValueAttribute = jarak.getAttribute('jarak-value');
        sessionStorage.setItem('jarak_value', jarakValue || '0 km');
        sessionStorage.setItem('jarak_value_attribute', jarakValueAttribute || '');
        console.log(`Jarak disimpan: ${jarakValue}, ${jarakValueAttribute}`);
    }
    // Simpan data durasi
    if (waktu) {
        const waktuValue = waktu.innerText.trim();
        const waktuValueAttribute = waktu.getAttribute('waktu-value');
        sessionStorage.setItem('waktu_value', waktuValue || '0 mnt');
        sessionStorage.setItem('waktu_value_attribute', waktuValueAttribute || '');
        console.log(`Durasi disimpan: ${waktuValue}, ${waktuValueAttribute}`);
    }
     // Simpan data tipe pembelian
     if (tipePembelian) {
        sessionStorage.setItem('tipe_pembelian', tipePembelian.value || '1');
        console.log(`Tipe pembelian disimpan: ${tipePembelian.value}`);
    }
    // Simpan data type client
    if (typeClient) {
        sessionStorage.setItem('type_client', typeClient.value || '');
        console.log(`Type client disimpan: ${typeClient.value}`);
    }
    // Simpan data tipe pengiriman
    if (tipePengiriman) {
        sessionStorage.setItem('tipe_pengiriman', tipePengiriman.value || '');
        console.log(`Tipe pengiriman disimpan: ${tipePengiriman.value}`);
    }
    // Simpan data alamat
    if (alamat) {
        sessionStorage.setItem('alamat_value', alamat.value || '');
        console.log(`Alamat disimpan: ${alamat.value}`);
    }
    if (listOrderContainer) {
        sessionStorage.setItem('List_product_sidebar_HTML', listOrderContainer.innerHTML);
    }
    // Cek dan simpan jumlah sidebar-product-card
    const productCardCount = listOrderItems.length;

    sessionStorage.setItem('product_card_count', productCardCount);

    if(totalPriceElement){
        sessionStorage.setItem('total_price_value',totalPriceElement.value);
    }


    // Simpan data dari tiap-tiap sidebar-product-card
    listOrderItems.forEach((productCard, index) => {
        const imgElement = productCard.querySelector('img');
        const productIdElement = productCard.querySelector(`[id^="sidebar-product-id-"]`);
        const priceElement = productCard.querySelector(`[id^="sidebar_price_product_"]`);
        const priceDisplayElement = productCard.querySelector(`[id^="sidebar-price-text-"]`);
        const priceElementSatuan = priceElement.getAttribute('sidebar_price_satuan');
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

// Muat data dari Session Storage
function loadDataFromSessionStorage() {

    console.log(`tes`);

}

function renderProductsFromSessionStorage() {
    // Kosongkan container terlebih dahulu
    console.log("Mulai render produk dari sessionStorage...");

    // Ambil data dari sessionStorage
    const data = {
        ongkirValue: sessionStorage.getItem('ongkir_value'),
        ongkirValueAttribute: sessionStorage.getItem('ongkir_value_attribute'),
        locationValueAttribute: sessionStorage.getItem('location_value_attribute'),
        jarakValue: sessionStorage.getItem('jarak_value'),
        jarakValueAttribute: sessionStorage.getItem('jarak_value_attribute'),
        waktuValue: sessionStorage.getItem('waktu_value'),
        waktuValueAttribute: sessionStorage.getItem('waktu_value_attribute'),
        tipePembelian: sessionStorage.getItem('tipe_pembelian'),
        alamatValue: sessionStorage.getItem('alamat_value'),
        totalItemValue: sessionStorage.getItem('product_card_count'),
        totalPriceValue: sessionStorage.getItem('total_price_value'),
    };

    // Fungsi untuk memperbarui elemen berdasarkan ID
    const updateElement = (id, value, attributes = {}) => {
        const element = document.getElementById(id);
        if (element && value) {
            element.innerText = value;
            Object.entries(attributes).forEach(([attr, attrValue]) => {
                if (attrValue) {
                    element.setAttribute(attr, attrValue);
                }
            });
            console.log(`Elemen #${id} diperbarui: ${value}`, attributes);
        }
    };

    // Perbarui elemen Ongkir, Jarak, dan Waktu
    updateElement('ongkir-display', data.ongkirValue, {
        'ongkir-value': data.ongkirValueAttribute,
        'location-value': data.locationValueAttribute,
    });

    updateElement('jarak', data.jarakValue, {
        'jarak-value': data.jarakValueAttribute,
    });

    updateElement('waktu', data.waktuValue, {
        'waktu-value': data.waktuValueAttribute,
    });

    // Perbarui select tipe pembelian
    const tipePembelianElement = document.getElementById('tipe-pembelian');
    if (tipePembelianElement && data.tipePembelian) {
        tipePembelianElement.value = data.tipePembelian;
        console.log('Tipe pembelian dimuat:', data.tipePembelian);
    }

    // Perbarui input alamat
    const alamatElement = document.getElementById('alamat');
    const kotaElement = document.getElementById('kota');
    if (alamatElement && data.alamatValue) {
        alamatElement.value = data.alamatValue;
        kotaElement.value = data.alamatValue;
        console.log('Alamat dimuat:', data.alamatValue);
    }

    // Perbarui data total item dan harga
    if (data.totalItemValue) {
        const totalItemElement = document.getElementById('totalitem');
        const totalPriceElement = document.getElementById('totalprice');
        const jumlahItemElement = document.getElementById('jumlahitem');

        if (totalItemElement) {
            totalItemElement.innerText = data.totalItemValue;
            totalPriceElement.innerText = `Rp. ${parseInt(data.totalPriceValue).toLocaleString('id-ID')}`;
            jumlahItemElement.classList.remove('hidden');
            console.log(`Total item dimuat: ${data.totalItemValue}, Total harga dimuat: Rp. ${data.totalPriceValue}`);
        }
    }

    const listOrderContainer = document.getElementById('list-order-container');
    if (!listOrderContainer) {
        console.error('Container #list-order-container tidak ditemukan');
        return;
    }
    listOrderContainer.innerHTML = '';

    // Ambil jumlah produk yang disimpan di sessionStorage
    const productCardCount = sessionStorage.getItem('product_card_count');
    console.log(`Jumlah produk yang ditemukan: ${productCardCount}`);

    if (!productCardCount || isNaN(productCardCount)) {
        console.warn('Tidak ada produk yang disimpan di sessionStorage');
        return;
    }
    if (productCardCount) {
        for (let i = 0; i < productCardCount; i++) {
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
            <p id="sidebar-product-id-${productVariantId}" value-sidebar-product-id-${productVariantId}="" class="text-sm font-semibold truncate border-b-2 border-[#D9D9D9] pb-[1px]">
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

    listOrderContainer.appendChild(newProductCard);

    saveDataToSessionStorage();

    // updateTotalItemAndPrice();

    console.log('Produk baru ditambahkan ke sidebar');

    // Fungsi untuk menghitung total harga dan jumlah item di sidebar
    function updateTotalItemAndPrice() {
        // Ambil semua key dari SessionStorage
        const keys = Object.keys(sessionStorage);
        let totalPrice = 0;
        let totalItems = 0;

        // Iterasi semua key di SessionStorage
        keys.forEach(key => {
            // Cek apakah key sesuai pola harga produk
            if (key.startsWith("product_variant_price_value_")) {
                const priceValue = parseFloat(sessionStorage.getItem(key)) || 0; // Ambil nilai harga
                if (priceValue > 0) {
                    totalPrice += priceValue; // Tambahkan ke total harga
                    totalItems += 1; // Tambahkan ke jumlah item
                }
            }
        });

        // Seleksi elemen tampilan total
        const totalItemElement = document.getElementById('totalitem');
        const totalPriceElement = document.getElementById('totalprice');
        const jumlahItemElement = document.getElementById('jumlahitem');

        // Validasi keberadaan elemen total
        if (totalItemElement && totalPriceElement && jumlahItemElement) {
            // Perbarui jumlah item dan total harga di UI
            totalItemElement.innerText = totalItems;
            totalPriceElement.innerText = `Rp. ${totalPrice.toLocaleString('id-ID')}`; // Format angka Rupiah

            // Tampilkan jumlah item jika ada produk
            if (totalItems > 0) {
                jumlahItemElement.classList.remove('hidden');
            } else {
                jumlahItemElement.classList.add('hidden');
            }
        } else {
            console.error('Elemen totalitem, totalprice, atau jumlahitem tidak ditemukan.');
        }
    }

    // Panggil fungsi untuk memperbarui total
    updateTotalItemAndPrice();

}



// Event listener untuk menyimpan nilai select "Tipe Pembelian" dan "Alamat" setiap kali berubah
// document.getElementById('tipe-pembelian').addEventListener('change', saveDataToSessionStorage);
// document.getElementById('alamat').addEventListener('change', saveDataToSessionStorage);


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


//   document.addEventListener("DOMContentLoaded", function() {
//     const selectAlamat = document.getElementById("alamat");

//     // Periksa apakah sessionStorage memiliki key 'locationValueAttribute'
//     // const storedLocation = sessionStorage.getItem('locationValueAttribute');

//     if (storedLocation) {
//       // Parse nilai yang disimpan dalam sessionStorage
//       const locationData = JSON.parse(storedLocation);

//       // Loop melalui semua option di select element
//       for (let i = 0; i < selectAlamat.options.length; i++) {
//         const option = selectAlamat.options[i];

//         // Cocokkan option berdasarkan data-city, data-price, dan data-district_id
//         if (
//           option.getAttribute('data-city') === locationData.city &&
//           option.getAttribute('data-price') === locationData.price &&
//           option.getAttribute('data-district_id') === locationData.district_id
//         ) {
//           option.selected = true;
//           break;
//         }
//       }
//     }
//   });


// Simpan data sebelum halaman ditutup atau direfresh
window.onbeforeunload = function () {
    try {
        saveDataToSessionStorage();
        console.log('Data telah disimpan ke sessionStorage sebelum halaman ditutup.');
    } catch (error) {
        console.error('Gagal menyimpan data sebelum halaman ditutup:', error);
    }
};

document.addEventListener('DOMContentLoaded', function () {
    try {
        loadDataFromSessionStorage();
        console.log('Data telah dimuat dari sessionStorage setelah halaman dimuat.');
    } catch (error) {
        console.error('Gagal memuat data dari sessionStorage:', error);
    }
});

