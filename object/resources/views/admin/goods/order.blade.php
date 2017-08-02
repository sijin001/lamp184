@extends('admin.parent') 
    @section('content')
    <div class="col-sm-6" style="margin-top:50px;">
        <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
            <b>商品订单表</b>
        </div>
    </div>
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
    <div class="col-md-10 col-md-offset-1">
        <div style="margin-top:50px">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>订单编号</th>
                        <th>用户名</th>
                        <th class="hidden-480">积分</th>
                        <th class="hidden-480">数量</th>
                        <th>总计</th>
                        <th>下单时间</th>
                        <th>收货人姓名</th>
                        <th>收货地址</th>
                        <th>收货人电话</th>
                        <th>送货时间</th>
                        <th>操作</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = ($now - 1) * 5 + 1; ?> 
                    @foreach($order as $v)
                    <tr>
                        <td class="center">{{ $i }}</td>
                        <td>
                           {{ $v->time }} 
                        </td>
                        <td>
                            {{ $v->name }}
                        </td>
                        <td class="hidden-480"> {{ $v->score }} </td>
                        <td class="hidden-480"> {{ $v->number }} </td>
                        <td> {{ $v->prices }} </td>
                        <td> {{ date('Y-m-d H:i:s', $v->time) }} </td>
                        <td> {{ $v->sname }} </td>
                        <td> {{ $v->site }} </td>
                        <td> {{ $v->phone }} </td>
                        <td> {{ $v->sendtime }} </td>
                        <td> 
                            <a class="btn btn-danger btn-xs" href="{{ url('admin/orderdel/'.$v->id) }}">
                                删除 
                            </a> 
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            {!! $order->render() !!}
        </div>
    </div>

    @endsection