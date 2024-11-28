// resources/js/api/fetchPencarainProduct.js

export async function fetchPencarianProduct(query) {
    try {
        const response = await fetch(`/api/list-products?filter_by_pencarian=${encodeURIComponent(query)}`);
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching pencarian products:', error);
        throw error;
    }
}
