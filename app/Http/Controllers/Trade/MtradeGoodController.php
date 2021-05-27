<?php

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use App\Models\MtradeAttributeValue;
use App\Models\MtradeGood;
use App\Models\MtradeGoodAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorHTML;

class MtradeGoodController extends Controller
{
    protected $model;

    public function __construct(MtradeGood $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $user = auth()->user();

        $good_attributes = MtradeGoodAttribute::with(['mtradeAttributeValues', 'mtradeCategoryGood' => function($q) use ($user){
            $q->where('company_id', $user->company_id);
        }])->get();

        $mtrade_goods = MtradeGood::with(['mTradeGoodAttribute' => function($q){
            $q->with(['mtradeAttributeValues', 'mtradeCategoryGood'  => function($query){
                $query->where('company_id', auth()->user()->company_id);
            }]);
        }]);

        if (request()->filled('sku')){
            $mtrade_goods = $mtrade_goods->where('sku', 'LIKE', '%'.request('sku').'%');
        }


        if (request()->filled('edit')){
            $model = MtradeGood::findOrFail(request('edit'));
            return view("trade.mtrade-good.index", [
                "good_attributes" => $good_attributes,
                'result' => $mtrade_goods,
                'model' => $model,
            ]);
        }
        $mtrade_goods = $mtrade_goods->paginate(10);


        return view("trade.mtrade-good.index", [
            "good_attributes" => $good_attributes,
            'result' => $mtrade_goods
        ]);
    }

    public function ajaxGetAttributeValues($id)
    {
        $attr_values = MtradeAttributeValue::with(['mTradeGoodAttribute', 'mTradeAttribute'])
            ->where('mtrade_good_attribute_id', $id)->orderBy('id', 'desc')
            ->get()->groupBy('mtrade_attribute_id');
        return view('trade.mtrade-good.render-attribute-value', compact('attr_values'))->render();
    }

    public function create()
    {
        abort(404);
    }

    public function store()
    {
        \request()->validate([
            'sku' => 'required',
            'mtrade_good_attribute_id' => 'required',
            'attribute_value_ids' => 'required',
            'picture' => 'required|max:10000'
        ]);

        try {
            $save = $this->model->create([
                'sku' => \request('sku'),
                'mtrade_good_attribute_id' => \request('mtrade_good_attribute_id'),
                'attributes' => \request('attribute_value_ids'),
            ]);

            if (\request()->hasFile('picture')){
                $file = \request('picture');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('goods', $filename);
                $save->update([
                    'picture' => $path
                ]);
            }
            return redirect()->route('mtrade-good.index')
                ->with('success', 'Успешно добавлено');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function show(MtradeGood $mtradeGood)
    {
        abort(404);
    }

    public function edit(MtradeGood $mtradeGood)
    {
        abort(404);
    }

    public function update(Request $request, MtradeGood $mtradeGood)
    {
        \request()->validate([
            'sku' => 'required',
            'mtrade_good_attribute_id' => 'required',
            'attribute_value_ids' => 'required',
            'picture' => 'nullable|max:10000'
        ]);

        try {
            $mtradeGood->update([
                'sku' => \request('sku'),
                'mtrade_good_attribute_id' => \request('mtrade_good_attribute_id'),
                'attributes' => \request('attribute_value_ids'),
            ]);

            if (\request()->hasFile('picture')){
                $file = \request('picture');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('goods', $filename);
                Storage::disk('public')->delete($mtradeGood->picture);
                $mtradeGood->update(['picture' => $path]);
            }
            return redirect()->route('mtrade-good.index')
                ->with('success', 'Успешно обновлено');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function destroy(MtradeGood $mtradeGood)
    {
        try {
            if ($mtradeGood->delete()){
                return redirect()->route('mtrade-good.index')
                    ->with('success', 'Успешно удален');
            }
            return redirect()->route('mtrade-good.index')
                ->with('danger', 'Ошибка удаления');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function print()
    {
        $generator = new BarcodeGeneratorHTML();
        $generator->getBarcode("12345", $generator::TYPE_CODE_128);
        return view("trade.mtrade-good.print", [
            "barcode" => $generator->getBarcode("12345", $generator::TYPE_CODE_128)
        ]);
    }
}
