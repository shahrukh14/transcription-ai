<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      background: #f9f9f9;
      color: #4c4c6d;
    }

    .invoice-box {
      max-width: 900px;
      margin: 20px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 40px;
      margin-right: 10px;
    }

    .logo h1 {
      color: #6C63FF;
      margin: 0;
      font-weight: 700;
    }

    .info {
      font-size: 14px;
      line-height: 1.6;
      margin-top: 10px;
    }

    .section {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .left, .right {
      width: 25%;
    }

    .bold {
      font-weight: 600;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background: #f1f1f5;
      color: #4c4c6d;
      font-size: 14px;
      text-transform: uppercase;
    }

    td {
      background: #fff;
      border-top: 1px solid #eee;
      font-size: 14px;
    }

    .text-right {
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="invoice-box">
    <div class="header">
      <div class="logo">
        <img src="https://cdn-icons-png.flaticon.com/512/5968/5968705.png" alt="Logo">
        <h1>Hybrid</h1>
      </div>
      <div class="invoice-details text-left">
        <p>Order ID : <strong>{{$transaction->order_id}}</strong></p>
        <p>Date : <strong>{{date('d M Y', strtotime($transaction->created_at))}}</strong></p>
      </div>
    </div>

    <div class="info">
      Office 149, 450 South Brand Brooklyn<br>
      San Diego County, CA 91905, USA<br>
      +1 (123) 456 7891, +44 (876) 543 2198
    </div>

    <div class="section">
      <div class="left">
        <p class="bold">Invoice To:</p>
        <p>
          <strong>{{$transaction->user->fullName()}}</strong><br>
          {{$transaction->user->mobile}}<br>
          {{$transaction->user->email}}
        </p>
      </div>
      <div class="right">
        <p class="bold">Payment Details:</p>
        <p>
          Amount: <strong>₹{{number_format($transaction->amount,2)}}</strong><br>
          Currency: {{$transaction->currency}}<br>
          Payment Mode: RazorPay<br>
        </p>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Package</th>
          <th>Type</th>
          <th>Amount</th>
          <th class="text-right">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>{{$transaction->package->name}}</strong><br></td>
          <td><strong>{{$transaction->package->type}}</strong><br></td>
          <td>₹{{$transaction->package->amount}}</td>
          <td class="text-right">₹{{$transaction->amount}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
