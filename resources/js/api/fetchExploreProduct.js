// resources/js/api/fetchExploreProduct.js

export async function fetchExploreProduct() {
    try {
        const response = await fetch('/api/list-products?filter=explore');
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching explore products:', error);
        throw error;
    }
}
