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
                    Schedule
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Schedule an Audit</h2>

            <form action="#" class="tw-space-y-4">
                <div>
                    <label for="audit_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Audit Name</label>
                    <input type="text" id="audit_name" name="audit_name" required
                        class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                        placeholder="Enter audit name">
                </div>

                <div>
                    <label for="audit_date" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Audit Date</label>
                    <input type="date" id="audit_date" name="audit_date" required
                        class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                </div>

                <div>
                    <label for="audit_time" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Audit Time</label>
                    <input type="time" id="audit_time" name="audit_time" required
                        class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                </div>

                <div>
                    <label for="auditor_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Auditor Name</label>
                    <input type="text" id="auditor_name" name="auditor_name" required
                        class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                        placeholder="Enter auditor name">
                </div>

                <div>
                    <label for="department" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Department</label>
                    <select id="department" name="department" required
                        class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-bg-white tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                        <option value="">Select department</option>
                        <option value="operations">Operations</option>
                        <option value="finance">Finance</option>
                        <option value="human_resources">Human Resources</option>
                        <option value="logistics">Logistics</option>
                    </select>
                </div>

                <div>
                    <label for="comments" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Additional Comments</label>
                    <textarea id="comments" name="comments" rows="4"
                        class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                        placeholder="Any additional information about the audit..."></textarea>
                </div>

                <button type="submit"
                    class="tw-w-full tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw-bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Schedule Audit
                </button>
            </form>
        </div>

</x-layout>

