import { fetchListProduct } from './api/fetchListProduct';

// Fungsi untuk memasukkan teks ke input ketika varian diklik
const addClickEventToVariants = () => {
    const variantLinks = document.querySelectorAll('.variantM');
    const searchInput = document.getElementById('search-input');

    variantLinks.forEach((variant) => {
        variant.addEventListener('click', (event) => {
            event.preventDefault();
            const variantText = variant.textContent;
            if (searchInput) {
                searchInput.value = variantText;  // Masukkan teks varian ke input
            }
        });
    });
};

// Fungsi untuk render ulang dropdown berdasarkan semua data produk
const renderAllProducts = (productTypes) => {
    const dropdownContent = document.querySelector('.listdropdown');
    dropdownContent.innerHTML = ''; // Kosongkan konten dropdown sebelum render ulang

    // Loop untuk setiap productType
    productTypes.forEach((type) => {
        const productType = type.product_type;

        // Loop untuk setiap produk dalam productType
        productType.products.forEach((product) => {
            const column = document.createElement('div');

            // Set label untuk setiap produk
            const label = document.createElement('label');
            label.classList.add('productM', 'text-[16px]', 'font-semibold', 'text-[#292929]', 'mb-2');
            label.textContent = product.title;
            column.appendChild(label);

            const ul = document.createElement('ul');
            ul.classList.add('space-y-1');

            // Tambahkan varian produk ke dalam ul
            product.variants.forEach((variant) => {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '#';
                a.classList.add('variantM', 'text-[#6B6B6B]', 'text-[12px]', 'hover:text-gray-900');
                a.setAttribute('value', variant.id);
                a.textContent = variant.name;
                li.appendChild(a);
                ul.appendChild(li);
            });

            column.appendChild(ul);
            dropdownContent.appendChild(column);
        });
    });

    // Tambahkan event listener pada semua varian setelah mereka dirender
    addClickEventToVariants();
};

// Fungsi untuk render ulang dropdown berdasarkan data dari satu productType
const renderDropdownContent = (productType) => {
    const dropdownContent = document.querySelector('.listdropdown');
    dropdownContent.innerHTML = ''; // Kosongkan konten dropdown sebelum render ulang

    // Loop untuk setiap produk dalam productType yang baru
    productType.products.forEach((product) => {
        const column = document.createElement('div');

        // Set label untuk setiap produk
        const label = document.createElement('label');
        label.classList.add('productM', 'text-[16px]', 'font-semibold', 'text-[#292929]', 'mb-2');
        label.textContent = product.title;
        column.appendChild(label);

        const ul = document.createElement('ul');
        ul.classList.add('space-y-1');

        // Tambahkan varian produk ke dalam ul
        product.variants.forEach((variant) => {
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = '#';
            a.classList.add('variantM', 'text-[#6B6B6B]', 'text-[12px]', 'hover:text-gray-900');
            a.setAttribute('value', variant.id);
            a.textContent = variant.name;
            li.appendChild(a);
            ul.appendChild(li);
        });

        column.appendChild(ul);
        dropdownContent.appendChild(column);
    });

    // Tambahkan event listener pada semua varian setelah mereka dirender
    addClickEventToVariants();
};

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const productTypes = await fetchListProduct();
        const productTypeElements = document.querySelectorAll('.productType');

        // Render semua produk saat dropdown pertama kali dibuka
        const categoryButton = document.getElementById('category');
        if (categoryButton) {
            categoryButton.addEventListener('click', function () {
                renderAllProducts(productTypes); // Render semua produk saat dropdown dibuka
            });
        }

        // Event Listener untuk setiap elemen productType
        productTypeElements.forEach((element) => {
            element.addEventListener('click', async (event) => {
                event.preventDefault();
                const value = element.getAttribute('value');  // Ambil value dari productType

                if (!value) {
                    console.error('No value attribute found on productType element.');
                    return;
                }

                // Mengirim request ke API dengan value dari productType
                try {
                    const response = await fetch(`/api/list-dropdown?id=${value}`);
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    const result = await response.json();

                    // Render ulang dropdown berdasarkan data yang diterima
                    const selectedProductType = result.data.original.find(type => type.product_type.id == value);
                    if (selectedProductType) {
                        renderDropdownContent(selectedProductType.product_type);
                    }
                } catch (error) {
                    console.error('Error fetching product by ID:', error);
                }
            });
        });
    } catch (error) {
        console.error('Error rendering dropdown:', error);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const categoryButton = document.getElementById('category');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownOverlay = document.getElementById('dropdownOverlay');

    if (categoryButton && dropdownMenu && dropdownOverlay) {
        // Toggle dropdown dan overlay
        categoryButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
            dropdownOverlay.classList.toggle('hidden');
        });

        // Tutup dropdown ketika klik di luar (overlay)
        dropdownOverlay.addEventListener('click', function () {
            dropdownMenu.classList.add('hidden');
            dropdownOverlay.classList.add('hidden');
        });
    } else {
        console.error('Required elements (category button, dropdown menu, or overlay) not found');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Ambil nilai dari sessionStorage
    let productCount = sessionStorage.getItem('productCardCount');

    // Jika nilai null, atur menjadi 0
    if (productCount === null) {
        productCount = 0;
    }

    // Perbarui nilai elemen dengan id="keranjang"
    document.getElementById('keranjang').textContent = productCount;
});
