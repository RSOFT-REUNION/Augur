<?php

namespace App\Livewire\Pages\Backend\Labels;

use App\Models\Label;
use Livewire\Component;
use Livewire\WithPagination;

class LabelList extends Component
{
    use WithPagination;

    public $search = '';
    public $jobs = [];
    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        if(strlen($this->search) > 2) {
            $this->jobs = Label::where('title', 'like', $query)->get();
        }
    }

    public function render()
    {
        $data = [];
        if($this->jobs && strlen($this->search) > 2) {
            $data['labels'] = $this->jobs->take(10);
        } else {
            $data['labels'] = Label::orderBy('title', 'asc')->paginate(15);
        }
        $data['labels_up'] = Label::where('show_home', 1)->count();
        return view('livewire.pages.backend.labels.label-list', $data);
    }
}
