<x-layout>
    <div class="container tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
                <x-breadcrumb href="/supplier/dashboard" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="true" :isLast="false">
                    Vendors
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    View Profile
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade"> <!-- Additional Information Section -->
            <div>
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700  tw-mb-4">Profile Information</h3>
                <p class="tw-text-sm tw-text-gray-600">
                    Manage your profile details and keep your information up-to-date to maintain vendor registration status.
                </p>
            </div>
        </div>

        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">


            <!-- Profile Information Display -->
            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6 tw-mb-6">
                <!-- Vendor Name -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Vendor Name</label>
                    <p class="tw-text-base tw-text-gray-600">{{ $supplier->name }}</p>
                </div>

                <!-- Contact Person -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Contact Person</label>
                    <p class="tw-text-base tw-text-gray-600">{{ $supplier->contact_person }}</p>
                </div>

                <!-- Contact Email -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Contact Email</label>
                    <p class="tw-text-base tw-text-gray-600">{{ $supplier->email }}</p>
                </div>

                <!-- Contact Phone -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Contact Phone</label>
                    <p class="tw-text-base tw-text-gray-600">{{ $supplier->contact_phone }}</p>
                </div>

                <!-- Business Address -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Business Address</label>
                    <p class="tw-text-base tw-text-gray-600">{{ $supplier->business_address }}</p>
                </div>

                <!-- Bio -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">About</label>
                    <p class="tw-text-base tw-text-gray-600">{{ $supplier->bio }}</p>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="tw-mt-6 tw-flex tw-justify-end">
                <a href="{{ route('profile.edit', $supplier->id) }}" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md tw-shadow tw-text-sm hover:tw-bg-indigo-300 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-ring-offset-2">
                    <i class="fa-solid fa-pen-to-square tw-mr-2"></i>
                    Edit Profile
                </a>
            </div>


            <!-- Additional Information Section -->
            <div data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700  tw-mb-4">Additional Information</h3>
                <p class="tw-text-sm tw-text-gray-600">
                    Remember to keep your profile information accurate and current to ensure vendor registration compliance.
                </p>
            </div>

        </div>
    </div>
</x-layout>