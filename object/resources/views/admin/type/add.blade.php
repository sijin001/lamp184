@extends('admin.parent') 
  @section('content')
    <div class="col-xs-12">
      <div class="page-content">
        <div class="page-header">
          <h3><i class="halflings-icon white edit"></i><span class="break"></span>添加分类</h3>
          <!-- 显示验证错误信息于视图中 -->
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>
        <div class="col-xs-12">
          <form class="form-horizontal" action="{{ url('admin/type') }}" method="post">
            {{ csrf_field() }}
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="focusedInput">请输入商品分类名</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="tname">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="focusedInput">系列</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="series">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <input type="hidden" name="path" value="0">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <input type="hidden" name="upid" value="0">
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="reset" class="btn">重置</button>
              </div>
            </fieldset>
            </form>
        </div>
      </div><!--/span-->
    </div><!--/row-->
@endsection
