@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Clock Reports</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Start Time</th>
                                    <th>Break Time</th>
                                    <th>End Time</th>
                                    <th>Total Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clockRecords as $record)
                                    <tr>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ $record->clock_in }}</td>
                                        <td>
                                            @foreach($record->breakTimes as $break)
                                                {{ $break->break_start }} - {{ $break->break_end }} <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $record->clock_out }}</td>
                                        <td>{{ $record->totalTime() }}</td>
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
