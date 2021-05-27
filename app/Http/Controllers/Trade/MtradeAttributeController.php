<?php

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use App\Models\MtradeAttribute;
use Illuminate\Http\Request;

class MtradeAttributeController extends Controller
{
    protected $model;

    public function __construct(MtradeAttribute $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $result = $this->model->where('company_id', auth()->user()->company_id);

        if (request()->filled('name')){
            $result = $result->where('name', 'LIKE', '%'.\request('name').'%');
        }

        if (request()->filled('type')){
            $result = $result->where('type', \request('type'));
        }

        if (request()->filled('required')){
            $result = $result->where('is_required', \request('required'));
        }

        $result = $result->orderBy('name')
            ->paginate(20);

        if (request()->filled('edit')){
            $model = $this->model->findOrFail(request('edit'));
            return view('trade.mtrade-attributes.index', [
                'model' => $model,
                'result' => $result
            ]);
        }

        return view('trade.mtrade-attributes.index', [
            'result' => $result
        ]);
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|integer'
        ]);

        $this->model->create([
            'name' => $request->name,
            'company_id' => auth()->user()->company_id,
            'is_required' => $request->required ? 1 : 0,
            'type' => $request->type
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

    public function update(Request $request, MtradeAttribute $mtradeAttribute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|integer'
        ]);

        $mtradeAttribute->update([
            'name' => $request->name,
            'is_required' => $request->required ? 1 : 0,
            'type' => $request->type
        ]);

        return redirect()
            ->route('mtrade-attributes.index')
            ->with('success', 'Успешно изменен!');
    }

    public function destroy(MtradeAttribute $mtradeAttribute)
    {
        try {
            if ($mtradeAttribute->delete()){
                return redirect()->route('mtrade-attributes.index')->with('success', 'Успешно удален');
            }
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
