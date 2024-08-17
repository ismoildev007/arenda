<!-- resources/views/dashboards/manager.blade.php -->

@extends('layouts.layout')

@section('content')

    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            <h1>Manager Dashboard</h1>
            <p>Welcome, {{ Auth::user()->first_name }}! You have manager-level access.</p>
        </div>
    </main>
<!--! ================================================================ !-->
<!--! [End] Main Content !-->
<!--! ================================================================ !-->
@endsection
