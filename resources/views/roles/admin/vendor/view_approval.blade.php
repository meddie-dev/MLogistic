<x-layout>
    <div class="container-fluid px-4  tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
                <x-breadcrumb href="/admin/dashboard" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="true" :isLast="false">
                    Vendor
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    {{$registrations->company_name}}
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
            <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
                Vendor Approval List
            </div>
            <div class="tw-flex tw-flex-col tw-space-y-4 tw-mb-6">
                <div class="tw-flex tw-items-center tw-space-x-4">
                    <img src="{{ asset('storage/' . $registrations->supporting_documents_path) }}" alt="{{$registrations->company_name}} logo"
                        class="tw-rounded-md tw-shadow-lg tw-w-full tw-h-60 tw-object-cover">
                </div>
                <div class="tw-flex tw-items-center tw-justify-between">
                    <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">{{$registrations->company_name}} <span class="tw-text-sm tw-font-normal tw-text-gray-500">({{$registrations->supplier->name}})</span></h4>
                </div>
                <div class="tw-flex tw-items-center tw-justify-between">
                    <textfield class="tw-text-sm tw-font-semibold tw-text-gray-800">{{$registrations->service_offerings}}</textfield>
                </div>
                <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-building tw-text-gray-500"></i>
                    <span class="tw-text-gray-700">{{$registrations->company_address}}</span>
                </div>
                <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-envelope tw-text-gray-500"></i>
                    <span class="tw-text-gray-700">{{$registrations->company_email}}</span>
                </div>
                <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-user-tie tw-text-gray-500"></i>
                    <span class="tw-text-gray-700">{{$registrations->key_contacts}}</span>
                </div>
                <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-circle-check tw-text-gray-500"></i>
                    <span class="tw-text-gray-700">{{$registrations->status ?? 'Pending' }}</span>
                </div>
              
                <div class="tw-flex tw-justify-end tw-mt-4 tw-space-x-2">
                    <button type="submit" form="reject-status"
                        class="tw-font-bold tw-py-2 tw-px-4 tw-rounded-md tw-text-sm tw-bg-red-500 hover:tw-bg-red-700 tw-text-white">
                        Reject
                    </button>

                    <button type="submit" form="update-status"
                        class="tw-font-bold tw-py-2 tw-px-4 tw-rounded-md tw-text-sm tw-bg-blue-500 hover:tw-bg-blue-700 tw-text-white">
                        Approve
                    </button>
                   
                    <form action="{{ route('cancel-approval', $registrations->id) }}" class="tw-hidden" method="POST" id="reject-status">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="Cancelled">
                    </form>

                    <form action="{{ route('update-approval', $registrations->id) }}" class="tw-hidden" method="POST" id="update-status">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="Approved">
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layout>