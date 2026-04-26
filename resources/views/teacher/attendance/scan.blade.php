@extends('layouts.app')

@section('title', 'Scan Attendance')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>
                        <i class="fas fa-qrcode me-2"></i>Scan Attendance
                    </h4>
                </div>

                <div class="card-body text-center">
                    <!-- ✅ ONLY ONE READER -->
                    <div id="reader" style="width: 100%; height: 60%"></div>

                    <!-- ✅ TOAST -->
                    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
                        <div id="toastMessage" class="toast align-items-center text-bg-success border-0" role="alert">
                            <div class="d-flex">
                                <div class="toast-body" id="toastBody"></div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ✅ QR LIBRARY -->
<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let scanner;
    let scanningLocked = false;

    // ✅ Toast
    function showToast(message, type = 'success') {
        let toastEl = document.getElementById('toastMessage');
        let toastBody = document.getElementById('toastBody');

        toastBody.innerText = message;
        toastEl.className = `toast align-items-center text-bg-${type} border-0`;

        let toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    // ✅ Main Scan Handler
    function onScanSuccess(decodedText, decodedResult) {

        // 🚫 Prevent double scan
        if (scanningLocked) {
            return;
        }

        scanningLocked = true;

        // ⏸ Pause scanner immediately
        scanner.pause(true);

        fetch("{{ route('attendance.mark') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                reg_no: decodedText
            })
        })
        .then(async res => {
            let data = await res.json();
            return data;
        })
        .then(data => {
            showToast(data.message, 'success');
        })
        .catch(error => {
            showToast("Error processing scan", 'danger');
            console.error(error);
        })
        .finally(() => {

            // ▶ Resume after 4 seconds
            setTimeout(() => {
                scanningLocked = false;
                scanner.resume();
            }, 4000);

        });
    }

    // ✅ Start scanner
    scanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: { width: 300, height: 300 },
            aspectRatio: 1.0
        },
        false
    );

    scanner.render(onScanSuccess);

});
</script>
@endsection