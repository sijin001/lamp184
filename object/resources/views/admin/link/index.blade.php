@extends('admin.parent')
@section('content')
	<div class="four-grids">
		<div class="col-md-3 four-grid" style="margin:20px">
			<div class="four-grid1">
				<a href="{{ url('admin/link')}}" ><span class="btn btn-primary ">友情链接列表</span></a>
			</div>
		</div>

		<div class="col-md-3 four-grid" style="margin:20px">
			<div class="four-grid2">
				<a href="{{ url('admin/link/create') }}" ><span class="btn btn-warning ">友情链接添加</span></a>
				
			</div>
		</div>
					
		<div class="col-md-3 four-grid" style="margin:20px">
			<div class="four-grid4">
				
				<a href="javascript:doCatch()"><span class="btn btn-inverse ">删除选择链接</span></a>
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
		<form class="input" action="{{ url('admin/link') }}">
			<div class="col-md-5">
				<input class="sb-search-input input__field--madoka" style="height:32px" placeholder="搜索标题..." type="search" name="title" id="input-31">
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
						  <th>标题</th>
						  <th>链接</th>
						  <th>操作</th>
						</tr>
				</thead>
				<!-- <form method="post" action="" name="myform" id="myform" style="display:none">
					{{csrf_field()}}
					{{method_field('DELETE')}} -->
				@foreach($list as $v)
				<tbody>
					<tr>
						<label>
						   <td><input type="checkbox" name="name[]" value="{{$v->id}}"></td>
						   <td>{{$v->id}}</td>
						   <td>{{$v->title}}</td>
						   <td><a href="{{$v->url}}" target="_blank">{{$v->url}}</a></td>		  
						   <td><a class="label label-success" href="{{ url('admin/link/'.$v->id) }}">修改</a></td>
						</label>
					</tr>
				</tbody>	
				@endforeach
				<!-- </form> -->
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
				//var url = "{{ url('admin/link/delete') }}";
				$.ajax({
					url: "{{ url('admin/deletetwo') }}",
					type: 'get',
					data: {del:del},
					dataType: 'json',
					success: function(data){
						alert(data);
						// 	
						// // console.log(data.status);
						}
					});
					window.location.href="{{ url('admin/link') }}"
				}		
			</script>
		</div>
	</div>
			
@endsection