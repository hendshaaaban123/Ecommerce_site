@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">

<div class="card">
    <div class="card-body">
        <h3 class="d-inline">Registerd Users</h3>
       
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
              @foreach($user as $item)
              <tr>
                <td class="ps-4">{{$item->id}}</td>
                <td class="ps-4">{{$item->name.' '.$item->lname}}</td>
                <td class="ps-4">{{$item->email}}</td>
                <td class="ps-4">{{$item->phone}}</td>
                <td>
                    <a href="{{route('update-user',$item->id)}}"  class="btn btn-warning">view</a>
                </td>

              </tr>
              @endforeach
            </tbody>
        </table>
    </div>

</div>
    </div>
</div>

@endsection
