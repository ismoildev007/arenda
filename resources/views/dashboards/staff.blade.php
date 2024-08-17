<!-- resources/views/dashboards/staff.blade.php -->

@extends('layouts.layout')

@section('content')

    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            <h1>Staff Dashboard</h1>
            <p>Welcome, {{ Auth::user()->first_name }}! You have staff-level access.</p>
        </div>
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
@endsection
