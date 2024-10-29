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
                    Edit Reservations
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade-up">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Update Vehicle Reservation</h2>

            <!-- Reservation Form -->
            <form id="reservationForm" class="tw-mt-6">
                <!-- Reservation ID -->
                <input type="hidden" id="reservationId" value="{{$reservation->id}}" />

                <!-- Reservation Date & Time -->
                <div class="tw-flex tw-w-full  tw-gap-6">
                    <!-- Reservation Date -->
                    <div class="tw-mb-4 tw-w-full" id="calendar">
                    </div>
                </div>

                <!-- Vehicle Name -->
                <div class="tw-mb-4">
                    <label for="vehicleName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Vehicle Name</label>
                    <input type="text" id="vehicleName" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" value="{{ $reservation->vehicle_name }}" placeholder="Enter vehicle name" required>
                </div>

                <!-- Reservation Purpose -->
                <div class="tw-mb-4">
                    <label for="purpose" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Purpose of Reservation</label>
                    <input type="text" id="purpose" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" value="{{ $reservation->purpose }}" placeholder="Enter purpose for reservation" required>
                </div>

                <!-- Request Reservation Button -->
                <div class="tw-mb-6">
                    <button type="submit" class="tw-w-full tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-shadow-md hover:tw-bg-indigo-700">Update Vehicle Reservation</button>
                </div>
            </form>
        </div>
    </div>

    <script>
            // Calendar
            var selectedDate = null;
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

</x-layout>
