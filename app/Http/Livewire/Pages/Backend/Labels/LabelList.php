<?php

namespace App\Http\Livewire\Pages\Backend\Labels;

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
        $data['labels_up'] = Label::where('show_home', 1)->count();
        return view('livewire.pages.backend.labels.label-list', $data);
    }
}
