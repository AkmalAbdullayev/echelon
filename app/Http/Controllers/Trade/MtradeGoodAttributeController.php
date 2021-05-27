<?php

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use App\Models\MtradeAttribute;
use App\Models\MtradeAttributeValue;
use App\Models\MtradeCategoryGood;
use App\Models\MtradeGoodAttribute;
use App\Models\MtradeUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MtradeGoodAttributeController extends Controller
{
    protected $model;

    public function __construct(MtradeGoodAttribute $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $user = auth()->user();

        $result = $this->model->with(['mtradeAttributeValues', 'mtradeCategoryGood' => function($q) use ($user){
            $q->where('company_id', $user->company_id);
        }]);

        $categories = MtradeCategoryGood::where('company_id', $user->company_id)
            ->orderBy('name')
            ->get();

        $units = MtradeUnit::where('company_id', $user->company_id)
            ->orderBy('name')
            ->get();

        $attributes = MtradeAttribute::where('company_id', $user->company_id)
            ->orderBy('name')
            ->get();

        if (request()->filled('name')){
            $result = $this->model->where('name', 'LIKE', "%".\request('name')."%");
        }

        if (request()->filled('category_id')){
            $result = $this->model->where('mtrade_category_good_id', request('category_id'));
        }

        if (request()->filled('unit_id')){
            $result = $this->model->where('unit_id', request('unit_id'));
        }

        if (request()->filled('weight')){
            $result = $this->model->where('weight', 'LIKE', request('weight') . '%');
        }

        $result = $result->orderBy('name')
            ->paginate(20);


        if (request()->filled('edit')){
            $model = $this->model->with(['mtradeAttributeValues', 'mtradeCategoryGood'])
                ->findOrFail(request('edit'));
            return view('trade.mtrade-good-attribute.index', [
                'categories' => $categories,
                'attributes' => $attributes,
                'result' => $result,
                'model' => $model,
                'units' => $units,
            ]);
        }

        return view('trade.mtrade-good-attribute.index', [
            'categories' => $categories,
            'attributes' => $attributes,
            'units' => $units,
            'result' => $result
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'weight' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'attribute_id' => 'required|array',
            'attribute_value' => 'required|array',
        ]);

        DB::transaction(function () use ($request){
            $model = new $this->model();
            $model->name = $request->name;
            $model->mtrade_category_good_id = $request->category_id;
            $model->unit_id = $request->unit_id;
            $model->weight = $request->weight;
            if ($request->filled('tags')){
                $tags = explode(',', $request->tags);
                $model->tags = json_encode($tags, JSON_UNESCAPED_UNICODE);
            }

            if ($request->filled('attribute_id')){
                $attribute_ids = $request->attribute_id;
            }

            if ($request->filled('attribute_value')){
                $attribute_values = $request->attribute_value;
            }
            $attributes = [];
            foreach ($attribute_ids as $k => $item) {
                if (!array_key_exists($item, $attributes)){
                    $attributes[$item] = $attribute_values[$k];
                }else{
                    $attributes[$item] = $attributes[$item]. ',' .$attribute_values[$k];
                }
            }
            $model->save();
            if (count($attributes) > 0){
                foreach ($attributes as $k => $item){
                    $values = explode(',', $item);
                    foreach ($values as $val){
                        MtradeAttributeValue::create([
                            'mtrade_good_attribute_id' => $model->id,
                            'mtrade_attribute_id' => $k,
                            'value' => $val,
                        ]);
                    }
                }
            }
        });
        return redirect()->route('mtrade-good-attribute.index')->with('success', 'Успешно добавлено!');
    }

    public function show($id)
    {
        abort(404);
    }

    public function update(Request $request, MtradeGoodAttribute $mtradeGoodAttribute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'weight' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'attribute_id' => 'required|array',
            'attribute_value' => 'required|array',
        ]);

        DB::transaction(function () use ($mtradeGoodAttribute, $request){
            $mtradeGoodAttribute->name = $request->name;
            $mtradeGoodAttribute->mtrade_category_good_id = $request->category_id;
            $mtradeGoodAttribute->unit_id = $request->unit_id;
            $mtradeGoodAttribute->weight = $request->weight;
            if ($request->filled('tags')){
                $tags = explode(',', $request->tags);
                $mtradeGoodAttribute->tags = json_encode($tags, JSON_UNESCAPED_UNICODE);
            }

            if ($request->filled('attribute_id')){
                $attribute_ids = $request->attribute_id;
            }

            if ($request->filled('attribute_value')){
                $attribute_values = $request->attribute_value;
            }
            $attributes = [];
            foreach ($attribute_ids as $k => $item) {
                if (!array_key_exists($item, $attributes)){
                    $attributes[$item] = $attribute_values[$k];
                }else{
                    $attributes[$item] = $attributes[$item]. ',' .$attribute_values[$k];
                }
            }
            $mtradeGoodAttribute->save();

            $mtradeGoodAttribute->mtradeAttributeValues()->delete();

            if (count($attributes) > 0){
                foreach ($attributes as $k => $item){
                    $values = explode(',', $item);
                    foreach ($values as $val){
                        MtradeAttributeValue::create([
                            'mtrade_good_attribute_id' => $mtradeGoodAttribute->id,
                            'mtrade_attribute_id' => $k,
                            'value' => $val,
                        ]);
                    }
                }
            }
        });
        return redirect()->route('mtrade-good-attribute.index')
            ->with('success', 'Успешно обновлен!');
    }

    public function destroy(MtradeGoodAttribute $mtradeGoodAttribute)
    {
        try {
            if ($mtradeGoodAttribute->mtradeAttributeValues()->delete()){
                $mtradeGoodAttribute->delete();
                return redirect()->route('mtrade-good-attribute.index')
                    ->with('success', 'Успешно удален');
            }
            return redirect()->route('mtrade-good-attribute.index')
                ->with('danger', 'Ошибка удаления');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
