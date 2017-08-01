@extends('admin.parent')
@section('content')
<div class="four-grids">
	<div class="clearfix"></div>
	<div class="bottom-table">
		<div class="col-md-3 four-grid" style="margin:20px">
			<div class="four-grid2">
				<a href="{{ url('admin/adminuser/create') }}" ><span class="btn btn-warning">管理员添加</span></a>
			</div>
		</div>
		@if (session('msg'))
		<script>
	    alert("{{ session('msg') }}");
		</script>
		@endif
		<div class="bs-docs-example">
			<table class="table table-hover">
				<thead>
					<tr>
					  <th>#</th>
					  <th>序号</th>
					  <th>名字</th>
					  <th>性别</th>
					  <th>职位</th>
					  <th>联系方式</th>
					  <th>操作</th>
					</tr>
				</thead>
				<form method="post" action="" name="myform" id="myform" style="display:none">
      				{{ csrf_field() }}
      				{{ method_field('DELETE') }}
      			</form>
      			<?php $i = ($now-1)*3+1; ?>
				@foreach($user as $k=>$v)
					<tr>
					<label>
					   	<td><input type="checkbox" name="name[]" value="{{ $v->id }}"></td>
					  	<td>{{ $i }}</td>
					  	<td>{{ $v->name }}</td>
					  	<td>{{ $v->sex==0?'男':'女' }}</td>
					 	<td>{{ $v->zhiwei }}</td>
					 	<td>{{ $v->phone }}</td>
			
					  	<td>
					  	<a class="label label-success" href="{{ url('admin/adminuser/'.$v->id.'/edit') }}">修改</a>
					  	<a class="label label-primary" href="javascript:doDel({{ $v->id }})">删除</a>
					  	</td>
					</label>
					</tr>
				<?php $i++; ?>
				@endforeach
			</table>
			{!! $user->render() !!}		 
		</div>	
	</div>
</div>
<script>
	function doDel(id)
	{
		if(confirm('确定要删除吗？')){
			var form = document.myform;
			var url = "{{ url('admin/adminuser') }}";
			form.action = url+'/'+id;
			form.submit();
		}
	}
</script>					
			
@endsection