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
                    Profile Management
                </x-breadcrumb>
            </ol>
        </nav>


        <div class="tw-max-w-7xl tw-mx-auto tw-py-6 sm:tw-px-6 lg:tw-px-8 tw-space-y-6">

            <!-- Profile Header -->
            <div class="tw-bg-white tw-shadow sm:tw-rounded-lg tw-p-6">
                <h2 class="tw-text-xl tw-font-semibold tw-text-gray-900">Profile Information</h2>
                <p class="tw-text-gray-600 tw-text-sm">Manage your profile details and personal information.</p>
            </div>

            <!-- Update Profile Form -->
            <div class="tw-bg-white tw-shadow sm:tw-rounded-lg tw-p-6">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Update Profile</h3>

                <form action="#" method="POST" class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6 tw-mt-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="John Doe" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="johndoe@example.com" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="(555) 555-5555" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Address</label>
                        <input type="text" id="address" name="address" value="123 Main St, City, Country" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <!-- Save Button -->
                    <div class="tw-col-span-1 md:tw-col-span-2 tw-flex tw-justify-end">
                        <button type="submit" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-text-sm tw-font-medium tw-rounded-md tw-shadow-sm hover:tw-bg-indigo-700 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-indigo-500 tw-focus:ring-offset-2">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password Section -->
            <div class="tw-bg-white tw-shadow sm:tw-rounded-lg tw-p-6">
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Change Password</h3>

                <form action="#" method="POST" class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6 tw-mt-4">
                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="new_password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">New Password</label>
                        <input type="password" id="new_password" name="new_password" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <!-- Confirm New Password -->
                    <div>
                        <label for="confirm_password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required
                            class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm">
                    </div>

                    <!-- Update Password Button -->
                    <div class="tw-col-span-1 md:tw-col-span-2 tw-flex tw-justify-end">
                        <button type="submit" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-red-600 tw-text-white tw-text-sm tw-font-medium tw-rounded-md tw-shadow-sm hover:tw-bg-red-700 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-red-500 tw-focus:ring-offset-2">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-layout>