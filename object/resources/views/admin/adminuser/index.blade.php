@extends('admin.parent')
@section('content')
<div class="four-grids">
				<div class="clearfix"></div>
<div class="bottom-table">
	
	<div class="bs-docs-example">

		<table class="table table-hover">
						<thead>
							<tr>
							  <th>序号</th>
							  <th>名字</th>
							  <th>性别</th>
							  <th>职位</th>
							  <th>联系方式</th>
							  <th>操作</th>
							</tr>
						</thead>
						<form method="" action="" name="myform" id="myform" style="display:none">
      					<!-- 	{{csrf_field()}}
      						{{method_field('DELETE')}} -->
						@foreach($user as $k=>$v)
							<tr>
							<label>
							   <td><input type="checkbox" name="name[]" value="{{$v->id}}"></td>
							  <td>{{$k+1}}</td>
							  <td>{{$v->name}}</td>
							  <td>{{$v->sex==0?'男':'女'}}</td>
							 <td>{{$v->zhiwei}}</td>
							 <td>{{$v->phone}}</td>
							  
							  <td><a class="label label-success" href="{{ url('admin/film/set/'.$v->id) }}">修改</a></td>
							</label>
							</tr>
							
						@endforeach
						<!-- </form> -->
					</table>
					 
								</form>
				</div>	
				</div>
								
								</div>
					
			
@endsection