@extends('admin.parent')
@section('content')

  <div class="col-md-9  col-md-offset-2 form-grid">
  							<form action="{{ url('admin/ads/'.$ads->id) }}" method="post" enctype="multipart/form-data">
  							{{ csrf_field() }}
  							{{ method_field('PUT')}}
							<div class="form-grid1">
							<h4><span>请您慎重修改会员信息</span> </h4>
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>标题</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<input type="text" name="title" value="{{$ads->title}}">
								<span>不超过10字符</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>链接</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<input type="text" name="url" value="{{$ads->url}}">
								<span></span>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>内容</h5>
								</div>
								
								<div class="col-md-9 grid-form1">
								<input type="text" name="content" value="{{$ads->content}}">
									<span>不超过100个字符</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>图片预览</h5>
								</div>
								<div class="col-md-9 grid-form1">
									<img src="{{ asset('admin/upload/ads/'.$ads->picture)}}" width=100 height=100>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>图片修改</h5>
								</div>
								<div class="col-md-9 grid-form1">
									<input type="file" name="picture" id="exampleInputFile">
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