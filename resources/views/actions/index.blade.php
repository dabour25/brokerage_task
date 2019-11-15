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
                <div class="card-header">Create New Action</div>
                <div class="card-body">
                    <form method="POST" action="/actions">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Customer Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{ $customer->customer_name }}" disabled>
                            </div>
                        </div>
                        <input type="text" name="customer" value="{{$customer->slug}}" hidden>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                                    <option value="call" {{old('type')=='call'?'selected':''}}>Call</option>
                                    <option value="visit" {{old('type')=='visit'?'selected':''}}>Visit</option>
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
                                <input id="phone" type="tel" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{old('phone_no')}}">
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
                                <textarea id="details" type="text" class="form-control @error('details') is-invalid @enderror" name="details">{{old('details')}}</textarea>
                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">Create</button>
                                <a href="/" class="btn btn-info">Back</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h4>Actions of customer: {{$customer->customer_name}}</h4>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Action Type</th>
                <th scope="col">Phone</th>
                <th scope="col">Creator</th>
                <th scope="col">Created at</th>
                <th scope="col">Last Update</th>
                <th scope="col" style="width: 40px;">Details</th>
                <th scope="col" style="width: 40px;">Edit</th>
                <th scope="col" style="width: 40px;">Delete</th>
            </tr>
        </thead>
      <tbody>
        @foreach($actions as $k=>$a)
        <tr>
            <th scope="row">{{$k+1}}</th>
            <td>{{$a->type}}</td>
            <td>{{$a->phone_no}}</td>
            <td>{{$a->email}}</td>
            <td>{{$a->created_at}}</td>
            <td>{{$a->updated_at}}</td>
            <td style="text-align: center;">
                <a href="/actions/{{$a->slug}}"><i class="view fa fa-television"></i></a>
            </td>
            <td style="text-align: center;">
                <a href="/actions/{{$a->slug}}/edit"><i class="edit fa fa-pencil-square-o"></i></a>
            </td>
            <td style="text-align: center;">
                <a href="#" onclick="remove('{{$a->slug}}')"><i class="trash fa fa-trash"></i></a>
            </td>
            <form id="remove{{$a->slug}}" action="/actions/{{$a->slug}}" method="POST" style="display: none;">
                @csrf
                {{ method_field('DELETE') }} 
            </form>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $actions->links() }}
</div>

<script type="text/javascript">
    function remove(slug) {
        $('#remove'+slug).submit();
    }
    $('#type').change(function(){
        if($(this).val()=='call'){
            $('#phone_container').show();
        }else{
            $('#phone_container').hide();
            $('#phone').val('');
        }
    });
</script>
@endsection
