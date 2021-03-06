@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card card-accent-info">
                        <div class="card-header">
                            编辑事物字段
                        </div>
                        <div class="card-body row">
                            <div class="col-md-8">
                                <form id="updateThingFieldForm">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right" for="name">字段名(英文)</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="name" name="name" value="{{ $field['name'] }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right" for="comment">中文名称</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" id="comment" name="comment" value="{{ $field['comment'] }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right" for="storageType">存储类型</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="storageType" id="storageType">
                                                @foreach($storageTypes as $key => $value)
                                                    <option value="{{ $key }}" @if($key===$field['storageType']) selected="selected" @endif >{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right" for="showType">展示类型</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="showType" id="showType">
                                                @foreach($showTypes as $key => $value)
                                                    <option value="{{ $key }}" @if($key===$field['showType']) selected="selected" @endif>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right" for="showOptions">展示选项(JSON)</label>
                                        <div class="col-md-9">
                                            <textarea rows="3" class="form-control" name="showOptions" id="showOptions">{{ json_encode($field['showOptions']) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right" for="isList">是否列表显示</label>
                                        <div class="col-md-9">
                                            <label class="switch switch-label switch-outline-primary-alt">
                                                <input type="checkbox" class="switch-input" @if($field['isList']) checked="checked" @endif id="isList" name="isList" value="1">
                                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right" for="isSearch">是否查询条件</label>
                                        <div class="col-md-9">
                                            <label class="switch switch-label switch-outline-primary-alt">
                                                <input type="checkbox" class="switch-input"  @if($field['isSearch']) checked="checked" @endif id="isSearch" name="isSearch" value="1">
                                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="form-group-actions col-md-9">
                                    <button class="btn btn-success btn-ladda ladda-button" data-style="zoom-out" id="updateThingFieldSubmit">
                                        <span class="ladda-label">提 交</span>
                                        <span class="ladda-spinner"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('#updateThingFieldSubmit').click(function(){
                let ladda = Ladda.create(this).start();
                let data = $('#updateThingFieldForm').serializeJSON();
                z_ajax('put',
                    '{{ route('updateThingField', ['appId'=>$appId, 'thingId'=>$thingId, 'fieldId'=>$field['id']]) }}',
                    data, function (response) {
                    let data = response.data;
                    if(data.code === 0){
                        z_notify_success(data.message ? data.message : '操作成功！', function () {
                            location.href = '{{ route('indexThingFields', ['appId'=>$appId, 'thingId'=>$thingId]) }}';
                        });
                    }else{
                        z_notify_fail(data.message ? data.message : '操作失败！');
                    }
                });
            });
        })
    </script>
@endpush