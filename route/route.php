<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
Route::rule('/', 'index/index/index');
Route::rule('comment/add', 'index/comment/add', 'post|get');
Route::rule('comment/like', 'index/comment/like', 'post|get');


Route::rule('news-[:id]', 'index/news/lst', 'get');
Route::rule('news/:id', 'index/news/art', 'get');
Route::rule('news/like', 'index/news/like', 'post|get');
Route::rule('news/love', 'index/news/love', 'post|get');
Route::rule('down', 'index/down/home', 'get');
Route::rule('down-:id', 'index/down/lst', 'get');
Route::rule('down/:id', 'index/down/art', 'get');

//练习题
Route::rule('exam', 'index/exam/home', 'get');//手机端用
Route::rule('exam-:id', 'index/exam/lst', 'get');
Route::rule('exam/:id', 'index/exam/art', 'get');
Route::rule('exam/tree-:id', 'index/exam/tree', 'get');
Route::rule('exam/count', 'index/exam/count', 'get|post');

Route::rule('point', 'index/point/home', 'get');//手机端用
Route::rule('point-:id', 'index/point/lst', 'get');
Route::rule('point/tree-:id', 'index/point/tree', 'get');
Route::rule('point/:id', 'index/point/art', 'get');
Route::rule('point/sectionlst-:id', 'index/point/sectionLst', 'get');


Route::rule('video-[:id]', 'index/video/lst', 'get');
Route::rule('video/:id', 'index/video/art', 'get');

Route::rule('guide', 'index/guide/lst', 'get');
Route::rule('guide-<id>', 'index/guide/art', 'get');

Route::rule('tax-[:id]', 'index/tax/lst', 'get');
Route::rule('tax/:id', 'index/tax/art', 'get');

Route::rule('love', 'index/love/click', 'get|post');
//专题
Route::rule('subject-[:id]', 'index/index/subject', 'get');
//注册登录
Route::rule('forget', 'index/index/forget', 'get|post');
Route::rule('loginout', 'index/index/loginout', 'get|post');
Route::rule('login', 'index/index/login', 'get|post');
Route::rule('register', 'index/index/register', 'get|post');
Route::rule('search/[:s]', 'index/index/search', 'get|post');
Route::rule('check', 'index/index/check', 'post|get');

Route::rule('user', 'index/user/home', 'get|post');
Route::rule('user/set', 'index/user/set', 'get|post');
Route::rule('user/exam', 'index/user/exam', 'get|post');
Route::rule('user/point', 'index/user/point', 'get|post');
Route::rule('user/commemt', 'index/user/comment', 'get|post');
Route::rule('user/upload', 'index/user/upload', 'get|post');

//Route::miss('index/index/miss');

Route::group('admin', function () {
    //pub
    Route::rule('upload', 'admin/base/upload', 'get|post');
    Route::rule('/', 'admin/index/login', 'get|post');
    Route::rule('forget', 'admin/index/forget', 'get|post');
    Route::rule('loginout', 'admin/index/loginout', 'post');
    Route::rule('forgetre', 'admin/index/forgetre', 'post');
    Route::rule('index', 'admin/home/index', 'get');
    Route::rule('del', 'admin/index/del', 'get|post');
    Route::rule('recover', 'admin/index/recover', 'get|post');


    Route::rule('slider/lst', 'admin/slider/lst', 'get');
    Route::rule('slider/del', 'admin/slider/del', 'get|post');
    Route::rule('slider/edit-[:id]', 'admin/slider/edit', 'get|post');
    Route::rule('slider/add', 'admin/slider/add', 'get|post');
    Route::rule('slider/sort', 'admin/slider/sort', 'post');

    Route::rule('book/getsub', 'admin/book/getsub', 'post');
    Route::rule('book/lst', 'admin/book/lst', 'get');
    Route::rule('book/add', 'admin/book/add', 'get|post');
    Route::rule('book/edit-[:id]', 'admin/book/edit', 'get|post');
    Route::rule('book/del', 'admin/book/del', 'get|post');
    Route::rule('book/sort', 'admin/book/sort', 'post');
    Route::rule('book/search', 'admin/book/search', 'post');

    Route::rule('chapter/lst-[:id]', 'admin/book/chapterlst', 'get|post');
    Route::rule('chapter/add-[:id]', 'admin/book/chapteradd', 'get|post');
    Route::rule('chapter/edit-[:id]', 'admin/book/chapteredit', 'get|post');

    Route::rule('exam/lst-[:id]', 'admin/exam/lst', 'get|post');
    Route::rule('exam/add', 'admin/exam/add', 'get|post');
    Route::rule('exam/sort', 'admin/exam/sort', 'post');
    Route::rule('exam/edit-[:id]', 'admin/exam/edit', 'get|post');
    Route::rule('exam/del', 'admin/exam/del', 'post');
    Route::rule('exam/search', 'admin/exam/search', 'post');
    Route::rule('exam/import', 'admin/exam/import', 'get|post');

    Route::rule('news/lst-[:id]', 'admin/news/lst', 'get|post');
    Route::rule('news/add', 'admin/news/add', 'get|post');
    Route::rule('news/edit-[:id]', 'admin/news/edit', 'get|post');
    Route::rule('news/del', 'admin/news/del', 'post');
    Route::rule('news/search', 'admin/news/search', 'post');
    Route::rule('news/top', 'admin/news/atop', 'post');
    Route::rule('news/trash', 'admin/news/trash', 'get|post');


    Route::rule('down/lst-[:id]', 'admin/down/lst', 'get|post');
    Route::rule('down/add', 'admin/down/add', 'get|post');
    Route::rule('down/edit-[:id]', 'admin/down/edit', 'get|post');
    Route::rule('down/del', 'admin/down/del', 'post');
    Route::rule('down/top', 'admin/down/atop', 'post');

    Route::rule('tax/lst-[:id]', 'admin/tax/lst', 'get|post');
    Route::rule('tax/add', 'admin/tax/add', 'get|post');
    Route::rule('tax/edit-[:id]', 'admin/tax/edit', 'get|post');
    Route::rule('tax/del', 'admin/tax/del', 'post');
    Route::rule('tax/search', 'admin/tax/search', 'post');
    Route::rule('tax/top', 'admin/tax/atop', 'post');

    Route::rule('newscate/lst-[:id]', 'admin/newscate/lst', 'get|post');
    Route::rule('newscate/add', 'admin/newscate/add', 'get|post');
    Route::rule('newscate/del', 'admin/newscate/del', 'get|post');
    Route::rule('newscate/edit-[:id]', 'admin/newscate/edit', 'get|post');
    Route::rule('newscate/search', 'admin/newscate/search', 'post');

    Route::rule('downcate/lst-[:id]', 'admin/downcate/lst', 'get|post');
    Route::rule('downcate/add', 'admin/downcate/add', 'get|post');
    Route::rule('downcate/del', 'admin/downcate/del', 'get|post');
    Route::rule('downcate/edit-[:id]', 'admin/downcate/edit', 'get|post');
    Route::rule('downcate/search', 'admin/downcate/search', 'post');

    Route::rule('guide/lst-[:id]', 'admin/guide/lst', 'get|post');
    Route::rule('guide/add', 'admin/guide/add', 'get|post');
    Route::rule('guide/del', 'admin/guide/del', 'get|post');
    Route::rule('guide/edit-[:id]', 'admin/guide/edit', 'get|post');
    Route::rule('guide/sort', 'admin/guide/sort', 'post');

    Route::rule('video/lst-[:id]', 'admin/video/lst', 'get|post');
    Route::rule('video/add', 'admin/video/add', 'get|post');
    Route::rule('video/del', 'admin/video/del', 'get|post');
    Route::rule('video/edit-[:id]', 'admin/video/edit', 'get|post');
    Route::rule('video/top', 'admin/video/atop', 'post');

    Route::rule('point/lst', 'admin/point/lst', 'get|post');
    Route::rule('point/lst-<id>', 'admin/point/lst', 'get|post');
    Route::rule('point/add', 'admin/point/add', 'get|post');
    Route::rule('point/edit-[:id]', 'admin/point/edit', 'get|post');
    Route::rule('point/del', 'admin/point/del', 'post');
    Route::rule('point/search', 'admin/point/search', 'post');
    Route::rule('point/top', 'admin/point/atop', 'post');


    Route::rule('user/lst-[:status]', 'admin/user/lst', 'get');
    Route::rule('user/edit-[:id]', 'admin/user/edit', 'get|post');
    Route::rule('user/del', 'admin/user/del', 'post');

    Route::rule('commemt/lst', 'admin/comment/lst', 'get');
    Route::rule('comment/art/:id', 'admin/comment/read', 'get');
    Route::rule('comment/del', 'admin/comment/del', 'post');

    Route::rule('webset', 'admin/system/webset', 'get');
    Route::rule('catset', 'admin/system/catset', 'get');
    Route::rule('set', 'admin/system/set', 'get|post');
    //Route::miss('admin/index/miss');
});
