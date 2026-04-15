<h2>Attendance Report - {{ $today }}</h2>

<table border="1" width="100%" cellpadding="5">
<tr>
<th>Name</th>
<th>Check In</th>
<th>Status</th>
</tr>

@foreach($records as $row)
<tr>
<td>{{ $row->student->name ?? '' }}</td>
<td>{{ $row->check_in_time }}</td>
<td>{{ $row->status }}</td>
</tr>
@endforeach

</table>