<?php

namespace App\Http\Livewire;

use App\Models\Bmr;
use Livewire\Component;

class BmiResult extends Component
{
    public $bmi;
    public $bmr;
    
    protected $listeners = [
        'bmrSaved' => 'handleSaved'
    ];

    public function mount()
    {
      if ($this->bmr !== null) {
        $this->handleSaved($this->bmr);
      }
    }
    
    public function handleSaved($bmr)
    {
        $this->bmi = $this->calculateBMI($bmr);
    }

    public function render()
    {
        return view('livewire.bmi-result');
    }


    public function calculateBMI($input)
    {
        $bmi = array('value' => $input);

        if ($bmi['value'] < 17) {
            $bmi['category'] = 'Sangat Kurus';
        } elseif ($bmi['value'] >= 17 && $bmi['value'] < 18.4) {
            $bmi['category'] = 'Kurus Ringan';
        } elseif ($bmi['value'] >= 18.4 && $bmi['value'] < 25) {
            $bmi['category'] = 'Normal';
        } elseif ($bmi['value'] >= 25 && $bmi['value'] < 27) {
            $bmi['category'] = 'Gemuk Ringan';
        } else {
            $bmi['category'] = 'Sangat Gemuk';
        }

        return $bmi;
    }
}
