<x-layout>
    <div class="container tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
                <x-breadcrumb href="/" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="true" :isLast="false">
                    Fleet
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    View Reservation Status
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vehicle Reservation Status</h2>

            <!-- Reservation Status Form -->
            <form id="statusForm" class="tw-mt-6">
                <!-- Supplier ID -->
                <div class="tw-mb-4">
                    <label for="supplierId" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Supplier ID</label>
                    <input type="text" id="supplierId" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter Supplier ID">
                </div>

                <!-- Reservation Number -->
                <div class="tw-mb-4">
                    <label for="reservationNumber" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Reservation Number</label>
                    <input type="text" id="reservationNumber" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter reservation number">
                </div>

                <!-- Check Status Button -->
                <div class="tw-mb-6">
                    <button type="button" class="tw-w-full tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-shadow-md hover:tw-bg-indigo-700" onclick="checkStatus()">Check Status</button>
                </div>
            </form>

            <!-- Reservation Status Display Section -->
            <div id="statusResult" class="tw-hidden tw-mt-8">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mb-4">Reservation Status</h3>
                <div class="tw-overflow-x-auto">
                    <table class="tw-w-full tw-bg-gray-100 tw-rounded-md tw-shadow-md">
                        <thead class="tw-bg-gray-200 tw-text-gray-700">
                            <tr>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Reservation ID</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Vehicle</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody id="reservationRecords" class="tw-bg-white">
                            <!-- Status records will be displayed here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-layout>
