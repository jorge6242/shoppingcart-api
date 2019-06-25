<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository  {
  
    protected $post;

    public function __construct(Product $product) {
      $this->product = $product;
    }

    public function find($id) {
      $product = $this->product->find($id);
      $product->photo = url('storage/products/'.$product->photo);
      return $product;
    }

    public function create($attributes) {
      return $this->product->create($attributes);
    }

    public function update($id, array $attributes) {
      return $this->product->find($id)->update($attributes);
    }
  
    public function all() {
      $products = $this->product->all();
      foreach ($products as $key => $product) {
        $path = url('storage/products/'.$product['photo']);
        $products[$key]->photo = $path;
      }
      return $products;
    }

    public function delete($id) {
     return $this->product->find($id)->delete();
    }
}