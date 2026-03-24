<!-- resources/views/partials/toastr.blade.php -->
<script>
$(document).ready(function() {
    @if(session('success'))
        toastr.success('{{ session('success') }}', 'Success!');
    @endif

    @if(session('error'))
        toastr.error('{{ session('error') }}', 'Error!');
    @endif

    @if(session('info'))
        toastr.info('{{ session('info') }}', 'Information');
    @endif

    @if(session('warning'))
        toastr.warning('{{ session('warning') }}', 'Warning!');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}', 'Validation Error');
        @endforeach
    @endif
});
</script>