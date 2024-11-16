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
          Create Vehicle Inventory
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade-up">
      <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Create Vehicle Inventory</h2>

      <!-- Form -->
      <form action="{{ route('store-inventory', $admin->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="tw-bg-red-100 tw-border-l-4 tw-border-red-500 tw-p-4 tw-my-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="tw-flex tw-flex-col tw-gap-6 tw-mt-6" data-aos="fade">
        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="name" class="tw-text-sm tw-text-gray-600">Vehicle Name:</label>
            <input type="text" id="name" name="name" placeholder="e.g. Toyota Corolla 2022" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm" required>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="model" class="tw-text-sm tw-text-gray-600">Vehicle Model:</label>
            <input type="text" id="model" name="model" placeholder="e.g. Corolla" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm" required>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="color" class="tw-text-sm tw-text-gray-600">Vehicle Color:</label>
            <input type="text" id="color" name="color" placeholder="e.g. Black" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm" required>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="year" class="tw-text-sm tw-text-gray-600">Vehicle Year:</label>
            <input type="number" id="year" name="year" placeholder="e.g. 2022" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm" required>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="license_plate" class="tw-text-sm tw-text-gray-600">License Plate:</label>
            <input type="text" id="license_plate" name="license_plate" placeholder="e.g. 123456" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm" required>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="image" class="tw-text-sm tw-text-gray-600">Vehicle Image:</label>
            <input type="file" id="image" name="image" placeholder="Upload Vehicle Image" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm" required>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="status" class="tw-text-sm tw-text-gray-600">Vehicle Status:</label>
            <select id="status" name="status" class="tw-border tw-rounded-lg tw-px-3 tw-py-2 tw-w-full tw-shadow-sm" required>
                <option value="available">Available</option>
                <option value="in-use">In Use</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="condition" class="tw-text-sm tw-text-gray-600">Vehicle Condition:</label>
            <select id="condition" name="condition" class="tw-border tw-rounded-lg tw-px-3 tw-py-2 tw-w-full tw-shadow-sm" required>
                <option value="good">Good</option>
                <option value="fair">Fair</option>
                <option value="poor">Poor</option>
            </select>
        </div>
    </div>

    <div class="tw-flex tw-justify-end tw-mt-6">
        <button type="submit" class="tw-bg-indigo-600 tw-text-white tw-px-3 tw-py-1 tw-rounded-md hover:tw-bg-indigo-700">Create</button>
    </div>
</form>

    </div>
  </div>
</x-layout>
