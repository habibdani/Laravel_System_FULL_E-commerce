// resources/js/api/fetchProductDashboard.js

export async function fetchProductDashboard() {
    try {
        const response = await fetch('/api/list-products');
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching list-products:', error);
        throw error;
    }
}
