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
            <div class="row">
                <!-- Basic Starts -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="editCustomerLocation" style="height: 300px;"></div>
                            <form class="form" action="{{route('user.customers.update',$customer->id)}}" method="post">
                                @csrf
                                @method('put')
                                <input hidden type="text" id="lang" name="lang" value="{{$customer->address->lang}}">
                                <input hidden type="text" id="lat" name="lat" value="{{$customer->address->lat}}">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label class="form-label" for="country">Select City</label>
                                        <select class="single-select form-select" name="city_id" id="single-select" multiple>
                                            @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ $city->id == $customer->address->city_id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="customer-name">Name</label>
                                            <input required type="text" id="customer-name" class="form-control" placeholder="Name" value="{{$customer->address->name}}" name="address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="customer-name">Name</label>
                                            <input required type="text" id="customer-name" class="form-control" placeholder="Name" value="{{$customer->name}}" name="name">
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="customer-phone">Phone</label>
                                            <input required type="tel" class="form-control" id="customer-phone" placeholder="phone" value="{{$customer->phone}}" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="customer-type">Customer Type</label>
                                            <input required type="text" id="customer-type" class="form-control" placeholder="type" value="{{$customer->type}}" name="type">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="customer-language">Customer Language</label>
                                            <input required type="text" id="customer-language" class="form-control" placeholder="Language" value="{{$customer->language}}" name="language">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-1">
                                        <label class="form-label" for="salesperson">Select Salesperson</label>
                                        <select class="salesperson-select form-select" name="salesperson_id" id="select2-limited" multiple>
                                            <option value="{{$customer->salesperson->id}}" selected>{{$customer->salesperson->user->name}}</option>
                                            @foreach($salespersons as $salesperson)
                                            <option value="{{$salesperson->id}}">{{$salesperson->user->name}}</option>
                                            @endforeach
                                        </select>
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
        </div>
    </div>
</div>
@endsection


@section('styles')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/maps/leaflet.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css-rtl/plugins/maps/map-leaflet.css">
<script src="../../../app-assets/vendors/js/maps/leaflet.min.js"></script>
<script src="../../../app-assets/js/scripts/maps/map-leaflet.js"></script>
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
@endsection

@section('scripts')
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="../../../app-assets/js/scripts/forms/form-select2.js"></script>
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/maps/leaflet.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css-rtl/plugins/maps/map-leaflet.css">
<script src="../../../app-assets/vendors/js/maps/leaflet.min.js"></script>
<script src="../../../app-assets/js/scripts/maps/map-leaflet.js"></script>
@endsection