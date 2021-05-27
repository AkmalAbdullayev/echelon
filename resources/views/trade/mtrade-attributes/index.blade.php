@extends('layouts.master', ['title' => 'Атрибуты'])
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="title">Атрибуты</div>
            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">Добавить</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped text-center">
                    <thead>
                    <tr class="bg-gray">
                        <th width="50">#</th>
                        <th>Название</th>
                        <th>Обязательный</th>
                        <th>Тип</th>
                        <th width="150">Действия</th>
                    </tr>
                    <tr class="bg-gray">
                        <th></th>
                        <th>
                            <form action="" onsubmit="this.submit()">
                                <input type="text"
                                       name="name"
                                       class="form-control form-control-sm"
                                       placeholder="Введите для поиска..."
                                       value="{{ request('name') }}"
                                       required
                                >
                            </form>
                        </th>
                        <th>
                            <form action="">
                                <select name="required"
                                        onchange="this.closest('form').submit()"
                                        class="form-control form-control-sm"
                                        required
                                >
                                    <option value="">Выберите</option>
                                    <option value="1" {{request('required') === '1' ? 'selected' : ''}}>Да</option>
                                    <option value="0" {{request('required') === '0' ? 'selected' : ''}}>Нет</option>
                                </select>
                            </form>
                        </th>
                        <th>
                            <form action="">
                                <select name="type"
                                        onchange="this.closest('form').submit()"
                                        class="form-control form-control-sm"
                                        required
                                >
                                    <option value="">Выберите</option>
                                    <option value="1" {{request('type') == 1 ? 'selected' : ''}}>Радио</option>
                                    <option value="2" {{request('type') == 2 ? 'selected' : ''}}>Чекбокс</option>
                                    <option value="3" {{request('type') == 3 ? 'selected' : ''}}>Поле</option>
                                </select>
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
                            <td width="150">
                                <span class="badge badge-pill badge-primary">
                                    {{ $item->is_required == 1 ? 'Да' : 'Нет' }}
                                </span>
                            </td>
                            <td width="150">
                                <span class="badge badge-pill badge-primary">{{ $item->typeName() }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a title="Изменить" href="{{route('mtrade-attributes.index') .'?edit='. $item->id}}" class="btn btn-sm btn-outline-primary">
                                        <i class="bx bxs-edit-alt"></i>
                                    </a>
                                    <a title="Удалить" href="" data-form="item{{$item->id}}" class="confirmDelete btn btn-sm btn-outline-danger">
                                        <i class="bx bx-trash"></i>
                                        <form action="{{ route('mtrade-attributes.destroy', $item->id) }}" method="POST" id="item{{$item->id}}">
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="{{ route('mtrade-attributes.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Добавить аттрибут</h5>
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
                        <div class="form-group">
                            <label for="">Тип <i class="text-danger">*</i></label>
                            <select name="type" class="@error('type') is-invalid @enderror form-control-sm form-control">
                                <option value="1">Радио</option>
                                <option value="2">Чекбокс</option>
                                <option value="3">Поле</option>
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" checked name="required" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Обязательный</label>
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
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="{{ route('mtrade-attributes.update', $model->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Изменить аттрибут</h5>
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
                        <div class="form-group">
                            <label for="">Тип <i class="text-danger">*</i></label>
                            <select name="type" class="@error('type') is-invalid @enderror form-control-sm form-control">
                                <option value="1" {{$model->type == 1 ? 'selected' : ''}}>Радио</option>
                                <option value="2" {{$model->type == 2 ? 'selected' : ''}}>Чекбокс</option>
                                <option value="3" {{$model->type == 3 ? 'selected' : ''}}>Поле</option>
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" {{$model->is_required == 1 ? 'checked' : ''}} name="required" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Обязательный</label>
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
        if (status){
            $('.card-header button').click()
        }
    </script>
@endpush
