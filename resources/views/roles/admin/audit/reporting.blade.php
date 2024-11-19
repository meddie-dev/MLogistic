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

        <x-breadcrumb :active="true" :isLast="true">
          Reporting
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        Audit Reporting
      </div>
      <div class="card-body">
        <div class="tw-overflow-x-auto">
          <table class="tw-w-full tw-bg-white tw-rounded-md tw-shadow-md tw-my-4" id="datatablesSimple">
            <thead class="tw-bg-gray-200 tw-text-gray-700">
              <tr>
                <th class="tw-px-4 tw-py-2">User</th>
                <th class="tw-px-4 tw-py-2">Date</th>
                <th class="tw-px-4 tw-py-2">Status</th>
                <th class="tw-px-4 tw-py-2">Report</th>
              </tr>
            </thead>
            <tbody id="reportRecords" class="tw-bg-white">
              @foreach($suppliers as $report)
              <tr>
                <td class="tw-px-4 tw-py-2">{{ $report->name }}</td>
                <td class="tw-px-4 tw-py-2">{{ $report->created_at->format('F j, Y') }}</td>
                <td>
                  @php
                  $currentDate = now();
                  $lastLoginDate = $report->last_login_at;
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
                <td class="tw-px-4 tw-py-2"><a href="{{ route('view-reporting', $report->user_id) }}" class="tw-text-blue-500 hover:tw-underline">View report</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
        </div>
        <div class="tw-mt-6" data-aos="fade-up">
          <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Review System Reports and Statistics</h3>
          <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
            <p>Utilize this section to evaluate system reports and gain insights into operational statistics. Analyzing these reports will aid in optimizing performance and ensuring compliance.</p>
            <br>
            <p>For more detailed insights, examine individual report entries above.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-layout>