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

        <x-breadcrumb :active="true" :isLast="false">
          Edit Vehicle Inventory
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          {{$vehicle->name}} Details
        </x-breadcrumb>


      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade-up">
      <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Edit Vehicle Inventory</h2>

      <!-- Form -->
      <form action="{{ route('update-inventory', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="tw-flex tw-flex-col tw-gap-6 tw-mt-6" data-aos="fade">
          @foreach ($errors->all() as $error)
          <div class="tw-bg-red-100 tw-border tw-border-red-400 tw-rounded-lg tw-p-4 tw-mb-4">
            <strong class="tw-text-red-700">{{ $error }}</strong>
          </div>
          @endforeach

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="name" class="tw-text-sm tw-text-gray-600">Vehicle Name:</label>
            <input type="text" id="name" name="name" placeholder="e.g. Toyota Corolla 2022" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('name') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" value="{{ $vehicle->name }}" required>
          </div>

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="model" class="tw-text-sm tw-text-gray-600">Vehicle Model:</label>
            <input type="text" id="model" name="model" placeholder="e.g. Corolla" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('model') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" value="{{ $vehicle->model }}" required>
          </div>

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="color" class="tw-text-sm tw-text-gray-600">Vehicle Color:</label>
            <input type="text" id="color" name="color" placeholder="e.g. Black" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('color') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" value="{{ $vehicle->color }}" required>
          </div>

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="year" class="tw-text-sm tw-text-gray-600">Vehicle Year:</label>
            <input type="number" id="year" name="year" placeholder="e.g. 2022" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('year') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" value="{{ $vehicle->year }}" required>
          </div>

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="license_plate" class="tw-text-sm tw-text-gray-600">License Plate:</label>
            <input type="text" id="license_plate" name="license_plate" placeholder="e.g. 123456" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('license_plate') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" value="{{ $vehicle->license_plate }}" required>
          </div>

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="image" class="tw-text-sm tw-text-gray-600">Vehicle Image:</label>
            <input type="file" id="image" name="image" placeholder="Upload Vehicle Image" class="tw-border tw-rounded-lg tw-px-4 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('image') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" value="{{ $vehicle->image }}" required>
            <span class="tw-text-sm tw-text-gray-600">View Current Image - <a class="tw-text-blue-500" href="{{ asset('storage/' . $vehicle->image) }}" target="_blank" rel="noopener noreferrer">View Image</a></span>
          </div>

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="status" class="tw-text-sm tw-text-gray-600">Vehicle Status:</label>
            <select id="status" name="status" class="tw-border tw-rounded-lg tw-px-3 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('status') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" required>
              <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>Available</option>
              <option value="in-use" {{ $vehicle->status == 'in-use' ? 'selected' : '' }}>In Use</option>
              <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
          </div>

          <div class="tw-flex tw-flex-col tw-gap-3">
            <label for="condition" class="tw-text-sm tw-text-gray-600">Vehicle Condition:</label>
            <select id="condition" name="condition" class="tw-border tw-rounded-lg tw-px-3 tw-py-2 tw-w-full tw-shadow-sm {{ $errors->has('condition') ? 'tw-bg-red-50 tw-border-red-500' : '' }}" required>
              <option value="good" {{ $vehicle->condition == 'good' ? 'selected' : '' }}>Good</option>
              <option value="fair" {{ $vehicle->condition == 'fair' ? 'selected' : '' }}>Fair</option>
              <option value="poor" {{ $vehicle->condition == 'poor' ? 'selected' : '' }}>Poor</option>
            </select>
          </div>
        </div>

        <div class="tw-flex tw-justify-between tw-mt-6">
          <a href="{{ route('vehicle-inventory') }}" class="tw-ml-3  tw-text-blue-500 tw-px-3 tw-py-1 tw-rounded-md ">Cancel</a>
          <div>
            <button type="submit" class="tw-bg-indigo-600 tw-text-white tw-px-3 tw-py-1 tw-rounded-md hover:tw-bg-indigo-700">Update</button>
            <button type="submit" form="delete-form" class="tw-bg-red-600 tw-text-white tw-px-3 tw-py-1 tw-rounded-md hover:tw-bg-red-700">Delete</button>
          </div>
        </div>
      </form>
      <form action="{{ route('delete-inventory', $vehicle->id) }}" id="delete-form" class="hidden" method="POST">
        @csrf
        @method('DELETE')

      </form>
      <br>
      <hr>
      <div class="tw-mt-6" data-aos="fade-up">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Edit Vehicle Inventory</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p>Update the vehicle inventory details and other relevant information.</p> <br>
          <p>Note: Make sure to update the vehicle status and condition to reflect the current condition of the vehicle.</p>
        </div>
      </div>
    </div>
  </div>
</x-layout>