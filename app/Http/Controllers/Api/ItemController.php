<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'items' => Item::all()
        ]);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $new_item = new Item();

        $new_item->name = $request->newItem;

        $new_item->save();

        return response()->json([
            'items' => Item::all()
        ]);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        $item = Item::find($id);

        if ($item) {
            $item->name = $request->itemName;

            $item->save();
        }

        return response()->json([
            'items' => Item::all()
        ]);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $item = Item::find($id);

        if ($item) {
            $item->completed = !$item->completed;

            $item->completed_at = $item->completed ? Carbon::now() : null;

            $item->save();
        }

        return response()->json([
            'items' => Item::all()
        ]);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if ($item) {
            $item->delete();
        }

        return response()->json([
            'items' => Item::all()
        ]);
    }
}
