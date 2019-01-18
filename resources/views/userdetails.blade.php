@extends('layouts.app')

@section('content')
<div class="container user-details">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Details</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <tbody>
                            <tr>
                              <th scope="row">Name</th>
                              <td>{{ $name }}</td>
                            </tr>
                            <tr>
                              <th scope="row">Age</th>
                              <td>{{ $age }}</td>
                            </tr>
                            <tr>
                              <th scope="row">Gender</th>
                              <td>{{ $gender }}</td>
                            </tr>
                            <tr>
                              <th scope="row">ZIP Code</th>
                              <td>{{ $zip }}</td>
                            </tr>
                            @if ($role=='agent')
                                <tr>
                                  <th scope="row">Profession</th>
                                  <td>{{ $profession }}</td>
                                </tr>
                                <tr>
                                  <th scope="row">Contacts</th>
                                  <td>
                                    <a class="btn btn-primary" href="{{ url("/agentcontacts") }}" role="button">See Contacts</a>
                                  </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
