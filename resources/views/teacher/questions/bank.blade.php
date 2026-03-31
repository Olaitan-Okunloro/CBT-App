 @extends('layouts.app')

@section('title', 'Create Questions')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Create Multiple Questions
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.question.bank.import') }}">
                        @csrf

                        @foreach($questions as $q)
                            <input type="checkbox" name="question_ids[]" value="{{ $q->id }}">
                            {{ $q->question_text }} <br>
                        @endforeach

                        <button class="btn btn-success">Import Selected</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection