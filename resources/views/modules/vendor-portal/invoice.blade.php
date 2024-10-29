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
                    Vendor
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Invoice Submission
                </x-breadcrumb>
            </ol>
        </nav>


        <div class="tw-max-w-5xl tw-mx-auto tw-py-6 sm:tw-px-6 lg:tw-px-8 tw-space-y-6">
            <!-- Invoice Submission Header -->
            <div class="tw-bg-white tw-shadow sm:tw-rounded-lg tw-p-6">
                <h2 class="tw-text-xl tw-font-semibold tw-text-gray-900">Invoice Submission</h2>
                <p class="tw-text-gray-600 tw-text-sm">Submit your invoice with the details below.</p>
            </div>

            <!-- Invoice Submission Form -->
            <form action="#" method="POST" enctype="multipart/form-data" class="tw-bg-white tw-shadow sm:tw-rounded-lg tw-p-6 tw-space-y-6">

                <!-- Invoice Information -->
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    <div>
                        <label for="invoice_number" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Invoice Number</label>
                        <input type="text" id="invoice_number" name="invoice_number" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <div>
                        <label for="issue_date" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Issue Date</label>
                        <input type="date" id="issue_date" name="issue_date" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <div>
                        <label for="due_date" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Due Date</label>
                        <input type="date" id="due_date" name="due_date" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>
                </div>

                <!-- Client Information -->
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    <div>
                        <label for="client_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Client Name</label>
                        <input type="text" id="client_name" name="client_name" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <div>
                        <label for="client_email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Client Email</label>
                        <input type="email" id="client_email" name="client_email" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>
                </div>

                <!-- Items List Table -->
                <div class="tw-overflow-x-auto">
                    <table class="tw-min-w-full tw-bg-white tw-border tw-border-gray-300">
                        <thead class="tw-bg-gray-50">
                            <tr>
                                <th class="tw-px-4 tw-py-2 tw-text-left tw-text-sm tw-font-medium tw-text-gray-700">Description</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left tw-text-sm tw-font-medium tw-text-gray-700">Quantity</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left tw-text-sm tw-font-medium tw-text-gray-700">Price</th>
                                <th class="tw-px-4 tw-py-2 tw-text-left tw-text-sm tw-font-medium tw-text-gray-700">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="tw-px-4 tw-py-2">
                                    <input type="text" name="item_description[]" required
                                        class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                                </td>
                                <td class="tw-px-4 tw-py-2">
                                    <input type="number" name="item_quantity[]" required
                                        class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                                </td>
                                <td class="tw-px-4 tw-py-2">
                                    <input type="number" step="0.01" name="item_price[]" required
                                        class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                                </td>
                                <td class="tw-px-4 tw-py-2">
                                    <input type="number" step="0.01" name="item_total[]" readonly
                                        class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-bg-gray-100 tw-text-gray-500 tw-sm:text-sm">
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>

                <!-- Invoice Upload -->
                <div>
                    <label for="invoice_file" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Upload Invoice</label>
                    <input type="file" id="invoice_file" name="invoice_file" accept=".pdf, .jpg, .png" required
                        class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                </div>

                <!-- Submit Button -->
                <div class="tw-flex tw-justify-end">
                    <button type="submit" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-text-sm tw-font-medium tw-rounded-md tw-shadow-sm hover:tw-bg-indigo-700 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-indigo-500 tw-focus:ring-offset-2">
                        Submit Invoice
                    </button>
                </div>
            </form>
        </div>


    </div>

</x-layout>