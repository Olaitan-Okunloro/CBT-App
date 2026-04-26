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

                    <video id="video"
                           width="300"
                           height="280"
                           autoplay
                           muted
                           playsinline
                           style="border-radius:10px; background:#000;">
                    </video>

                    <div class="mt-3">

                        <h5 id="resultText">
                            Loading camera...
                        </h5>

                    </div>

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
document.addEventListener('DOMContentLoaded', async function () {

    const video = document.getElementById('video');

    const resultText =
        document.getElementById('resultText');

    const students = @json($students);

    let modelsReady = false;

    let processing = false;

    let locked = false;

    if (!video) {
        alert('Video element not found');
        return;
    }

    try {

        const stream =
            await navigator.mediaDevices.getUserMedia({
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

        resultText.innerHTML = 'Scanning face...';

    } catch (error) {

        console.error(error);

        resultText.innerHTML =
            'Camera failed to start';

        return;
    }

    const labeled = students.map(student => ({

        id: student.id,

        name: student.user?.name ?? 'Unknown',

        descriptor: new Float32Array(
            JSON.parse(student.face_descriptor)
        )

    }));

    function distance(a, b)
    {
        return Math.sqrt(
            a.reduce((sum, val, i) =>
                sum + Math.pow(val - b[i], 2), 0)
        );
    }

    function findMatch(desc)
    {
        let best = null;

        let min = 999;

        labeled.forEach(student => {

            let d = distance(
                Array.from(desc),
                Array.from(student.descriptor)
            );

            if (d < min) {
                min = d;
                best = student;
            }

        });

        return min < 0.75 ? best : null;
    }

    setInterval(async function () {

        if (!modelsReady || processing || locked) {
            return;
        }

        processing = true;

        try {

            const detection = await faceapi
                .detectSingleFace(
                    video,
                    new faceapi.TinyFaceDetectorOptions()
                )
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!detection) {

                resultText.innerHTML =
                    'No face detected';

                processing = false;

                return;
            }

            const match =
                findMatch(detection.descriptor);

            if (!match) {

                resultText.innerHTML =
                    'Face not recognized';

                processing = false;

                return;
            }

            resultText.innerHTML =
                'Recognized: ' + match.name;

            const response =
                await fetch(
                    "{{ route('attendance.mark') }}",
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json',

                            'X-CSRF-TOKEN':
                                "{{ csrf_token() }}"
                        },

                        body: JSON.stringify({
                            student_id: match.id
                        })
                    }
                );

            const data =
                await response.json();

            resultText.innerHTML =
                data.message;

            locked = true;

            setTimeout(function () {

                locked = false;

                resultText.innerHTML =
                    'Ready for next student';

            }, 8000);

        } catch (error) {

            console.error(error);

            resultText.innerHTML =
                'Scan failed';

        }

        processing = false;

    }, 2500);

});
</script>

@endpush