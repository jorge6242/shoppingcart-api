<?php

namespace App\Services;

use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService {

	public function __construct(ProductRepository $product) {
		$this->product = $product ;
	}

	public function index() {
		return $this->product->all();
	}

	public function create($request) {

		$image = $request['photo'];
		if($image !== null) {
			$name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
			\Image::make($request['photo'])->save(public_path('storage/products/').$name);
			$request['photo'] = $name;
		} else {
			$request['photo'] = "product-empty.png";
		}
		$request['user_id'] = auth()->user()->id;
		return $this->product->create($request);
	}

	public function update($request, $id) {
			$image = $request['photo'];
			if($image !== null) {
				$name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
				\Image::make($request['photo'])->save(public_path('storage/products/').$name);
				$request['photo'] = $name;
			} else {
				$currenPhoto = Product::all()->where('id', $id)->first();
				$request['photo'] = $currenPhoto->photo;
			}
      return $this->product->update($id, $request);
	}

	public function read($id) {
     return $this->product->find($id);
	}

	public function delete($id) {
      return $this->product->delete($id);
	}
}