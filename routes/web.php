<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function (){
    Route::group(['prefix'=>'user'],function (){
        Route::get('danhsach','UserController@getdanhSach')->name('danhSachUser');//
        Route::post('danhsach','UserController@postdanhSach')->name('postdanhSachUser');

        Route::get('sua/{id}','UserController@getSua')->name('getSuaUser');
        Route::post('sua/{id?}','UserController@postSua')->name('postSuaUser');
        Route::post('ajax','UserController@ajaxSua')->name('postSuaUserajax');

        Route::get('them','UserController@getThem')->name('getThemUser');//
        Route::post('themuser','UserController@postThem')->name('postThemUser');//

        Route::get('delete/{id?}','UserController@getxoa')->name('getXoaUser');
    });
    Route::group(['prefix'=>'category'],function (){
        Route::get('danhsach','categoryControler@getdanhSach')->name('danhSachcate');//

        Route::get('sua/{id}','categoryControler@getSua')->name('getSuacate');//
        Route::post('sua/{id}','categoryControler@postSua')->name('postSuacate');//

        Route::get('them','categoryControler@getThem')->name('getThemcate');
        Route::post('them','categoryControler@postThem')->name('postThemcate');

        Route::get('xoa/{id?}','categoryControler@getxoa')->name('getXoaCate');//
    });

    Route::group(['prefix'=>'product'],function (){
        Route::get('danhsach','ProductController@getdanhSach')->name('danhSachProduct');//

        Route::get('sua/{id}','ProductController@getSua')->name('getSuaProduct');//
        Route::post('sua/{id}','ProductController@postSua')->name('postSuaProduct');//

        Route::get('them','ProductController@getThem')->name('getThemProduct');
        Route::post('them','ProductController@postThem')->name('postThemProduct');//

        Route::get('xoa/{id}','ProductController@getxoaImg_detail')->name('getXoaProduct_img');//
        Route::get('xoa-product/{id?}','ProductController@getxoa')->name('getXoaProduct');//
    });
    Route::group(['prefix'=>'color'],function (){
        Route::get('danhsach','ColorController@getdanhSach')->name('danhSachColor');//

        Route::get('sua/{id}','ColorController@getSua')->name('getSuacolor');//
        Route::post('sua/{id}','ColorController@postSua')->name('postSuacolor');//

        Route::get('them','ColorController@getThem')->name('getThemcolor');
        Route::post('them','ColorController@postThem')->name('postThemcolor');

        Route::get('xoa/{id?}','ColorController@getxoa')->name('getXoacolor');//
    });
    Route::group(['prefix'=>'size'],function (){
        Route::get('danhsach','SizeCOntroller@getdanhSach')->name('danhSachsize');//

        Route::get('sua/{id}','SizeCOntroller@getSua')->name('getSuasize');//
        Route::post('sua/{id}','SizeCOntroller@postSua')->name('postSuasize');//

        Route::get('them','SizeCOntroller@getThem')->name('getThemsize');
        Route::post('them','SizeCOntroller@postThem')->name('postThemsize');

        Route::get('xoa/{id?}','SizeCOntroller@getxoa')->name('getXoasize');//

    });
    Route::group(['prefix'=>'order'],function (){
        Route::get('danhsach','orderControler@getdanhSach')->name('danhSachorder');//
        Route::get('xoa/{id?}','orderControler@getxoa')->name('getXoaOrder');//
        Route::get('xacnhandon/{id?}','orderControler@xacnhandon')->name('xacnhandon');//
        Route::get('xacnhandondagiao/{id?}','orderControler@xacnhandondagiao')->name('xacnhandondagiao');//
    });


});
Route::group(['prefix'=>'fonend'],function (){


    Route::get('login','FonendController@login')->name('login');
    Route::post('login','FonendController@postlogin')->name('postlogin');


    Route::post('logout','FonendController@logout')->name('logout');
    Route::post('logout_user','FonendController@logout_user')->name('logout_user');


    Route::get('dangki','FonendController@dangki')->name('dangki');
    Route::post('dangki','FonendController@postdangki')->name('postdangki');

    //Trang blog
    Route::get('blog','FonendController@blog')->name('blog');
    //Danh Mục Sản Phẩm
    Route::get('category_product/{id}','FonendController@category_product')->name('category_product');
    //detail
    Route::get('product_detail/{id}','FonendController@detail')->name('productDetail');
    //cart
    Route::post('addCart/{id}','FonendController@addcart')->name('addcart');
    Route::get('del-cart/{id}','FonendController@delCart')->name('delCart');
    //checkout
    Route::get('checkout','FonendController@checkout')->name('checkout');
    //mail
    Route::post('sendmail','FonendController@sendmai')->name('sendmai');
    Route::get('add-mail','FonendController@addmail')->name('addmail');
    //search
    Route::post('timkiem','FonendController@timkiem')->name('timkiem');
    //lịch sử mua hàng
    Route::get('xemlichsumuahang/{id}','FonendController@lichsu')->name('lichsu');
    //xóa đơn hàng
    Route::post('xoadonhang/{id?}','FonendController@xoadonhang')->name('xoadonhang');
    Route::post('editproduct/{id}/{qty}','AjaxController@editpro')->name('editpro');


});
    //trang chủ
    Route::get('/', 'FonendController@trangchu')->name('trangchu');
    // xử lí ajax
    Route::post('checkemail','AjaxController@checkemail')->name('checkemail');
    Route::post('ajaxcate','AjaxController@ajaxcate')->name('ajaxcate');


Route::get('tungthanh',function (){
    $data=App\User::where('id','>',1)->orderBy('id')->get();
    dd($data);
});








