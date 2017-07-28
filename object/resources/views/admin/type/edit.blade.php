@extends('admin.parent') 
  @section('content')
    <div class="col-xs-12">
      <div class="page-content">
        <div class="page-header">
          <h2><i class="halflings-icon white edit"></i><span class="break"></span>修改分类</h2>
        </div>
        <div class="col-xs-12">
          <form class="form-horizontal" action="{{ url('admin/type/'.$type->id) }}" method="post">
            {{ csrf_field() }} 
            {{ method_field("PUT") }}
            <fieldset>
              <div class="control-group" style="margin-bottom: 50px;">
                <label class="control-label col-md-3" for="focusedInput">原分类名</label>
                <div class="controls col-md-9">
                  <input class="input-xlarge focused" id="focusedInput" type="text" value="{{ $type->tname }}" disabled>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label col-md-3" for="focusedInput">新分类名</label>
                <div class="controls col-md-9">
                  <input class="input-xlarge focused" id="focusedInput" type="text" value="新分类名" name="tname">
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn btn-primary">提交</button>
                  <button type="reset" class="btn">重置</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div><!--/span-->
    </div><!--/row-->
  @endsection
