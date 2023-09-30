@extends('layouts\appLayout')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Bootstrap Tables</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Table Bootstrap
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square me-1">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square me-1">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail me-1">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar me-1">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <!-- Bordered table start -->
            <x-alerts />


            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-3 col-12 mb-1">
                                <form action="">

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" aria-describedby="button-addon2" />
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                            <a href="{{route('user.invoices.create')}}" class="dt-button create-new btn btn-primary" type="button">
                                <span>
                                    <i data-feather="plus"></i>
                                    Create invoice
                                </span>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4 mb-4">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Customer</th>
                                        <th>Saleperson</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($invoices->isEmpty())
                                    <tr>
                                        <td colspan="100">
                                            <x-no-items-message />
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        
                                        <td>{{$invoice->invoice_number}}</td>
                                        <td>{{$invoice->created_at}}</td>
                                        <td>
                                            <x-status-badge :statusId="$invoice->status_id" />
                                        </td>
                                        <td>{{$invoice->customer->name}}</td>
                                        <td>{{$invoice->salesperson->name}}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item text-primary" href="{{route('user.invoices.edit',$invoice->id)}}">
                                                        <i data-feather='edit-2' class="feather feather-edit-2 me-50"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger delete-item" href="#" data-id="{{$invoice->id}}">
                                                        <i data-feather='trash-2' class="feather feather-trash me-50"></i>
                                                        <span>Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <form action="{{route('user.invoices.destroy',$invoice->id)}}" data-id="{{$invoice->id}}" method="post" hidden>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
            <!-- Bordered table end -->
        </div>
    </div>
</div>

@endsection


@section('styles')

@endsection

@section('scripts')


@endsection