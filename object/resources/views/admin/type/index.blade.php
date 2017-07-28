@extends('admin.parent') 
  @section('content')
  <div class="page-content">
    <h3>商品分类</h3>
    <form action="" name="myform" method="post" style="display:none;">
      {{ csrf_field() }} {{ method_field("DELETE") }}
    </form>
    @if (session('msg'))
    <div class="alert alert-success">
      {{ session('msg') }}
    </div>
    @endif @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif
    <span>
      <a class="btn btn-success" href="{{ url('admin/type/create') }}">
        添加分类 
      </a>
    </span>
  </div>
  <div class="col-xs-10 col-md-offset-1">
    <h5><i class="halflings-icon white align-justify"></i><span class="break"></span>分类列表</h5>
    <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="center">#</th>
                <th>编号</th>
                <th>商品分类</th>
                <th class="hidden-480">系列</th>
                <th class="hidden-480" colspan="2">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php $i = ($now - 1) * 6 + 1; ?>
              @foreach($list as $v)
                <tr>
                  <td class="center">
                    <label>
                    <input type="checkbox" class="ace" />
                    <span class="lbl"></span>
                  </label>
                </td>
                <td>{{ $i }}</td>
                <td>{{ $v->tname }}</td>
                <td class="hidden-480">{{ $v->series }}</td>
                <td class="center">
                  <a class="btn btn-info btn-xs" href="{{ url('admin/type/'.$v->id)}}/edit">
                    修改  
                  </a>
                </td> 
                <td class="center">
                  <a class="btn btn-danger btn-xs" href="javascript:doDel({{ $v->id }})">
                    删除 
                  </a>
              </tr>
              <?php $i++ ?>
            @endforeach 
            </tbody>
          </table>
          <div class="pagination pagination-centered">
            {!! $list->appends($where)->render() !!}
          </div>
        </div><!-- /.table-responsive -->
      </div><!-- /span -->
    </div><!-- /row -->
</div><!-- /row -->
<script>
function doDel(id) {
  if (confirm('确定要删除吗？')) {
    var form = document.myform;
    form.action = "{{ url('admin/type') }}" + '/' + id;
    form.submit();
  }
}
</script>
  @endsection
