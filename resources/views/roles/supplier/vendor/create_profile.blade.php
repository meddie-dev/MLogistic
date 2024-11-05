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
                    Vendors
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Manage Profiles
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vendor Profile Management</h2>

            <!-- Vendor Profile Form -->
            <form action="{{ route('profile.store', $supplier->id) }}" method="POST" class="tw-mt-6">
                @csrf
                <!-- Vendor Name -->
                <div class="tw-mb-4">
                    <label for="vendor_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Vendor Name</label>
                    <input type="text" id="vendor_name" name="vendor_name" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter your company name" required>
                </div>

                <!-- Contact Person -->
                <div class="tw-mb-4">
                    <label for="contact_person" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter your full name" required>
                </div>

                <!-- Contact Email -->
                <div class="tw-mb-4">
                    <label for="contact_email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Contact Email</label>
                    <input type="email" id="contact_email" name="contact_email" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter your email address" required>
                </div>

                <!-- Contact Phone Number -->
                <div class="tw-mb-4">
                    <label for="contact_phone" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Contact Phone</label>
                    <input type="tel" id="contact_phone" name="contact_phone" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter your phone number" required>
                </div>

                <!-- Business Address -->
                <div class="tw-mb-4">
                    <label for="business_address" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Business Address</label>
                    <input type="text" id="business_address" name="business_address" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter your business address" required>
                </div>

                <!-- Bio/About -->
                <div class="tw-mb-4">
                    <label for="bio" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Tell Us About Yourself</label>
                    <textarea id="bio" name="bio" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Please enter a brief description about yourself" required></textarea>
                </div>

                <!-- Submit Profile Button -->
                <div class="tw-mb-6">
                    <button type="submit" class="tw-w-full tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-shadow-md hover:tw-bg-indigo-700">Save Profile</button>
                </div>
            </form>

            <!-- Document Upload Form -->
            <div class="tw-mt-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Manage Profile</h3>
                <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
                    <p>Fill out the form to update your vendor profile. Manage their profile information, updating contact details and uploading performance records if required</p> <br>
                    <p>If you want change a password or supplier account information, click <a href="{{ route('settings.index') }}" class="tw-text-indigo-600 tw-underline">here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>




