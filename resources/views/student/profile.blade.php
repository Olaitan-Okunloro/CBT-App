@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <i class="fas fa-user-shield me-2"></i>
            Student Profile
        </div>

        <div class="card-body">

            <div class="text-center mb-4">
                <!-- Profile Image Display -->
                <div class="position-relative d-inline-block">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/profile/' . $user->profile_photo) }}"
                             id="profileImage"
                             width="120"
                             height="120"
                             class="rounded-circle shadow"
                             style="object-fit:cover;">
                    @else
                        <i id="profileIcon" class="fas fa-user-circle text-secondary" style="font-size:120px;"></i>
                        <img id="profileImage" style="display:none; width:120px; height:120px; border-radius:50%; object-fit:cover;">
                    @endif
                    
                    <!-- Camera Button Overlay -->
                    <button type="submit" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle" 
                            style="width: 35px; height: 35px;" data-bs-toggle="modal" data-bs-target="#cameraModal">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
            </div>

            <form method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.profile.update') }}"
                  id="profileForm">
                @csrf

                <input type="hidden" name="captured_photo" id="captured_photo">

                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label>Profile Photo</label>
                    <input type="file" name="profile_photo" class="form-control" id="fileInput" accept="image/*">
                    <small class="text-muted">Or use the camera to take a photo directly</small>
                </div>

                <button class="btn btn-success" type="submit" id="submitBtn">
                    <i class="fas fa-save me-2"></i>Update Profile
                </button>

            </form>

        </div>

    </div>

</div>

<!-- Camera Modal -->
<div class="modal fade" id="cameraModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-camera me-2"></i>Take a Photo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Video element for camera stream -->
                <video id="video" width="100%" height="auto" autoplay playsinline muted style="border-radius: 10px; background: #000; display: none;"></video>
                
                <!-- Canvas for capturing image -->
                <canvas id="canvas" style="display: none;"></canvas>
                
                <!-- Captured image preview -->
                <div id="capturedImagePreview" style="display: none;">
                    <img id="capturedImage" width="100%" style="border-radius: 10px;">
                </div>

                <!-- Camera Controls -->
                <div class="mt-3">
                    <button type="button" class="btn btn-success" id="startCameraBtn">
                        <i class="fas fa-play me-2"></i>Start Camera
                    </button>
                    <button type="button" class="btn btn-primary" id="captureBtn" style="display: none;">
                        <i class="fas fa-camera me-2"></i>Capture Photo
                    </button>
                    <button type="button" class="btn btn-warning" id="retakeBtn" style="display: none;">
                        <i class="fas fa-redo me-2"></i>Retake
                    </button>
                    <button type="button" class="btn btn-success" id="savePhotoBtn" style="display: none;">
                        <i class="fas fa-save me-2"></i>Use This Photo
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #video, #capturedImage {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 10px;
    }
    
    .position-relative .btn {
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<script>
let stream = null;
let capturedPhotoData = null;
let videoElement = document.getElementById('video');
let canvasElement = document.getElementById('canvas');
let capturedImageElement = document.getElementById('capturedImage');
let fileInput = document.getElementById('fileInput');
let profileImage = document.getElementById('profileImage');
let profileIcon = document.getElementById('profileIcon');

// Start Camera
document.getElementById('startCameraBtn').addEventListener('click', async function() {
    try {

        this.disabled = true;
        this.innerHTML = 'Starting...';
        // Request camera permissions
        stream = await navigator.mediaDevices.getUserMedia({ 
            video: { 
                facingMode: 'user',
                width: { ideal: 1280 },
                height: { ideal: 720 }
            } 
        });
        
        videoElement.srcObject = stream;
        videoElement.style.display = 'block';
        
        // Hide preview, show video
        document.getElementById('capturedImagePreview').style.display = 'none';
        this.style.display = 'none';
        document.getElementById('captureBtn').style.display = 'inline-block';
        
    } catch (err) {
        console.error('Camera error:', err);
        Swal.fire({
            icon: 'error',
            title: 'Camera Error',
            text: 'Unable to access camera. Please check permissions and ensure you have a camera.',
            confirmButtonColor: '#6f42c1'
        });
    }
});

// Capture Photo
document.getElementById('captureBtn').addEventListener('click', function() {

    const context = canvasElement.getContext('2d');

    // ✅ Smaller size
    canvasElement.width = 300;
    canvasElement.height = 300;

    // ✅ Draw resized image
    context.drawImage(
        videoElement,
        0,
        0,
        canvasElement.width,
        canvasElement.height
    );

    // ✅ Heavy compression
    capturedPhotoData = canvasElement.toDataURL(
        'image/jpeg',
        0.2
    );

    console.log('Captured size:', capturedPhotoData.length);

    // Preview
    capturedImageElement.src = capturedPhotoData;

    document.getElementById(
        'capturedImagePreview'
    ).style.display = 'block';

    // Stop stream
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }

    videoElement.style.display = 'none';

    this.style.display = 'none';

    document.getElementById(
        'retakeBtn'
    ).style.display = 'inline-block';

    document.getElementById(
        'savePhotoBtn'
    ).style.display = 'inline-block';
});

// Retake Photo
document.getElementById('retakeBtn').addEventListener('click', async function() {
    // Hide preview
    document.getElementById('capturedImagePreview').style.display = 'none';
    
    // Hide retake and save buttons
    this.style.display = 'none';
    document.getElementById('savePhotoBtn').style.display = 'none';
    
    // Show start camera button
    document.getElementById('startCameraBtn').style.display = 'inline-block';
    
    // Clear captured data
    capturedPhotoData = null;
});

// Save Photo to Form
document.getElementById('savePhotoBtn').addEventListener('click', function() {

    if (!capturedPhotoData) {

        Swal.fire({
            icon: 'warning',
            title: 'No Photo',
            text: 'Please capture a photo first.'
        });

        return;
    }

    console.log(capturedPhotoData);
    // ✅ Save base64 to hidden input
    document.getElementById('captured_photo').value = capturedPhotoData;

    // ✅ Optional preview update
    if (profileImage) {
        profileImage.src = capturedPhotoData;
        profileImage.style.display = 'inline-block';

        if (profileIcon) {
            profileIcon.style.display = 'none';
        }
    }

    // ✅ Close modal
    const modal = bootstrap.Modal.getInstance(
        document.getElementById('cameraModal')
    );

    modal.hide();

    Swal.fire({
        icon: 'success',
        title: 'Photo Ready',
        text: 'Click Update Profile to save.',
        timer: 2000,
        showConfirmButton: false
    });

});

// Helper function to convert data URL to Blob
function dataURLtoBlob(dataURL) {
    const arr = dataURL.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], { type: mime });
}

// Preview uploaded file
fileInput.addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            if (profileImage) {
                profileImage.src = event.target.result;
                profileImage.style.display = 'inline-block';
                if (profileIcon) profileIcon.style.display = 'none';
            }
        };
        reader.readAsDataURL(e.target.files[0]);
        
        // Debug log
        console.log('File selected:', e.target.files[0].name, e.target.files[0].size);
    }
});

// Form submission debug
document.getElementById('profileForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('fileInput');
    if (fileInput.files.length > 0) {
        console.log('Submitting with file:', fileInput.files[0].name, fileInput.files[0].size);
    } else {
        console.log('No file selected for upload');
    }
});

// Clean up camera stream when modal is closed
document.getElementById('cameraModal').addEventListener('hidden.bs.modal', function() {
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }
    // Reset camera button visibility
    document.getElementById('startCameraBtn').style.display = 'inline-block';
    document.getElementById('captureBtn').style.display = 'none';
    document.getElementById('retakeBtn').style.display = 'none';
    document.getElementById('savePhotoBtn').style.display = 'none';
    document.getElementById('capturedImagePreview').style.display = 'none';
    videoElement.style.display = 'none';
});
</script>
@endsection