<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function postItem(Request $request)
    {
      $item = new Item;
      $item->upc_ean_isbn = $request->upc_ean_isbn;
      $item->item_name = $request->item_name;
      $item->size = $request->size;
      $item->description = $request->description;
      $item->cost_price = $request->cost_price;
      $item->selling_price = $request->selling_price;
      $item->quantity = $request->quantity;
      $item->save();

      return response()->json(['item' => $item], 201);
    }
}
