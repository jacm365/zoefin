@extends('layouts.app')

@section('content')
<div class="container user-details">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contacts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Distance</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact['distance'] }} miles</td>
                                    <td>{{ $contact['name'] }}</td>
                                    <td>{{ $contact['age'] }}</td>
                                    <td>{{ $contact['gender'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
