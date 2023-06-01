<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>博客管理系统后台</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="{{ asset('style/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('style/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('style/weather-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--Beyond styles-->
    <link id="beyond-link" href="{{ asset('style/beyond.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('style/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('style/animate.css') }}" rel="stylesheet">
</head>
<body>
<!-- 头部 -->
<nav class="navbar navbar-expand-md navbar-light shadow-sm bg-info">
            <div class="container">
       
                    <h2>博客管理系统后台</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
<!-- /头部 -->
<div class="main-container container-fluid">
	<div class="page-container">
		<!-- Page Sidebar -->
        <div class="page-sidebar" id="sidebar">
            <!-- Page Sidebar Header-->
            <div class="sidebar-header-wrapper">
                <input class="searchinput" type="text">
                <i class="searchicon fa fa-search"></i>
                <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
            </div>
            <!-- /Page Sidebar Header -->
            <!-- Sidebar Menu -->
            <ul class="nav sidebar-menu">
                <!--Dashboard-->
                <li>
                    <a href="#" class="menu-dropdown">
                        <i class="menu-icon fa fa-user"></i>
                        <span class="menu-text">管理员</span>
                        <i class="menu-expand"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="/admin/document/index.html">
                                <span class="menu-text">管理列表</span>
                                <i class="menu-expand"></i>
                            </a>
                        </li>
                    </ul>                            
                </li> 
                <li>
                    <a href="#" class="menu-dropdown">
                        <i class="menu-icon fa fa-file-text"></i>
                        <span class="menu-text">文档</span>
                        <i class="menu-expand"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="/admin/document/index.html">
                                <span class="menu-text">文章列表</span>
                                <i class="menu-expand"></i>
                            </a>
                        </li>
                    </ul>                            
                </li> 
                <li>
                    <a href="#" class="menu-dropdown">
                        <i class="menu-icon fa fa-gear"></i>
                        <span class="menu-text">系统</span>
                        <i class="menu-expand"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="/admin/document/index.html">
                                <span class="menu-text">配置</span>
                                <i class="menu-expand"></i>
                            </a>
                        </li>
                    </ul>                            
                </li>                                           
            </ul>
        <!-- /Sidebar Menu -->
        </div>
        <!-- /Page Sidebar -->
        <!-- Page Content -->
        <div class="page-content">
            <!-- Page Breadcrumb -->
            <div class="page-breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="#">系统</a></li>
                    <li>博客文章管理</li>
                    <li class="active">{{$caption}}</li>
                </ul>
            </div>
            <!-- /Page Breadcrumb -->
            <!-- Page Body -->
            <div class="page-body">                  
                <button type="button" tooltip="新增文章" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '/admin/user/add.html'"> <i class="fa fa-plus"></i> Add</button>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <div class="widget-header bordered-bottom bordered-blue">
                        <span class="widget-caption">{{$caption}}文章</span>
                    </div>
                    <div class="widget-body">
                        <div id="horizontal-form">
                            <form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label no-padding-right">标题</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="title" placeholder="" name="title" required="" type="text" value="@if ($caption =='修改'){{$data->title}}@endif">
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label no-padding-right">作者</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="title" placeholder="" name="author" required="" type="text" value="@if ($caption =='修改'){{$data->author}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label no-padding-right">简介</label>
                                    <div class="col-sm-6">
                                        <textarea name="desc">@if ($caption =='修改'){{$data->desc}}@endif

                                        </textarea>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>

                                <div class="form-group">
                                    <label for="pic" class="col-sm-2 control-label no-padding-right">缩略图</label>
                                    <div class="col-sm-6">
                                        @if ($caption == '修改' && $data->pic)
                                            <p><img src="{{ asset($data->pic) }}" alt="{{ $data->title }}" class="img-thumbnail"></p>
                                            <input id="pic" placeholder="" name="pic" type="file">
                                        @else
                                            <input id="pic" placeholder="" name="pic" type="file" required>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label no-padding-right">内容</label>
                                    <div class="col-sm-6">
                                        <textarea name="content" cols="76" >@if ($caption =='修改'){{$data->content}}@endif</textarea>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>

                                <div class="form-group">
                                    <label for="is_show" class="col-sm-2 control-label no-padding-right">是否推荐</label>
                                    <div class="col-xs-4">
                                        <label>
                                            <input class="checkbox-slider slider-icon yesno" name="is_recommend" {{ $data->is_recommend ? 'checked' : '' }} type="checkbox">
                                            推荐：
                                            <span class="text"></span>
                                        </label>
                                    </div>                            
                                </div>

                                <!-- <div class="form-group">
                                    
                                    <label for="is_show" class="col-sm-2 control-label no-padding-right">是否推荐</label>
                                    <div class="col-xs-4">
                                        <label>
                                            <input class="checkbox-slider slider-icon yesno" name="is_show" checked="checked" type="checkbox">
                                            推荐：
                                            <span class="text"></span>
                                        </label>
                                    </div>                            
                                </div>  -->
                                <div class="form-group">
                                    <label for="group_id" class="col-sm-2 control-label no-padding-right">所属栏目</label>
                                    <div class="col-sm-6">
                                        <select name="group_id" style="width: 100%;">
                                            
                                        @foreach ($add as $add)
                                        <option value="{{ $add->cid }}" @if ($add->cid == old('group_id')) selected @endif>{{ $add->cname }}</option>
                                        @endforeach

                                        </select>

                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">保存信息</button>
                                    </div>
                             @if($errors->any())
                                <div>
                                    @foreach($errors->all() as $err)
                                    <div>{{$err}}</div>
                                    @endforeach
                                </div>
                            @endif
                                {{csrf_field()}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Body -->
</div>
</body>
</html>
<script>

</script>