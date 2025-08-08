@extends('layouts.app')

@section('content')
<div class="container py-4" style="min-height: 430px; display: flex; flex-direction: column;">
    <h2 class="mb-4">Track Your Appointments</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form action="/track" method="POST">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-9 mb-3">
                        <label>Enter Your Phone Number</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-primary w-100">Find Appointments</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (isset($appointments) && $appointments->count() > 0)
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Your Appointments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time Slot</th>
                                <th>Car License</th>
                                <th>Car Engine</th>
                                <th>Assigned Mechanic</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ date('d M Y', strtotime($appointment->appointment_date)) }}</td>
                                <td>{{ $appointment->time_slot ?? 'Not specified' }}</td>
                                <td>{{ $appointment->car_license }}</td>
                                <td>{{ $appointment->car_engine }}</td>
                                <td>{{ $appointment->mechanic->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @elseif (isset($appointments))
        <div class="alert alert-warning">
            No appointments found with this phone number.
        </div>
    @endif
</div>
@endsection
