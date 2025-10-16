<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice Details</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background-color: #f7f8fa;
      color: #333;
    }

    .invoice-wrapper {
      max-width: 1000px;
      margin: 50px auto;
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .invoice-header {
      text-align: center;
      border-bottom: 2px solid #eee;
      padding-bottom: 15px;
      margin-bottom: 40px;
    }

    .invoice-header h3 {
      margin: 0;
      font-weight: 600;
      font-size: 1.6rem;
      color: #333;
    }

    .invoice-body {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
      padding: 25px 30px;
      flex: 1;
      min-width: 300px;
    }

    .card h6 {
      margin-top: 0;
      font-size: 1rem;
      color: #444;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .card p {
      margin: 6px 0;
      font-size: 0.95rem;
    }

    .status-badge {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 15px;
      font-size: 0.85rem;
      background: #e9ecef;
      color: #555;
    }

    .table-wrapper {
      margin-top: 10px;
      border-radius: 8px;
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    thead {
      background-color: #f5f6fa;
    }

    th, td {
      padding: 10px 12px;
      text-align: left;
      border: 1px solid #eee;
    }

    th {
      color: #555;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.85rem;
    }

    td {
      color: #333;
    }

    .no-data {
      text-align: center;
      font-style: italic;
      color: #777;
    }

    @media (max-width: 768px) {
      .invoice-body {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <div class="invoice-wrapper">
    <div class="invoice-header">
      <h3>Invoice</h3>
    </div>

    <div class="invoice-body">
      <!-- Left Card -->
      <div class="card">
        <h6>Invoice Details</h6>
        <p><strong>Proof Reader :</strong> {{$invoice->proofReader->fullName()}}</p>
        <p><strong>Month :</strong> {{$invoice->month}}</p>
        <p><strong>Amount :</strong> {{$invoice->amount}}</p>
        <p><strong>CF Amount :</strong> {{$invoice->cf_amount}}</p>
        <p><strong>Total Amount :</strong> {{((int)$invoice->amount + (int)$invoice->cf_amount)}}</p>
        <p><strong>Payment Status :</strong>
          @if ($invoice->status == 1)
            <span class="status-badge">Completed</span>
          @elseif($invoice->status == 2)
            <span class="status-badge">Carry Forwarded</span>
          @else
            <span class="status-badge">Pending</span>
          @endif
        </p>
      </div>

      <!-- Right Card -->
      <div class="card">
        <h6>Completed task in the month of {{$invoice->month}}, {{$invoice->year}} by {{$invoice->proofReader->fullName()}}</h6>
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>AUDIO</th>
                <th>PRICE</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tasks as $task)
              <tr>
                <td>{{$task->audio_name}}</td>
                <td>{{$task->price}}</td>
              </tr>
              @empty
              <tr>
                <td colspan="2" class="no-data">No data found</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
