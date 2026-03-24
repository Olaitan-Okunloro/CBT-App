<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>

    <style>
        body {
            font-family: Arial;
        }

        .header {
            text-align: center;
        }

        .receipt-box {
            border:1px solid #ddd;
            padding:20px;
            margin-top:20px;
        }

        table {
            width:100%;
        }

        td {
            padding:8px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Payment Receipt</h2>
        <p>CBT Registration Portal</p>
    </div>

    <div class="receipt-box">
        <table>
            <tr>
                <td><strong>Receipt Reference</strong></td>
                <td>{{ $payment->reference }}</td>
            </tr>

            <tr>
                <td><strong>Student Name</strong></td>
                <td>{{ $payment->user->name }}</td>
            </tr>

            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $payment->user->email }}</td>
            </tr>

            <tr>
                <td><strong>Amount Paid</strong></td>
                <td>₦{{ number_format($payment->amount) }}</td>
            </tr>

            <tr>
                <td><strong>Payment Date</strong></td>
                <td>{{ $payment->paid_at }}</td>
            </tr>

            <tr>
                <td><strong>Status</strong></td>
                <td>Successful</td>
            </tr>

        </table>
    </div>

</body>
</html>