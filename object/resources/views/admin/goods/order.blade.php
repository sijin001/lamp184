@extends('admin.parent') 
    @section('content')
    <div class="col-sm-6" style="margin-top:50px;">
        <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
            <b>商品订单表</b>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div style="margin-top:50px">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>订单编号</th>
                        <th>商品信息</th>
                        <th class="hidden-xs">单价</th>
                        <th class="hidden-480">数量</th>
                        <th>总计</th>
                        <th>用户名</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <tr>
                        <td class="center">1</td>
                        <td>
                           11 
                        </td>
                        <td>
                            11
                        </td>
                        <td class="hidden-xs">
                            11
                        </td>
                        <td class="hidden-480"> 11 </td>
                        <td> 11 </td>
                        <td> 11 </td>
                    </tr>
                    
                </tbody>
            </table>
            
        </div>
    </div>
    @endsection