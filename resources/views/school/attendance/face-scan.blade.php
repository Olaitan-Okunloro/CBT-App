@extends('layouts.app')

@section('title', 'Face Attendance Scan')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Facial Attendance Scanner
                </div>

                <div class="card-body text-center">

                    <video id="video" width="500" height="380" autoplay muted></video>

                    <div class="mt-3">
                        <h5 id="resultText">Waiting for face...</h5>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script src="{{ asset('js/face-api.min.js') }}"></script>

<script>
window.onload = function () {
    console.log(faceapi);
};
</script>
@endsection