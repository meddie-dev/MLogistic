<x-layout>
  <div class="container-fluid tw-my-10 px-4">

    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
        <x-breadcrumb href="/supplier/dashboard" :active="true" :isLast="true">
          <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-my-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <div>
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mb-4">Hi, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}!</h3>

        <p class="tw-text-sm tw-text-gray-500  tw-indent-14 max-sm:tw-line-clamp-3"> Welcome to Supplier Dashboard! This page provides an overview of your vendor profile and registration status. You can edit your profile details and keep your information up-to-date to ensure your vendor registration is active. If you have any questions or need any assistance, please don't hesitate to reach out to us. We're here to help! </p>
      </div>
    </div>


    <div class="row" data-aos="fade">
      <div class="col-xl-6" data-aos="fade-right" >
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-file-upload me-1"></i>
            <b>Reservation Calendar:</b> Vehicle Reservations
          </div>
          <div class="card-body">
            <div id="dashboardCalendar"></div>
          </div>
        </div>
      </div>
      <div class="col-xl-6" data-aos="fade-left" >
        <div class="card mb-4">

          <div class="card-header">
            <i class="fas fa-chart-area me-1"></i>
            <b>Reservation Status:</b> Count of Reservations
          </div>
          <div class="chart-container tw-bg-white">
            <canvas id="reservationStatusChart" width="300" height="200"></canvas>
            <script>
              // Define status labels and counts passed from the controller
              const statuses = ['Pending', 'Approved', 'Cancelled'];
              const statusCounts = @json($statusCounts); // Counts of reservations for each status
              const ctx = document.getElementById('reservationStatusChart').getContext('2d');

              const reservationStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                  labels: statuses,
                  datasets: [{
                    label: 'Reservation Status Counts',
                    data: Object.values(statusCounts),
                    backgroundColor: [
                      'rgba(255, 159, 64, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                      'rgba(255, 159, 64, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {
                  responsive: true, // Makes the chart responsive
                  maintainAspectRatio: false, // Allows the chart to resize without maintaining aspect ratio
                  plugins: {
                    legend: {
                      position: 'top', // Position of the legend
                    },
                  },
                }
              });
            </script>
          </div>

        </div>
      </div>
    </div>

    <!-- Document Upload History -->
    <div class="card mb-4" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
      <div class="card-header">
        <i class="fas fa-file-upload me-1"></i>
        Document Upload History
      </div>
      <div class="card-body">
        <table id="datatablesSimple" class="table">
          <thead>
            <tr>
              <th>Document Name</th>
              <th>Uploaded At</th>
              <th>Time</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($documents as $document)
            <tr>
              <td>{{ $document->document_type }}</td>
              <td>{{ $document->created_at->format('M d, Y') }}</td>
              <td>{{ $document->created_at->setTimezone('Asia/Manila')->format('h:i A') }}</td>
              <td><a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="tw-text-indigo-600 tw-text-sm tw-font-medium tw-underline">View File</a>
              </td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>

</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('dashboardCalendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev',
        center: 'title',
        right: 'next'
      },
      contentHeight: 145,
      initialView: 'listWeek',
      events: [
        @foreach($reservation as $reservations) {
          title: '{{ $reservations->vehicle_name }}',
          start: '{{ $reservations->reservation_date }}',
          color: '{{ $reservations->status == "Approved" ? "green" : ($reservations->status == "Pending" ? "yellow" : "red") }}',
          extendedProps: {
            status: '{{ $reservations->status }}'
          }
        },
        @endforeach
      ],
    });
    calendar.render();
  });
</script>