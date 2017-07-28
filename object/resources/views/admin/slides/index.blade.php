@extends('admin.parent') 
    @section('content')
	<div class="form-section col-md-8 col-md-offset-1">
		<h2>轮播图</h2>
		<span>
         <a class="btn btn-success btn-sm" href="{{ url('admin/lunbo/create') }}" style="">
           添加轮播图 
         </a>
       </span>
       @if (session('msg'))
      	<div class="alert alert-success">
        	{{ session('msg') }}
      	</div>
      @endif
      @if (session('error'))
      	<div class="alert alert-danger">
       	 {{ session('error') }}
      	</div>
      @endif
		<div class="col-md-12 form-grid" style="margin:30px;">
		<form action="" name="myform" method="post" style="display:none;">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		</form>	
		<div class="mailbox-content">
        <table class="table" border="2" bordercolor="#E0E0E0">
          <tbody>
            <tr class="unread checked">
              <th class="hidden-xs">
                ID
              </th>
              <th>
                轮播缩略图
              </th>
              <th class="hidden-xs">
                操作
              </th>
              
            </tr>
            <?php $i = ($now - 1) * 5 + 1; ?>
			@foreach($imgs as $img)
            <tr class="read checked">
              <td class="hidden-xs">
                {{ $i }}
              </td>
              <td>
                <img src="{{ url('admin/upload/slides/'.$img->img) }}" width="80">
              </td>
              <td>
                <a href="javascript:doDel({{ $img->id }})">
                  删除 
                </a>
              </td>
            </tr>
            <?php $i++; ?>
           @endforeach
          </tbody>
        </table>
        <div class="pagination pagination-centered">
          {!! $imgs->render() !!}
        </div> 
      </div>
		</div>
	</div>
	<script>
		function doDel($id)
		{
			if(confirm('确定要删除吗？')){
				var form = document.myform;
				var url = '{{ url("admin/lunbo") }}';
				form.action = url +'/'+ $id;
				form.submit();
			}
		}
	</script>

    @endsection