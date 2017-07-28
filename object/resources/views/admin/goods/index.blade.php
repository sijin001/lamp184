@extends('admin.parent') @section('content')
<div class="page-content">
  <div class="inbox-section">
    <h2>商品管理</h2>
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
    <div class="col-xs-12">
      <div class="col-md-12 inbox-grid1">
        <form action="{{ url('admin/goods') }}" method="GET">
          <div class="widget-main">
            <div class="row">
              <!-- 搜索 -->
              <div class="col-xs-12 col-sm-8">
                <div class="input-group">
                  <input type="text" class="form-control search-query" name="gname" placeholder="商品名" />
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-purple btn-sm">
                      搜索
                      <i class="icon-search icon-on-right bigger-110"></i>
                    </button>
                  </span>
                </div>
              </div>
              <span>
                <a class="btn btn-success btn-sm" href="{{ url('admin/goods/create') }}" style="float: right;">
                   添加商品 
                </a>
              </span>
            </div>
          </div>
        </form>
      </div>
      <form action="" name="myform" method="post" style="display:none">
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
              <th class="hidden-xs">
                所属分类
              </th>
              <th class="hidden-xs">
                商品名称
              </th>
              <th class="hidden-xs">
                商品主题
              </th>
              <th class="hidden-xs">
                商品价格
              </th>
              <th class="hidden-xs">
                商品数量
              </th>
              <th>
                状态
              </th>
              <th>
                操作
              </th>
            </tr>
            <?php $i = ($now - 1) * 5 + 1;?>
            @foreach($list as $k=>$v)

            <tr class="read checked">
              <td class="hidden-xs">
                {{ $i }}
              </td>
              <td class="hidden-xs">
                {{ $v->tname }}
              </td>
              <td class="hidden-xs">
                {{ $v->gname }}
              </td>
              <td class="hidden-xs">
                {{ $v->theme }}
              </td>
              <td class="hidden-xs">
                {{ $v->price }}
              </td>
              <td class="hidden-xs">
                {{ $v->num }}
              </td>
              <td>
                <a href="{{ url('admin/goods/set'.'/'.$v->id) }}">{{ $v->gnew == 0 ? '新品' : '非新品'}}</a><span class="gray">&nbsp;|&nbsp;</span><a href="{{ url('admin/goods/sethot'.'/'.$v->id) }}">{{ $v->ghot == 0 ? '热销' : '正常'}}</a>
              </td>
              <td>
                <a class="btn btn-info" href="{{ url('admin/goods').'/'.$v->id.'/edit' }}">
                  修改  
                </a>
                <a class="btn btn-danger" href="javascript:doDel({{ $v->id }})">
                  删除 
                </a>
              </td>
            </tr>
            <?php $i++ ?>
            @endforeach
          </tbody>
        </table>
        <div class="pagination pagination-centered">
          {!! $list->appends($where)->render() !!}
        </div> 
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<script>
  function doDel(id)
  {
    if(confirm('确定要删吗？')){
      var form = document.myform;
      var url = "{{ url('admin/goods') }}";
      form.action = url+'/'+id;
      form.submit();
    }
  }
</script>
@endsection
