@php
$badgeClass = '';

switch ($statusId) {
case \App\Models\Status::ACTIVE:
$badgeClass = 'badge-light-success';
$status = 'Active';
break;
case \App\Models\Status::BLOCKED:
$badgeClass = 'badge-light-danger';
$status = 'Blocked';
break;
case \App\Models\Status::NEW:
$badgeClass = 'badge-light-primary';
$status = 'New';
break;
case \App\Models\Status::PAID:
$badgeClass = 'badge-light-success';
$status = 'Payed';
break;
case \App\Models\Status::OVERDUE:
$badgeClass = 'badge-success';
$status = 'overdue';
break;
case \App\Models\Status::PENDING:
$badgeClass = 'badge-light-warning';
$status = 'Pending';
break;
default:
$badgeClass = 'badge-light-primary';
break;
}
@endphp


<span class="badge rounded-pill {{ $badgeClass }} me-1">
    {{$status}}
</span>