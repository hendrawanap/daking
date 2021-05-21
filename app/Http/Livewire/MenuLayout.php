<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;

class MenuLayout extends Component
{
    public $userMenus;
    public $recMenus;
    public $menu;
    public $selected;
    public $showForm = false;

    protected $listeners = [
      'closeForm' => 'handleClose'
    ];

    public function mount() {
      if ($this->userMenus->count() !== 0) {
        $this->userMenu = $this->userMenus[0];
        $this->selected = $this->userMenu->name;
      } else {
        $this->selected = $this->recMenus[0]->name; 
      }
    }

    public function setMenu(Menu $menu, bool $isUserMenu) {
      $this->menu = $menu;
      $this->selected = $menu->name;
      $this->emit('menuUpdated', $menu, $isUserMenu);
    }

    public function handleClose()
    {
      $this->showForm = false;
    }

    public function render()
    {
        return view('profile.menu-layout');
    }
}
