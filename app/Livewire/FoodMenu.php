<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Food;

class FoodMenu extends Component
{
    public $category = 'All';

    public function setCategory($name)
    {
        $this->category = $name;
    }

    public function render()
    {
        $foods = ($this->category == 'All') 
            ? Food::all() 
            : Food::where('category', $this->category)->get();

        return view('livewire.food-menu', [
            'foods' => $foods
        ]);
    }

    // Add this to your FoodMenu.php
public function addToCart($foodId)
{
    // Logic for adding to session or database
    // For example, if using a cart package or session:
    $food = Food::findOrFail($foodId);
    
    // Example using Session:
    $cart = session()->get('cart', []);
    $cart[$foodId] = [
        "name" => $food->name,
        "quantity" => ($cart[$foodId]['quantity'] ?? 0) + 1,
        "price" => $food->price,
        "image" => $food->image
    ];
    session()->put('cart', $cart);

    $this->dispatch('cartUpdated'); // Notify other components
}

}