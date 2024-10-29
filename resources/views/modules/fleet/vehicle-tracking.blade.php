<x-layout>
    <div class="container tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse ">
                <x-breadcrumb href="/" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="true" :isLast="false">
                    Fleet
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Vehicle Tracking
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vehicle Tracking Module</h2>

            <div class="tw-mt-4">
                <label for="vehicleSelect" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Select Vehicle</label>
                <select id="vehicleSelect" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                    <option value="vehicle1">Vehicle 1</option>
                    <option value="vehicle2">Vehicle 2</option>
                    <option value="vehicle3">Vehicle 3</option>
                    <option value="vehicle4">Vehicle 4</option>
                </select>
            </div>

            <div class="tw-mt-4">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-700">Real-time GPS Location:</h3>
                <div id="map" style="height: 400px;"></div>
            </div>

            <div class="tw-mt-4">
                <button id="trackVehicle" class="tw-w-full tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw:bg-indigo-700">Track Vehicle</button>
            </div>

            <div class="tw-mt-4">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-700">Vehicle Status</h3>
                <p id="vehicleStatus" class="tw-p-2 tw-bg-gray-200 tw-rounded-md">Select a vehicle and click "Track Vehicle" to see its status.</p>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Sample vehicle data (replace with real GPS data as needed)
        const vehicleData = {
            vehicle1: { lat: 34.0522, lng: -118.2437, status: "In Transit" }, // Los Angeles
            vehicle2: { lat: 36.1699, lng: -115.1398, status: "Stopped" },    // Las Vegas
            vehicle3: { lat: 40.7128, lng: -74.0060, status: "Arrived" },    // New York
            vehicle4: { lat: 37.7749, lng: -122.4194, status: "In Transit" }  // San Francisco
        };

        let map;
        let marker;

        // Initialize map
        function initMap() {
            const initialLocation = { lat: 34.0522, lng: -118.2437 }; // Default location (Los Angeles)
            map = L.map('map').setView(initialLocation, 6);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Create a marker for the vehicle
            marker = L.marker(initialLocation).addTo(map)
                .bindPopup('Vehicle Location')
                .openPopup();
        }

        // Update the map with the selected vehicle's location
        function updateVehicleLocation(vehicle) {
            const { lat, lng, status } = vehicleData[vehicle];

            // Move the marker to the new location
            marker.setLatLng([lat, lng]);

            // Update vehicle status text
            document.getElementById("vehicleStatus").innerText = `${vehicle} is ${status}`;
            map.setView([lat, lng], 12); // Center the map on the vehicle's location
        }

        // Event listener for tracking vehicle
        document.getElementById("trackVehicle").addEventListener("click", () => {
            const selectedVehicle = document.getElementById("vehicleSelect").value;
            updateVehicleLocation(selectedVehicle);
        });

        // Initialize the map on page load
        window.onload = initMap;
    </script>
</x-layout>
