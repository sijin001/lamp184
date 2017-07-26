@extends('admin.parent')
	@section('content')
	<div class="main-page">
		<!--buttons-->
		<div class="grids-section">
			<h2 onclick="showList()">场次列表</h2>
			<div id="addd" class="btn btn-primary" style="margin-left:20px;" onclick="doClick()" >添加</div>
			<!--movieshow start-->
			<div id="showadd" style="display:none;">
				<form action="/movieshow" method="post" name="addform">
					{{ csrf_field() }}
					<div class="col-md-12 bottom-form">
						<div class="col-md-1 grid-form">
							<h5>影名</h5>
						</div>
						<div class="col-md-3 grid-form1">
							<select class="col-md-12" style="height:30px" name="mid">
								<option value="0">请选择</option>
								@foreach($movies as $m)
								<option value="{{ $m->id }}">{{ $m->title }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-1 grid-form">
							<h5>日期</h5>
						</div>
						<div class="col-lg-3">
							<input type="text" placeholder="格式:XXXX-XX-XX" class="col-md-12" name="date">
						</div>
						<div class="col-md-1 grid-form">
							<h5>时间</h5>
						</div>
						<div class="col-md-3 " >
							<input type="text" placeholder="格式:XX:XX" class="col-md-12" name="time">
						</div>
					</div>
					<div class="col-md-12 bottom-form">

						<div class="col-md-1 grid-form">
							<h5 >影厅</h5>
						</div>
						<div class="col-md-3 grid-form1">
							<select class="col-md-12" style="height:30px" name="rid">
								<option value="0">请选择</option>
								@foreach($rooms as $r)
								<option value="{{ $r->id }}">{{ $r->rname }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-1 grid-form">
							<h5>价格</h5>
						</div>
						<div class="col-md-3 " >
							<input type="text" placeholder="价格" class="col-md-12" name="price">
						</div>
						<button type="submit" class="btn btn-sm btn-primary col-md-2" style="width:80px;margin-left:50px;" ><i class="fa fa-angle-right"></i> 提交 </button>
						<button type="reset" class="btn btn-sm btn-warning col-md-2" style="width:80px;margin-left:20px;"><i class="fa fa-repeat"></i> 重置 </button>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
			<div class="col-md-12 table-grid">
				<form action="" method="post" name="myform" style="display:none;">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
				</form>
				<div class="panel panel-widget">
					<div class="bs-docs-example">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<form action="/movieshow" name="myforms">
										<th>
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
												
												<option   value="{{ date('Y-m-d') }}" {{ ($arr['date'] == date('Y-m-d') ) ? 'selected' : '' }}>{{ date('Y-m-d') }}</option>
												<option   value="{{ date('Y-m-d',strtotime('+1 day')) }}" {{ ($arr['date'] == date('Y-m-d',strtotime('+1 day')) ) ? 'selected' : '' }}>{{ date('Y-m-d',strtotime('+1 day')) }}</option>
												<option   value="{{ date('Y-m-d',strtotime('+2 day')) }}" {{ ($arr['date'] == date('Y-m-d',strtotime('+2 day')) ) ? 'selected' : '' }}>{{ date('Y-m-d',strtotime('+2 day')) }}</option>
												
											</select>
										</th>
										<th>
											<select class="col-md-12" style="height:30px" name="time" onchange="doSearch(this)">
												<option value="" name="time">放映时间</option>
												@foreach($show as $sh)
												<option value="{{ $sh->time }}" {{ ($arr['time'] == $sh->time ) ? 'selected' : '' }}>{{ $sh->time }}</option>
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
									</form>
									<th>价格</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach($shows as $s)
								<tr>
									<td>{{ $s->id }}</td>
									<td id="mid" name="" ondblclick="doSelect(this)">{{ $s->title }}</td>
									<td id="date" name="" ondblclick="doChange(this)">{{ $s->date }}</td>
									<td id="time" name="" ondblclick="doChange(this)">{{ $s->time }}</td>
									<td id="rid" name="" ondblclick="doSelect(this)">{{ $s->rname }}</td>
									<td id="price" name="" ondblclick="doChange(this)">{{ $s->price }}</td>
									<td><a href="javascript:doDel({{ $s->id }})">删除</a></td>
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
						{!! $shows->render() !!}
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
				form.action = '/movieshow/'+id;
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

		function doSelect(element)
		{
			var id = element.parentNode.firstChild.nextSibling.innerHTML;
			var name = element.id;
			var oldhtml = element.innerHTML;
			var url = "{{ url('/movieshowajax') }}";
			var num = 1;

			if(element.id == 'mid'){
				element.innerHTML = '';
				//element.appendChild(mymovie);
				element.innerHTML = `<select class="col-md-12" style="height:30px;" name="mid" id="mymovie">
									@foreach($movies as $mo)
									<option value="{{ $mo->id }}">{{ $mo->title }}</option>
									@endforeach
								</select>`;
				var mymovie = document.getElementById('mymovie');
				mymovie.focus();
				var list = mymovie.options;

				for(var m = 0;m <　list.length;m++){

					if(list[m].innerHTML == oldhtml){
						list[m].selected = true;
					}
				}
				

				mymovie.onchange = function ()
				{
					for(var i = 0;i < list.length; i++){

						if(list[i].selected == true && list[i].innerHTML!=oldhtml){
							if(confirm('确定要修改吗？')){
								var value = list[i].value;
								var newhtml = list[i].innerHTML;

								//创建ajax
					            $.ajax({
					                url:url,
					                type:'post',
					                dataType:'json',
					                data:{'id':id,name:name,value:value,'_token':"{{ csrf_token() }}"},
					                success:function(data){
										element.innerHTML = newhtml;

					                },
					                error:function(){
					                    alert('ajax请求失败');
					                }
					            });
					          	num = 2;
					        }
						}
					}
				}

				mymovie.onblur = function()
				{
					if(num == 1){
					   	element.innerHTML = oldhtml;
					}
				}
			}

			if(element.id == 'rid'){
				element.innerHTML = '';
				//element.appendChild(mymovie);
				element.innerHTML = `<select class="col-md-12" style="height:30px;" name="rid" id="mymovieroom">
									@foreach($rooms as $ro)
									<option value="{{ $ro->id }}">{{ $ro->rname }}</option>
									@endforeach
								</select>`;
				var mymovieroom = document.getElementById('mymovieroom');
				mymovieroom.focus();
				var list = mymovieroom.options;

				for(var m = 0;m <　list.length;m++){

					if(list[m].innerHTML == oldhtml){
						list[m].selected = true;
					}
				}
				
				mymovieroom.onblur = function()
					{
					    element.innerHTML = oldhtml;	
					}

				mymovieroom.onchange = function ()
				{
					for(var i = 0;i < list.length; i++){

						if(list[i].selected == true && list[i].innerHTML!=oldhtml){
							if(confirm('确定要修改吗？')){
								var value = list[i].value;
								var newhtml = list[i].innerHTML;

								//创建ajax
					            $.ajax({
					                url:url,
					                type:'post',
					                dataType:'json',
					                data:{'id':id,name:name,value:value,'_token':"{{ csrf_token() }}"},
					                success:function(data){

										element.innerHTML = newhtml;
					                    
					                },
					                error:function(){
					                    alert('ajax请求失败');
					                }
					            });
					            num = 2;
					        }
						}
					}
				}
				mymovieroom.onblur = function()
				{
					if(num == 1){
					   	element.innerHTML = oldhtml;
					}
				}
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
	            var url = "{{ url('/movieshowajax') }}";
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

	    function doSearch(element)
	    {
	    	var forms = document.myforms;
	    	forms.submit();
	    }
	</script>
@endsection