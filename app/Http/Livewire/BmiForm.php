<?php

namespace App\Http\Livewire;

use App\Models\Bmr;
use Exception;
use Livewire\Component;

class BmiForm extends Component
{
    public $sex;
    public $age;
    public $height;
    public $weight;

    public function mount()
    {
      if (auth()->check()) {
        $bmr = auth()->user()->bmr;
        if ($bmr !== null) {
          $this->sex = $bmr->sex;
          $this->age = $bmr->age;
          $this->height = $bmr->height;
          $this->weight = $bmr->weight;
        } 
      }
    }

    public function store()
    {
        $bmr = null;

        $this->validate([
            'sex' => 'required',
            'age' => 'required|integer|min:6|max:120',
            'height' => 'required|integer|min:50|max:300',
            'weight' => 'required|integer|min:30|max:200',
        ]);
        
        $bmi = $this->calculateBmi($this->height);
        if (auth()->check()) {
            $bmr = Bmr::updateOrCreate(
                [
                    'user_id' => auth()->user()->id
                ],
                [
                    'user_id' => auth()->user()->id,
                    'sex' => $this->sex,
                    'age' => $this->age,
                    'height' => $this->height,
                    'weight' => $this->weight,
                    'bmi' => $bmi,
                    'bmr' => $this->calculateBMR($this->weight, $this->height, $this->age, $this->sex)
                ]
            );
        } else {
            $bmr = [
                'height' => $this->height,
                'weight' => $this->weight
            ];
        }

        // $this->resetInput();

        $this->emit('bmrSaved', $bmi);
    }
    public function calculateBmi($height)
    {
      if ($height == 0) return 0;
      $bmi = $this->weight / pow($this->height * 0.01, 2);
      return $bmi;
    }
    public function calculateBMR($weight, $height, $age, $sex)
    {
        if($sex == 'Male')
        {
            return 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
        }

        return 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
    }

    private function resetInput()
    {
        $this->sex = null;
        $this->age = null;
        $this->height = null;
        $this->weight = null;
    }



    public function render()
    {
        return view('livewire.bmi-form');
    }
}
