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
          Vendor Approval
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        Vendor Approval List
      </div>
      <div class="card-body">
        <div class="tw-overflow-x-auto">
          <table class="tw-w-full tw-bg-white tw-rounded-md tw-shadow-md tw-my-4" id="datatablesSimple">
            <thead class="tw-bg-gray-200 tw-text-gray-700">
              <tr>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-user tw-mr-2"></i>Supplier</th>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-building tw-mr-2"></i>Company Name</th>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-envelope tw-mr-2"></i>Company Email</th>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-circle-info tw-mr-2"></i>Status</th>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-calendar tw-mr-2"></i>Created Date</th>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-pen tw-mr-2"></i>Action</th>
              </tr>
            </thead>
            <tbody id="registrationRecords" class="tw-bg-white">
              @foreach ($registrations as $registration)

              <tr class="tw-border-b registration-row">
                <td class="tw-px-4 tw-py-2">{{ $registration->supplier->name }}</td>
                <td class="tw-px-4 tw-py-2">{{ $registration->company_name }}</td>
                <td class="tw-px-4 tw-py-2">{{ $registration->company_email }}</td>
                <td class="tw-px-4 tw-py-2">
                  @if ($registration->status === 'Pending')
                  <span class="tw-inline-block tw-bg-yellow-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $registration->status }}</span>
                  @elseif ($registration->status === 'Approved')
                  <span class="tw-inline-block tw-bg-green-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $registration->status }}</span>
                  @else
                  <span class="tw-inline-block tw-bg-red-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $registration->status }}</span>
                  @endif
                </td>
                <td class="tw-px-4 tw-py-2">{{ \Carbon\Carbon::parse($registration->created_at)->format('F j, Y') }}</td>
                <td class="tw-px-4 tw-py-2">
                  <a href="{{ route('view-approval', $registration->id) }}" class="tw-text-indigo-600 tw-underline">view</a>
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
          <hr>
        </div>
        <div class="tw-mt-6">
          <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Oversee Vendor Approvals and Monitor Onboarding Progress</h3>
          <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
            <p>This section allows you to view and monitor vendor approvals and onboarding progress. If a vendor's status is still pending, please wait for the admin to review their request.</p>
            <br>
            <p>To view more details about the vendor registration, click on the <a href="javascript:void(0)" class="tw-text-indigo-600 tw-underline">view</a> button.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-layout>