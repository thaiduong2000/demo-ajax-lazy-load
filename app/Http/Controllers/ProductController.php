<?php

namespace App\Http\Controllers;

use App\Enums\Initial;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Maker;

class ProductController extends Controller
{
  protected $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function search(Request $request)
  {
    $initials = Initial::LIST_EN;
    $maker = Maker::all();
    return view('lazyLoading.index', compact('maker', 'initials'));
  }

  public function vehicleApi(Request $request)
  {
    if ($request->ajax()) {
      $data = $this->productService->vehicleApi($request);
      return response()->json(['status' => true, 'data' => $data]);
    }
    return response()->json(['status' => false, 'data' => []]);
  }
  public function modelApi(Request $request)
  {
    if ($request->ajax()) {
      $data = $this->productService->modelApi($request);
      return response()->json(['status' => true, 'data' => $data]);
    }
    return response()->json(['status' => false, 'data' => []]);
  }
}
