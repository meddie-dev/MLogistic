<x-client-layout>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1>Fraud Prevention Monitor</h1>
          @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          @endif
        </div>
      </div>

      <!-- Filter Form -->
      <div class="row mt-4">
        <div class="col-12">
          <form method="GET" action="{{ url()->current() }}">
            <div class="form-row align-items-center">
              <div class="col-auto">
                <input type="text" class="form-control mb-2" name="user_id" placeholder="Filter by User ID" value="{{ request()->query('user_id') }}">
              </div>
              <div class="col-auto ml-auto">
                <button type="submit" class="btn btn-primary mb-2">Filter</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary mb-2 ml-2">Show All</a>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12">
        <h5>Fraud Data ({{ collect($fraudData)->where('is_fraud', 1)->count() }} records marked as fraud)</h5>        </div>
      </div>

      <!-- Table for Fraud Data -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="table-responsive">
          @if (!empty($fraudData) && count($fraudData) > 0)
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>User ID</th>
                <th>Event</th>
                <th>IP Address</th>
                <th>Fraud Detected</th>
                <th>Fraud Likelihood</th>
                <th>Rounded Likelihood</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fraudData as $data)
                @if (empty(request()->query('user_id')) || request()->query('user_id') == $data['user_id'])
                <tr class="{{ intval($data['fraud_likelihood'] ?? 0) >= 90 ? 'table-danger' : (intval($data['fraud_likelihood'] ?? 0) >= 50 ? 'table-warning' : '') }}">
                  <td>{{ $data['user_id'] ?? 'N/A' }}</td>
                  <td>{{ $data['event'] ?? 'N/A' }}</td>
                  <td>{{ $data['ip_address'] ?? 'N/A' }}</td>
                  <td>{{ ($data['is_fraud'] ?? 'N/A') == '1' ? 'Yes' : 'No' }}</td>
                  <td>{{ $data['fraud_likelihood'] ?? 'N/A' }}</td>
                  <td>{{ intval($data['fraud_likelihood'] ?? 0) }}%</td>
                  <td>{{ $data['created_at'] ?? 'N/A' }}</td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
          @else
          <div class="alert alert-warning">
            No fraud data available.
          </div>
          @endif

          <!-- Note when no data found -->
          @if (empty($fraudData) || count($fraudData) === 0)
          <div class="alert alert-info mt-4">
            Please check back later or adjust your search criteria.
          </div>
          @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</x-client-layout>


