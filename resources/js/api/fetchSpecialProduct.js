// resources/js/api/fetchSpecialProduct.js

export async function fetchSpecialProduct() {
    try {
        const response = await fetch('/api/list-products?filter=special');
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching special products:', error);
        throw error;
    }
}
