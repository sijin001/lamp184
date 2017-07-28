@extends('admin.parent') 
    @section('content')
	<div class="form-section col-md-8 col-md-offset-1">
		<h2>轮播图</h2>
		<span>
         <a class="btn btn-success btn-sm" href="" style="">
           添加轮播图 
         </a>
       </span><hr>
		<div class="col-md-12 form-grid" style="margin:30px;">
		<form action="{{ url('/admin/lunbo') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-grid1">
          <div class="bottom-form" style="margin-bottom:20px;">
            <div class="col-md-2">
              <h5>轮播图</h5>
            </div>
            <div class="col-md-10">
              <input type="file" id="exampleInputFile" name="img">
            </div>
            <div class="clearfix"></div>
          </div>
          <hr>
          <div class="bottom-form" style="margin-bottom:20px;">
            <div class="col-md-2">
              <h5></h5>
            </div>
            <div class="col-md-10">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交</button>
              <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置</button>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </form>
		</div>
	</div>
	
    @endsection