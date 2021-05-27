@extends('layouts.master', ['title' => 'Атрибуты товаров'])
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="title">Атрибуты товаров</div>
            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">Добавить</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped text-center">
                    <thead>
                    <tr class="bg-gray">
                        <th width="50">#</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Ед.изм</th>
                        <th>Вес</th>
                        <th width="150">Действия</th>
                    </tr>
                    <tr class="bg-gray">
                        <th></th>
                        <th>
                            <form action="" onsubmit="this.submit()">
                                <input type="text"
                                       name="name"
                                       class="form-control form-control-sm"
                                       placeholder="Введите..."
                                       value="{{ request('name') }}">
                            </form>
                        </th>
                        <th>
                            <form action="">
                                <select name="category_id"
                                        onchange="this.closest('form').submit()"
                                        class="form-control form-control-sm">
                                    <option value="">Выберите</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id  }}" {{request('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </th>
                        <th width="150">
                            <form action="">
                                <select name="unit_id"
                                        onchange="this.closest('form').submit()"
                                        class="form-control form-control-sm">
                                    <option value="">Выберите</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id  }}" {{request('unit_id') == $unit->id ? 'selected' : ''}}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </th>
                        <th width="100">
                            <form action="" onsubmit="this.submit()">
                                <input type="number"
                                       name="weight"
                                       class="form-control form-control-sm"
                                       placeholder="Введите..."
                                       value="{{ request('weight') }}">
                            </form>
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $k => $item)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td class="text-left">{{ $item->name }}</td>
                            <td class="text-left">{{ $item->mtradeCategoryGood->name ?? ' - ' }}</td>
                            <td>
                                <span class="btn btn-sm btn-outline-primary">{{ $item->mtradeUnit->name ?? $item->unit_id }}</span>
                            </td>
                            <td>{{ $item->weight }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="" class="btn btn-sm btn-outline-primary openProductsTD" title="Открыть"><i class="bx bx-folder-open"></i></a>
                                    <a href="{{route('mtrade-good-attribute.index') .'?edit='. $item->id}}" class="btn btn-sm btn-outline-primary" title="Изменить">
                                        <i class="bx bxs-edit-alt"></i>
                                    </a>
                                    <a href="" data-form="item{{$item->id}}" class="confirmDelete btn btn-sm btn-outline-danger" title="Удалить">
                                        <i class="bx bx-trash"></i>
                                        <form action="{{ route('mtrade-good-attribute.destroy', $item->id) }}" method="POST" id="item{{$item->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="child-elements" style="display: none">
                            <td></td>
                            <td colspan="5">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th>Теги</th>
                                        <th>Атрибуты</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td width="200">
                                            @foreach(json_decode($item->tags) as $it)
                                                <span class="btn btn-sm btn-outline-primary" style="margin: 3px 0;">{{ $it }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <table class="table table-sm text-left table-bordered mb-0">
                                                <?php
                                                    $result1 = [];
                                                    foreach ($item->mtradeAttributeValues as $obj) {
                                                        if (isset($result1[$obj->mtradeAttribute->name])) {
                                                            $result1[$obj->mtradeAttribute->name] .= ', '.$obj->value;
                                                        } else{
                                                            $result1[$obj->mtradeAttribute->name] = $obj->value;
                                                        }
                                                    }
                                                ?>
                                                    @foreach($result1 as $key => $value)
                                                        <tr>
                                                            <td class="border-bottom font-weight-bold" width="250">{{ $key }}</td>
                                                            <td class="border-bottom">
                                                                <span class="badge badge-pill badge-light-primary">{{ $value }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $result->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <div class="modal fade"
         id="exampleModalCenter"
         tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('mtrade-good-attribute.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Добавить атрибут товара</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Выход">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Название <i class="text-danger">*</i></label>
                            <input type="text" class="@error('name') is-invalid @enderror form-control form-control-sm"
                                   name="name" placeholder="Ввеедите название..."
                                   value="{{ old('name') }}"
                                   required
                            >
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="">Категория <i class="text-danger">*</i></label>
                                    <select name="category_id"
                                            class="form-control-sm form-control"
                                            required
                                    >
                                        <option value="">Выберите</option>
                                        @foreach($categories as $k => $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="">Единица измерения <i class="text-danger">*</i></label>
                                    <select name="unit_id"
                                            class="@error('unit_id') is-invalid @enderror form-control-sm form-control"
                                            required
                                    >
                                        <option value="">Выберите</option>
                                        @foreach($units as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="">Теги</label>
                                    <input type="text"
                                           class="form-control @error('tags') is-invalid @enderror form-control-sm"
                                           data-role="tagsinput"
                                           name="tags"
                                           placeholder="Введите..."
                                    >
                                    @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="">Вес </label>
                                    <input type="text" class="@error('weight') is-invalid @enderror form-control-sm form-control"
                                           name="weight" placeholder="Введите вес..."
                                           value="{{ old('weight') }}"
                                    >
                                    @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group tags-group">
                            <label for="">Значение атрибутов товара</label>
                            <div class="row tags first-tags-row mb-1">
                                <div class="col-5">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" name="attribute_id[]" required>
                                            <option value="">Выберите атрибут</option>
                                            @foreach($attributes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <input type="text"
                                               name="attribute_value[]"
                                               class="form-control-sm form-control tagsinput"
                                               data-role="tagsinput"
                                               required
                                        >
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="btn-group btn-group-sm w-100 font-weight-bold">
                                        <button type="button" class="btn btn-sm btn-primary addAttributeRow">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Отмена</span>
                        </button>
                        <button type="submit" class="btn btn-sm btn-outline-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Добавить</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(isset($model))
        <div class="modal fade edit-modal" id="exampleModalCenterEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitleEdit" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('mtrade-good-attribute.update', $model->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Изменить атрибут товара</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Выход">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Название <i class="text-danger">*</i></label>
                                <input type="text" class="@error('name') is-invalid @enderror form-control form-control-sm"
                                       name="name" placeholder="Ввеедите название..."
                                       value="{{ old('name', $model->name) }}"
                                       required
                                >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="">Категория <i class="text-danger">*</i></label>
                                        <select name="category_id"
                                                class="form-control-sm form-control"
                                                required
                                        >
                                            <option value="">Выберите</option>
                                            @foreach($categories as $k => $item)
                                                <option value="{{$item->id}}" {{ $item->id == $model->mtrade_category_good_id ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="">Единица измерения <i class="text-danger">*</i></label>
                                        <select name="unit_id"
                                                class="@error('unit_id') is-invalid @enderror form-control-sm form-control"
                                                required
                                        >
                                            <option value="">Выберите</option>
                                            @foreach($units as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $model->unit_id ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="">Теги</label>
                                        <input type="text"
                                               class="form-control @error('tags') is-invalid @enderror form-control-sm"
                                               data-role="tagsinput"
                                               name="tags"
                                               value="{{implode(',', json_decode($model->tags))}}"
                                               placeholder="Введите..."
                                        >
                                        @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="">Вес </label>
                                        <input type="text" class="@error('weight') is-invalid @enderror form-control-sm form-control"
                                               name="weight" placeholder="Введите вес..."
                                               value="{{ old('weight', $model->weight) }}"
                                        >
                                        @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group tags-group">
                                <label for="">Значение атрибутов товара</label>
                                <?php
                                $result1 = [];
                                foreach ($model->mtradeAttributeValues as $obj) {
                                    if (isset($result1[$obj->mtradeAttribute->id])) {
                                        $result1[$obj->mtradeAttribute->id] .= ', '.$obj->value;
                                    } else{
                                        $result1[$obj->mtradeAttribute->id] = $obj->value;
                                    }
                                }
                                $i=0;
                                ?>
                                @foreach($result1 as $k => $attrValue)
                                    <div class="row tags {{$i == 0 ? 'first-tags-row' : ''}} mb-1">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" name="attribute_id[]" required>
                                                <option value="">Выберите атрибут</option>
                                                @foreach($attributes as $item)
                                                    <option value="{{ $item->id }}" {{ $k == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text"
                                                   name="attribute_value[]"
                                                   class="form-control-sm form-control tagsinput"
                                                   value="{{$attrValue}}"
                                                   data-role="tagsinput"
                                                   required
                                            >
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="btn-group btn-group-sm w-100 font-weight-bold">
                                            @if($i > 0)
                                                <button type="button" class="btn btn-sm btn-danger removeAttributeRow">-</button>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-primary addAttributeRow">+</button>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++?>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Отмена</span>
                            </button>
                            <button type="submit" class="btn btn-sm btn-outline-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Обновить</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @push('js')
            <script>
                $('#exampleModalCenterEdit').modal('show')
            </script>
        @endpush
    @endif
@endsection

@push('js')
    <script>
        let status = `{{ $errors->any() }}`;
        if (status) $('.card-header button').click();


        $('.tags-group').on('click', '.addAttributeRow', function (e){
            e.preventDefault();
            $('.tags-group').append(`
                <div class="row tags mb-1">
                    <div class="col-5">
                        <div class="form-group">
                            <select class="form-control form-control-sm" name="attribute_id[]" required>
                                <option value="">Выберите атрибут</option>
                                @foreach($attributes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <input type="text" data-role="tagsinput" name="attribute_value[]" required class="form-control-sm form-control tagsinput">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="btn-group btn-group-sm w-100 font-weight-bold">
                            <button type="button" class="btn btn-sm btn-danger removeAttributeRow">-</button>
                            <button type="button" class="btn btn-sm btn-primary addAttributeRow">+</button>
                        </div>
                    </div>
                </div>
            `)
            $('.tagsinput').tagsinput()
        })
        $('.tags-group').on('click', '.removeAttributeRow', function (e) {
            e.preventDefault();
            if (!$(this).parents('.tags').hasClass('first-tags-row')){
                $(this).parents('.tags').remove()
            }
        })
    </script>
@endpush
