<x-layout>
  <div class="container-fluid px-4  tw-my-10">
    <!-- Breadcrumb -->
    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
        <x-breadcrumb href="/admin/dashboard" :active="false" :isLast="false">
          <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>

        <x-breadcrumb href="" :active="true" :isLast="false">
          Vehicle
        </x-breadcrumb>

        <x-breadcrumb href="/admin/vehicle/scheduling" :active="false" :isLast="false">
          Scheduling
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          {{$supplier->name}}
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
        View Scheduling
      </div>
      <div class="tw-flex tw-flex-col tw-space-y-4 tw-mb-6">
        @foreach ($supplier->profiles as $profile)
        <div class="tw-flex tw-items-center tw-justify-between">
          <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">
            {{ $profile->vendor_name ?? 'N/A' }}
            <span class="tw-text-sm tw-font-normal tw-text-gray-500">({{ $supplier->email }})</span>
          </h4>
        </div>

        <div class="tw-flex tw-items-center tw-justify-between">
          <textfield class="tw-text-sm tw-font-semibold tw-text-gray-800">
            {{ $profile->bio ?? 'N/A' }}
          </textfield>
        </div>

        <hr class="tw-my-4"> <!-- Separator for each profile -->
        @endforeach
      </div>
      <div id="calendar"></div>
      <div class="tw-overflow-x-auto">
        <table class="tw-w-full tw-bg-white tw-rounded-md tw-shadow-md tw-my-4" id="datatablesSimple">
          <thead class="tw-bg-gray-200 tw-text-gray-700">
            <tr>
              <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-hashtag tw-mr-2"></i>ID</th>
              <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-car tw-mr-2"></i>Vehicle</th>
              <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-file-pen tw-mr-2"></i>Purpose</th>
              <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-calendar tw-mr-2"></i>Scheduled Date</th>
              <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-circle-info tw-mr-2"></i>Status</th>
              <th class="tw-px-4 tw-py-2 tw-text-center" colspan="2"><i class="fa-solid fa-wrench tw-mr-2"></i>Action</th>
            </tr>
          </thead>
          <tbody id="reservationRecords" class="tw-bg-white">
            @foreach ($supplier->vehicleReservations as $reservation)
            <tr class="tw-border-b reservation-row">
              <td class="tw-px-4 tw-py-2 id">{{ $loop->iteration }}</td>
              <td class="tw-px-4 tw-py-2">{{ $reservation->vehicle_name }}</td>
              <td class="tw-px-4 tw-py-2">{{ $reservation->purpose }}</td>
              <td class="tw-px-4 tw-py-2">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F j, Y') }}</td>
              <td class="tw-px-4 tw-py-2 ">
                @if ($reservation->status === 'Approved')
                <span class="tw-inline-block tw-bg-green-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $reservation->status }}</span>
                @elseif ($reservation->status === 'Pending')
                <span class="tw-inline-block tw-bg-yellow-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $reservation->status  }}</span>
                @else
                <span class="tw-inline-block tw-bg-red-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $reservation->status}}</span>
                @endif
              </td>
              <td class="tw-px-2 tw-py-2 tw-text-center">
                <!-- Approve button and form -->
                <button type="submit" form="approve-form-{{ $reservation->id }}" class="tw-cursor-pointer tw-text-green-500 tw-text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve">
                  <i class="fa-solid fa-check"></i>
                </button>
                <form action="{{ route('approve-scheduling', $reservation->id) }}" method="POST" id="approve-form-{{ $reservation->id }}" class="tw-hidden">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="status" value="Approved">
                </form>
              </td>

              <td class="tw-px-2 tw-py-2 tw-text-center">
                <!-- Cancel button and form -->
                <button type="submit" form="cancel-form-{{ $reservation->id }}" class="tw-cursor-pointer tw-text-red-500 tw-text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                  <i class="fa-solid fa-ban"></i>
                </button>
                <form action="{{ route('cancel-scheduling', $reservation->id) }}" method="POST" id="cancel-form-{{ $reservation->id }}" class="tw-hidden">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="status" value="Cancelled">
                </form>
              </td>

            </tr>
            @endforeach
            <form action="{{ route('approve-scheduling', $reservation->id) }}" class="tw-hidden" method="POST" id="update-status">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="Approved">
            </form>
            <form action="{{ route('cancel-scheduling', $reservation->id) }}" class="tw-hidden"
              method="POST" id="reject-status">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="Cancelled">
            </form>
          </tbody>
        </table>
        <hr>

      </div>
      <div class="tw-mt-6" data-aos="fade-up">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Manage Vehicle Bookings</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p>Oversee and manage vehicle bookings. Gaining insights into each vendor’s history and performance will support you in making well-informed project assignments.</p> <br>
          <p>Note: You can make changes to the booking details by clicking on the ', approve by clicking ' <span class="tw-text-green-500">✓ Approved</span>', or cancel by clicking '<span class="tw-text-red-500">✗ Cancelled</span>'.
          </p>
        </div>
      </div>

    </div>

  </div>
</x-layout>