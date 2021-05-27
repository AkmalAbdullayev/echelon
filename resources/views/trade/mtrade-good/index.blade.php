@extends("layouts.master", ["title" => "Товары"])
@section("content")
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="title">Товары</div>
            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Добавить
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped text-center">
                    <thead>
                    <tr class="bg-gray">
                        <th width="50">#</th>
                        <th>Штрих код</th>
                        <th>Атрибут товара</th>
                        <th>Атрибуты</th>
                        <th>Картинка</th>
                        <th width="150">Действия</th>
                    </tr>
                    <tr class="bg-gray">
                        <th></th>
                        <th>
                            <form action="" onsubmit="this.submit()">
                                <input type="text"
                                       name="sku"
                                       class="form-control form-control-sm"
                                       placeholder="Введите для поиска..."
                                       value="{{ request('sku') }}">
                            </form>
                        </th>
                        <th>
                            <form action="">
                                <select name="mtrade_good_attribute_id"
                                        onchange="this.closest('form').submit()"
                                        class="form-control form-control-sm">
                                    <option value="">Выберите</option>
                                    @foreach($good_attributes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </th>
                        <th>
                            <form action="" onsubmit="this.submit()">
                                <input type="text"
                                       name="attribute"
                                       class="form-control form-control-sm"
                                       placeholder="Введите для поиска..."
                                       value="{{ request('attribute') }}"
                                >
                            </form>
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $key => $val)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $val->sku }}</td>
                            <td>{{ $val->mTradeGoodAttribute->name ?? '' }}</td>
                            <td>
                                <?php
                                $attributes = explode(',', $val->attributes);
                                ?>
                                @foreach($attributes as $item)
                                    <i class="badge badge-primary badge-pill">{{ $val->getAttributeName($item) }}</i>
                                @endforeach
                            </td>
                            <td>
                                @if($val->picture)
                                    <img src="{{ asset('storage/'.$val->picture) }}" alt="" width="50" class="rounded">
                                @else
                                    <i> - </i>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route("print")}}" target="_blank" class="btn btn-sm btn-outline-primary" title="Распечатать">
                                        <i class="bx bx-printer"></i>
                                    </a>
                                    <a href="{{route('mtrade-good.index') .'?edit='. $val->id}}" class="btn btn-sm btn-outline-primary" title="Изменить">
                                        <i class="bx bxs-edit-alt"></i>
                                    </a>
                                    <a href="" data-form="item{{$val->id}}" class="confirmDelete btn btn-sm btn-outline-danger" title="Удалить">
                                        <i class="bx bx-trash"></i>
                                        <form action="{{ route('mtrade-good.destroy', $val->id) }}" method="POST" id="item{{$val->id}}">
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
            {{ $result->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <div class="modal fade"
         id="exampleModalCenter"
         tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true"
    >
        <div class="modal-dialog modal-lg modal-dialog-centered"
             role="document"
        >
            <div class="modal-content">
                <form action="{{ route('mtrade-good.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Товары</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Выход">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Штрих код <i class="text-danger">*</i></label>
                                    <input type="text"
                                           class="@error('sku') is-invalid @enderror form-control form-control-sm"
                                           name="sku" placeholder="Введите..."
                                           value="{{ old('sku') }}"
                                           required
                                    >
                                    @error('sku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Атрибут товара <i class="text-danger">*</i></label>
                                    <select name="mtrade_good_attribute_id" id="good_attribute_id"
                                            class="form-control form-control-sm" required>
                                        <option value="">Выбрать</option>
                                        @foreach($good_attributes as $k => $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('mtrade_good_attribute')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div id="attributes" class="form-group"></div>
                        <input type="hidden" name="attribute_value_ids" id="attribute_value_ids">
                        <div class="form-group">
                            <label for="">Добавить картинку <i class="text-danger">*</i></label>
                            <div class="custom-file">
                                <input type="file" accept="image/*" name="picture"
                                       class="d-one @error('picture') is-invalid @enderror custom-file-input"
                                       id="getFile"
                                       required
                                >
                                <label for="getFile" class="custom-file-label">Выбрать файл</label>
                            </div>
                            @error('picture')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
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
        <div class="modal fade"
             id="exampleModalCenterEdit"
             tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('mtrade-good.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Товары</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Выход">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Штрих код <i class="text-danger">*</i></label>
                                        <input type="text"
                                               class="@error('sku') is-invalid @enderror form-control form-control-sm"
                                               name="sku" placeholder="Введите..."
                                               value="{{ old('sku', $model->sku) }}" required>
                                        @error('sku')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Атрибут товара <i class="text-danger">*</i></label>
                                        <select name="mtrade_good_attribute_id" id="good_attribute_id_edit"
                                                class="form-control form-control-sm" required>
                                            <option value="">Выбрать</option>
                                            @foreach($good_attributes as $k => $v)
                                                <option value="{{$v->id}}" {{ $v->id == $model->mtrade_good_attribute_id ? 'selected' : '' }}>{{$v->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('mtrade_good_attribute')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="attributes_edit" class="form-group"></div>
                            <input type="hidden" name="attribute_value_ids" id="attribute_value_ids_edit">
                            <div class="form-group">
                                <label for="">Добавить новую картинку </label>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" name="picture"
                                           class="d-one @error('picture') is-invalid @enderror custom-file-input"
                                           id="getFileEdit">
                                    <label for="getFileEdit" class="custom-file-label">Выбрать файл</label>
                                </div>
                                @error('picture')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($model->picture)
                                    <a href="{{ asset('storage/'.$model->picture) }}" target="_blank" class="btn btn-outline-info btn-sm mt-1">
                                        <img src="{{ asset('storage/'.$model->picture) }}" alt="{{$model->sku}}" width="50">
                                    </a>
                                @endif
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
        $(window).on('load', function (){
            loadData($('#good_attribute_id_edit').val(), true)
        });


        function loadData(id, edit = false){
            if (edit){
                if (id !== '') {
                    $.get(`/ajax/m-trade-attribute-values/${id}`, function (data) {
                        $('#attributes_edit').html(``)
                        $('#attributes_edit').append(data)
                    });
                } else {
                    $('#attributes_edit').html(``)
                }
            }else{
                if (id !== '') {
                    $.get(`/ajax/m-trade-attribute-values/${id}`, function (data) {
                        $('#attributes').html(``)
                        $('#attributes').append(data)
                    });
                } else {
                    $('#attributes').html(``)
                }
            }
        }
        $('#good_attribute_id').on('change', function () {
            loadData($(this).val())
        })

        $('#good_attribute_id_edit').on('change', function () {
            loadData($(this).val(), true)
        })

        $('#getFile').on('change', function (e) {
            $(this).parents('.form-group').find('.invalid-feedback').remove()
            $(this).parents('.form-group').append(`
                <span class="invalid-feedback" role="alert">
                    <strong>${e.target.value}</strong>
                </span>
            `)
        })


        $('#attributes').on('change', '.my-custom-radio input', function () {
            let atValIds = [];
            $.each($('#attributes tr'), function (i, item) {
                if ($(this).find('input[type=radio]:checked').val() !== undefined) {
                    atValIds.push($(this).find('input[type=radio]:checked').val())
                }
            })
            $('#attribute_value_ids').val(atValIds)
        })

        $('#attributes_edit').on('change', '.my-custom-radio input', function () {
            let atValIds = [];
            $.each($('#attributes_edit tr'), function (i, item) {
                if ($(this).find('input[type=radio]:checked').val() !== undefined) {
                    atValIds.push($(this).find('input[type=radio]:checked').val())
                }
            })
            $('#attribute_value_ids_edit').val(atValIds)
        })

    </script>
@endpush
