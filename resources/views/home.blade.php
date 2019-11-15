@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{session()->get('message')}}
    </div>
    @endif
    <h4>Customers in the System</h4>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Type</th>
                <th scope="col">Creator</th>
                <th scope="col">Created at</th>
                <th scope="col">Last Update</th>
                <th scope="col" style="width: 40px;">Actions</th>
                <th scope="col" style="width: 40px;">Edit</th>
                <th scope="col" style="width: 40px;">Delete</th>
            </tr>
        </thead>
      <tbody>
        @foreach($customers as $k=>$c)
        <tr>
            <th scope="row">{{$k+1}}</th>
            <td>{{$c->customer_name}}</td>
            <td>{{$c->type}}</td>
            <td>{{$c->email}}</td>
            <td>{{$c->created_at}}</td>
            <td>{{$c->updated_at}}</td>
            <td style="text-align: center;"><a href="/customers/{{$c->slug}}"><i class="view fa fa-television"></i></a></td>
            <td style="text-align: center;">
                <a href="/customers/{{$c->slug}}/edit"><i class="edit fa fa-pencil-square-o"></i></a>
            </td>
            <td style="text-align: center;">
                <a href="#" onclick="remove('{{$c->slug}}')"><i class="trash fa fa-trash"></i></a>
            </td>
            <form id="remove{{$c->slug}}" action="/customers/{{$c->slug}}" method="POST" style="display: none;">
                @csrf
                {{ method_field('DELETE') }} 
            </form>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $customers->links() }}
</div>
<script type="text/javascript">
    function remove(slug) {
        $('#remove'+slug).submit();
    }
</script>
@endsection
