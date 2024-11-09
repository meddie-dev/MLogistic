<x-layout>
    <div class="container-fluid px-4  tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse ">
                <x-breadcrumb href="/supplier/dashboard" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="true" :isLast="false">
                    Vendor
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    View Vendors
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8">
            <h2 class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">View Registered Vendors</h2>

            <!-- Contract Display Section -->
            <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-6 tw-my-4" data-aos="fade">
                @foreach ($supplier->registrations as $vendor)
                <div class="tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6 flex flex-col justify-between h-full">
                    <!-- Button Section -->
                    <div class="tw-flex tw-justify-end tw-space-x-2 mt-4"> <!-- Added mt-4 for spacing -->
                        <a href="{{ route('edit.registration', $vendor->id) }}" class="tw-bg-gray-100 tw-p-2 tw-rounded-md tw-text-gray-700 tw-text-sm tw-font-medium tw-mr-2 tw-flex tw-items-center">
                            <i class="fa-solid fa-pen-to-square tw-mr-2"></i>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('delete.registration', $vendor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vendor registration?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="tw-bg-gray-100 tw-p-2 tw-rounded-md tw-text-gray-700 tw-text-sm tw-font-medium tw-mr-2 tw-flex tw-items-center">
                                <i class="fa-solid fa-trash-can tw-mr-2"></i>
                                <span>Remove</span>
                            </button>
                        </form>
                    </div>


                    <div class="flex-grow">
                        <h3 class="tw-text-2xl tw-font-bold tw-text-gray-700 tw-mb-4">{{ $vendor->company_name }}</h3>
                        <div class="tw-flex tw-items-center tw-space-x-4">
                            <img src="{{ asset('storage/' . $vendor->supporting_documents_path) }}" alt="{{ $vendor->company_name }} logo"
                                class="tw-rounded-md tw-shadow-lg tw-w-full tw-h-60 tw-object-cover"> 
                        </div>


                        <div class="tw-flex tw-flex-col tw-space-y-2 tw-items-start tw-mb-4">
                            <div class="tw-w-full tw-overflow-y-auto tw-max-h-48 tw-p-2 tw-rounded-md tw-bg-gray-100">
                                <h4 class="tw-text-lg tw-font-bold tw-text-gray-700 tw-mb-2">Service Offerings</h4>
                                <p class="tw-text-gray-700">{{ $vendor->service_offerings }}</p>
                            </div>

                            <div class="tw-flex tw-items-center tw-space-x-2">
                                <i class="fa-solid fa-building tw-text-gray-500"></i>
                                <span class="tw-text-gray-700">{{ $vendor->company_address }}</span>
                            </div>

                            <div class="tw-flex tw-items-center tw-space-x-2">
                                <i class="fa-solid fa-envelope tw-text-gray-500"></i>
                                <span class="tw-text-gray-700">{{ $vendor->company_email }}</span>
                            </div>

                            <div class="tw-flex tw-items-center tw-space-x-2">
                                <i class="fa-solid fa-user-tie tw-text-gray-500"></i>
                                <span class="tw-text-gray-700">{{ $vendor->key_contacts }}</span>
                            </div>

                            <div class="tw-flex tw-items-center tw-space-x-2">
                                <i class="fa-solid fa-eye tw-text-gray-500"></i>
                                <a href="{{ asset('storage/' . $vendor->supporting_documents_path) }}" target="_blank" class="tw-text-gray-700">
                                    View
                                </a>
                            </div>

                            <div class="tw-flex tw-items-center tw-space-x-2">
                                <i class="fa-solid fa-circle-check tw-text-gray-500"></i>
                                <span class="tw-text-gray-700">{{ $vendor->status ?? 'Pending' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="tw-flex tw-items-center tw-justify-center  tw-border-color-gray-300 tw-opacity-50 tw-rounded tw-p-8 tw-border-[7px] tw-border-dashed">
                    <div class="tw-flex tw-items-center tw-justify-center">
                        <a href="/supplier/vendor/registration"><i class="fa-solid fa-plus tw-text-5xl tw-text-gray-600 tw-opacity-50"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Registration Review and Approval Section -->
            <div class="tw-mt-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Vendor Review and Approval</h3>
                <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
                    <p>The procurement team will review submitted registrations. Vendors might be asked for more information or documents if required. Approved vendors will be onboarded to receive service orders.</p><br>
                    <p>Approved vendors gain access to the Procurement Module for placing service orders for registered services.</p>
                </div>
            </div>
        </div>
        @if ($supplier->registrations->count() == 0)
        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10  tw-p-8">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-300 tw-text-center">
                No registered vendors yet.
            </h2>
        </div>
        @endif
    </div>
</x-layout>