// resources/js/api/fetchShippings.js

export async function fetchShippings() {
    try {
        const response = await fetch('/api/shippings');
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching shippings:', error);
        throw error;
    }
}
