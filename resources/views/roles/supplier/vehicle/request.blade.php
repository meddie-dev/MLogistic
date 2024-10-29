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
                    Vehicle Reservations
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade-up">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vehicle Reservation Request</h2>

            <!-- Reservation Form -->
            <form id="reservationForm" class="tw-mt-6">
                <!-- Reservation Date & Time -->
                <div class="tw-flex tw-w-full  tw-gap-6">
                    <!-- Reservation Date -->
                    <div class="tw-mb-4 tw-w-full" id="calendar">
                    </div>

                </div>

                <!-- Vehicle Name -->
                <div class="tw-mb-4">
                    <label for="vehicleName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Vehicle Name</label>
                    <input type="text" id="vehicleName" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter vehicle name" required>
                </div>

                <!-- Reservation Purpose -->
                <div class="tw-mb-4">
                    <label for="purpose" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Purpose of Reservation</label>
                    <input type="text" id="purpose" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter purpose for reservation" required>
                </div>

                <!-- Request Reservation Button -->
                <div class="tw-mb-6">
                    <button type="submit" class="tw-w-full tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-shadow-md hover:tw-bg-indigo-700">Request Vehicle Reservation</button>
                </div>
            </form>

            <!-- Generated Reservations Section -->
            <div data-aos="fade-up">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Requested Reservations</h3>
                <div class="tw-overflow-x-auto">
                    <table class="tw-w-full tw-bg-gray-100 tw-rounded-md tw-shadow-md">
                        <thead class="tw-bg-gray-200 tw-text-gray-700">
                            <tr>
                                <th class="tw-px-4 tw-py-2">#</th>
                                <th class="tw-px-4 tw-py-2">Vehicle</th>
                                <th class="tw-px-4 tw-py-2">Purpose</th>
                                <th class="tw-px-4 tw-py-2">Reservation Date</th>
                                <th class="tw-px-4 tw-py-2">Status</th>
                                <th class="tw-px-4 tw-py-2">Action</th>
                                <td class="tw-px-4 tw-py-2 tw-flex tw-space-x-2 tw-items-center"></td>
                            </tr>
                        </thead>
                        <tbody id="reservationRecords" class="tw-bg-white">
                            <!-- Records will be displayed here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            const reservationForm = document.getElementById('reservationForm');
            const reservationRecordsTbody = document.getElementById('reservationRecords');
            let recordId = 1;
            let selectedDate = null;

            // Function to add a reservation record
            reservationForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                const vehicleName = document.getElementById('vehicleName').value;
                const purpose = document.getElementById('purpose').value;

                // Create a new table row for the record
                const recordRow = document.createElement('tr');
                recordRow.className = 'tw-border-b tw-border-gray-300';
                recordRow.innerHTML = `
                <td class="tw-px-4 tw-py-2">${recordId++}</td>
                <td class="tw-px-4 tw-py-2">${vehicleName}</td>
                <td class="tw-px-4 tw-py-2">${purpose}</td>
                <td class="tw-px-4 tw-py-2">${new Intl.DateTimeFormat('en-US', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                }).format(new Date(selectedDate))}</td>
                <td class="tw-px-4 tw-py-2 tw-text-yellow-500">Pending</td>
                <td class="tw-px-4 tw-py-2 tw-flex tw-space-x-2 tw-items-center">
                    <button class="tw-text-blue-500 tw-font-semibold edit-btn">Edit</button>
                    <button class="tw-text-red-500 tw-font-semibold remove-btn">Remove</button>
                </td>
            `;

                // Append the new row to the table body
                reservationRecordsTbody.appendChild(recordRow);

                // Clear form inputs
                reservationForm.reset();

                // Add event listener for the remove button
                recordRow.querySelector('.remove-btn').addEventListener('click', function() {
                    reservationRecordsTbody.removeChild(recordRow);
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    selectable: true,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    dateClick: function(info) {
                        selectedDate = new Date(info.dateStr).toISOString();
                    },
                    select: function(info) {
                        selectedDate = new Date(info.startStr).toISOString();
                    }
                });

                calendar.render();
            });
        </script>

    </div>

</x-layout>