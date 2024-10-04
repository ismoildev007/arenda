@extends('layouts.client')

@section('content')
<main style="margin-left: 0;" class="nxl-container">
    <div class="nxl-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Contract Details</h2>

                    <!-- Contract Information Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Contract #{{ $contract->contract_number }}</h4>
                        </div>
                        <div class="card-body">
                            <!-- Contract Details -->
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <strong>Room:</strong> 
                                    {{ $contract->room->number ?? 'N/A' }} - {{ $contract->room->floor->building->name ?? 'N/A' }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>Client:</strong> 
                                    {{ $contract->client->first_name ?? '' }} {{ $contract->client->last_name ?? '' }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <strong>Room Size:</strong> 
                                    {{ $contract->room->size ?? 'N/A' }} m<sup>2</sup>
                                </div>
                                <div class="col-sm-6">
                                    <strong>Total Amount:</strong> 
                                    {{ number_format($contract->total_amount, 0, '.', ',') }} so'm
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <strong>Start Date:</strong> 
                                    {{ $contract->start_date ? $contract->start_date->format('d M, Y') : 'N/A' }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>End Date:</strong> 
                                    {{ $contract->end_date ? $contract->end_date->format('d M, Y') : 'N/A' }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <strong>Discount:</strong> 
                                    {{ $contract->discount !== null ? number_format($contract->discount, 2) . ' %' : 'N/A' }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>Status:</strong>
                                    <span style="color: {{ $contract->status == 'active' ? 'green' : 'red' }};">
                                        <b>{{ $contract->status }}</b>
                                    </span>
                                </div>

                            </div>

                            <!-- Room Images -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5>Room Images</h5>
                                    @if(isset($contract->room->images))
                                    @if($contract->room->images && count($contract->room->images) > 0)
                                        <div class="d-flex flex-wrap">
                                            @foreach($contract->room->images as $image)
                                                <div class="me-2 mb-2">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Room Image" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No images available.</p>
                                    @endif
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('client.contract') }}" class="btn btn-primary">Back to Contracts</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
