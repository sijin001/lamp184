@extends('admin.parent')
	@section('content')
	<div class="main-page">
		<!--buttons-->
		<div class="grids-section">
			<h2 onclick="showList()">评论列表</h2>
			<div class="col-md-12 table-grid">
				<form action="" method="post" name="myform" style="display:none;">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
				</form>
				<div class="panel panel-widget">
					<div class="bs-docs-example">
						<table class="table table-bordered">
							<thead>
								<form action="/moviecomment" name="myforms">
									<tr>
										<th>#</th>
										<th>用户名</th>
										<th>
											<select class="col-md-12" style="height:30px" name="mid" onchange="doSearch(this)">
												<option value="">电影名</option>
												@foreach($movies as $m)
												<option value="{{ $m->id }}" {{ ($arr['mid'] == $m->id) ? 'selected' : '' }} >{{ $m->title }}</option>
												@endforeach
											</select>
										</th>
										<th>评论内容</th>
										<th>评论时间</th>
										<th>操作</th>
									</tr>
								</form>
							</thead>
							<tbody>
								@foreach($comments as $c)
								<tr>
									<td>{{ $c->id }}</td>
									<td>{{ $c->user }}</td>
									<td>{{ $c->title }}</td>
									<td>{{ $c->content }}</td>
									<td>{{ $c->ctime }}</td>
									<td><a href="javascript:doDel({{ $c->id }})">删除</a></td>
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
						{!! $comments->render() !!}
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<!--movieshow end-->
		</div>
	</div>
	<script>
		function doDel(id)
		{
			if(confirm('确定要删除吗？')){
				var form = document.myform;
				form.action = '/moviecomment/'+id;
				form.submit();
			}
		}

	    function doSearch(element)
	    {
	    	var forms = document.myforms;
	    	forms.submit();
	    }
	</script>
@endsection