@extends('layouts.app')

@section('title', 'Register Face')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Register Face - {{ $student->user->name ?? 'Student' }}
                </div>

                <div class="card-body text-center">

                    <video id="video" width="500" height="380" autoplay muted></video>

                    <canvas id="canvas" style="display:none;"></canvas>

                    <div class="mt-3">
                        <button class="btn btn-success" onclick="captureFace()">
                            Capture Face
                        </button>
                    </div>

                    <form id="faceForm" method="POST" action="{{ route('face.save', $student->id) }}">
                        @csrf

                        <input type="hidden" name="image" id="imageInput">
                        <input type="hidden" name="descriptor" id="descriptorInput">
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<script defer src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

<script>
let video = document.getElementById('video');

navigator.mediaDevices.getUserMedia({ video:true })
.then(stream => {
    video.srcObject = stream;
});

async function captureFace()
{
    const canvas = document.getElementById('canvas');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    let ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0);

    let image = canvas.toDataURL('image/png');

    document.getElementById('imageInput').value = image;

    document.getElementById('descriptorInput').value = '[]';

    document.getElementById('faceForm').submit();
}
</script>
@endsection