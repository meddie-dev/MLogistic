<x-client-layout>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1>Fraud Detection Data</h1>

          @if ($fraudData && count($fraudData) > 0)
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>User ID</th>
                <th>Event</th>
                <th>IP Address</th>
                <th>Fraud Detected</th>
                <th>Fraud Likelihood (%)</th>
                <th>Created At</th>
                <th>Is Fraud</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fraudData as $data)
              <tr>
                <td>{{ $data['user_id'] ?? 'N/A' }}</td>
                <td>{{ $data['event'] ?? 'N/A' }}</td>
                <td>{{ $data['ip_address'] ?? 'N/A' }}</td>
                <td>{{ $data['fraud_detected'] == '1' ? 'Yes' : 'No' }}</td>
                <td>{{ isset($data['fraud_likelihood']) ? $data['fraud_likelihood'] : 'N/A' }}</td>
                <td>{{ $data['created_at'] ?? 'N/A' }}</td>
                <td>{{ $data['is_fraud'] ?? 'N/A' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="alert alert-warning">
            No fraud data available.
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>
</x-client-layout>