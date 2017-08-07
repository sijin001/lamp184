@extends('admin.parent')
  @section('content')
<div id="beshow" style="position:fixed;display:none;width:600px;height:400px;border:1px solid #ccc;z-index:1;background:#FFFFFF;left:510px;top:200px;"></div>
<div class="main-page ">
    <div class="grids">
        <h2 ><span class="btn btn-primary" onclick="showList('none','block')">影片列表</span>||<span class="btn btn-primary" onclick="showList('block','none')">影片添加</span></h2>
        <!--列表-->
        <div class="col-md-12 table-grid panel panel-widget" id="showlist" style="display:block;">
            <div class="panel panel-widget">
                <div class="bs-docs-example">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th width="7%">电影名</th>
                                <th width="5%">上映时间</th>
                                <th width="5%">国家</th>
                                <th width="5%">导演</th>
                                <th width="10%">主演</th>
                                <th width="8%">类型</th>
                                <th width="3%">版本</th>
                                <th width="5%">片长</th>
                                <form action="{{ url('/admin/movie') }}" name="myforms">
                                <th width="8%">
                                    <select class="col-md-12" style="height:30px" name="hot" onchange="doSearch(this)">
                                        <option value="" name="hot" >最热</option>
                                        <option value="1" {{ ($arr['hot'] == 1 ) ? 'selected' : '' }}>是</option>
                                        <option value="2" {{ ($arr['hot'] == 2 ) ? 'selected' : '' }}>否</option>
                                    </select>
                                </th>
                                <th width="8%">
                                    <select class="col-md-12" style="height:30px" name="new" onchange="doSearch(this)">
                                        <option value="" name="new">最新</option>
                                        <option value="1" {{ ($arr['new'] == 1 ) ? 'selected' : '' }}>是</option>
                                        <option value="2" {{ ($arr['new'] == 2 ) ? 'selected' : '' }}>否</option>
                                    </select>
                                </th>
                                <th width="8%">
                                    <select class="col-md-12" style="height:30px" name="status" onchange="doSearch(this)">
                                        <option value="" name="status">上映</option>
                                        <option value="1" {{ ($arr['status'] == 1 ) ? 'selected' : '' }}>是</option>
                                        <option value="2" {{ ($arr['status'] == 2 ) ? 'selected' : '' }}>否</option>
                                    </select>
                                </th>
                                </form>
                                <th width="5%">剧情</th>
                                <th width="5%">剧照</th>
                                <th width="5%">宣传画</th>
                                <th width="5%">标题图片</th>
                                <th width="5%">操作</th>
                            </tr>
                        </thead>
                         <form action="" method="post" name="myform" style="display:none;">
                            {{ csrf_field() }}
                            <tbody>
                                @foreach($movies as $v)
                                <tr>
                                    <td>{{ $v->id }}</td>
                                    <td id="title" ondblclick="doChange(this)">{{ $v->title }}</td>
                                    <td id="showtime" ondblclick="doChange(this)">{{ $v->showtime }}</td>
                                    <td id="country" ondblclick="doChange(this)">{{ $v->country }}</td>
                                    <td id="director" ondblclick="doChange(this)">{{ $v->director }}</td>
                                    <td id="star" ondblclick="doChange(this)">{{ $v->star }}</td>
                                    <td id="type" ondblclick="doChange(this)">{{ $v->type }}</td>
                                    <td id="format" ondblclick="doChange(this)">{{ $v->format }}</td>
                                    <td id="lenght" ondblclick="doChange(this)">{{ $v->length }}</td>
                                    <td id="hot" ondblclick="doSelect(this)">{{ ($v->hot == 1)?'是':'否' }}</td>
                                    <td id="new" ondblclick="doSelect(this)">{{ ($v->new == 1)?'是':'否' }}</td>
                                    <td id="status" ondblclick="doSelect(this)">{{ ($v->status == 1)?'是':'否' }}</td>
                                    <td><a id="des" href="#" onclick="doShow(this)" class="btn btn-sm" name="{{ $v->des }}">查看</a></td>
                                    
                                    <td><a id="poster" href="#" onclick="doShow(this)" class="btn btn-sm" name="{{ $v->poster }}">查看</a></td>
                                    <td><a id="images" href="#" onclick="doShow(this)" class="btn btn-sm" name="{{ $v->images }}">查看</a></td>
                                    <td><a id="title_pic" href="#" onclick="doShow(this)" class="btn btn-sm" name="{{ $v->title_pic }}">查看</a></td>
                                    <td><a href="javascript:doDel({{ $v->id }})" class="btn btn-sm">删除</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </form>
                    </table>
                    {!! $movies->appends($where)->render() !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--列表结束-->
        <!--添加-->
        <div class="col-md-12 form-grid panel panel-widget" id="showadd" style="display:none;">
            <div class="col-md-12 form-grid1">
                <div class="col-md-12 bottom-form">
                   
                    <form action="{{ url('/admin/movie') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12 bottom-form">
                            <div class="col-md-1 grid-form">
                                <h5>片名</h5>
                            </div>
                            <div class="col-lg-3 " >
                                <input type="text" placeholder="影片名称" class="col-md-12" name="title">
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>日期</h5>
                            </div>
                            <div class="col-lg-3" >
                                <input type="text" placeholder="正确格式:XXXX-XX-XX" class="col-md-12" name="showtime">
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>国家</h5>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" placeholder="影片国家" class="col-md-12" name="country">
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12 bottom-form">
                            <div class="col-md-1 grid-form">
                                <h5>导演</h5>
                            </div>
                            <div class="col-md-3" >
                                <input type="text" placeholder="影片导演" class="col-md-12" name="director">
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>主演</h5>
                            </div>
                            <div class="col-md-7 ">
                                <input type="text" placeholder="影片主演" class="col-md-12" name="star">
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12 bottom-form">
                            <div class="col-md-1 grid-form">
                                <h5>类型</h5>
                            </div>
                            <div class="col-lg-3 " >
                                <input type="text" placeholder="影片类型" class="col-md-12" name="type">
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>版本</h5>
                            </div>
                            <div class="col-lg-3" >
                                <input type="text" placeholder="影片版本" class="col-md-12" name="format">
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>片长</h5>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" placeholder="影片片长" class="col-md-12" name="length">
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12 bottom-form">
                            <div class="col-md-1 grid-form">
                                <h5>最热</h5>
                            </div>
                            <div class="col-md-3 grid-form1">
                                <div class="input-group" class="col-md-12">
                                    是 <input type="radio" name="hot" value="1">
                                    否 <input type="radio" name="hot" value="2" checked>
                                </div>
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>最新</h5>
                            </div>
                            <div class="col-md-3 grid-form1">
                                <div class="input-group" class="col-md-12">
                                    是 <input type="radio" name="new" value="1">
                                    否 <input type="radio" name="new" value="2" checked>
                                </div>
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>状态</h5>
                            </div>
                            <div class="col-md-3 grid-form1">
                                <div class="input-group" class="col-md-12">
                                    已经上映 <input type="radio" name="status" value="1">
                                    即将上映 <input type="radio" name="status" value="2" checked>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="bottom-form">
                            <div class="col-md-1 grid-form">
                                <h5>宣传画</h5>
                            </div>
                            <div class="col-md-3 grid-form1">
                                <input type="file" id="exampleInputFile" name="poster">
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>剧情照</h5>
                            </div>
                            <div class="col-md-3 grid-form1">
                                <input type="file" id="exampleInputFile" name="images">
                            </div>
                            <div class="col-md-1 grid-form">
                                <h5>标题图</h5>
                            </div>
                            <div class="col-md-3 grid-form1">
                                <input type="file" id="exampleInputFile" name="title_pic">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="bottom-form col-md-12">
                            <div class="col-md-1 grid-form">
                                <h5>剧情介绍</h5>
                            </div>
                            <div class="col-md-11 grid-form1">
                                <textarea placeholder="剧情介绍" class="col-md-12" name="des"></textarea>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="bottom-form">
                            <div class="col-md-9 grid-form1">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交 </button>
                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置 </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--添加结束-->
    </div>
</div>
<script>
    function showList(sta,stu)
    {
        var showlist = document.getElementById('showlist');
        var showadd = document.getElementById('showadd');
        showadd.style.display = sta;
        showlist.style.display = stu;
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
            var url = "{{ url('/admin/movieajax') }}";
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


    function doSelect(element)
    {
        if(confirm('确定要修改吗?')){

            //双击取反
            var value = (element.innerHTML == '是') ? '2' : '1';
            var id = element.parentNode.firstChild.nextSibling.innerHTML;
            var name = element.id;
            var url = "{{ url('/admin/movieajax') }}";
            //创建ajax
            $.ajax({
                url:url,
                type:'post',
                dataType:'json',
                data:{'id':id,name:name,value:value,'_token':"{{ csrf_token() }}"},
                success:function(data){
                   console.log(data);
                    
                },
                error:function(){
                    alert('ajax请求失败');
                }
            });

            element.innerHTML = (value == 1) ? '是' : '否';
        }
    }
    function doDel(id)
    {

        if (confirm('确定要删除吗？')) {
            var form = document.myform;
            form.innerHTML = form.innerHTML+' {{ method_field('DElETE')}}';
            form.action = "{{ url('/admin/movie') }}"+"/"+id;
            form.submit();
        }
    }


    function doShow(element)
    {
        var doshow = document.getElementById('beshow');
        var id = element.id;
        var content = element.name;
        if(id == 'des'){
            beshow.innerHTML = `<p style="font-size:20px;">`+content+`</p>`;
        }


        if(id == 'poster' || id == 'images' || id == 'title_pic'){
            beshow.innerHTML = `<img src="{{ asset('admin/upload/movie/`+content+`') }}" width="600px" height="400px">`;
        }

        
        event.stopPropagation();
        beshow.style.display = 'block';
        $('body').click(function () {
            beshow.innerHTML = '';
            beshow.style.display = "none";
        });
    }

    function doSearch(element)
    {
        var forms = document.myforms;
        forms.submit();
    }
</script>
@endsection
