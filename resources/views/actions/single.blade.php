@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Action: {{$action->slug}} || of Customer: {{$action->customer_name}}</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$action->type}}" disabled>
                        </div>
                    </div>
                    @if($action->type=='call')
                    <div class="form-group row" id="phone_container">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                        <div class="col-md-6">
                            <input id="phone" type="tel" class="form-control" value="{{$action->phone_no}}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="details" class="col-md-4 col-form-label text-md-right">Details</label>
                        <div class="col-md-6">
                            <textarea id="details" type="text" class="form-control" disabled>{{$action->details}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <a href="/customers/{{$action->customer_slug}}" class="btn btn-info">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection