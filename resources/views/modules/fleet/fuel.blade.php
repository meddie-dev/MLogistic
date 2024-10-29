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
                    Fuel Management
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8">
            <h2 class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">Fuel Management Module</h2>

            <!-- Fuel Form -->
            <form id="fuelForm" class="tw-space-y-6">
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    <!-- Vehicle Name -->
                    <div>
                        <label for="vehicle" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Vehicle</label>
                        <input type="text" id="vehicle" required class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm-text-sm" placeholder="Enter vehicle name">
                    </div>

                    <!-- Distance Traveled (km) -->
                    <div>
                        <label for="distance" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Distance Traveled (km)</label>
                        <input type="number" id="distance" required class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm-text-sm" placeholder="Enter distance in km">
                    </div>
                </div>

                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    <!-- Fuel Efficiency (liters/km) -->
                    <div>
                        <label for="fuelEfficiency" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Fuel Efficiency (liters/km)</label>
                        <input type="number" id="fuelEfficiency" required class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm-text-sm" placeholder="Enter fuel efficiency">
                    </div>

                    <!-- Fuel Cost ($/liter) -->
                    <div>
                        <label for="fuelCost" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Fuel Cost ($/liter)</label>
                        <input type="number" id="fuelCost" required class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm-text-sm" placeholder="Enter fuel cost per liter">
                    </div>
                </div>

                <!-- Add Fuel Record Button -->
                <div class="tw-mt-6">
                    <button type="submit" class="tw-w-full tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md tw-shadow tw-hover:bg-indigo-700 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-indigo-500 tw-focus:ring-offset-2">Add Fuel Record</button>
                </div>
            </form>

            <!-- Fuel Records -->
            <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Fuel Records</h3>
            <div id="fuelRecords" class="tw-bg-gray-100 tw-rounded-md tw-p-4 tw-shadow-inner">
                <!-- Records will be displayed here -->
            </div>
        </div>

        <script>
            const fuelForm = document.getElementById('fuelForm');
            const fuelRecordsDiv = document.getElementById('fuelRecords');

            // Function to add a fuel record
            fuelForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                const vehicle = document.getElementById('vehicle').value;
                const distance = parseFloat(document.getElementById('distance').value);
                const fuelEfficiency = parseFloat(document.getElementById('fuelEfficiency').value);
                const fuelCost = parseFloat(document.getElementById('fuelCost').value);

                // Calculate total liters used and total cost
                const totalLitersUsed = (distance * fuelEfficiency).toFixed(2);
                const totalCost = (totalLitersUsed * fuelCost).toFixed(2); // Calculate total cost

                // Create a new record element
                const recordDiv = document.createElement('div');
                recordDiv.className = 'tw-bg-white tw-rounded-md tw-shadow-sm tw-p-2 tw-mb-2 tw-flex tw-justify-between tw-items-center';
                recordDiv.innerHTML = `
                <span class="tw-font-medium">${vehicle}</span> — <span>${distance} km</span>, <span>${totalLitersUsed} liters used</span>, <span>total cost: $${totalCost}</span>
                <button class="tw-text-red-500 hover:tw-text-red-700 tw-font-semibold">Remove</button>
            `;

                // Append to the fuel records
                fuelRecordsDiv.appendChild(recordDiv);

                // Clear form inputs
                fuelForm.reset();

                // Add event listener for the remove button
                recordDiv.querySelector('button').addEventListener('click', function() {
                    fuelRecordsDiv.removeChild(recordDiv);
                });
            });
        </script>

    </div>


</x-layout>