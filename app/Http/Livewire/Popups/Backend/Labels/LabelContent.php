<?php

namespace App\Http\Livewire\Popups\Backend\Labels;

use App\Models\Label;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class LabelContent extends ModalComponent
{
    public $label;
    public $up;

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    public function mount($label_id)
    {
        $this->label = Label::where('id', $label_id)->first();
        if($this->label->show_home == 1) {
            $this->up = 1;
        } else {
            $this->up = 0;
        }
    }

    public function up()
    {
        switch ($this->label->show_home) {
            case 0 :
                $this->label->show_home = 1;
                $this->label->update();
                $this->up = 1;
                break;
            case 1 :
                $this->label->show_home = 0;
                $this->label->update();
                $this->up = 0;
                break;
        }
    }

    public function delete()
    {
        $this->label->delete();
        return redirect()->route('bo.labels');
    }

    public function render()
    {
        $data = [];
        $data['label'] = $this->label;
        $data['up'] = $this->up;
        return view('livewire.popups.backend.labels.label-content', $data);
    }
}
