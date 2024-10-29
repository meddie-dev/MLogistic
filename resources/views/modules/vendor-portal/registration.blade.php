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
                    Registration
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vendor Registration Form</h2>

            <form action="#" method="POST" class="tw-my-5">
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-10 tw-my-8">
                    <div>
                        <!-- Vendor Name -->
                        <div>
                            <label for="vendor_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Vendor Name</label>
                            <input type="text" id="vendor_name" name="vendor_name" required
                                class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                                placeholder="Enter vendor name">
                        </div>

                        <!-- Email -->
                        <div class="tw-mt-4">
                            <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                                placeholder="Enter email address">
                        </div>

                        <!-- Phone Number -->
                        <div class="tw-mt-4">
                            <label for="phone" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required
                                class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                                placeholder="Enter phone number">
                        </div>
                    </div>

                    <div>
                        <!-- Business Registration Number -->
                        <div>
                            <label for="registration_number" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Business Registration Number</label>
                            <input type="text" id="registration_number" name="registration_number" required
                                class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                                placeholder="Enter registration number">
                        </div>

                        <!-- Address -->
                        <div class="tw-mt-4">
                            <label for="address" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Business Address</label>
                            <input type="text" id="address" name="address" required
                                class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500"
                                placeholder="Enter business address">
                        </div>

                        <!-- Service Area -->
                        <div class="tw-mt-4">
                            <label for="service_area" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Service Area</label>
                            <select id="service_area" name="service_area" required
                                class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-bg-white tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500">
                                <option value="">Select service area</option>
                                <option value="local">Local</option>
                                <option value="regional">Regional</option>
                                <option value="national">National</option>
                                <option value="international">International</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="tw-mt-14">
                    <button type="submit"
                        class="tw-w-full tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout>