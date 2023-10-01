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

        </div>
        <div class="content-body">
            <x-alerts />
            <section id="multiple-column-form">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{route('administrator.salespersons.update',$salesperson->id)}}" method="post">
                                    @method('PUT')

                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Name</label>
                                                <input value="{{$salesperson->user->name}}" type="text" id="first-name-column" class="form-control" placeholder="First Name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="last-name-column">Email</label>
                                                <input value="{{$salesperson->user->email}}" type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="email">
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-12">
                                            <label class="form-label" for="small-select-multi">Permissions</label>
                                            <div class="mb-1">
                                                <select value="{{$salesperson->permission}}" name="permissions[]" class="select2-size-sm form-select" multiple="multiple" id="small-select-multi">
                                                    @foreach($permissions as $permission)
                                                    <option value="{{ $permission->name }}" {{ in_array($permission->name, $selectedPermissions) ? 'selected' : '' }}>
                                                        {{ $permission->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="basicSelect">Basic Select</label>
                                            <select class="form-select" id="basicSelect" name="status_id">
                                                <option value="{{ \App\Models\Status::ACTIVE }}" {{ $salesperson->status_id === \App\Models\Status::ACTIVE ? 'selected' : '' }}>Active</option>
                                                <option value="{{ \App\Models\Status::BLOCKED }}" {{ $salesperson->status_id === \App\Models\Status::BLOCKED ? 'selected' : '' }}>Blocked</option>
                                                <!-- Add more options as needed -->
                                            </select>
    
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="countries">Countries</label>
                                            <div class="mb-1">
                                                
                                            <select name="countries[]" id="countries" class="select2-size-sm form-select" multiple="multiple" id="small-select-multi">
    @foreach($countries as $country)
        <option value="{{ $country->name }}" {{ in_array($country->name, $selectedCountries) ? 'selected' : '' }}>
            {{ $country->name }}
        </option>
    @endforeach
</select>

                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary ">Save</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection


@section('styles')

<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
@endsection

@section('scripts')
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="../../../app-assets/js/scripts/forms/form-select2.js"></script>
@endsection