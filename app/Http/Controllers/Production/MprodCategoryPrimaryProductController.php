<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\MprodCategoryPrimaryProduct;
use Illuminate\Http\Request;

class MprodCategoryPrimaryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryPrimaryProducts = MprodCategoryPrimaryProduct::paginate(20);

        return view('production.category-primary-product.index', compact('categoryPrimaryProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:150|min:2|required'
        ], validateText());

        try {
            MprodCategoryPrimaryProduct::create([
                'company_id' => 1,
                'name' => $request->name
            ]);

            return back()->with('success', 'Successfully saved!');
        } catch (\Exception $exception) {
            return back()->with('danger', 'Oops, something went wrong. Please try again!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MprodCategoryPrimaryProduct $mprodCategoryPrimaryProduct
     * @return \Illuminate\Http\Response
     */
    public function show(MprodCategoryPrimaryProduct $mprodCategoryPrimaryProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MprodCategoryPrimaryProduct $mprodCategoryPrimaryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(MprodCategoryPrimaryProduct $mprodCategoryPrimaryProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MprodCategoryPrimaryProduct $mprodCategoryPrimaryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:150|min:2|required'
        ], validateText());

        $mprodCategoryPrimaryProduct = MprodCategoryPrimaryProduct::findOrFail($id);

        try {
            $mprodCategoryPrimaryProduct->update([
                'name' => $request->name
            ]);

            return back()->with('success', 'Successfully changed!');
        } catch (\Exception $exception) {
            return back()->with('danger', 'Oops, something went wrong. Please try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MprodCategoryPrimaryProduct $mprodCategoryPrimaryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $mprodCategoryPrimaryProduct = MprodCategoryPrimaryProduct::findOrFail($request->id);

        try {
            $mprodCategoryPrimaryProduct->delete();

            return back()->with('success', 'Successfully deleted!');
        } catch (\Exception $exception) {
            return back()->with('danger', 'Oops, something went wrong. Please try again!');
        }
    }
}
