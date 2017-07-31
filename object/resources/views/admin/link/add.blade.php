@extends('admin.parent')
@section('content')

  <div class="col-md-9  col-md-offset-2 form-grid">
  							<form action="{{ url('admin/link') }}" method="post" enctype="multipart/form-data">
  							{{ csrf_field() }}
							<div class="form-grid1" >
							<h4 style="margin-bottom:50px"><span class="btn btn-primary">添加友情链接</span> </h4>
							
							<div class="bottom-form" style="margin-bottom:20px">
								<div class="col-md-1 grid-form">
									<h5  class="btn btn-primary btn-xs">标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题</h5>
								</div>
								<div class="col-md-6">
								<input type="text" name="title" id="inputWarning" class="width-100" placeholder="please enter tilte">
								<!-- <span><b>Please enter title</b></span> -->
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="bottom-form">
								<div class="col-md-1 grid-form">
									<h5 class="btn btn-primary btn-xs" >链接地址</h5>
								</div>
								<div class="col-md-6 grid-form1">
								<input type="text" name="url" id="inputWarning" class="width-100" placeholder="please enter url">
								<!-- <span><b>Please enter url</b></span> -->
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="bottom-form" style="margin-top:20px">
								
								<div class="col-md-9 grid-form1">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 添加</button>
							<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置</button>
								</div>
								<div class="clearfix"></div>
							</div>
							<form>
						</div>


			
@endsection