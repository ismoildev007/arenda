<div class="card border-top-0">
    <div class="card-body">
        <!-- [ Filter Buttons ] start -->
<style>
    .nav-link.active, .active-btn {
        background-color: #007bff; /* Bosilganda rangni o'zgartirish */
        color: white;
    }
    .nav-link {
        color: #000; /* Tugma matni uchun asosiy rang */
    }
</style>


<div class="d-flex align-items-center justify-content-between">
    <div class="nav-tabs-wrapper page-content-left-sidebar-wrapper">
        <div class="d-flex d-md-none">
            <a href="javascript:void(0)" class="page-content-left-close-toggle">
                <i class="feather-arrow-left me-2"></i>
                <span>Back</span>
            </a>
        </div>
          <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
            <li class="nav-item flex-fill border-top" role="presentation">
                <a href="javascript:void(0);" class="nav-link active" id="physical-persons-tab" data-bs-toggle="tab" data-bs-target="#physical-persons-content" role="tab">Jismoniy shaxslar</a>
            </li>
            <li class="nav-item flex-fill border-top" role="presentation">
                <a href="javascript:void(0);" class="nav-link" id="legal-persons-tab" data-bs-toggle="tab" data-bs-target="#legal-persons-content" role="tab">Yuridik shaxslar</a>
            </li>
            <li class="nav-item flex-fill border-top" role="presentation">
                <a href="javascript:void(0);" class="nav-link" id="all-clients-tab" data-bs-toggle="tab" data-bs-target="#all-clients-content" role="tab">Barchasi</a>
            </li>
        </ul>
    </div>
</div>



         <!-- <div class="mb-4 d-flex">
            <button id="individual-btn" wire:click="individual" class="btn btn-outline-primary me-2">Jismoniy shaxslar</button>
            <button id="legal-btn" wire:click="legal" class="btn btn-outline-success">Yuridik shaxslar</button>
            <button id="all-btn" wire:click="mall" class="btn btn-outline-secondary mx-2">Barchasi</button>
        </div> -->
        <!-- [ Filter Buttons ] end -->

        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="physical-persons-content" role="tabpanel">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="border-top">
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>PINFL</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                @if($client->pinfl !== null)
                                    <tr class="client-row" data-type="physical">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                                        <td>{{ $client->pinfl }}</td>
                                        <td>
                                            @if($client->company_name !== null)
                                                {{ $client->company_name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('clients.show', $client->id) }}" class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>

                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form class="dropdown-item" action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="background: none; border: none; padding: 0;"  onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="legal-persons-content" role="tabpanel">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="border-top">
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>INN</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                @if($client->pinfl === null)
                                    <tr class="client-row" data-type="legal">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                                        <td>
                                            @if($client->inn !== null)
                                                {{ $client->inn }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($client->company_name !== null)
                                                {{ $client->company_name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('clients.show', $client->id) }}" class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>

                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form class="dropdown-item" action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="background: none; border: none; padding: 0;"  onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="all-clients-content" role="tabpanel">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="border-top">
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>PINFL</th>
                                <th>INN</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                @if($client)
                                    <tr class="client-row" data-type="{{ $client->pinfl ? 'physical' : 'legal' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                                        <td>
                                            @if($client->pinfl !== null)
                                                {{ $client->pinfl }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($client->inn !== null)
                                                {{ $client->inn }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($client->company_name !== null)
                                                {{ $client->company_name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('clients.show', $client->id) }}" class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>

                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form class="dropdown-item" action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="background: none; border: none; padding: 0;"  onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

