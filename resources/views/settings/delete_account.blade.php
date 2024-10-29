<x-layout>

    <div class="container tw-my-10">

        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
            <x-breadcrumb href="/" :active="true" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fas fa-user fa-fw"></i></div>
                    Account Settings
                </x-breadcrumb>

                <x-breadcrumb href="{{ route('settings.index') }}" :active="false" :isLast="false">
                    Profile Management
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Delete Account
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-7xl tw-mx-auto tw-py-6 sm:tw-px-6 lg:tw-px-8 tw-space-y-6">

            <!-- Delete Account Section -->
            <div class="tw-bg-white tw-shadow sm:tw-rounded-lg tw-p-6">
                <h2 class="tw-text-xl tw-font-semibold tw-text-gray-900">Delete Account</h2>

                @if (session('success'))
                    <div class="alert alert-success tw-mb-4">{{ session('success') }}</div>
                @endif

                <form action="{{ route('settings.verifyOtp') }}" method="POST">
                    @csrf
                    <div class="form-group tw-mt-4">
                        <label for="otp" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Enter the OTP sent to your email:</label>
                        <input type="text" name="otp" class="tw-mt-1 tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm:text-sm" required>
                    </div>
                    <button type="submit" class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-red-600 tw-text-white tw-text-sm tw-font-medium tw-rounded-md tw-shadow-sm hover:tw-bg-red-700 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-red-500 tw-focus:ring-offset-2 tw-mt-4">
                        Verify and Delete Account
                    </button>
                </form>
            </div>

        </div>

    </div>

</x-layout>
