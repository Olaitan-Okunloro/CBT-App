@extends('layouts.app')

@section('title', 'Smart Result Upload')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-11">

<div class="card shadow-sm">
<div class="card-header bg-primary text-white">
<h4 class="mb-0">
<i class="fas fa-file-signature me-2"></i>
Smart Result Upload
</h4>
</div>

<div class="card-body">

<form method="POST" action="{{ route('results.store') }}" id="resultsForm">
@csrf

<div class="row mb-4">

<div class="col-md-4">
<label class="fw-bold">Session</label>
<input type="text" name="session" class="form-control" required>
</div>

<div class="col-md-4">
<label class="fw-bold">Term</label>
<select name="term" class="form-select" required>
<option value="">Select</option>
<option>1st Term</option>
<option>2nd Term</option>
<option>3rd Term</option>
</select>
</div>

<div class="col-md-4">
<label class="fw-bold">Upload Type</label>
<select name="upload_type" id="uploadType" class="form-select" required>
<option value="test">Test Scores</option>
<option value="exam">Exam Scores</option>
</select>
</div>

</div>

<div id="results-wrapper">

<div class="result-block card mb-4 border-left-primary" data-index="0">

<div class="card-header bg-light d-flex justify-content-between align-items-center">
<h5 class="mb-0 text-primary">
<i class="fas fa-user-graduate me-2"></i>
Result 1
</h5>

<button type="button"
class="btn btn-sm btn-danger remove-result"
style="display:none;"
onclick="removeResult(this)">
<i class="fas fa-trash-alt me-1"></i>Remove
</button>
</div>

<div class="card-body">
<div class="row">

<div class="col-md-4 mb-3">
<label class="fw-bold">Student</label>
<select name="rows[0][student_id]"
class="form-select student-select"
data-index="0"
required>

<option value="">Select Student</option>

@foreach($students as $student)
<option value="{{ $student->id }}"
data-class="{{ $student->class_id }}">
{{ $student->user->name ?? 'N/A' }}
</option>
@endforeach

</select>
</div>

<div class="col-md-4 mb-3">
<label class="fw-bold">Class</label>
<input type="text"
class="form-control class-text"
readonly>

<input type="hidden"
name="rows[0][class_id]"
class="class-id">
</div>

<div class="col-md-4 mb-3">
<label class="fw-bold">Subject</label>
<select name="rows[0][subject_id]" class="form-select" required>
<option value="">Select Subject</option>
@foreach($subjects as $subject)
<option value="{{ $subject->id }}">
{{ $subject->name }}
</option>
@endforeach
</select>
</div>

<div class="col-md-12 mb-3">
<label class="fw-bold score-label">Test Score</label>
<input type="number"
name="rows[0][score]"
class="form-control"
required>
</div>

</div>
</div>

</div>

</div>

<div class="d-flex justify-content-between mt-4">
<button type="button" class="btn btn-success" onclick="addResult()">
<i class="fas fa-plus-circle me-2"></i>Add More
</button>

<button type="submit" class="btn btn-primary btn-lg">
<i class="fas fa-save me-2"></i>Save Scores
</button>
</div>

</form>

</div>
</div>

</div>
</div>
</div>

<script>
let resultCount = 1;

function addResult()
{
let html = document.querySelector('.result-block').outerHTML;

html = html.replaceAll('[0]', '['+resultCount+']');
html = html.replace('Result 1','Result '+(resultCount+1));
html = html.replace('style="display:none;"','');

document.getElementById('results-wrapper')
.insertAdjacentHTML('beforeend', html);

resultCount++;
showRemoveButtons();
bindStudents();
}

function removeResult(btn)
{
btn.closest('.result-block').remove();
renumber();
}

function renumber()
{
let blocks = document.querySelectorAll('.result-block');

blocks.forEach((block,index)=>{

block.querySelector('h5').innerHTML =
'<i class="fas fa-user-graduate me-2"></i>Result '+(index+1);

block.querySelectorAll('input,select').forEach(el=>{
let name = el.getAttribute('name');
if(name){
el.setAttribute(
'name',
name.replace(/rows\[\d+\]/, 'rows['+index+']')
);
}
});

});

resultCount = blocks.length;
showRemoveButtons();
bindStudents();
}

function showRemoveButtons()
{
document.querySelectorAll('.remove-result')
.forEach(btn=>{
btn.style.display = resultCount > 1 ? 'block':'none';
});
}

function bindStudents()
{
document.querySelectorAll('.student-select').forEach(select=>{

select.onchange = function(){

let option = this.options[this.selectedIndex];
let classId = option.getAttribute('data-class');

let block = this.closest('.result-block');

block.querySelector('.class-id').value = classId;
block.querySelector('.class-text').value = 'Class Auto Loaded';

};

});
}

document.getElementById('uploadType').onchange = function(){

let type = this.value;

document.querySelectorAll('.score-label').forEach(label=>{
label.innerHTML = type === 'test' ? 'Test Score' : 'Exam Score';
});

};

bindStudents();
</script>

@endsection