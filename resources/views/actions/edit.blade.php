@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{session()->get('message')}}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Action: {{$action->slug}} || of Customer: {{$action->customer_name}}</div>
                <div class="card-body">
                    <form method="POST" action="/actions/{{$action->slug}}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                                    <option value="call" {{$action->type=='call'?'selected':''}}>Call</option>
                                    <option value="visit" {{$action->type=='visit'?'selected':''}}>Visit</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="phone_container">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{$action->phone_no}}">
                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="details" class="col-md-4 col-form-label text-md-right">Details</label>
                            <div class="col-md-6">
                                <textarea id="details" type="text" class="form-control @error('details') is-invalid @enderror" name="details">{{$action->details}}</textarea>
                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="/customers/{{$action->customer_slug}}" class="btn btn-info">Back</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#type').change(function(){
        checktype();
    });
    function checktype(){
        if($('#type').val()=='call'){
            $('#phone_container').show();
        }else{
            $('#phone_container').hide();
            $('#phone').val('');
        }
    }
    checktype();
</script>
@endsection