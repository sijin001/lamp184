@extends('admin.parent')
@section('content')

  <div class="col-md-9  col-md-offset-2 form-grid">
  							<form action="{{ url('admin/user/'.$user->id) }}" method="post" enctype="multipart/form-data">
  							{{ csrf_field() }}
  							{{ method_field('PUT')}}
							<div class="form-grid1">
							<h4><span>请您慎重修改会员信息</span> </h4>
							
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>姓名</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<input type="text" name="name" value="{{$user->name}}" disabled>
								<span>您没有权限修改姓名</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>性别</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<input type="text" name="sex" value="{{$user->sex==0?'男':'女'}}" disabled>
								<span>您没有权限修改性别</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="bottom-form">
								<div class="col-md-3 grid-form">
									<h5>*状态</h5>
								</div>
								<div class="col-md-9 grid-form1">
								<select name="status">
									<option value="1">&nbsp;&nbsp;普通会员&nbsp;&nbsp;</option>
									<option value="2">&nbsp;&nbsp;VIP会员&nbsp;&nbsp;</option>
									<option value="3">&nbsp;&nbsp;钻石会员&nbsp;&nbsp;</option>
									</select>
								<span>菜单下拉选择</span>
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
									<h5>地址</h5>
								</div>
								
								<div class="col-md-9 grid-form1">
								<input type="text" name="addr" value="{{$user->addr}}">
									<span>最长不超过50字符</span>
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