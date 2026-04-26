@extends('layouts.app')

@section('title', 'Register Face')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    Register Face -
                    {{ $student->user->name ?? 'Student' }}
                </div>

                <div class="card-body text-center">

                    <video id="video"
                           width="300"
                           height="280"
                           autoplay
                           muted
                           playsinline
                           style="border-radius:10px; background:#000;">
                    </video>

                    <canvas id="canvas"
                            style="display:none;">
                    </canvas>

                    <div class="mt-3">

                        <button type="button"
                                class="btn btn-success"
                                onclick="captureFace()">
                            Capture Face
                        </button>

                    </div>

                    <form id="faceForm"
                          method="POST"
                          action="{{ route('face.save', $student->id) }}">

                        @csrf

                        <input type="hidden"
                               name="image"
                               id="imageInput">

                        <input type="hidden"
                               name="descriptor"
                               id="descriptorInput">

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')

<!-- <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script> -->
 <script src="{{ asset('js/face-api.min.js') }}"></script>

<script>
let modelsReady = false;

document.addEventListener('DOMContentLoaded', async function () {

    const video = document.getElementById('video');

    if (!video) {
        alert('Video element not found');
        return;
    }

    try {

        const stream = await navigator.mediaDevices.getUserMedia({
            video: true,
            audio: false
        });

        video.srcObject = stream;

        await video.play();

        await Promise.all([

            faceapi.nets.tinyFaceDetector.loadFromUri('/models'),

            faceapi.nets.faceLandmark68Net.loadFromUri('/models'),

            faceapi.nets.faceRecognitionNet.loadFromUri('/models')

        ]);

        modelsReady = true;

        console.log('Camera and models ready');

    } catch (error) {

        console.error(error);

        alert('Camera Error: ' + error.message);
    }

});

async function captureFace()
{
    if (!modelsReady) {

        alert('Please wait, models still loading...');

        return;
    }

    const video = document.getElementById('video');

    try {

        const detection = await faceapi
            .detectSingleFace(
                video,
                new faceapi.TinyFaceDetectorOptions()
            )
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) {

            alert('No face detected');

            return;
        }

        const canvas = document.getElementById('canvas');

        canvas.width = video.videoWidth;

        canvas.height = video.videoHeight;

        const ctx = canvas.getContext('2d');

        ctx.drawImage(
            video,
            0,
            0,
            canvas.width,
            canvas.height
        );

        document.getElementById('imageInput').value =
            canvas.toDataURL('image/png');

        document.getElementById('descriptorInput').value =
            JSON.stringify(
                Array.from(detection.descriptor)
            );

        document.getElementById('faceForm').submit();

    } catch (error) {

        console.error(error);

        alert('Face capture failed');
    }
}
</script>

@endpush