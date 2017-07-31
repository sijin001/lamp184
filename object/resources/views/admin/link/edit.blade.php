@extends('admin.parent')
@section('content')

  <div class="col-md-9  col-md-offset-2 form-grid">
  							<form action="{{ url('admin/link/'.$link->id) }}" method="post" enctype="multipart/form-data">
  							{{ csrf_field() }}
  							{{ method_field('PUT')}}
							<div class="form-grid1">
							<h4><span>修改友情链接信息</span> </h4>
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>title</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<input type="text" name="title" value="{{$link->title}}" >
								<span>不超过100字符</span>
								</div>
								<div class="clearfix"></div>
							</div>
							
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>链接地址</h5>
								</div>
								
								<div class="col-md-9 grid-form1">
								<input type="text" name="url" value="{{$link->url}}">
									<span>带http协议</span>
								</div>
								<div class="clearfix"></div>
							</div>
							
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>信息提交</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 修改</button>
							<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置</button>
								</div>
								<div class="clearfix"></div>
							</div>
							<form>
						</div>


			
@endsection