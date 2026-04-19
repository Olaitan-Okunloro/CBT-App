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

                    <video id="video" width="300" height="280" autoplay muted></video>

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

<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

<script>
window.onload = async function () {

    let video = document.getElementById('video');

    navigator.mediaDevices.getUserMedia({ video:true })
    .then(stream => {
        video.srcObject = stream;
    });

    await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/models')
    ]);

};

async function captureFace()
{
    const video = document.getElementById('video');

    const detection = await faceapi
        .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceLandmarks()
        .withFaceDescriptor();

    if(!detection){
        alert('No face detected');
        return;
    }

    const canvas = document.getElementById('canvas');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx = canvas.getContext('2d');
    ctx.drawImage(video,0,0);

    document.getElementById('imageInput').value =
        canvas.toDataURL('image/png');

    document.getElementById('descriptorInput').value =
        JSON.stringify(Array.from(detection.descriptor));

    document.getElementById('faceForm').submit();
}
</script>
@endsection