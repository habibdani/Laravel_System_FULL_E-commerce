// resources/js/api/fetchListProduct.js

export async function fetchListProduct(id) {
    try {
        const response = await fetch(`/api/list-dropdown`);
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
