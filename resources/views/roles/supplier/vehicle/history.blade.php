<x-layout>
  <div class="container-fluid px-4  tw-my-10">
    <!-- Breadcrumb -->
    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
        <x-breadcrumb href="/supplier/dashboard" :active="false" :isLast="false">
          <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>

        <x-breadcrumb href="#" :active="true" :isLast="false">
          Vehicle Reservations
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          Reservation History
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6 " data-aos="fade-up">
      <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vehicle Reservation History</h2>

      <div class="tw-mt-6">
        @php
        $currentYear = \Carbon\Carbon::now()->year;
        $groupedReservations = $reservations->groupBy(function($reservation) use ($currentYear) {
        return \Carbon\Carbon::parse($reservation->reservation_date)->year == $currentYear ? 'Current Year' : \Carbon\Carbon::parse($reservation->reservation_date)->format('Y');
        })->sortKeysDesc();
        @endphp

        @foreach ($groupedReservations as $year => $yearReservations)
        <div class="tw-mb-6 sm:tw-mb-8 md:tw-mb-10 lg:tw-mb-12 xl:tw-mb-16">
          <h3 class="tw-text-lg sm:tw-text-xl md:tw-text-2xl lg:tw-text-3xl xl:tw-text-4xl tw-font-semibold tw-mb-4 md:tw-mb-6 lg:tw-mb-8 xl:tw-mb-10">{{ $year }}</h3>
          <div class="tw-overflow-x-auto">
            <table class="tw-w-full tw-table-auto">
              <thead>
                <tr>
                  <th class="tw-w-1/12 tw-text-left tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10" style="width: 10%">Reservation Date</th>
                  <th class="tw-w-3/12 tw-text-left tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10" style="width: 30%">Vehicle Name</th>
                  <th class="tw-w-2/12 tw-text-left tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10" style="width: 20%">Purpose</th>
                  <th class="tw-w-1/12 tw-text-left tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10" style="width: 15%">Status</th>
                  <th class="tw-w-2/12 tw-text-left tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10" style="width: 25%">Time</th>
                </tr>
              </thead>
              <tbody>
                @php
                $monthGroupedReservations = $yearReservations->groupBy(function($reservation) {
                return \Carbon\Carbon::parse($reservation->reservation_date)->format('F');
                });
                @endphp
                @foreach ($monthGroupedReservations as $month => $monthReservations)
                <tr>
                  <td colspan="5" class="tw-px-4 tw-py-2 tw-bg-gray-100 tw-font-semibold">{{ $month }}</td>
                </tr>
                @foreach ($monthReservations as $reservation)
                <tr>
                  <td class="tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M, Y') }}</td>
                  <td class="tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10">{{ $reservation->vehicle_name }}</td>
                  <td class="tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10">{{ $reservation->purpose }}</td>
                  <td class="tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10">{{ $reservation->status }}</td>
                  <td class="tw-px-4 tw-py-2 md:tw-px-6 lg:tw-px-8 xl:tw-px-10">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('h:i A') }}</td>
                </tr>
                @endforeach
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endforeach
      </div>

      @if ($reservations->count() == 0)
      <div class="tw-text-center tw-my-10">
        <h2 class="tw-text-2xl tw-font-bold tw-text-gray-200 tw-text-center">No Vehicle Reservations Found</h2>
      </div>
      @endif

      <hr>

      <div class="tw-mt-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Update Reservation History</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p>Please provide the necessary details to update a vehicle reservation history, including any changes made.</p> <br>
          <p>To view your updated reservations, click <a href="{{ route('view-status') }}" class="tw-text-indigo-600 tw-underline">here</a>.</p>
        </div>
      </div>
    </div>

  </div>
</x-layout>