<x-layout>
    <div class="container tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
                <x-breadcrumb href="/" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="false" :isLast="false">
                    Fleet
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    View Logs
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Reservation History</h2>

            <!-- Reservation History Display Section -->
            <div id="historyResult" class="tw-mt-6">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mb-4">Past Reservations</h3>
                <div class="tw-overflow-x-auto">
                    <table class="tw-w-full tw-bg-gray-100 tw-rounded-md tw-shadow-md">
                        <thead class="tw-bg-gray-200 tw-text-gray-700">
                            <tr>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Reservation ID</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Vehicle</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Status</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Reservation Date</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody id="reservationHistoryRecords" class="tw-bg-white">
                            <!-- History records will be displayed here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            // Simulate loading past reservations (replace with actual API call logic)
            function loadReservationHistory() {
                // Sample data for reservation history
                const historyData = [
                    { id: 1, vehicle: "Car A", status: "Completed", date: "2024-10-01" },
                    { id: 2, vehicle: "Car B", status: "Cancelled", date: "2024-09-15" },
                    { id: 3, vehicle: "Truck C", status: "Completed", date: "2024-08-10" },
                ];

                const reservationHistoryTbody = document.getElementById('reservationHistoryRecords');

                // Clear existing records
                reservationHistoryTbody.innerHTML = '';

                // Populate with sample data for demonstration
                historyData.forEach((record) => {
                    const recordRow = document.createElement('tr');
                    recordRow.className = 'tw-border-b tw-border-gray-300';
                    recordRow.innerHTML = `
                        <td class="tw-px-4 tw-py-2">${record.id}</td>
                        <td class="tw-px-4 tw-py-2">${record.vehicle}</td>
                        <td class="tw-px-4 tw-py-2">${record.status}</td>
                        <td class="tw-px-4 tw-py-2">${record.date}</td>
                        <td class="tw-px-4 tw-py-2">
                            <button class="tw-text-indigo-600 tw-font-semibold details-btn">View Details</button>
                        </td>
                    `;

                    // Add event listener for the details button
                    recordRow.querySelector('.details-btn').addEventListener('click', function () {
                        alert(`Viewing details for Reservation ID: ${record.id}`);
                    });

                    // Append each record to the table body
                    reservationHistoryTbody.appendChild(recordRow);
                });
            }

            // Load the reservation history on page load
            window.onload = loadReservationHistory;
        </script>

    </div>
</x-layout>
