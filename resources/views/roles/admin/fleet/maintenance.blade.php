<x-layout>
  <div class="container-fluid px-4 tw-my-10">
    <!-- Breadcrumb -->
    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
        <x-breadcrumb href="/supplier/dashboard" :active="false" :isLast="false">
          <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>

        <x-breadcrumb href="/supplier/fleet/maintenance" :active="true" :isLast="false">
          Fleet Management
        </x-breadcrumb>

        <x-breadcrumb href="/supplier/fleet/maintenance" :active="true" :isLast="true">
          Maintenance
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        Maintenance
      </div>

      <div class="card-body">
        <div class="tw-overflow-x-auto">
          <table class="tw-w-full tw-bg-white tw-rounded-md tw-shadow-md tw-my-4" id="datatablesSimple">
            <thead class="tw-bg-gray-200 tw-text-gray-700">
              <tr>
                <th class="tw-px-4 tw-py-2">ID</th>
                <th class="tw-px-4 tw-py-2">Vehicle Name</th>
                <th class="tw-px-4 tw-py-2">Model</th>
                <th class="tw-px-4 tw-py-2">Color</th>
                <th class="tw-px-4 tw-py-2">License Plate</th>
                <th class="tw-px-4 tw-py-2">Year Model</th>
                <th class="tw-px-4 tw-py-2">Status</th>
                <th class="tw-px-4 tw-py-2">Condition</th>
                <th class="tw-px-4 tw-py-2">Last Maintenance</th>
                <th class="tw-px-4 tw-py-2">Next Maintenance Due</th>
                <th class="tw-px-4 tw-py-2">Action</th>
              </tr>
            </thead>
            <tbody id="reservationRecords" class="tw-bg-white">
              @foreach ($vehicles as $vehicle)
                @php
                  // Calculate the difference in months since last maintenance or since the vehicle was created if no maintenance has been performed yet
                  $lastMaintenanceDate = $vehicle->last_maintenance ?: $vehicle->created_at;
                  $monthsSinceLastMaintenance = now()->diffInMonths($lastMaintenanceDate);

                  // Check if the next maintenance date is upcoming or overdue
                  if ($monthsSinceLastMaintenance >= 3) {
                    // Overdue maintenance
                    $vehicle->status = 'maintenance';
                    $vehicle->condition = 'poor';
                  } elseif ($monthsSinceLastMaintenance >= 1 && $monthsSinceLastMaintenance < 3) {
                    // Maintenance is upcoming
                    $vehicle->status = 'available';
                    $vehicle->condition = 'fair';
                  } else {
                    // Vehicle is in good condition and no maintenance is overdue
                    $vehicle->status = 'available';
                    $vehicle->condition = 'good';
                  }

                  // Save the vehicle if any status or condition changes
                  if ($vehicle->isDirty('status') || $vehicle->isDirty('condition')) {
                    $vehicle->save();
                  }
                @endphp
                <tr>
                  <td class="tw-px-4 tw-py-2">{{ $vehicle->id }}</td>
                  <td class="tw-px-4 tw-py-2">{{ $vehicle->name }}</td>
                  <td class="tw-px-4 tw-py-2">{{ $vehicle->model }}</td>
                  <td class="tw-px-4 tw-py-2">{{ $vehicle->color }}</td>
                  <td class="tw-px-4 tw-py-2">{{ $vehicle->license_plate }}</td>
                  <td class="tw-px-4 tw-py-2">{{ $vehicle->year }}</td>
                  <td class="tw-px-4 tw-py-2">
                    <span class="tw-font-bold
                      @if($vehicle->status == 'maintenance') tw-text-red-500 @endif
                      @if($vehicle->status == 'available') tw-text-green-500 @endif
                      @if($vehicle->status == 'in-use') tw-text-yellow-500 @endif">
                      {{ ucfirst($vehicle->status) }}
                    </span>
                  </td>
                  <td class="tw-px-4 tw-py-2">
                    <span class="tw-font-bold 
                      @if($vehicle->condition == 'poor') tw-text-red-500 @endif
                      @if($vehicle->condition == 'good') tw-text-green-500 @endif
                      @if($vehicle->condition == 'fair') tw-text-yellow-500 @endif">
                      {{ ucfirst($vehicle->condition) }}
                    </span>
                  </td>
                  <td class="tw-px-4 tw-py-2">
                    {{ $vehicle->last_maintenance ? \Carbon\Carbon::parse($vehicle->last_maintenance)->timezone('Asia/Manila')->format('F j, Y') : 'N/A' }}
                  </td>
                  <td class="tw-px-4 tw-py-2">
                    {{ $vehicle->next_maintenance_due ? \Carbon\Carbon::parse($vehicle->next_maintenance_due)->timezone('Asia/Manila')->format('F j, Y') : 'N/A' }}
                  </td>
                  <td class="tw-px-4 tw-py-2">
                    <form method="POST" action="{{ route('update-maintenance', $vehicle->id) }}">
                      @csrf
                      @method('PATCH')
                      @if($vehicle->condition == 'good' && $vehicle->status == 'available')
                        <span class=" tw-text-gray-500">
                           Well Maintained
                        </span>
                      @else
                        <button type="submit" class="tw-px-4 tw-py-2 tw-bg-blue-500 tw-text-white tw-rounded-md">
                          <i class="fa-solid fa-wrench"></i> Mark as Maintained
                        </button>
                      @endif
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
        </div>

        <div class="tw-mt-6" data-aos="fade-up">
  <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Update Vehicle Maintenance</h3>
  <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
    <p>In this section, you can review and update the maintenance history of your vehicles. Keeping track of each vehicle’s maintenance status and condition is essential for ensuring optimal performance and safety on the road.</p>
    <br>
    <p>To gain deeper insights into the maintenance needs of each vehicle, simply click on the corresponding actions in the table above.</p>
  </div>
</div>
      </div>
    </div>
  </div>
</x-layout>