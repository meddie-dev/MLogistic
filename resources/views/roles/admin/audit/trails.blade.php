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
          Trails
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        Audit Trails
      </div>
      <div class="card-body">
        <div class="tw-overflow-x-auto">
          <table class="tw-w-full tw-bg-white tw-rounded-md tw-shadow-md tw-my-4" id="datatablesSimple">
            <thead class="tw-bg-gray-200 tw-text-gray-700">
              <tr>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-hashtag tw-mr-2"></i>Name</th>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-user tw-mr-2"></i>Email</th>
                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-pen tw-mr-2"></i>Action</th>
              </tr>
            </thead>
            <tbody id="auditRecords" class="tw-bg-white">
              <!-- Example entry -->
              @foreach($suppliers as $supplier)
              <tr>
                <td class="tw-px-4 tw-py-2">{{ $supplier->name }}</td>
                <td class="tw-px-4 tw-py-2">{{ $supplier->email }}</td>
                <td class="tw-px-4 tw-py-2"><a href="{{ route('view-trails', $supplier->user_id) }}" class="tw-text-blue-500 hover:tw-underline">view</a></td>
              </tr>
              @endforeach
              <!-- More audit trail entries -->
            </tbody>
          </table>
          <hr>
        </div>
        <div class="tw-mt-6" data-aos="fade-up">
          <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Explore System Activities and Logs</h3>
          <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
            <p>Use this section to monitor and track system activities with detailed logs. Understanding the actions and events within the system will help ensure accountability and security.</p>
            <br>
            <p>For more detailed information, examine individual log entries above.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-layout>