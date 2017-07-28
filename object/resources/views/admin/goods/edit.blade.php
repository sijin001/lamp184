@extends('admin.parent') 
@section('content')
<div class="col-xs-12">
  <div class="page-content">
    <h4><span>商品修改</span> </h4>
    <div class="row">
      <div class="col-xs-12">
        <form class="form-horizontal" role="form" action="{{ url('admin/goods'.'/'.$goods->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 商品名称 </label>

            <div class="col-sm-11">
              <input type="text" id="form-field-1" name="gname" value="{{ $goods->gname }}" class="col-xs-10 col-sm-5" />
            </div>
          </div>
          <div class="space-4"></div>
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-input-readonly"> 所属分类 </label>
            <div class="col-sm-11">
              <input readonly="" type="text" class="col-xs-10 col-sm-5" id="form-input-readonly" value="{{ $goods->tname }}" />
            </div>
          </div>
          <div class="space-4"></div>
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-2"> 商品价格 </label>
            <div class="col-sm-11">
              <input type="text" id="form-field-2" placeholder="商品价格" class="col-xs-10 col-sm-5" name="price" value="{{ $goods->price }}" />
            </div>
          </div>
          <div class="space-4"></div>
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-2"> 商品主题 </label>
            <div class="col-sm-11">
              <input type="text" id="form-field-2" placeholder="商品主题" class="col-xs-10 col-sm-5" name="theme" value="{{ $goods->theme }}" />
            </div>
          </div>
          <div class="space-4"></div>
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-5">商品数量</label>
            <div class="col-sm-11">
              <div class="clearfix">
                <input class="col-xs-1" type="text" id="form-field-5" placeholder="" name="num" value="{{ $goods->num }}" />
              </div>
              <div class="space-2"></div>
              <div class="help-block" id="input-span-slider"></div>
            </div>
          </div>
          <div class="space-4"></div>
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-2"> 商品主图 </label>
            <div class="col-sm-11">
              <input type="file" id="form-field-2" class="col-xs-10 col-sm-5" name="picture1" />
            </div>
          </div>
          <div class="space-4"></div>
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-2"> 商品缩略图 </label>
            <div class="col-sm-11">
              <input type="file" id="form-field-2" class="col-xs-10 col-sm-5" name="picture2" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-2"> 商品详情图 </label>
            <div class="col-sm-11">
              <input type="file" id="form-field-2" class="col-xs-10 col-sm-5" name="picture3[]" multiple/>
            </div>
          </div>
          <div class="space-4"></div>
          <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
              <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                提交
              </button>
              &nbsp; &nbsp; &nbsp;
              <button class="btn" type="reset">
                <i class="icon-undo bigger-110"></i>
                重置
              </button>
            </div>
          </div>
        </form>
      </div>
    </div><!-- /.col -->
  </div>
</div><!-- /.row -->
  @endsection



