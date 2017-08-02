@extends('admin.parent') 
    @section('content')
    <div class="col-sm-6" style="margin-top:50px;">
        <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
            <b>购物车</b>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div style="margin-top:50px">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>商品图</th>
                        <th>商品信息</th>
                        <th class="hidden-xs">价格（元）</th>
                        <th class="hidden-480">数量</th>
                        <th>用户名</th>
                        <th>地址</th>
                        <th>电话</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = ($now - 1) * 5 + 1; ?>
                    @foreach($arr as $v)
                    <tr>
                        <td class="center">{{ $i }}</td>
                        <td>
                            <img src="{{ asset('admin/upload/goods/'.$v->gimage) }}" width="70">
                        </td>
                        <td>
                            <h5>{{ $v->gname }}</h5> <br>
                            {{ $v->theme }}
                        </td>
                        <td class="hidden-xs">
                            ￥{{ $v->price }}
                        </td>
                        <td class="hidden-480"> {{ $v->number }} </td>
                        <td> {{ $v->name }} </td>
                        <td> {{ $v->addr }} </td>
                        <td> {{ $v->phone }} </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            {!! $arr->render() !!}
        </div>
    </div>
    @endsection