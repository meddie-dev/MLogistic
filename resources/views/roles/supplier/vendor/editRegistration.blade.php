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
                    Vendor Management
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Edit Vendor
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade">
            <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Edit Vendor Registration</h2>

            <!-- Vendor Registration Form -->
            <form action="{{ route('update.registration', $vendor->id) }}" method="POST" enctype="multipart/form-data" id="vendorRegistrationForm" class="tw-mt-6">
                @csrf
                @method('PATCH') <!-- Use PUT method for updating -->

                <!-- Company Details -->
                <div class="tw-mb-4">
                    <label for="company_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Company Name</label>
                    <input type="text" id="company_name" name="company_name" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter company name" value="{{ old('company_name', $vendor->company_name) }}" required>
                    @error('company_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Company Address -->
                <div class="tw-mb-4">
                    <label for="company_address" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Company Address</label>
                    <input type="text" id="company_address" name="company_address" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter company address" value="{{ old('company_address', $vendor->company_address) }}" required>
                    @error('company_address')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Company Email -->
                <div class="tw-mb-4">
                    <label for="company_email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Company Email</label>
                    <input type="email" id="company_email" name="company_email" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter Email address" value="{{ old('company_email', $vendor->company_email) }}" required>
                    @error('company_email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Service Offerings -->
                <div class="tw-mb-4">
                    <label for="service_offerings" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Service Offerings</label>
                    <textarea id="service_offerings" name="service_offerings" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Describe the services or goods provided" rows="4" required>{{ old('service_offerings', $vendor->service_offerings) }}</textarea>
                    @error('service_offerings')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Key Contacts -->
                <div class="tw-mb-4">
                    <label for="key_contacts" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Key Contacts</label>
                    <textarea id="key_contacts" name="key_contacts" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="List the main points of contact (names, roles, contact info)" rows="3" required>{{ old('key_contacts', $vendor->key_contacts) }}</textarea>
                    @error('key_contacts')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Supporting Document Upload -->
                <div class="tw-mb-4">
                    <label for="supporting_documents_path" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Upload Supporting Documents</label>
                    <p class="tw-text-xs tw-text-gray-500 tw-mb-1">Upload business registration certificates, proof of insurance, etc. Leave blank to keep the existing document.</p>
                    <div class="tw-mt-1 tw-flex tw-justify-center tw-p-2 tw-border tw-border-gray-300 tw-rounded-md">
                        <input type="file" id="supporting_documents_path" name="supporting_documents_path" class="tw-block tw-w-full" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                    </div>
                    @error('supporting_documents_path')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <small class="tw-text-gray-600">Current Document: <a href="{{ asset('storage/' . $vendor->supporting_documents_path) }}" target="_blank" class="tw-text-indigo-600 tw-underline">View Current Document</a></small>
                </div>

                <!-- Submit Registration Button -->
                <div class="tw-mb-6">
                    <button type="submit" class="tw-w-full tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-shadow-md hover:tw-bg-indigo-700">Update Registration</button>
                </div>
                <!-- Cancel Button -->
                <div class="tw-mb-6 tw-text-center">
                    <a href="{{ route('view-vendors') }}" class="tw-w-full tw-px-4 tw-py-1 tw-text-gray-300">Cancel</a>
                </div>
            </form>

            <!-- Registration Review and Approval Section -->
            <div class="tw-mt-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Vendor Review and Approval</h3>
                <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
                    <p>Upon submission, the institution’s procurement team will review the registration details. Vendors may be contacted for additional information or supporting documents if needed. Approved vendors will be formally onboarded, enabling them to receive service orders.</p><br>
                    <p>Once approved, vendors will have access to the Procurement Module, where they can place service orders for their registered services.</p><br>
                    <p>To view your registered vendors, click <a href="{{ route('view-vendors') }}" class="tw-text-indigo-600 tw-underline">here</a>.</p>
                </div>
            </div>

        </div>
    </div>
</x-layout>