@extends('admin.parent')
	@section('content')
	<div class="main-page">
		<!--buttons-->
		<div class="grids-section">
			<h2>订单列表</h2>
			<div class="col-md-12 table-grid">
				<form action="" method="post" name="myform" style="display:none;">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
				</form>
				<div class="panel panel-widget">
					<div class="bs-docs-example">
						<table class="table table-bordered">
							<thead>
								<form action="{{ url('/admin/movieorder') }}" name="myforms">
									<tr>
										<th>#</th>
										<th>用户</th>
										<th>订单号</th>
										<th class="col-md-2">
											<select class="col-md-12" style="height:30px" name="mid" onchange="doSearch(this)">
												<option value="">电影名</option>
												@foreach($movies as $m)
												<option value="{{ $m->id }}" {{ ($arr['mid'] == $m->id ) ? 'selected' : '' }}>{{ $m->title }}</option>
												@endforeach
											</select>
										</th>
										<th>
											<select class="col-md-12" style="height:30px" name="date" onchange="doSearch(this)">
												<option value="" name="date">放映日期</option>
												@foreach($showDate as $sd)
												<option   value="{{ $sd->date }}" {{ ($arr['date'] == $sd->date ) ? 'selected' : '' }}>{{ $sd->date }}</option>
												@endforeach
											</select>
										</th>
										<th>
											<select class="col-md-12" style="height:30px" name="time" onchange="doSearch(this)">
												<option value="" name="time">放映时间</option>
												@foreach($showTime as $st)
												<option value="{{ $st->time }}" {{ ($arr['time'] == $st->time ) ? 'selected' : '' }}>{{ $st->time }}</option>
												@endforeach
											</select>
										</th>
										<th>
											<select class="col-md-12" style="height:30px" name="rid" onchange="doSearch(this)">
												<option value="" name="rid">影厅</option>
												@foreach($rooms as $r)
												<option value="{{ $r->id }}" {{ ($arr['rid'] == $r->id ) ? 'selected' : '' }}>{{ $r->rname }}</option>
												@endforeach
											</select>
										</th>
										<th>座位</th>
										<th>价格</th>
										<th>操作</th>
									</tr>
								</form>
							</thead>
							<tbody>
								@foreach($orders as $v)
								<tr>
									<td>{{ $v->id}}</td>
									<td>{{ $v->name}}</td>
									<td>{{ $v->number }}</td>
									<td>{{ $v->title }}</td>
									<td>{{ $v->date }}</td>
									<td>{{ $v->time }}</td>
									<td>{{ $v->rname }}</td>
									<td>{{ $v->seat }}</td>
									<td>{{ $v->price }}</td>
									<td><a href="javascript:doDel( {{ $v->id }})">删除</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $orders->appends($where)->render() !!}
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<script>

		function doDel(id)
		{
			if(confirm('确定要删除吗?')) {
				var form = document.myform;
				form.action = "{{ url('/admin/movieorder') }}"+"/"+id;
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