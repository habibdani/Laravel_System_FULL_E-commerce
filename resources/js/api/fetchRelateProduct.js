// resources/js/api/fetchRelateProduct.js

export async function fetchRelateProduct(product_type_id) {
    try {
        const response = await fetch(`/api/list-products?product_type_id=${product_type_id}`);
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching realate products:', error);
        throw error;
    }
}
