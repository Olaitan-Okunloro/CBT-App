@extends('layouts.app')

@section('content')

<h3>Result</h3>

<p>Score: {{ $attempt->score }} / {{ $attempt->total }}</p>

@endsection
