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
                            <button class="dt-button create-new btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createAdministrator">
                                <span>
                                    <i data-feather="plus"></i>
                                    Create Administrator
                                </span>
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4 mb-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($administrators->isEmpty())
                                    <tr>
                                        <td colspan="100">
                                            <x-no-items-message />
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach($administrators as $administrator)
                                    <tr>
                                        <td>{{$administrator->user->name}}</td>
                                        <td>{{$administrator->user->email}}</td>
                                        <td>
                                            <x-status-badge :statusId="$administrator->user->status_id" />
                                        </td>
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
                                                    <a class="dropdown-item text-primary" href="{{route('administrator.administrators.edit',$administrator->id)}}">
                                                        <i data-feather='edit-2' class="feather feather-edit-2 me-50"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger delete-item" href="#" data-id="{{$administrator->id}}">
                                                        <i data-feather='trash-2' class="feather feather-trash me-50"></i>
                                                        <span>Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <form action="{{route('administrator.administrators.destroy',$administrator->id)}}" data-id="{{$administrator->id}}" method="post" hidden>
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


<!-- Basic Modals start -->

<!-- Modal -->
<div class="modal fade text-start" id="createAdministrator" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Create Administrator</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" action="{{route('administrator.administrators.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="first-name-column">Name</label>
                                <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="email-column">Email</label>
                                <input type="text" id="email-column" class="form-control" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="last-name-column">Password</label>
                                <input type="password" class="form-control" placeholder="Passwrod" name="password">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="small-select-multi">Permissions</label>
                            <div class="mb-1">
                                <select name="permissions[]" class="select2-size-sm form-select" multiple="multiple" id="small-select-multi">
                                    @foreach($permissions as $permission)
                                    <option value="{{$permission}}">{{$permission}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="countries">Country</label>
                            <div class="mb-1">
                                <select name="country_id" class="single-select form-select" multiple="multiple" id="countries">
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection


@section('styles')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/animate/animate.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css-rtl/plugins/extensions/ext-component-sweet-alerts.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
@endsection

@section('scripts')
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="../../../app-assets/js/scripts/forms/form-select2.js"></script>
<script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
<script src="../../../app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>

@endsection