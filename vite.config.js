import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/header-script.js',
                'resources/js/sidebar-script.js',
                'resources/js/bootstrap.js',
                'resources/js/editProduct-script.js',
                'resources/js/login-script.js',
                'resources/js/maps-script.js',
                'resources/js/orderDashboard-script.js',
                'resources/js/orderDetail-script.js',
                'resources/js/productDashboard-script.js',
                'resources/js/productDetails-script.js',
                'resources/js/shop-script.js',
                'resources/js/api/fetchDetailProduct.js',
                'resources/js/api/fetchExploreProduct.js',
                'resources/js/api/fetchFilterByProductId.js',
                'resources/js/api/fetchListProduct.js',
                'resources/js/api/fetchOrder.js',
                'resources/js/api/fetchPencarainProduct.js',
                'resources/js/api/fetchProductDashboard.js',
                'resources/js/api/fetchRelateProduct.js',
                'resources/js/api/fetchShippingDistricts.js',
                'resources/js/api/fetchShippings.js',
                'resources/js/api/fetchSpecialProduct.js',
                'resources/js/addproduct-script.js',
            ],
        }),
    ],
    build: {
        outDir: 'public/build',   // Output utama di public/build
        assetsDir: 'assets',      // Aset disimpan di folder assets
        manifest: true,           // Buat manifest.json
        rollupOptions: {
            input: {
                main: 'resources/js/app.js',
                styles: 'resources/css/app.css',
                headerScript: 'resources/js/header-script.js',
                sidebarScript: 'resources/js/sidebar-script.js',
                bootstrap: 'resources/js/bootstrap.js',
                editProductScript: 'resources/js/editProduct-script.js',
                loginScript: 'resources/js/login-script.js',
                mapsScript: 'resources/js/maps-script.js',
                orderDashboardScript: 'resources/js/orderDashboard-script.js',
                orderDetailScript: 'resources/js/orderDetail-script.js',
                productDashboardScript: 'resources/js/productDashboard-script.js',
                productDetailScript: 'resources/js/productDetails-script.js',
                shopScript: 'resources/js/shop-script.js',
                fetchDetailProduct: 'resources/js/api/fetchDetailProduct.js',
                fetchExploreProduct: 'resources/js/api/fetchExploreProduct.js',
                fetchFilterByProductId: 'resources/js/api/fetchFilterByProductId.js',
                fetchListProduct: 'resources/js/api/fetchListProduct.js',
                fetchOrder: 'resources/js/api/fetchOrder.js',
                fetchPencarianProduct: 'resources/js/api/fetchPencarainProduct.js',
                fetchProductDashboard: 'resources/js/api/fetchProductDashboard.js',
                fetchRelateProduct: 'resources/js/api/fetchRelateProduct.js',
                fetchShippingDistricts: 'resources/js/api/fetchShippingDistricts.js',
                fetchShippings: 'resources/js/api/fetchShippings.js',
                fetchSpecialProduct: 'resources/js/api/fetchSpecialProduct.js',
                addProductScript: 'resources/js/addproduct-script.js',
            },
        },
        emptyOutDir: true,        // Hapus folder build sebelum build baru
    },
    base: '/build/', // Path dasar untuk semua resource
});
