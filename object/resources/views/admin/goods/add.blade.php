@extends('admin.parent')
  @section('content')
    <div class="col-xs-12">
      <div class="page-content">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span>添加商品</h2>
        </div>
        @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        <div class="col-xs-12">
          <form class="form-horizontal" action="{{ url('admin/goods') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>
              <div class="form-group">
                <label class="control-label col-md-1" for="focusedInput">商品名称</label>
                <div class="controls col-md-11">
                  <input class="input-xlarge focused" id="focusedInput" type="text" placeholder="商品名称" name="gname">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1" for="selectError3">所属分类</label>
                <div class="controls col-md-11">
                  <select id="selectError3" name="tid">
                    <option value="0">--请选择--</option>
                    @foreach($ob as $v)
                    <option value="{{ $v->id }}">{{ $v->tname }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1" for="focusedInput">商品价格</label>
                <div class="controls col-md-11">
                  <input class="input-xlarge focused" id="focusedInput" type="text" placeholder="商品价格" name="price">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1" for="focusedInput">商品主题</label>
                <div class="controls col-md-11">
                  <input class="input-xlarge focused" id="focusedInput" type="text" placeholder="主题" name="theme">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1" for="focusedInput">商品数量</label>
                <div class="controls col-md-11">
                  <input class="input-xlarge focused" id="focusedInput" type="text" placeholder="" name="num">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1" for="focusedInput">商品主图</label>
                <div class="controls col-md-11">
                  <input class="input-xlarge focused" id="focusedInput" type="file" name="picture1">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1" for="focusedInput">商品缩略图</label>
                <div class="controls col-md-11">
                  <input class="input-xlarge focused" id="focusedInput" type="file" name="picture2">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1" for="focusedInput">商品详情图</label>
                <div class="controls col-md-11">
                  <input class="input-xlarge focused" id="focusedInput" type="file" name="picture3[]"  multiple >
                </div>
              </div>
              
              <div class="clearfix form-actions">
                <div class="col-md-offset-4 col-md-8">
                  <button type="submit" class="btn btn-primary">提交</button>&nbsp;&nbsp;
                  <button type="reset" class="btn">重置</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  @endsection
