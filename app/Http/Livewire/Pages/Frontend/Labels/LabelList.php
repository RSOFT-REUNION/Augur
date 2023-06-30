<?php

namespace App\Http\Livewire\Pages\Frontend\Labels;

use App\Models\Label;
use Livewire\Component;
use Livewire\WithPagination;

class LabelList extends Component
{
    use WithPagination;
    public function render()
    {
        $data = [];
        $data['labels'] = Label::orderBy('title', 'asc')->paginate(15);
        return view('livewire.pages.frontend.labels.label-list', $data);
    }
}
