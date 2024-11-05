<x-layout>
    <div class="container tw-my-10">
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
                    View Status
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
            <div class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">
                Vehicle Reservations Status
            </div>
            <div class="card-body">
                <div class="tw-overflow-x-auto">
                    <table class="tw-w-full tw-bg-white tw-rounded-md tw-shadow-md tw-my-4" id="datatablesSimple">
                        <thead class="tw-bg-gray-200 tw-text-gray-700">
                            <tr>
                                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-hashtag tw-mr-2"></i>ID</th>
                                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-car tw-mr-2"></i>Vehicle</th>
                                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-file-pen tw-mr-2"></i>Purpose</th>
                                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-calendar tw-mr-2"></i>Scheduled Date</th>
                                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-circle-info tw-mr-2"></i>Status</th>
                                <th class="tw-px-4 tw-py-2"><i class="fa-solid fa-wrench tw-mr-2"></i>Action</th>
                            </tr>
                        </thead>
                        <tbody id="reservationRecords" class="tw-bg-white">
                            @foreach ($reservations as $reservation)
                            <tr class="tw-border-b reservation-row">
                                <td class="tw-px-4 tw-py-2 id">{{ $loop->iteration }}</td>
                                <td class="tw-px-4 tw-py-2">{{ $reservation->vehicle_name }}</td>
                                <td class="tw-px-4 tw-py-2">{{ $reservation->purpose }}</td>
                                <td class="tw-px-4 tw-py-2">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F j, Y') }}</td>
                                <td class="tw-px-4 tw-py-2 ">
                                    @if ($reservation->status === 'Approved')
                                    <span class="tw-inline-block tw-bg-green-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $reservation->status }}</span>
                                    @else
                                    <span class="tw-inline-block tw-bg-orange-500 tw-rounded-full tw-px-3 tw-py-1 tw-text-white tw-text-sm">{{ $reservation->status }}</span>
                                    @endif
                                </td>
                                <td class="tw-px-4 tw-py-2">
                                    @if ($reservation->status === 'Approved')
                                    <a href="" class="tw-text-green-500 hover:tw-text-green-700">View</a>
                                    @else
                                    <a href="{{ route('edit-reservation', $reservation->id) }}" class="tw-text-blue-500 hover:tw-text-blue-700">Edit</a>
                                    <form action="{{ route('delete-reservation', $reservation->id) }}" method="POST" class="tw-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this reservation?');" class="tw-text-red-500 hover:tw-text-red-700">Delete</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                </div>
                <div class="tw-mt-6">
                    <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Update Vehicle Reservation Status</h3>
                    <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
                        <p>This section allows you to view and monitor your vehicle reservation status. If your status is still pending, please wait for the admin to review your request.</p>
                        <br>
                        <p>To make a new vehicle reservation, click <a href="/supplier/vehicle/request" class="tw-text-indigo-600 tw-underline">here</a>.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layout>
