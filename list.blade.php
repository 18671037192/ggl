@extends('layouts.app')
<!--Basic Styles-->
        <link href="style/bootstrap.css" rel="stylesheet">
        <link href="style/font-awesome.css" rel="stylesheet">
        <link href="style/weather-icons.css" rel="stylesheet">
        <!--Beyond styles-->
        <link id="beyond-link" href="style/beyond.css" rel="stylesheet" type="text/css">
        <link href="style/demo.css">
        <link href="style/typicons.css">
        <link href="style/animate.css">  
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@section('content')
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
                    <li class="active">博客文章管理</li>
                </ul>
            </div>
            <!-- /Page Breadcrumb -->
            <!-- Page Body -->
            <div class="page-body">                  
                <button type="button" tooltip="添加用户" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = 'news/add'"> <i class="fa fa-plus"></i> Add</button>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="flip-scroll">
                            <table class="table table-bordered table-hover">
                                <thead class="">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">所属栏目</th>
                                        <th class="text-center">标题</th>
                                        <th class="text-center">作者</th>
                                        <th class="text-center">是否推荐</th>
                                        <th class="text-center">发布时间</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!-- @foreach ($list as $k => $v)
                                    <tr>
                                        <td align="center">{{ $v->aid }}</td>
                                        <td align="center">{{ $v->cates->cname }}</td>
                                        <td align="center">{{ $v->desc }}</td>
                                        <td align="center">{{ $v->author }}</td>
                                        <td align="center">
                                            <a href="javascript:void(0);" class="btn btn-default btn-sm recommend" data-aid="{{ $v->aid }}" data-state="{{ $v->state }}">
                                                @if ($v->state)
                                                    是
                                                @else
                                                    否
                                                @endif
                                            </a>
                                        </td>
                                        <td align="center">{{ $v->systime }}</td>
                                        <td align="center">
                                            <a href="news/edit/{{ $v->aid }}" class="btn btn-primary btn-sm shiny"><i class="fa fa-edit"></i> 编辑</a>
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $v->aid }})" class="btn btn-danger btn-sm shiny"><i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach -->


                                @foreach ($list as $k=>$v)
                                    <tr>
                                        <td align="center">{{$v->aid}}</td>
                                        <td align="center">{{$v->cates->cname}}</td>
                                        <td align="center">{{$v->desc}}</td>
                                        <td align="center">{{$v->author}}</td>
                                        <td align="center"><a href="#">@if($v->state)
                                                                            是
                                                                        @else
                                                                            否
                                                                        @endif</a></td>
                                        <td align="center">{{$v->systime}}</td>
                                        <td align="center">
                                            <a href="news/edit/{{$v->aid}}" class="btn btn-primary btn-sm shiny"><i class="fa fa-edit"></i> 编辑</a>
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $v->aid }})" class="btn btn-danger btn-sm shiny"><i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                                <tfoot class="">
                                    <tr>
                                    <div>{{$list->links()}}</div>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function confirmDelete(aid) {
        if (confirm("确定要删除这篇文章吗？")) {
            window.location.href = "news/del/" + aid;
        }
    };
    </script>
