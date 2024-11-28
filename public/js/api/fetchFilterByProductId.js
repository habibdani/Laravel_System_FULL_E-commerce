// resources/js/api/fetchfillterbyproductid.js

export async function fetchfillterbyproductid(query) {
    try {
        const response = await fetch(`/api/list-products?Product_id=${encodeURIComponent(query)}`);
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
