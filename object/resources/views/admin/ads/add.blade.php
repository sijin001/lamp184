@extends('admin.parent')
@section('content')

  <div class="col-md-9  col-md-offset-2 form-grid">
			<form action="{{ url('admin/ads') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
		<div class="form-grid1">
		<h4><span>广告信息添加</span> </h4>
		
		<div class="bottom-form">
			<div class="col-md-3 grid-form">
				<h5>标题</h5>
			</div>
			<div class="col-md-9 grid-form1">
			<input type="text" name="title">
			<span>Please enter title</span>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="bottom-form">
			<div class="col-md-3 grid-form">
				<h5>链接</h5>
			</div>
			<div class="col-md-9 grid-form1">
			<input type="text" name="url">
			<span>Please enter url</span>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="bottom-form">
			<div class="col-md-3 grid-form">
				<h5>内容</h5>
			</div>
			<div class="col-md-9 grid-form1">
			<input type="text" name="content">
			<span>Please enter content</span>
			</div>
			<div class="clearfix"></div>
		</div>
		
		
		<div class="bottom-form">
			<div class="col-md-3 grid-form">
				<h5>图片上传</h5>
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
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 上传</button>
		<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<form>
	</div>


			
@endsection