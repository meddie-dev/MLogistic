<x-layout>
  <div class="container-fluid px-4 tw-my-10">
    <!-- Breadcrumb -->
    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
        <x-breadcrumb href="/admin/dashboard" :active="false" :isLast="false">
          <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>

        <x-breadcrumb href="#" :active="true" :isLast="false">
          Audit
        </x-breadcrumb>

        <x-breadcrumb href="/admin/audit/reporting" :active="false" :isLast="false">
          Reporting
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          {{ $suppliers->name }}
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center ">
        Audit Reporting
      </div>
      <div class="card-body">
        <div class="tw-overflow-x-auto">
          <div class="tw-mt-2 tw-flex tw-flex-col tw-space-y-6" data-aos="fade">
            <div class="tw-mt-6 tw-space-y-6" data-aos="fade">
              <div class="tw-p-5 tw-space-y-6">
                <!-- Supplier Name and Email -->
                <div class="tw-flex tw-items-baseline tw-space-x-2">
                  <h4 class="tw-text-xl tw-font-semibold tw-text-gray-800">
                    {{ $suppliers->name }}
                  </h4>
                  @php
                  $currentDate = now();
                  $lastLoginDate = $suppliers->last_login_at;
                  $daysSinceLastLogin = $lastLoginDate ? (int) abs($currentDate->diffInDays($lastLoginDate)) : null;
                  @endphp

                  <!-- Show Last Login Status -->
                  @if (!is_null($daysSinceLastLogin))
                  <span class="badge bg-{{ $daysSinceLastLogin === 0 ? 'success' : 'danger' }}">
                    {{ $daysSinceLastLogin === 0 ? 'Active' :'Inactive: ' . $daysSinceLastLogin . ' days since last login' }}
                  </span>
                  @else
                  <span class="badge bg-warning">Last Login: N/A</span>
                  @endif
                </div>

                <!-- Business Info -->
                <div class="tw-space-y-4">
                  <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-building tw-text-gray-500"></i>
                    <p class="tw-text-sm tw-text-gray-600">
                      <span class="tw-font-semibold">Business Name:</span> {{ $profiles->first()->vendor_name }}
                    </p>
                  </div>
                  <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-map-marker-alt tw-text-gray-500"></i>
                    <p class="tw-text-sm tw-text-gray-600">
                      <span class="tw-font-semibold">Business Address:</span> {{ $profiles->first()->business_address }}
                    </p>
                  </div>
                </div>

                <!-- Contact Info -->
                <div class="tw-space-y-4">
                  <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-user-tie tw-text-gray-500"></i>
                    <p class="tw-text-sm tw-text-gray-600">
                      <span class="tw-font-semibold">Contact Person:</span> {{ $profiles->first()->contact_person }}
                    </p>
                  </div>
                  <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-envelope tw-text-gray-500"></i>
                    <p class="tw-text-sm tw-text-gray-600">
                      <span class="tw-font-semibold">Contact Email:</span> {{ $profiles->first()->contact_email }}
                    </p>
                  </div>
                  <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-phone-alt tw-text-gray-500"></i>
                    <p class="tw-text-sm tw-text-gray-600">
                      <span class="tw-font-semibold">Contact Phone:</span> {{ $profiles->first()->contact_phone }}
                    </p>
                  </div>
                </div>

                <!-- Bio -->
                <div class="tw-flex tw-items-center tw-space-x-2">
                  <i class="fa-solid fa-file-alt tw-text-gray-500"></i>
                  <p class="tw-text-sm tw-text-gray-600">
                    <span class="tw-font-semibold">Bio:</span> {{ $profiles->first()->bio }}
                  </p>
                </div>

                <!-- Created & Updated Dates -->
                <div class="tw-flex tw-items-center tw-space-x-4">
                  <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-calendar tw-text-gray-500"></i>
                    <span class="tw-text-sm tw-text-gray-600">
                      Created At: {{ $profiles->first()->created_at->format('F j, Y') }}
                    </span>
                  </div>
                  <div class="tw-flex tw-items-center tw-space-x-2">
                    <i class="fa-solid fa-calendar-check tw-text-gray-500"></i>
                    <span class="tw-text-sm tw-text-gray-600">
                      Updated At: {{ $profiles->first()->updated_at->format('F j, Y') }}
                    </span>
                  </div>
                </div>
              </div>
              <h1 class="tw-text-xl tw-font-bold tw-text-gray-400 tw-p-5">Audit Reports:</h1>

              <div class="tw-flex tw-flex-col tw-p-6 tw-gap-4 tw-transition hover:shadow-xl hover:bg-gray-200">
                <!-- Report Folder with Download Action -->
                <div class="tw-flex tw-items-center tw-justify-between tw-bg-white tw-p-4 tw-rounded-md tw-shadow-md hover:shadow-xl hover:bg-gray-50 cursor-pointer">
                  <div class="tw-text-sm tw-font-semibold tw-text-gray-600">
                    <i class="fa-solid fa-folder tw-text-xl tw-text-gray-600 tw-mr-3"></i>
                    <span class="tw-text-gray-800">Activity Log:</span>
                  </div>
                  <a href="{{ route('activity.csv', ['user_id' => $suppliers->user_id]) }}" class="tw-text-green-600 hover:tw-text-green-800 tw-text-sm"><span class="tw-underline tw-flex tw-justify-end">Download</span>
                  </a>
                </div>
                <div class="tw-flex tw-items-center tw-justify-between tw-bg-white tw-p-4 tw-rounded-md tw-shadow-md hover:shadow-xl hover:bg-gray-50 cursor-pointer">
                  <div class="tw-text-sm tw-font-semibold tw-text-gray-600">
                    <i class="fa-solid fa-folder tw-text-xl tw-text-gray-600 tw-mr-3"></i>
                    <span class="tw-text-gray-800">Vechicle Log:</span>
                  </div>
                  <a href="{{ route('reservation.csv', $suppliers->user_id) }}" class="tw-text-green-600 hover:tw-text-green-800 tw-text-sm"><span class="tw-underline tw-flex tw-justify-end">Download</span>
                  </a>
                </div>
              </div>
            </div>

            <hr>
          </div>
        </div>
        <div class="tw-mt-6" data-aos="fade-up">
          <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Review Supplier Information and Audit Reports</h3>
          <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
            <p>Use this section to review the supplier details, including business name, contact information, and last login status. This information provides key insights into the supplier’s engagement and activity.</p>
            <br>
            <p>Additionally, you can download the audit report for a comprehensive overview of past actions and audit reports related to this supplier.</p>
          </div>
        </div>

      </div>
    </div>
</x-layout>