@extends('admin.parent')
@section('content')
	<div class="four-grids">
		<div class="col-md-3 four-grid " style="margin:20px">
			<div class="four-grid1">
				<a href="{{ url('admin/user')}}" ><span class="btn btn-primary ">会员列表</span></a>
			</div>
		</div>
					
		<div class="col-md-3 four-grid" style="margin:20px">
			<div class="four-grid4">
				
				<a href="javascript:doCatch()"><span class="btn btn-inverse">删除选中信息</span></a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	@if (session('msg'))
	<script>
    alert("{{ session('msg') }}");
	</script>
	@endif
		
	<!--搜索-->
	<div class="search-box " style="width:400px;margin:20px">
		<form class="input" action="{{ url('admin/user') }}">
			<div class="col-md-5">
				
				<input class="sb-search-input input__field--madoka" style="height:32px" placeholder="搜索会员..." type="search" name="name" id="input-31">
			</div>
			<div class="col-md-5">
				<select class="form-control m-b-10" name='sex'>
					<option >--按性别查找--</option>
					<option value='1'>女</option>
					<option value='0'>男</option>
				</select>
			</div>
			<div class="col-md-2">
				<input type="submit" class='btn m-b-10 btn-sm' value='搜索'>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
	<div class="bottom-table">
	
		<div class="bs-docs-example">

			<table class="table table-hover">
				<thead>
					<tr>
					  <th>选择</th>
					  <th>序号</th>
					  <th>头像</th>
					  <th>名字</th>
					  <th>性别</th>
					  <th>电话</th>
					  <th>地址</th>
					  <th>积分</th>
					  <th>状态</th>
					  <th>操作</th>
					</tr>
				</thead>
				<?php $i = ($now-1)*3+1; ?> 
				@foreach($list as $v)
				<tbody>
					<tr>
					<label>
					  <td><input type="checkbox" name="name[]" value="{{$v->id}}"></td>
					  <td>{{$i}}</td>
					  <td><img src="{{ asset('admin/upload/photo/'.$v->photo)}}" width=20 height=20></td>
					  <td>{{$v->name}}</td>
					  <td>{{$v->sex==0?'男':'女'}}</td>
					  <td>{{$v->phone}}</td>
					  <td>{{$v->addr}}</td>
					  <td>{{$v->score}}</td>
					  <td>
					    @if ($v->status == 1)
							普通会员
						@elseif ($v->status == 2)
							VIP会员
						@elseif ($v->status == 3)
							钻石会员
						@endif
					  </td>
					  <td>
					  	<a class="label label-success" href="{{ url('admin/user/'.$v->id) }}">修改</a>
					  </td>
					</label>
				    </tr>
				</tbody>	
				<?php $i++; ?>
						
				@endforeach
			</table>
			{!! $list->appends($where)->render() !!}
			<script src="{{ asset('admin/js/jquery-1.8.3.min.js') }}" ></script>
			<script type="text/javascript">
				var arr = [];
			
				var sun = document.getElementsByTagName('input');
				function doCatch(){
					for(var i=0;i<sun.length;i++){
						if(sun[i].checked){
							//alert(sun[i].value);
						arr[arr.length] = sun[i].value;
						var del = arr.join('###');				
						// alert(this.value);
					}
					//form.action = 'admin/user/'+ arr;
					//form.submit();
				}
					// alert(del);
		
				//var url = "{{ url('admin/delete') }}";
				$.ajax({
						url: "{{ url('admin/delete') }}",
						type: 'get',
						data: {del:del},
						dataType: 'json',
						success: function(data){
							alert(data);
						// 	
						// // console.log(data.status);
						}
					});
					window.location.href="{{ url('admin/user') }}"
				}		
			</script>
		</div>
	</div>
			
@endsection