<?php

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use App\Models\MtradeCategoryGood;
use Illuminate\Http\Request;

class MtradeCategoryGoodController extends Controller
{

    protected $model;

    public function __construct(MtradeCategoryGood $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $result = $this->model->where('company_id', auth()->user()->company_id);


        if (request()->filled('edit')){
            $model = $this->model->findOrFail(\request('edit'));
            return view('trade.mtrade-category-goods.index', [
                'result' => $result,
                'model' => $model
            ]);
        }

        if (request()->filled('name')){
            $result = $result->where('name', 'LIKE', "%".\request('q')."%");
        }

        $result = $result->orderBy('name')->get();

        return view('trade.mtrade-category-goods.index', [
            'result' => $result
        ]);
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $this->model->create([
            'name' => $request->name,
            'company_id' => auth()->user()->company_id,
            'parent_category_id' => $request->parent_id ?? null
        ]);

        return back()->with('success', 'Успешно добавлено!');
    }


    public function show()
    {
        abort(404);
    }

    public function edit()
    {
        abort(404);
    }

    public function update(Request $request, MtradeCategoryGood $mtradeCategoryGood)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $mtradeCategoryGood->update([
            'name' => $request->name,
            'parent_category_id' => $request->parent_id ?? null
        ]);

        return redirect()
            ->route('mtrade-category-goods.index')
            ->with('success', 'Успешно изменен!');
    }

    public function destroy(MtradeCategoryGood $mtradeCategoryGood)
    {
        try {
            if ($mtradeCategoryGood->delete()){
                return back()->with('success', 'Успешно удален');
            }
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
