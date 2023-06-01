<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\News;
use DB;
use App\Models\Cates;
class Newscontroller extends Controller
{
   
    //
    public function index(){
        //倒序
        $data = News::orderBy('aid', 'desc')->paginate(5);
        // $data = News::paginate(3);
        return view('list')->with('list',$data);
    }
    public function add(Request $req){
        // 在前面的返回语句中返回视图，避免后续的代码执行
    
    
        if ($req->isMethod('post')) {
            $data = $req->validate([
                'title' => 'required|min:5',
                'desc' => 'required|min:5',
                'content' => 'required|min:10',
            ], [
                'title.required' => '标题不能为空',
                'title.min' => '标题至少5个字符',
                'desc.required' => '简介不能为空',
                'desc.min' => '简介至少5个字符',
                'content.required' =>'内容不能为空',
                'content.min' => '内容至少有10个字符',
            ]);
    
                $file = '';
                if($req->hasFile('pic')){
                //获取上传文件对象
                $pic = $req->file('pic');
                //判断是否上传成功
                $exts = ['jpg','jpeg','png','gif','svg'];
                if($pic->isValid() && in_array($pic->extension(),$exts)){
                    //给文件重命名
                    $name = md5(microtime(true)).'.'.$pic->extension();
                    $pic->move('npload',$name);
                    $file = 'npload/'.$name;
                }
            }
            $data=[
                'title'=>$req->input('title'),
                'author'=> $req->input('author'),
                'desc'=> $req->input('desc'),
                'pic' => $file,
                'systime'=>date('Y-m-d H:i:s'),
                'content'=> $req->input('content'),
                'state'=> $req->has('is_recommend') ? 1 : 0,
                'cid'=> $req->input('group_id')
            ];
    
            $res = News::create($data)->save();
            if ($res) {
                return redirect('news');
            }
    
            // 返回错误信息
            return back()->withErrors(['error' => '保存新闻失败']);
        }
        $add = Cates::all();
        return view('add')->with('add', $add)->with('caption','新增');
    
    }


        public function edit(Request $req){
        $aid = $req->aid;//获取留言id
        $data = News::findOrFail($aid);
        $file = $data->pic;
                if($req->hasFile('pic')){
                //获取上传文件对象
                $pic = $req->file('pic');
                //判断是否上传成功
                $exts = ['jpg','jpeg','png','gif','svg'];
                if($pic->isValid() && in_array($pic->extension(),$exts)){
                    //给文件重命名
                    $name = md5(microtime(true)).'.'.$pic->extension();
                    $pic->move('npload',$name);
                    $file = 'npload/'.$name;
                }
            }
            if ($req->input('title') && $req->input('content')){
                $data->title = $req->input('title');
                $data->author = $req->input('author');
                $data->desc = $req->input('desc');
                $data->content = $req->input('content');
                $data->state = $req->has('is_recommend') ? 1 : 0; // 修改此处
                $data->systime = date('Y-m-d H:i:s');
                $data->pic = $file;
                $data->cid = $req->input('group_id');
                $res = $data->save();
                if ($res) {
                    return redirect('news');
                }
                // 返回错误信息
                return back()->withErrors(['error' => '保存新闻失败']);
            }
            $add = Cates::all();
            return view('add', ['caption' => '修改', 'add' => $add, 'data' => $data]);
        }
    public function del(Request $req){
        $aid = $req->aid;
        $rows = News::where('aid',$aid)->delete();
        if($rows>0) {
        return redirect('news');
    }
    }
    }