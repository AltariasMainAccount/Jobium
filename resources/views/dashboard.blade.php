@extends('layout.dboard')

@section('content')
    <div class="album">
        <div class="container">
            <div class="row">
                <h1>Jobium Dashboard</h1>
		        <p>This is the dashboard of Jobium, if you managed to get here then you're authenticated!</p>
                <p>Your token is: <b>{{ $token }}</b></p>
		    </div>
        </div>
    </div>
@endsection