<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Book as bookModel;
class Video extends Base
{
  public function lst()
    {
      $books = model('book')->where('pid', 0)->order(['sort' => 'desc'])->all();
      $where = [];
      $catename = null;
      if (input('?id')) {
            $where = [
                'videocate_id' => input('id')
            ];
       $catename = model('videocate')->where('id', input('id'))->value('title');
      }
       $videolst = model('video')
       ->where($where)
       ->with('videocate')
       ->order(['atop' => 'asc','update_time' => 'desc'])
       ->paginate(10, false, ['query' => $where]);

      $viewData = [
            'videolst' => $videolst,
            'books' => $books,
            'books' => $books,
            'catename' => $catename,
        ];
      $this->assign($viewData);

      return view();
    }

  public function add()
    {
      $books = new BookModel();
      $booktree = $books->booktree();
      $this->assign('booktree',$booktree);
      if (request()->isAjax()) {
        $desc    =input('post.desc');
        $content =input('post.content');
        if (empty($desc)) {
          $desc = mb_substr($content,0,250,"UTF-8");
        };
        $data = [
          'title'      => input('post.title'),
          'seo_title'  => input('post.seo_title'),
          'video_link' => input('post.video_link'),
          'img'        => input('post.img'),
          'book_id'    => input('post.book_id'),
          'desc'       => $desc,
          'content'    => htmlspecialchars_decode($content)
        ];
        $result = model('video')->add($data);
        if ($result == 1) {
          $this->success('栏目添加成功！', 'admin/video/lst');
        }else {
          $this->error($result);
        }
      }


      return view();
    }

  public function search()
    {
        $keyword = '%' . input('s') . '%';
        $where[] = ['title', 'like', $keyword];
        $searchs = model('video')->where($where)->paginate(20, false, $where);
        $viewData = [
            'searchs' => $searchs,
            'title' => '"' . input('keyword') . '"' . '搜索结果'
        ];
        $this->assign($viewData);
        return view();
    }

  public function edit()
    {
      if (request()->isAjax()) {
        $desc    =input('post.desc');
        $content =htmlspecialchars_decode(input('post.content'));
        $contents = preg_replace("/<([a-zA-Z]+)[^>]*>/","<\\1>",$content);
        if (empty($desc)) {
          $desc = mb_substr($contents,0,250,'utf-8');
        };
        dump($desc);die;
        $data = [
          'id'      => input('post.id'),
          'title'      => input('post.title'),
          'seo_title'  => input('post.seo_title'),
          'video_link' => input('post.video_link'),
          'img'        => input('post.img'),
          'book_id'    => input('post.book_id'),
          'desc'       => $desc,
          'content'    => $content
        ];
        $result = model('video')->edit($data);
        if ($result == 1) {
           $this->success('栏目编辑成功！', 'admin/video/lst');
          }else {
            $this->error($result);
           }
       }

      $Info = model('video')->find(input('id'));
      $viewData = [
            'Info' => $Info
        ];
      $this->assign($viewData);
      return view();
    }


    public function atop()
    {
        $info = model('video')->find(input('id'));
        $info->atop = input('post.atop') ? 0 : 1;
        $result = $info->save();
        if ($result) {
            $this->success('操作成功！', 'admin/video/lst');
        }else {
            $this->error('操作失败！');
        }
    }
    public function del()
    {
        $delInfo = model('video')->find(input('id'));
        $result = $delInfo->delete();
        if ($result) {
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }

}
