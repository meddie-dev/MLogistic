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
                    Maintenance Scheduling
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Maintenance Scheduling Module</h2>

            <!-- Maintenance Form -->
            <form id="maintenanceForm" class="tw-mt-6">
                <!-- Vehicle/Equipment Name -->
                <div class="tw-mb-4">
                    <label for="vehicleEquipment" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Vehicle/Equipment Name</label>
                    <input type="text" id="vehicleEquipment" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter vehicle or equipment name">
                </div>

                <!-- Maintenance Task -->
                <div class="tw-mb-4">
                    <label for="task" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Maintenance Task</label>
                    <input type="text" id="task" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter maintenance task">
                </div>

                <!-- Date & Reminder -->
                <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-6">
                    <!-- Maintenance Date -->
                    <div class="tw-mb-4">
                        <label for="maintenanceDate" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Maintenance Date</label>
                        <input type="date" id="maintenanceDate" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                    </div>

                    <!-- Reminder -->
                    <div class="tw-mb-4">
                        <label for="reminder" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Reminder (Days Before)</label>
                        <input type="number" id="reminder" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter number of days before to remind">
                    </div>
                </div>

                <!-- Add Maintenance Record Button -->
                <div class="tw-mb-6">
                    <button type="submit" class="tw-w-full tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-shadow-md hover:tw-bg-indigo-700">Add Maintenance Schedule</button>
                </div>
            </form>

            <!-- Generated Report Section -->
            <div>
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Generated Schedules</h3>
                <div class="tw-overflow-x-auto">
                    <table class="tw-w-full tw-bg-gray-100 tw-rounded-md tw-shadow-md">
                        <thead class="tw-bg-gray-200 tw-text-gray-700">
                            <tr>
                                <th class="tw-px-4 tw-py-2 tw-text-left">#</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Vehicle/Equipment</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Task</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Date</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Reminder</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody id="maintenanceRecords" class="tw-bg-white">
                            <!-- Records will be displayed here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            const maintenanceForm = document.getElementById('maintenanceForm');
            const maintenanceRecordsTbody = document.getElementById('maintenanceRecords');
            let recordId = 1;

            // Function to add a maintenance record
            maintenanceForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                const vehicleEquipment = document.getElementById('vehicleEquipment').value;
                const task = document.getElementById('task').value;
                const maintenanceDate = document.getElementById('maintenanceDate').value;
                const reminder = document.getElementById('reminder').value;

                // Create a new table row for the record
                const recordRow = document.createElement('tr');
                recordRow.className = 'tw-border-b tw-border-gray-300';
                recordRow.innerHTML = `
                <td class="tw-px-4 tw-py-2">${recordId++}</td>
                <td class="tw-px-4 tw-py-2">${vehicleEquipment}</td>
                <td class="tw-px-4 tw-py-2">${task}</td>
                <td class="tw-px-4 tw-py-2">${new Date(maintenanceDate).toLocaleDateString()}</td>
                <td class="tw-px-4 tw-py-2">${reminder} days before</td>
                <td class="tw-px-4 tw-py-2">
                    <button class="tw-text-red-500 tw-font-semibold remove-btn">Remove</button>
                </td>
            `;

                // Append the new row to the table body
                maintenanceRecordsTbody.appendChild(recordRow);

                // Clear form inputs
                maintenanceForm.reset();

                // Add event listener for the remove button
                recordRow.querySelector('.remove-btn').addEventListener('click', function() {
                    maintenanceRecordsTbody.removeChild(recordRow);
                });
            });
        </script>

    </div>

</x-layout>