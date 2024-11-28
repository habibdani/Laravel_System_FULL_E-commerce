// resources/js/api/fetchShippingDistricts.js

export async function fetchShippingDistricts() {
    try {
        const response = await fetch('/api/shipping-districts');
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        const result = await response.json();
        return result.data.original;
    } catch (error) {
        console.error('Error fetching shipping districts:', error);
        throw error;
    }
}
