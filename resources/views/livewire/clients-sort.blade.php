<div class="card border-top-0">
    <div class="card-body">
        <!-- [ Filter Buttons ] start -->
        <style>
            .active-btn {
                background-color: #007bff; /* Bosilganda rangni o'zgartirish uchun */
                color: white;
            }
        </style>
        <div class="mb-4 d-flex">
            <button id="individual-btn" wire:click="individual" class="btn btn-outline-primary me-2">Jismoniy shaxslar</button>
            <button id="legal-btn" wire:click="legal" class="btn btn-outline-success">Yuridik shaxslar</button>
            <button id="all-btn" wire:click="mall" class="btn btn-outline-secondary mx-2">Barchasi</button>
        </div>
        <!-- [ Filter Buttons ] end -->

        <table class="table">
            <thead>
            <tr>
                <th>Familiya</th>
                <th>Ism</th>
                <th>Otasining ismi</th>
                <th class="pinfl-header">PINFL</th>
                <th class="inn-header">INN</th>
                <th>Filial</th>
                <th>Viloyat</th>
                <th>Tuman</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->last_name }}</td>
                    <td>{{ $client->first_name }}</td>
                    <td>{{ $client->middle_name }}</td>
                    <td class="pinfl-cell">{{ $client->pinfl ?? 'N/A' }}</td>
                    <td class="inn-cell">{{ $client->inn ?? 'N/A' }}</td>
                    <td>{{ $client->branch->name }}</td>
                    <td>{{ $client->region->name }}</td>
                    <td>{{ $client->district->name }}</td>
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
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn'); // Barcha tugmalarni tanlash

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Barcha tugmalardan `active-btn` classini olib tashlash
                buttons.forEach(btn => btn.classList.remove('active-btn'));
                // Faqat bosilgan tugmaga `active-btn` classini qo'shish
                this.classList.add('active-btn');
            });
        });
    });
</script>
