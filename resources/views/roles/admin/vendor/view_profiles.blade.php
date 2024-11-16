<x-layout>
  <div class="container-fluid px-4 tw-my-10">
    <!-- Breadcrumb -->
    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
        <x-breadcrumb href="/admin/dashboard" :active="false" :isLast="false">
          <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>

        <x-breadcrumb href="/admin/vendor/approval" :active="false" :isLast="false">
          Vendor Approval
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          {{ $profile->vendor_name }}
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        Vendor Approval - {{ $profile->vendor_name }}
      </div>
      <div class="tw-flex tw-flex-col tw-space-y-4 tw-mb-6">

        <div class="tw-flex tw-items-center tw-justify-between">
          <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">
            {{ $profile->vendor_name }}

            @php
            $currentDate = now();
            $lastLoginDate = $supplier->last_login_at;
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

          </h4>

        </div>
        <div class="tw-flex tw-items-center tw-justify-between">
          <p class="tw-text-sm tw-font-semibold tw-text-gray-800">{{ $profile->bio }}</p>
        </div>
        <div class="tw-flex tw-items-center tw-space-x-2">
          <i class="fa-solid fa-building tw-text-gray-500"></i>
          <span class="tw-text-gray-700">{{ $profile->business_address }}</span>
        </div>
        <div class="tw-flex tw-items-center tw-space-x-2">
          <i class="fa-solid fa-envelope tw-text-gray-500"></i>
          <span class="tw-text-gray-700">{{ $profile->contact_email }}</span>
        </div>
        <div class="tw-flex tw-items-center tw-space-x-2">
          <i class="fa-solid fa-user-tie tw-text-gray-500"></i>
          <span class="tw-text-gray-700">{{ $profile->contact_person }}</span>
        </div>
        <div class="tw-flex tw-items-center tw-space-x-2">
          <i class="fa-solid fa-phone tw-text-gray-500"></i>
          <span class="tw-text-gray-700">{{ $profile->contact_phone }}</span>
        </div>
        <div class="tw-flex tw-items-center tw-space-x-2">
          @if ($profile->id)
          <i class="fa-solid fa-check-circle tw-text-green-500"></i>
          @else
          <i class="fa-solid fa-times-circle tw-text-red-500"></i>
          @endif
          <span class="tw-text-gray-700">
            {{ $profile->id ? 'Verified' : 'Not Verified' }}
          </span>
        </div>
      </div>
      <hr>
      <div class="tw-mt-6" data-aos="fade-up">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Review and Update Vendor Profile</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p>In this section, you can review your vendor profile details, including status, bio, business address, and contact information. Update any details as necessary to ensure your profile is accurate and up-to-date.</p>
          <br>
          <p>To make updates, contact the supplier directly using the email address provided above.</p>
        </div>
      </div>

      <div class="tw-flex tw-justify-end tw-mb-6">
        <a
          href="/admin/vendor/profiles"
          class="tw-font-bold tw-py-2 tw-px-4 tw-rounded-md tw-text-sm tw-bg-blue-500 hover:tw-bg-blue-300 tw-text-white">
          Return
        </a>
      </div>
    </div>

  </div>
</x-layout>