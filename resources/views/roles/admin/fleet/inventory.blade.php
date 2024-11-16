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
          Fleet Management
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          Vehicle Inventory
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade-up">
      <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vehicle Inventory</h2>

      <!-- Filter -->
      <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-mt-10">
        <div class="tw-relative tw-w-full md:tw-w-1/3 tw-mb-4 md:tw-mb-0">
          <i class="fa-solid fa-magnifying-glass tw-absolute tw-top-1/2 tw-left-2 tw-transform tw--translate-y-1/2 tw-text-gray-400"></i>
          <input type="text" placeholder="Search by name or model" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-pl-8 tw-w-full tw-shadow-sm" id="vehicleSearch">
        </div>

        <select id="statusFilter" class="tw-border tw-rounded-lg tw-px-3 tw-py-2 tw-w-full md:tw-w-1/3 tw-shadow-sm" onchange="filterVehicles()">
          <option value="">All Statuses</option>
          <option value="available">Available</option>
          <option value="in-use">In Use</option>
          <option value="maintenance">Maintenance</option>
        </select>
      </div>

      <div class="tw-flex tw-flex-row tw-items-center tw-justify-between" data-aos="fade">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-my-5">Vehicle List</h3>

        <a href="/admin/fleet/inventory/create" class="tw-inline-flex tw-items-center tw-text-blue-600 tw-font-bold tw-transition-all hover:tw-text-blue-500" title="Add a new vehicle to the inventory">
          <i class="fa-solid fa-plus tw-mr-2"></i>
          <span class="tw-hidden md:tw-inline">Add New Vehicle</span>
        </a>
      </div>

      <!-- Inventory List -->
      <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6 tw-mt-6" id="vehicleList">
        @if(count($vehicles) > 0)
        @foreach($vehicles as $vehicle)
        <div class="tw-border tw-rounded-lg tw-overflow-hidden tw-shadow-md vehicle-item"
          data-name="{{ strtolower($vehicle->name) }}"
          data-model="{{ strtolower($vehicle->model) }}">
          <img src="{{ asset('storage/' . $vehicle->image) }}" alt="Vehicle Image" class="tw-w-full tw-h-48 tw-object-cover">
          <div class="tw-p-4">
            <h3 class="tw-text-lg tw-font-semibold">
              {{ ucwords($vehicle->name) }}
              <span class="tw-text-sm tw-font-normal
                {{ $vehicle->status === 'available' ? 'tw-text-green-600' :
                ($vehicle->status === 'in-use' ? 'tw-text-yellow-400' : 'tw-text-red-600') }}">
                ({{ ucwords($vehicle->status) }})
              </span>
            </h3>
            <h1 class="tw-py-2">Vehicle Details:</h1>
            <div class="tw-text-gray-600 tw-indent-5">
              <p class="tw-text-sm tw-text-gray-600">Model: {{ $vehicle->model }}</p>
              <p class="tw-text-sm tw-text-gray-600">Color: {{ $vehicle->color }}</p>
              <p class="tw-text-sm tw-text-gray-600">License Plate: {{ $vehicle->license_plate }}</p>
              <p class="tw-text-sm tw-text-gray-600">Year: {{ $vehicle->year }}</p>
              <p class="tw-text-sm tw-text-gray-600">Status: {{ ucwords($vehicle->status) }}</p>
              <p class="tw-text-sm tw-text-gray-600">Condition: {{ ucwords($vehicle->condition) }}</p>
            </div>
            <div class="tw-mt-4 tw-flex tw-justify-end">
              <a href="{{ route('view-inventory', $vehicle->id) }}" class="tw-bg-indigo-600 tw-text-white tw-px-3 tw-py-1 tw-rounded-md hover:tw-bg-indigo-200">Edit</a>
            </div>
          </div>
        </div>
        @endforeach
        @else
        <div class="tw-bg-white tw-rounded-lg tw-p-6 tw-w-full tw-flex tw-items-center tw-justify-center tw-min-h-[200px]">
          <p class="tw-text-lg tw-font-semibold tw-text-center tw-text-gray-600">Currently, there are no vehicles available in the inventory.</p>
        </div>
        @endif
      </div>
      <br>
      <hr>

      <div class="tw-mt-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Add New Vehicle</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p class="tw-mb-2">Please fill out the form below to add a new vehicle to the inventory:</p>
          <p>To view your updated inventory, click <a href="/admin/fleet/inventory/create" class="tw-text-indigo-600 tw-underline">here</a>.</p>
        </div>
      </div>
    </div>
  </div>
</x-layout>

<script>
  // Function to filter vehicles based on search input and status
  const filterVehicles = () => {
    const query = document.getElementById('vehicleSearch').value.toLowerCase();
    const status = document.getElementById('statusFilter').value.toLowerCase();
    const vehicles = document.querySelectorAll('.vehicle-item');
    let visibleVehicles = 0;

    vehicles.forEach(vehicle => {
      const name = vehicle.getAttribute('data-name');
      const model = vehicle.getAttribute('data-model');
      const statusText = vehicle.querySelector('.tw-text-sm').textContent.toLowerCase();

      const matchesSearch = name.includes(query) || model.includes(query);
      const matchesStatus = status ? statusText.includes(status) : true;

      if (matchesSearch && matchesStatus) {
        vehicle.style.display = 'block';
        visibleVehicles++;
      } else {
        vehicle.style.display = 'none';
      }
    });

    const noResultsNote = document.querySelector('#no-results');
    if (visibleVehicles === 0) {
      if (!noResultsNote) {
        const note = document.createElement('p');
        note.classList.add('tw-text-center', 'tw-text-sm', 'tw-text-gray-600', 'tw-mt-4');
        note.id = 'no-results';
        note.textContent = 'No vehicles found. Try searching with a different keyword or filter.';
        document.getElementById('vehicleList').appendChild(note);
      }
    } else {
      if (noResultsNote) {
        noResultsNote.remove();
      }
    }
  };

  // Event listener for search input
  document.getElementById('vehicleSearch').addEventListener('input', filterVehicles);

  // Event listener for the status filter
  document.getElementById('statusFilter').addEventListener('change', filterVehicles);
</script>