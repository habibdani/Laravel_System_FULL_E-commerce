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

import { fetchPencarianProduct } from './api/fetchPencarainProduct';

const debounce = (func, delay) => {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), delay);
    };
};

async function renderfilterProducts(searchQuery) {
    try {
        const products = await fetchPencarianProduct(searchQuery);
        const productList = document.getElementById('filter-product-list');

        // Clear existing products
        productList.innerHTML = '';

        // Create and append new product cards
        products.forEach((product) => {
            const productCard = createProductCard(product);
            productList.appendChild(productCard);
        });

        // Update "View All" link
        updateViewAllLink(
            products.length,
            productList.clientWidth,
            document.getElementById('filter-view-all-link')
        );
    } catch (error) {
        console.error('Error rendering products:', error);
    }
}

function createProductCard(product) {
    const productCard = document.createElement('div');
    productCard.setAttribute('data-product-id', product.product_id);
    productCard.setAttribute('product-type-id', product.product_type_id);
    productCard.setAttribute('product-variant-id', product.product_variant_id);
    
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = `/view-product`;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;

    const productVariantInput = document.createElement('input');
    productVariantInput.type = 'hidden';
    productVariantInput.name = 'product_variant_id';
    productVariantInput.value = product.product_variant_id;

    const productTypeInput = document.createElement('input');
    productTypeInput.type = 'hidden';
    productTypeInput.name = 'product_type_id';
    productTypeInput.value = product.product_type_id;

    form.appendChild(csrfInput);
    form.appendChild(productVariantInput);
    form.appendChild(productTypeInput);

    productCard.classList.add(
        'product-card',
        'shadow-custom',
        'h-[186.83px]',
        'bg-white',
        'rounded-md',
        'flex',
        'flex-col',
        'justify-between',
        'overflow-hidden'
    );
    productCard.style.width = '149.74px';
    productCard.style.flexShrink = '0';
    productCard.style.position = 'relative';

    // Product Image
    const productImageContainer = document.createElement('div');
    productImageContainer.classList.add(
        'relative',
        'w-full',
        'h-[100px]',
        'mb-2',
        'rounded-t-md',
        'overflow-hidden'
    );

    const productImage = document.createElement('img');
    productImage.src = `${window.location.origin}/storage/${product.variant_image}`;
    productImage.alt = product.variant_name;
    productImage.classList.add('object-cover', 'w-full', 'h-full');
    productImageContainer.appendChild(productImage);

    // Preorder Label
    if (product.preorder) {
        const preorderLabel = document.createElement('span');
        preorderLabel.textContent = 'Preorder';
        preorderLabel.classList.add(
            'bg-black',
            'text-white',
            'font-poppins',
            'text-[10px]',
            'font-normal',
            'px-2',
            'py-1',
            'rounded',
            'absolute',
            'bottom-2',
            'left-2'
        );
        preorderLabel.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
        productImageContainer.appendChild(preorderLabel);
    }

    // Product Name
    const productName = document.createElement('p');
    productName.textContent = product.variant_name;
    productName.classList.add('font-normal', 'text-[#747474]', 'text-left', 'truncate', 'text-[10px]', 'mx-2');
    productName.style.width = '100%';
    productName.style.whiteSpace = 'nowrap';
    productName.style.overflow = 'hidden';
    productName.style.textOverflow = 'ellipsis';

    // Product Price
    const productPrice = document.createElement('p');
    productPrice.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(product.variant_price)}`;
    productPrice.classList.add('text-[14px]', 'text-left', 'font-semibold', 'text-[#292929]', 'm-2');
    productPrice.style.width = '100%';
    productPrice.style.whiteSpace = 'nowrap';
    productPrice.style.overflow = 'hidden';
    productPrice.style.textOverflow = 'ellipsis';

    // Assemble Card
    productCard.appendChild(productImageContainer);
    productCard.appendChild(productName);
    productCard.appendChild(productPrice);

    form.appendChild(productCard);

    document.body.appendChild(form);

    // Event listener for product card click
    productCard.addEventListener('click', async () => {
        try {
            form.submit();

        } catch (error) {
            console.error('Error fetching product details:', error);
        }
    });

    return form;
    // Tambahkan delay animasi untuk setiap produk
}

function updateViewAllLink(totalProducts, listWidth, viewAllLink) {
    const productCardWidth = 149.74;
    const visibleProductCount = Math.floor(listWidth / productCardWidth);
    const hiddenProductCount = totalProducts - visibleProductCount;

    if (hiddenProductCount > 0) {
        viewAllLink.innerHTML = `View all (${hiddenProductCount}+) <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
    } else {
        viewAllLink.textContent = 'View all';
    }
}

// Attach event listener to the search input field with debounce
const searchInput = document.getElementById('searchproduct');
searchInput.addEventListener(
    'input',
    debounce((event) => {
        const searchQuery = event.target.value.trim();
        renderfilterProducts(searchQuery);
    }, 300) // Debounce delay in milliseconds
);
