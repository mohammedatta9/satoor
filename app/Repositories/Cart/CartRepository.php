<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository
{
    public function get($owner_id = null) : Collection;

    public function add(Product $product, $owner_id = null, $quantity = 1);

    public function update($id, $quantity);

    public function delete($id);

    public function empty();

    public function total($owner_id = null) : float;
}
