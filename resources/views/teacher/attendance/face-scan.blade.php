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

                    <video id="video" width="300" height="280" autoplay muted></video>

                    <div class="mt-3">
                        <h5 id="resultText">Waiting for face...</h5>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

<script>
window.onload = async function () {

    let video = document.getElementById('video');
    let resultText = document.getElementById('resultText');

    const students = @json($students);

    navigator.mediaDevices.getUserMedia({ video:true })
    .then(stream => {
        video.srcObject = stream;
    });

    await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/models')
    ]);

    resultText.innerHTML = "Scanning face...";

    const labeled = students.map(student => ({
        id: student.id,
        name: student.user?.name ?? 'Unknown',
        descriptor: new Float32Array(JSON.parse(student.face_descriptor))
    }));

    function distance(a,b){
        return Math.sqrt(
            a.reduce((sum,val,i)=>sum + Math.pow(val-b[i],2),0)
        );
    }

    function findMatch(desc){

        let best = null;
        let min = 999;

        labeled.forEach(student => {

            let d = distance(desc, student.descriptor);

            if(d < min){
                min = d;
                best = student;
            }
        });

        return min < 0.75 ? best : null;
    }

    let processing = false;
    let locked = false;

    setInterval(async () => {

        if(processing || locked) return;

        processing = true;

        const detection = await faceapi
            .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if(!detection){
            resultText.innerHTML = "No face detected";
            processing = false;
            return;
        }

        const match = findMatch(detection.descriptor);

        if(match){

            resultText.innerHTML = "Recognized: " + match.name;

            fetch("{{ route('attendance.mark') }}", {
                method: "POST",
                headers: {
                    "Content-Type":"application/json",
                    "X-CSRF-TOKEN":"{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    student_id: match.id
                })
            })
            .then(res => res.json())
            .then(data => {

                resultText.innerHTML = data.message;

                locked = true; // stop further scans

                setTimeout(() => {
                    locked = false;
                    resultText.innerHTML = "Ready for next student";
                }, 8000);

                processing = false;
            });

        } else {
            resultText.innerHTML = "Face not recognized";
            processing = false;
        }

    }, 2500);

};
</script>
@endsection