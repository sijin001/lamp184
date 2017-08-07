@extends('admin.parent')
	@section('content')
	<div class="main-page">
		<div class="grids-section">
			<!--movieroom start-->
			<h2 >影厅列表</h2>
			<div id="addd" class="btn btn-primary" style="margin-left:20px;" onclick="doClick()" >添加</div>
			<div id="showadd" style="display:none;">
				<form action="" method="post" name="myform" style="display:none;">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
				</form>
				<form action="{{ url('/admin/movieroom') }}" method="post" name="addform">
					{{ csrf_field() }}
					<div class="col-md-8 bottom-form">
						<div class="col-md-2 grid-form">
							<h5>新增影厅</h5>
						</div>
						<div class="col-lg-4 " >
							<input type="text" placeholder="影厅名" class="col-md-12" name="rname">
						</div>
						<div class="col-md-2 grid-form">
							<h5>座位数量</h5>
						</div>
						<div class="col-lg-4" >
							<input type="text" placeholder="座位数" class="col-md-12" name="number">
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form col-md-4">
						<div class="col-md-12 grid-form1">
							<button type="submit" class="btn btn-sm btn-primary col-md-4"><i class="fa fa-angle-right"></i> 提交 </button>
							<div class="col-md-1"></div>
							<button type="reset" class="btn btn-sm btn-warning col-md-4"><i class="fa fa-repeat"></i> 重置 </button>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
			<div class="col-md-12 table-grid">
				<div class="panel panel-widget">
					<div class="bs-docs-example">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>影厅名</th>
									<th>座位数</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach($movierooms as $v)
								<tr>
									<td>{{ $v->id }}</td>
									<td id="rname" ondblclick="doChange(this)">{{ $v->rname }}</td>
									<td id="number" ondblclick="doChange(this)">{{ $v->number}}</td>
									<td><a href="javascript:doDel({{ $v->id }})">删除</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<!--movieroom end-->
		</div>
	</div>
	<script>
    
	    function doDel(id)
	    {
	        if (confirm('确定要删除吗？')) {
	            var form = document.myform;
	            form.action = "{{ url('/admin/movieroom') }}"+"/"+id;
	            form.submit();
	        }
	    }
	    function doClick()
		{
			var add = document.getElementById('addd');
			var showadd = document.getElementById('showadd');
			if(add.innerHTML == '添加'){
				add.innerHTML = '返回';
				showadd.style.display = 'block';
			}else{
				var addform = document.addform;
				add.innerHTML = "添加";
				showadd.style.display = "none";
				addform.reset();
			}
		}

		function doChange(element)
	    {
	        var oldhtml = element.innerHTML;
	        var newobj = document.createElement('input');
	        var id = element.parentNode.firstChild.nextSibling.innerHTML;
	        newobj.type = 'text';
	        newobj.name = element.id;
	        newobj.value = oldhtml;
	        element.innerHTML = '';
	        element.appendChild(newobj);
	        newobj.focus();
	        newobj.onblur = function()
	        {
	            var url = "{{ url('/admin/movieroomajax') }}";
	            var name = newobj.name;
	            var value = newobj.value;
	            if (newobj.value != oldhtml) {
	                if (confirm('确定要修改吗？')) {
	                    // 创建ajax对象
	                    $.ajax({
	                        url:url,
	                        type:'post',
	                        dataType:'json',
	                        data:{'id':id,name:name,value:value,'_token':"{{ csrf_token() }}"},
	                        success:function(data){

	                        },
	                        error:function(){
	                            alert('ajax请求失败');
	                        }
	                    });

	                    //上传成功，替换input
	                    element.innerHTML = value;

	                }
	            }else{
	                element.innerHTML = value;
	            }
	        }
	    }

	</script>
@endsection
