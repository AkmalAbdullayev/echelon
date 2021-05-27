@extends('layouts.master', ['title' => 'Категория товаров'])
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="title">Категория товаров</div>
            <form action="">
                <input type="search" name="q" value="{{request('q')}}" class="form-control form-control-sm" style="width: 200px;" placeholder="Введите для поиска...">
            </form>
        </div>
        <div class="card-body">
            <form action="{{ isset($model) ? route('mtrade-category-goods.update', $model->id) : route('mtrade-category-goods.store') }}" method="POST" class="form-row mb-1">
                @csrf
                @if(isset($model))
                    @method('PUT')
                @endif
                <div class="col-5">
                    <label for="">Добавить / Изменить категорию</label>
                    <select name="parent_id" class="form-control form-control-sm @error('name') is-invalid @enderror">
                        <option value="">Выберите категорию</option>
                        @foreach($result as $item)
                            <option value="{{$item->id}}" {{ isset($model) && $model->parent_category_id == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-5">
                    <label for="" class="text-white">Добавить / Изменить категорию</label>
                    <input type="text"
                           class="form-control form-control-sm @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name', $model->name ?? null) }}"
                           placeholder="Введите название..."
                           required
                    >
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-2">
                    <label for="" class="text-white">$</label>
                    <button type="submit" class="btn btn-sm btn-block btn-outline-primary">{{ isset($model) ? 'Обновить' : 'Добавить' }}</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped text-center">
                    <thead>
                    <tr class="bg-gray">
                        <th width="50">#</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th width="150">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $k => $item)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td class="text-left">{{ $item->name }}</td>
                            <td width="200">{{ $item->parent->name ?? '-' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a title="Изменить" href="{{ route('mtrade-category-goods.index') .'?edit='. $item->id }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bx bxs-edit-alt"></i>
                                    </a>
                                    <a title="Удалить" href="" data-form="category{{ $item->id }}" class="confirmDelete btn btn-sm btn-outline-danger">
                                        <i class="bx bx-trash"></i>
                                        <form action="{{ route('mtrade-category-goods.destroy', $item->id) }}" method="POST" id="category{{$item->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
