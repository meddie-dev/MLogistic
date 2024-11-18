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
          Audit
        </x-breadcrumb>

        <x-breadcrumb href="/admin/audit/trails" :active="false" :isLast="false">
          Trails and Logs
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          {{ $supplier->name }}
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        Audit Trails and Logs
      </div>

      <div class="tw-flex tw-flex-col tw-space-y-6 tw-mb-6">
        <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">
          {{ $supplier->name }}
          <span class="tw-text-sm tw-font-normal tw-text-gray-500">({{ $supplier->email }})</span>
        </h4>

        <div class="tw-flex tw-items-center tw-space-x-2">
          <i class="fa-solid fa-calendar tw-text-gray-500"></i>
          <span class="tw-text-gray-700">
            {{ $supplier->created_at->timezone('Asia/Manila')->format('F j, Y \\a\\t g:i A') }}
          </span>
        </div>

        @php
        $uniqueIpCount = $uniqueIps->count();
        @endphp

        @if ($uniqueIpCount > 1)
        @if ($uniqueIpCount > 5)
        <div class="tw-flex tw-items-center tw-space-x-3 tw-bg-red-100 tw-px-4 tw-py-2 tw-rounded-lg tw-font-semibold tw-text-red-800 tw-border tw-border-red-200">
          <i class="fa-solid fa-exclamation-circle tw-text-red-800"></i>
          <span>{{ $uniqueIpCount }} different IP addresses</span>
        </div>
        @else
        <div class="tw-flex tw-items-center tw-space-x-3 tw-bg-yellow-100 tw-px-4 tw-py-2 tw-rounded-lg tw-font-semibold tw-text-yellow-800 tw-border tw-border-yellow-200">
          <i class="fa-solid fa-info-circle tw-text-yellow-800"></i>
          <span>{{ $uniqueIpCount }} different IP addresses</span>
        </div>
        @endif
        @else
        <div class="tw-flex tw-items-center tw-space-x-3 tw-bg-green-100 tw-px-4 tw-py-2 tw-rounded-lg tw-font-semibold tw-text-green-800 tw-border tw-border-green-200">
          <i class="fa-solid fa-check-circle tw-text-green-800"></i>
          <span>All IP addresses are the same</span>
        </div>
        @endif

        @if ($uniqueIpCount > 1)
        <a class="tw-cursor-pointer tw-text-blue-500 tw-underline tw-text-sm tw-font-semibold tw-mt-2 tw-transition-all tw-duration-300" onclick="document.getElementById('uniqueIpList').classList.toggle('tw-hidden')">
          View Unique IP Addresses
        </a>
        <ul id="uniqueIpList" class="tw-list-disc tw-ml-6 tw-mt-2 tw-text-gray-700 tw-hidden">
          @foreach ($uniqueIps as $ip)
          <li>{{ $ip }}</li>
          @endforeach
        </ul>
        @endif
      </div>

      <hr>

      <div class="tw-mt-6 tw-flex tw-flex-col tw-space-y-4" id="auditRecords" data-aos="fade">
        <div class="tw-flex tw-items-center tw-justify-between tw-mb-4">
          <div class="tw-flex tw-items-center">
            <label class="tw-block tw-text-sm tw-font-semibold tw-text-gray-800 tw-mr-2" for="event">Filter by Event:</label>
            <div class="tw-relative">
              <select class="tw-appearance-none tw-bg-white tw-border tw-border-gray-300 tw-rounded-lg tw-py-2 tw-pr-8 tw-pl-3 tw-text-gray-700 tw-shadow-sm focus:tw-outline-none focus:tw-ring focus:tw-ring-primary-500 focus:tw-border-primary-500" id="event">
                <option value="">All </option>
                <option value="login">Login</option>
                <option value="logout">Logout</option>
                <option value="view">View</option>
                <option value="create">Create</option>
                <option value="update">Update</option>
                <option value="delete">Delete</option>
              </select>
              <div class="tw-absolute tw-inset-y-0 tw-right-0 tw-flex tw-items-center tw-px-2 tw-pointer-events-none">
                <i class="fa-solid fa-chevron-down tw-text-gray-400"></i>
              </div>
            </div>
          </div>
          <div class="tw-flex tw-items-center">
            <label class="tw-block tw-text-sm tw-font-semibold tw-text-gray-800 tw-mr-2" for="ip_address">Filter by IP Address:</label>
            <input class="tw-appearance-none tw-bg-white tw-border tw-border-gray-300 tw-rounded-lg tw-py-2 tw-px-4 tw-text-gray-700 tw-shadow-sm focus:tw-outline-none focus:tw-ring focus:tw-ring-primary-500 focus:tw-border-primary-500" type="text" id="ip_address">
          </div>
        </div>
        @if ($authlogs->count() > 0)
        @foreach ($authlogs as $log)
        <div class="tw-relative tw-pl-8 tw-py-4 tw-border-l-4 tw-transition-all tw-duration-300 {{$log->ip_address != request()->ip() ? 'tw-border-red-500' : 'tw-border-green-500'}}">
          <div class="tw-absolute tw-left-0 tw-top-0 tw-transform tw-translate-x-[-50%] tw-translate-y-[-50%] {{$log->ip_address == request()->ip() ? 'tw-bg-green-500' : 'tw-bg-red-500'}} tw-rounded-full tw-h-4 tw-w-4 tw-transition-colors tw-duration-300"></div>
          <div class="tw-flex tw-items-center tw-justify-between tw-bg-gray-100 tw-rounded-lg tw-shadow-sm tw-px-4 tw-py-2">
            <div class="tw-text-sm tw-font-semibold tw-text-gray-800">User ID: {{$log->user_id}}</div>
            <div class="tw-flex-1 tw-text-center tw-text-sm tw-font-semibold tw-text-gray-800">{{ucwords($log->event)}}</div>
            <div class="tw-text-sm tw-font-normal tw-text-gray-600">{{\Illuminate\Support\Carbon::parse($log->created_at)->setTimezone('Asia/Manila')->format('M j, Y, g:i A')}}</div>
          </div>
          <div class="tw-text-sm tw-font-normal tw-text-gray-700 tw-mt-2 tw-ml-8 tw-pl-4 tw-border-l-2 tw-border-dotted tw-border-gray-300">
            <i class="fa-solid fa-map-marker-alt tw-text-gray-500 tw-mr-2"></i>{{$log->ip_address}}
          </div>
        </div>
        @endforeach
        @else
        <p class="tw-text-center tw-text-gray-600 tw-mt-6">No audit records found.</p>
        @endif
        <div class="tw-flex tw-justify-start tw-mt-4">
          <a href="/admin/audit/trails" class="tw-ml-3  tw-text-blue-500 tw-px-3 tw-py-1 tw-rounded-md ">Back</a>
        </div>
      </div>
      <br>
      <hr>
      <div class="tw-mt-6" data-aos="fade-up">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Monitor and Track Activities</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p>Use this section to monitor and track system activities with detailed logs. Understanding the actions and events within the system will help ensure accountability and security.</p>
          <br>
          <p>For more detailed information, examine individual log entries above.</p>
        </div>
      </div>
    </div>

  </div>
</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const eventSelect = document.getElementById('event');
    const ipAddressInput = document.getElementById('ip_address');

    const filterRecords = () => {
      const event = eventSelect.value.toLowerCase();
      const ipAddress = ipAddressInput.value.trim().toLowerCase();

      // Select all individual log entry containers
      const auditRecords = document.querySelectorAll('#auditRecords > div:not(.tw-flex)');

      let recordCount = 0;

      auditRecords.forEach(record => {
        // Locate event type and IP address elements within each log entry
        const eventType = record.querySelector('.tw-flex-1').textContent.trim().toLowerCase();
        const logIpAddress = record.querySelector('.tw-text-sm.tw-font-normal.tw-text-gray-700').textContent.trim().toLowerCase();

        // Match conditions
        const eventMatch = event === '' || eventType.includes(event);
        const ipAddressMatch = ipAddress === '' || logIpAddress.includes(ipAddress);

        // Toggle display based on match results
        record.style.display = eventMatch && ipAddressMatch ? 'block' : 'none';

        if (record.style.display === 'block') {
          recordCount++;
        }
      });

      const note = document.querySelector('#auditRecords > p');
      if (recordCount === 0) {
        if (!note) {
          const newNote = document.createElement('p');
          newNote.classList.add('tw-text-center', 'tw-text-gray-600', 'tw-mt-6');
          newNote.textContent = 'No audit records found.';
          document.getElementById('auditRecords').appendChild(newNote);
        }
      } else if (note) {
        note.remove();
      }
    };

    // Attach event listeners to the filters
    eventSelect.addEventListener('change', filterRecords);
    ipAddressInput.addEventListener('input', filterRecords);
  });
</script>