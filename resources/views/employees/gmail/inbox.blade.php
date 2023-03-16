@extends('layout')
@section('content')
{{-- {{print_r($emails)}} --}}
{{-- <ul class="list-group">
    @foreach($emails as $email)
        <li class="list-group-item">
            <h4>{{ $email['subject'] }}</h4>
            <p><strong>From:</strong> {{ $email['from'] }}</p>
            <p><strong>Date:</strong> {{ $email['date'] }}</p>
            <p>{{ ($email['body']) }}</p>
        </li>
    @endforeach
</ul> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Gmail Inbox</div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emails as $email)
                                <tr>
                                    <td>{{ $email['from'] }}</td>
                                    <td>{{ $email['subject'] }}</td>
                                    <td>{{ $email['date'] }}</td>
                                    <td>{!! $email['body'] !!}</td>
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
    
