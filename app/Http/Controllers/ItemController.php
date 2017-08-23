<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
//use JWTAuth;

class ItemController extends Controller
{
    public function postItem(Request $request)
    {
      //\Log::info($request->all());
      // if(!$user = JWTAuth::parseToken()->authenticate()) {
      //   return response()->json([
      //     'mesage' => 'Page not found'
      //     ], 404);
      // }
      //$user = JWTAuth::parseToken()->toUser();
      $exploded = explode(',', $request->avatar);
      $decoded = base64_decode($exploded[1]);
      if(str_contains($exploded[0], 'jpeg'))
        $extention = 'jpg';
      elseif(str_contains($exploded[0], 'gif'))
        $extention = 'gif';
      else
        $extention = 'png';

      $fileName = str_random() .'.'. $extention;
      $path = public_path() . '/img/items/' . $fileName;
      file_put_contents($path, $decoded);

      $item = new Item;
      $item->upc_ean_isbn = $request->upc_ean_isbn;
      $item->item_name = $request->item_name;
      $item->size = $request->size;
      $item->description = $request->description;
      $item->cost_price = $request->cost_price;
      $item->selling_price = $request->selling_price;
      $item->quantity = $request->quantity;
      $item->avatar = $fileName;
      $item->save();

      //return response()->json(['item' => $item, 'user' => $user], 201);
    }

    public function getItem()
    {
    	$item = Item::all();
    	return response()->json(['item' => $item], 200);
    }

    public function showItem($id)
    {
      $item = Item::findOrFail($id);
      return response()->json(['item' => $item], 200);
    }

    public function editItem(Request $request, $id)
    {
      $item = Item::findOrFail($id);
      $item->upc_ean_isbn = $request->upc_ean_isbn;
      $item->item_name = $request->item_name;
      $item->size = $request->size;
      $item->description = $request->description;
      $item->cost_price = $request->cost_price;
      $item->selling_price = $request->selling_price;
      $item->quantity = $request->quantity;
      $item->save();

      return response()->json(['item' => $item], 200);
    }

    public function deleteItem($id)
    {
      return Item::destroy($id);
    }
}
