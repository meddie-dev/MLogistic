<x-layout>
    <div class="container-fluid px-4  tw-my-10">
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

        <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade"> <!-- Additional Information Section -->
            <div>
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700  tw-mb-4">Profile Information</h3>
                <p class="tw-text-sm tw-text-gray-600">
                    Manage your profile details and keep your information up-to-date to maintain vendor registration status.
                </p>
            </div>
        </div>

        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
            @if ($profile != null) 
                <!-- Profile Information Display -->
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6 tw-mb-6">
                    <!-- Vendor Name -->
                    <div>
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Vendor Name</label>
                        <p class="tw-text-base tw-text-gray-600">{{ $profile->vendor_name }}</p>
                    </div>

                    <!-- Contact Person -->
                    <div>
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Contact Person</label>
                        <p class="tw-text-base tw-text-gray-600">{{ $profile->contact_person }}</p>
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Contact Email</label>
                        <p class="tw-text-base tw-text-gray-600">{{ $profile->contact_email }}</p>
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Contact Phone</label>
                        <p class="tw-text-base tw-text-gray-600">{{ $profile->contact_phone }}</p>
                    </div>

                    <!-- Business Address -->
                    <div>
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Business Address</label>
                        <p class="tw-text-base tw-text-gray-600">{{ $profile->business_address }}</p>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">About</label>
                        <p class="tw-text-base tw-text-gray-600">{{ $profile->bio }}</p>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="tw-mt-6 tw-flex tw-justify-end">
                    <a href="{{ route('profile.edit', $supplier->id) }}" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md tw-shadow tw-text-sm hover:tw-bg-indigo-300 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-ring-offset-2">
                        <i class="fa-solid fa-pen-to-square tw-mr-2"></i>
                        Edit Profile
                    </a>
                </div>
            @else
                <!-- Create Profile Button -->
                <div class="tw-flex tw-flex-col tw-items-center">
                    <a href="{{ route('profile.create', $supplier->id) }}" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-indigo-700 tw-text-white tw-font-semibold tw-rounded-md tw-shadow-lg tw-text-sm hover:tw-bg-indigo-300 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-indigo-700 focus:tw-ring-offset-2">
                        <i class="fa-solid fa-plus tw-mr-2"></i>
                        Create Your Profile
                    </a>
                    <p class="tw-text-center tw-text-sm tw-text-gray-600 tw-mt-2">Having a profile will help us to know more about your business and will increase your credibility.</p>
                </div>
                    @endif
            
        </div>
    </div>
</x-layout>