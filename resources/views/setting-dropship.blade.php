@extends('layouts.app')

@section('title', 'Info WA')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Content -->
        <div class="w-full p-4">
            <div class="container mt-5">
                <h1 class="mb-4 text-center text-primary font-bold">Dropship</h1>

                <!-- Form -->
                <form id="infoClientForm">
                    <div class="mb-4">
                        <label for="clientName" class="block text-sm font-medium text-gray-700">Client Name</label>
                        <input type="text" id="clientName" name="name" 
                               class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               readonly>
                    </div>
                    <div class="mb-4">
                        <label for="pricePercentage" class="block text-sm font-medium text-gray-700">Price Percentage</label>
                        <input type="number" id="pricePercentage" name="price_percentage" 
                               class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               required>
                    </div>
                    <button type="button" id="saveButton" 
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const authToken = sessionStorage.getItem('authToken');
            const apiUrl = 'http://127.0.0.1:8001/api/info-client/2';

            // Fetch client info and populate the form
            try {
                const response = await fetch(apiUrl, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json',
                    }
                });

                const result = await response.json();
                if (result.success) {
                    const clientData = result.data;
                    document.getElementById('clientName').value = clientData.name;
                    document.getElementById('pricePercentage').value = clientData.price_persentage;
                } else {
                    alert(result.message || 'Failed to fetch client info.');
                }
            } catch (error) {
                console.error('Error fetching client info:', error);
                alert('An error occurred while fetching client info.');
            }

            // Handle save button click
            document.getElementById('saveButton').addEventListener('click', async () => {
                const pricePercentage = document.getElementById('pricePercentage').value;

                if (!pricePercentage || isNaN(pricePercentage)) {
                    alert('Please provide a valid price percentage.');
                    return;
                }

                try {
                    const saveResponse = await fetch('http://127.0.0.1:8001/api/update-presentage', {
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${authToken}`,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: 2,
                            price_percentage: parseFloat(pricePercentage),
                        }),
                    });

                    const saveResult = await saveResponse.json();
                    if (saveResult.success) {
                        alert('Price percentage updated successfully.');
                    } else {
                        alert(saveResult.message || 'Failed to update price percentage.');
                    }
                } catch (error) {
                    console.error('Error updating price percentage:', error);
                    alert('An error occurred while saving the data.');
                }
            });
        });
    </script>

    <style>
        /* Optional styles for better UI */
        label {
            font-weight: bold;
        }
        button {
            cursor: pointer;
        }
    </style>
@endsection
