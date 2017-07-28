@extends('admin.parent') 
    @section('content')
	<div class="form-section col-md-8 col-md-offset-1">
		<h2>站点配置</h2>
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
			<form action="{{ url('admin/config/'.$config->id) }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-grid1">
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>网站标题</h5>
						</div>
						<div class="col-md-10">
							<input type="text" class="col-md-8" name="webname" value="{{ $config->webname }}">
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>网站关键字</h5>
						</div>
						<div class="col-md-10">
							<input type="text" class="col-md-8" name="wkeyword" value="{{ $config->wkeyword }}">
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>网站版权</h5>
						</div>
						<div class="col-md-10">
							<input type="text" class="col-md-8" name="wcopyright" value="{{ $config->wcopyright }}">
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>网站描述</h5>
						</div>
						<div class="col-md-10">
							<input type="text" class="col-md-8" name="wdes" value="{{ $config->wdes }}" />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>网站开关</h5>
						</div>
						<div class="col-md-10">
							<div class="radio block"><label><input type="radio" name="wstatus" value="0" checked> 开</label></div>
							<div class="radio block"><label><input type="radio" name="wstatus" value="1"> 关</label></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>LOGO</h5>
						</div>
						<div class="col-md-10">
							<input type="file" id="exampleInputFile" name="logo">
						</div>
						<div class="col-md-10">
							<input type="hidden" id="exampleInputFile" value="{{ $config->logo }}" name="photo">
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>预览</h5>
						</div>
						<div class="col-md-10">
							<img src="{{ url('admin/upload/config/'.$config->logo) }}" width="100" />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bottom-form" style="margin-bottom:20px;">
						<div class="col-md-2">
							<h5>Button</h5>
						</div>
						<div class="col-md-10">
							<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交</button>
							<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置</button>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
	
    @endsection