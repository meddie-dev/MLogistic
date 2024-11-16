<x-layout>
  <div class="container-fluid px-4  tw-my-10">
    <!-- Breadcrumb -->
    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse ">
        <x-breadcrumb href="/supplier/dashboard" :active="false" :isLast="false">
          <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>

        <x-breadcrumb href="#" :active="true" :isLast="false">
          Vehicle Reservations
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          Reservation Request
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6" data-aos="fade-up">
      <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vehicle Reservation Request</h2>


      <!-- Reservation Form -->
      <form id="reservationForm" action="{{ route('store-reservation', $supplier->id) }}" method="POST" class="tw-mt-6">
        @csrf
        <!-- Reservation Date -->
        <div class="tw-flex tw-w-full  tw-gap-6">
          <!-- Reservation Date -->
          <div class="tw-mb-4 tw-w-full" id="calendar">
            <input type="hidden" name="reservation_date" id="reservation_date">
          </div>
        </div>

        <!-- Vehicle Name -->
        <div class="tw-mb-4">
          <label for="vehicleName" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Vehicle Name</label>
          <input type="text" id="vehicleName" name="vehicle_name" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter vehicle name" required>
        </div>

        <!-- Reservation Purpose -->
        <div class="tw-mb-4">
          <label for="purpose" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Purpose of Reservation</label>
          <input type="text" id="purpose" name="purpose" class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" placeholder="Enter purpose for reservation" required>
        </div>

        <!-- Request Reservation Button -->
        <div class="tw-mb-6">
          <button type="submit" class="tw-w-full tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-shadow-md hover:tw-bg-indigo-700">Request Vehicle Reservation</button>
        </div>
        <hr>
      </form>
      <div class="tw-mt-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Request Vehicle Reservation</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p>Please provide the necessary details to request a vehicle reservation, including the purpose and vehicle name.</p> <br>
          <p>To view your existing reservations, click <a href="{{ route('view-status') }}" class="tw-text-indigo-600 tw-underline">here</a>.</p>
        </div>
      </div>
    </div>
  </div>


</x-layout>

<script>
  // Pass PHP data as a JavaScript variable
  const existingReservations = <?php echo json_encode($reservations); ?>;
</script>