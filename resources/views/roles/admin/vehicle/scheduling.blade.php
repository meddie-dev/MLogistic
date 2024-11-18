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
          Vehicle Reservation
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          Scheduling
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        Vehicle Scheduling
      </div>
      <div class="card-body">
        <div class="tw-overflow-x-auto">
          <table class="tw-w-full tw-bg-white tw-rounded-md tw-shadow-md tw-my-4" id="datatablesSimple">
            <thead class="tw-bg-gray-200 tw-text-gray-700">
              <tr>
                <th class="tw-px-4 tw-py-2">ID</th>
                <th class="tw-px-4 tw-py-2">Supplier Name</th>
                <th class="tw-px-4 tw-py-2">Created Date</th>
                <th class="tw-px-4 tw-py-2">Time</th>
                <th class="tw-px-4 tw-py-2">Email</th>
                <th class="tw-px-4 tw-py-2">Status</th>
                <th class="tw-px-4 tw-py-2">Action</th>
              </tr>
            </thead>
            <tbody id="reservationRecords" class="tw-bg-white">
              @foreach ($supplier as $suppliers)
              <tr>
                <td class="tw-px-4 tw-py-2">{{ $suppliers->id }}</td>
                <td class="tw-px-4 tw-py-2">{{ $suppliers->name }}</td>
                <td class="tw-px-4 tw-py-2">{{ $suppliers->created_at->timezone('Asia/Manila')->format('F j, Y') }}</td>
                <td class="tw-px-4 tw-py-2">{{ $suppliers->created_at->timezone('Asia/Manila')->format('g:i A') }}</td>
                <td class="tw-px-4 tw-py-2">{{ $suppliers->email }}</td>
                <td class="tw-px-4 tw-py-2">
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
                </td>

                <td>
                  @if ($suppliers->profiles->isNotEmpty())
                  <a href="{{ route('view-scheduling', $suppliers->user_id) }}" class="tw-text-blue-500 tw-underline">View</a>
                  @else
                  <span class="tw-text-gray-500">Not Verified</span>
                  @endif
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
        </div>
        <div class="tw-mt-6" data-aos="fade-up">
          <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Manage Vehicle Bookings</h3>
          <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
            <p>Oversee and manage vehicle bookings. Gaining insights into each vendor’s history and performance will support you in making well-informed project assignments.</p>
            <br>
            <p>To view a vendor’s complete profile, simply click on view in the table above.</p>
          </div>
        </div>

      </div>
    </div>

  </div>
</x-layout>