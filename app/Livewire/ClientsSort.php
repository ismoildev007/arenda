<?php

namespace App\Livewire;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ClientsSort extends Component
{
    public Collection $clients;

    public function mount()
    {
        $this->clients = Client::all();
    }

    public function legal()
    {
        $this->clients = Client::whereNotNull('inn')->get();
    }
    public function mall()
    {
        $this->clients = Client::all();
    }
    public function individual()
    {
        $this->clients = Client::whereNotNull('pinfl')->get();
    }

    public function render()
    {
        return view('livewire.clients-sort');
    }
}
