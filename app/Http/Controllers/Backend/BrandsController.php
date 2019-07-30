<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use Image;
use File;

class BrandsController extends Controller
{
	public function index()
	{
		$brands = Brand::orderBy('id', 'desc')->get();
		return view('backend.pages.brands.index', compact('brands'));
	}

	public function create()
	{
		
		return view('backend.pages.brands.create');
	}

	public function store(Request $request)
	{
		$this-> validate($request , [

			'name' => 'required' , 
			 
			'image' => 'nullable|image' , 
		],

		[
			'name.required' => 'Please provide a Brand Name',

			'image.image' => 'File should in Image Format',

		]);

		$brand = new Brand();
		$brand->name = $request->name;
		$brand->description = $request->description;
		//$brand->image = $request->image;
		
		//insert images
		if($request->image){

			//insert image
			$image = $request->file('image');
			$img = time() . '.'. $image->getClientOriginalExtension();
			$location = public_path('images/brands/' .$img);
			Image::make($image)->save($location);
			$brand->image = $img;
		}

		$brand->save();

		session()->flash('success', 'A new brand has added successfully!!');
		return redirect()->route('admin.brands');
	}

	public function edit($id)
	{

		$brand = Brand::find($id);
		if (!is_null($brand)) {
			return view('backend.pages.brands.edit', compact('brand'));
		}
		else{
			return redirect()->route(admin.brands);
		}
	}

	public function update(Request $request, $id)
	{
		$this-> validate($request , [
			'name' => 'required' , 
			'image' => 'nullable | image' , 
		],

		[
			'name.required' => 'Please provide a brand Name',
			'image.image' => 'File should in Image Format',

		]);

		$brand = Brand::find($id);
		$brand-> name = $request->name;
		$brand-> description = $request->description;
		//insert images
		if($request->image){

			if (File::exists('images/brands/' .$brand->image)) {
				File::delete('images/brands/' .$brand->image);
			}

			//insert image
			$image = $request->file('image');
			$img = time() . '.'. $image->getClientOriginalExtension();
			$location = public_path('images/brands/' .$img);
			Image::make($image)->save($location);
			$brand->image = $img;
		}

		$brand->save();

		session()->flash('success', 'A new brand has updated successfully!!');
		return redirect()->route('admin.brands');
	}

	public function delete($id)
	{
		$brand = Brand::find($id);
		if (!is_null($brand)) {

			if (File::exists('images/brands/' .$brand->image)) {
				File::delete('images/brands/' .$brand->image);
			}


			$brand-> delete();
		}
		session()->flash('success','Brand has deleted Successfully!!');
		return back();
	}


}
