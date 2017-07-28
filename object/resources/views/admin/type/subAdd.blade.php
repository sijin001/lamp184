@extends('admin.parent') @section('content')
<div class="col-md-10 form-grid">
  <div class="form-grid1">
    <h4><span>{{ $list->name }}</span> >添加子分类</h4> @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{ url('admin/subType') }}" method="post">
      {{ csrf_field() }}
      <div class="bottom-form">
        <div class="col-md-3 grid-form">
          <h5>子分类名称</h5>
        </div>
        <div class="col-md-9 grid-form1">
          <p>
            <input type="text" placeholder="{{ $list->name }}" name="name">
          </p>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="bottom-form">
        <div class="col-md-9 grid-form1">
          <input type="hidden" name="upid" value="{{ $list->id }}">
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="bottom-form">
        <div class="col-md-3 grid-form">
          <h5></h5>
        </div>
        <div class="col-md-9 grid-form1">
          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交</button>
          <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </form>
  </div>
  @endsection
