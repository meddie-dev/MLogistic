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
                    Audit
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Report
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Audit Reporting Module</h2>
            <form id="reportForm" class="tw-my-5">
                <div class="tw-mb-4">
                    <label for="reportType" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Select Report Type</label>
                    <select id="reportType" name="reportType" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                        <option value="shipments">Shipments Report</option>
                        <option value="deliveries">Deliveries Report</option>
                        <option value="audits">Audits Report</option>
                    </select>
                </div>

                <div class="tw-mb-4">
                    <label for="startDate" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Start Date</label>
                    <input type="date" id="startDate" name="startDate" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" required>
                </div>

                <div class="tw-mb-4">
                    <label for="endDate" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">End Date</label>
                    <input type="date" id="endDate" name="endDate" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" required>
                </div>

                <div class="tw-mb-4">
                    <label for="status" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Status</label>
                    <select id="status" name="status" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                        <option value="all">All</option>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>

                <button type="submit" class="tw-w-full tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw:bg-indigo-700">Generate Report</button>
            </form>

            <div id="reportContainer" class="hidden">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-700">Generated Report</h3>
                <table class="tw-min-w-full tw-mt-4 tw-border tw-border-gray-300">
                    <thead>
                        <tr class="tw-bg-gray-100">
                            <th class="tw-p-3 tw-border-b tw-border-gray-300">#</th>
                            <th class="tw-p-3 tw-border-b tw-border-gray-300">Report Type</th>
                            <th class="tw-p-3 tw-border-b tw-border-gray-300">Date Range</th>
                            <th class="tw-p-3 tw-border-b tw-border-gray-300">Status</th>
                        </tr>
                    </thead>
                    <tbody id="reportData" class="tw-bg-white"></tbody>
                </table>
            </div>
        </div>

        <script>
            const reportForm = document.getElementById('reportForm');
            const reportContainer = document.getElementById('reportContainer');
            const reportData = document.getElementById('reportData');

            reportForm.addEventListener('submit', (event) => {
                event.preventDefault();
                const reportType = document.getElementById('reportType').value;
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const status = document.getElementById('status').value;

                // Clear previous report data
                reportData.innerHTML = '';

                // Sample report data (you can replace this with actual data from your backend)
                const sampleData = [{
                        id: 1,
                        type: reportType,
                        dateRange: `${startDate} to ${endDate}`,
                        status: status
                    },
                    {
                        id: 2,
                        type: reportType,
                        dateRange: `${startDate} to ${endDate}`,
                        status: status
                    },
                    {
                        id: 3,
                        type: reportType,
                        dateRange: `${startDate} to ${endDate}`,
                        status: status
                    }
                ];

                sampleData.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="tw-p-3 tw-border-b tw-border-gray-300">${item.id}</td>
                    <td class="tw-p-3 tw-border-b tw-border-gray-300">${item.type}</td>
                    <td class="tw-p-3 tw-border-b tw-border-gray-300">${item.dateRange}</td>
                    <td class="tw-p-3 tw-border-b tw-border-gray-300">${item.status}</td>
                `;
                    reportData.appendChild(row);
                });

                reportContainer.classList.remove('hidden'); // Show the report container
            });
        </script>

</x-layout>