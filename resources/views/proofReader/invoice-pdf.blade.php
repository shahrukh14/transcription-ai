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
      background-color: #fff;
      color: #333;
    }

    .invoice-wrapper {
      max-width: 1000px;
      margin: 10px auto;
      background: #fff;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .invoice-header {
      text-align: center;
      /* border-bottom: 2px solid #eee; */
      padding-bottom: 15px;
      margin-bottom: 20px;
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
    <table style="width: 100%; border-collapse: collapse; border: none;">
      <tr>
          <!-- Logo on the left -->
          <td style="text-align: left; vertical-align: middle; border: none;">
              @php
                  $existingSettings = App\Models\Generalsettings::first();
                  $logoPath = null;
                  if ($existingSettings && $existingSettings->logo) {
                      $logoPath = public_path('admin/generalSetting/' . $existingSettings->logo);
                  }
              @endphp

              @if($logoPath && file_exists($logoPath))
                  <img src="{{ $logoPath }}" style="height: 50px;" alt="Logo">
              @endif
          </td>

          <!-- Invoice number on the right -->
          <td style="text-align: right; vertical-align: middle; border: none;">
              <h2>Invoice - {{ $invoice->invoice_number ?? '' }}</h2>
          </td>
          <td style="text-align: right; vertical-align: middle; border: none;">
              <h5>Date : {{ $invoice->created_at ? $invoice->created_at->format('d/m/Y h:i A') : '' }}</h5>
          </td>
      </tr>
  </table>

  <div class="invoice-wrapper">
    {{-- <div class="invoice-header">
      <h3>Invoice</h3>
    </div> --}}

    <div class="invoice-body" style="display: flex; gap: 30px;">
      
      <table style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
          <tr>
              <!-- Left Card -->
              <td style="vertical-align: top; width: 48%; padding-right: 10px; border-radius: 5px;">
                 <h4>From</h4>
                <p><strong> {{$invoice->proofReader->fullName()}}</strong><br>
                  {{$invoice->proofReader->city}},{{$invoice->proofReader->state}}, <br>
                  Mobile : {{$invoice->proofReader->mobile}}, <br>
                  Email : {{$invoice->proofReader->email}}, <br>
                </p>

                {{-- @php $bank = $invoice->proofReader->bank_details; @endphp
                  @if($bank && is_array($bank))
                      <p><strong>Bank Name :</strong> {{ $bank['bank_name'] }}</p>
                      <p><strong>Branch :</strong> {{ $bank['branch'] }}</p>
                      <p><strong>Account No :</strong> {{ $bank['account_no'] }}</p>
                      <p><strong>IFSC :</strong> {{ $bank['ifsc'] }}</p>
                  @endif --}}
              </td>
              <!-- Right Card -->
              <td style="vertical-align: top; width: 48%; padding-left: 10px; border-radius: 5px;">
                  <h4>To</h4>
                  <p>
                    <strong>{{ $settings->name ?? 'Company Name' }}</strong><br>
                    {{ $settings->address ?? 'Address not set' }}<br>
                    Phone : {{ $settings->mobile ?? '' }}<br>
                    Email : {{ $settings->email ?? '' }}<br>
                    @if(!empty($settings->gst))
                        <strong>GSTIN : </strong> {{ $settings->gst }}
                    @endif
                </p>
              </td>
          </tr>
      </table>


      <!-- Table Card -->
      <div class="card">
        <strong>Completed task in the month of {{$invoice->month}}, {{$invoice->year}} by {{$invoice->proofReader->fullName()}}</strong>
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>AUDIO</th>
                <th>DATE</th>
                <th>PRICE (INR)</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tasks as $index => $task)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{$task->audio_name}}</td>
                <td>{{ $task->claimed_dt ? \Carbon\Carbon::parse($task->claimed_dt)->format('d/m/Y') : '' }}</td>
                <td>{{number_format((float)$task->price, 2)}}</td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="no-data">No data found</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      {{-- bank Details --}}
        <div style="vertical-align: top; width: 48%; padding-left: 10px; border-radius: 5px;">
            <h4>Bank Details :</h4>
            <p>
              @php $bank = $invoice->proofReader->bank_details; @endphp
              @if($bank && is_array($bank))
                  <strong>Bank Name :</strong> {{ $bank['bank_name'] }} <br>
                  <strong>Branch :</strong> {{ $bank['branch'] }} <br>
                  <strong>Account No :</strong> {{ $bank['account_no'] }} <br>
                  <strong>IFSC :</strong> {{ $bank['ifsc'] }}
              @endif
            </p>
        </div>
    </div>
  </div>

</body>
</html>
