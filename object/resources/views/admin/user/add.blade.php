@extends('admin.parent')
@section('content')

  <div class="col-md-9  col-md-offset-2 form-grid">
	<form action="{{ url('admin/user') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-grid1">
			<h4><span>会员信息添加</span> </h4>

			<div class="bottom-form">
				<div class="col-md-3 grid-form">
					<h5>姓名</h5>
				</div>
				<div class="col-md-9 grid-form1">
				<input type="text" name="name">
				<span>Please enter your name</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="bottom-form">
				<div class="col-md-3 grid-form">
					<h5>性别</h5>
				</div>
				<div class="col-md-9 grid-form1">
				<select name="sex"><option value="0">男</option><option value="1">女</option></select>
				<span>Please enter your sex</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="bottom-form">
				<div class="col-md-3 grid-form">
					<h5>密钥</h5>
				</div>
				<div class="col-md-9 grid-form1">
				<input type="password" name="pass">
				<span>Please enter a complex password</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="bottom-form">
				<div class="col-md-3 grid-form">
					<h5>确认密钥</h5>
				</div>
				
				<div class="col-md-9 grid-form1">
				<input type="password">
					<span>Please enter again password</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="bottom-form">
				<div class="col-md-3 grid-form">
					<h5>手机号</h5>
				</div>
				
				<div class="col-md-9 grid-form1">
				<input type="text" name="phone">
					<span>Please enter Tel</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="bottom-form">
				<div class="col-md-3 grid-form">
					<h5>地址</h5>
				</div>
				
				<div class="col-md-9 grid-form1">
				<input type="text" name="addr">
					<span>Please enter addr</span>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="bottom-form">
				<div class="col-md-3 grid-form">
					<h5>头像上传</h5>
				</div>
				<div class="col-md-9 grid-form1">
					<input type="file" name="photo" id="exampleInputFile">
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
		</div>
	<form>
</div>

			
@endsection