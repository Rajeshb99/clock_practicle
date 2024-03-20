@extends('employee.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Clock In/Out</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if($clockedIn)
                            <form id="clockOutForm" method="POST" action="{{ route('user.clockOut') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Clock Out</button>
                            </form>
                            
                            <form id="takeBreakForm" method="POST" action="{{ route('user.takeBreak') }}">
                                @csrf
                                <button type="button" class="btn btn-primary" id="takeBreakBtn">Take a Break</button>
                            </form>

                            <form id="endBreakForm" method="POST" action="{{ route('user.endBreak') }}" style="display: none;">
                                @csrf
                                <button type="button" class="btn btn-secondary" id="endBreakBtn">End Break</button>
                            </form>
                        @else
                            <form id="clockInOutForm" method="POST" action="{{ route('user.clockInOut') }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Clock In</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Ajax for taking a break
        $('#takeBreakBtn').click(function() {
            var form = $('#takeBreakForm');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Toggle to "End Break" button after successfully taking a break
                    $('#takeBreakForm').hide();
                    $('#endBreakForm').show();
                    console.log('Break taken successfully');
                },
                error: function(xhr, status, error) {
                    console.error('Failed to take a break');
                }
            });
        });

        // Function to handle ending a break
        $('#endBreakBtn').click(function() {
            var form = $('#endBreakForm');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Toggle to "Take a Break" button after successfully ending a break
                    $('#takeBreakForm').show();
                    $('#endBreakForm').hide();
                    console.log('Break ended successfully');
                },
                error: function(xhr, status, error) {
                    console.error('Failed to end the break');
                }
            });
        });
    </script>
@endsection
