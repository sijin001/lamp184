@extends('admin.parent')
@section('content')

  <div class="col-md-9  col-md-offset-2 form-grid">
  							<form action="{{ url('admin/film/update/'.$user->id) }}" method="post" enctype="multipart/form-data">
  							{{ csrf_field() }}
  							<!-- {{ method_field('PUT')}} -->
							<div class="form-grid1">
							<h4><span>修改管理员信息</span> </h4>
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>姓名</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<input type="text" name="name" value="{{$user->name}}" >
								<span>修改姓名</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>性别</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<select name= "sex">
								<option value = 0>男</option>
								<option value = 2>女</option>
								</select>
								<span>修改性别</span>	
								</div>
								

								<div class="clearfix"></div>
							</div>
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>密码</h5>
								</div>
								
								<div class="col-md-9 grid-form1">
								<input type="pass" name="pass" value="{{$user->pass}}">
									<span>输入密码</span>
								</div>
								<div class="clearfix"></div>
							</div>
								
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>职位</h5>
								</div>
								
								<div class="col-md-9 grid-form1">
								<input type="text name="zhiwei" value="{{$user->zhiwei}}">
									<span>公司职位</span>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>手机号</h5>
								</div>
								
								<div class="col-md-9 grid-form1">
								<input type="text" name="phone" value="{{$user->phone}}">
									<span>中国制式11号码</span>
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