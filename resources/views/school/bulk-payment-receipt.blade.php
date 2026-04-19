<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body{font-family: DejaVu Sans;}
        table{width:100%;border-collapse:collapse;}
        td,th{border:1px solid #ccc;padding:8px;}
    </style>
</head>
<body>

    <h2>Bulk Payment Receipt</h2>

    <table>
        <tr>
            <th>Reference</th>
            <td>{{ $payment->reference }}</td>
        </tr>

        <tr>
            <th>Students Covered</th>
            <td>{{ $payment->student_count }}</td>
        </tr>

        <tr>
            <th>Amount</th>
            <td>₦{{ number_format($payment->amount,2) }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>{{ ucfirst($payment->status) }}</td>
        </tr>

        <tr>
            <th>Date</th>
            <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y h:i A') }}</td>
        </tr>
    </table>

</body>
</html>