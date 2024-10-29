<x-layout>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Admin Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $userCount }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GRAPH -->
        <div class="row">
            <div class="col-xl-6">
                <!-- User Login Chart -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                       <b> Annual User Count Overview: </b> A 12-Month Analysis
                    </div>
                    <div class="chart-container">
                        <canvas id="userChart" width="400" height="200"></canvas>

                        <script>
                            const months = @json($months);
                            const userCounts = @json($userCounts);

                            const ctx = document.getElementById('userChart');
                            if (ctx) {
                                const userChart = new Chart(ctx.getContext('2d'), {
                                    type: 'line',
                                    data: {
                                        labels: months,
                                        datasets: [{
                                            label: 'Users',
                                            data: userCounts,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
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
                            } else {
                                console.error("Canvas element not found!");
                            }
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <!-- Role Data Chart -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                       <b> User Statistics:</b> Identifying Counts by Role
                    </div>

                    <div class="chart-container">
                        <canvas id="userRoleChart" width="400" height="200"></canvas>
                        <script>
                            const roles = @json($roles); // Roles passed from the controller
                            const roleCounts = @json($roleCounts); // Counts of users for each role
                            const rtx = document.getElementById('userRoleChart').getContext('2d');

                            const userRoleChart = new Chart(rtx, {
                                type: 'pie', // O 'pie' kung gusto mo ng pie chart
                                data: {
                                    labels: roles, // Labels for roles
                                    datasets: [{
                                        label: 'User Statistics: Identifying Counts by Role', // Dataset label
                                        data: roleCounts, // User counts by role
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)', // Color for Admin (Red)
                                            'rgba(54, 162, 235, 0.2)', // Color for Supplier (Blue)
                                            'rgba(255, 206, 86, 0.2)' // Color for Constructor (Yellow)
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)', // Border color for Admin (Red)
                                            'rgba(54, 162, 235, 1)', // Border color for Supplier (Blue)
                                            'rgba(255, 206, 86, 1)' // Border color for Constructor (Yellow)
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

        <!-- Users Table -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Create at</th>
                            <th>Update at</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Create at</th>
                            <th>Update at</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y/m/d') }}</td>
                            <td>{{ $user->updated_at->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>