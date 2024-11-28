// resources/js/api/fetchDetailProduct.js

export async function fetchDetailProduct(id) {
    try {
        const response = await fetch(`/api/product/details?id=${id}`);
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching product details:', error);
        throw error;
    }
}
