<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\Checkoutcontroller;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\HomeBlogController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ShippingAreaController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login',[AdminController::class,'store'])->name('admin.login');
});


Route::middleware(['auth:admin'])->group(function(){


Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');

// Admin All routes
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

// admin Profile Controller

Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
Route::get('edit/admin/profile', [AdminProfileController::class, 'EditAdminProfile'])->name('edit.admin.profile');
Route::post('edit/admin/update', [AdminProfileController::class, 'UpdateAdminProfile'])->name('admin.profile.update');
Route::get('admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('admin/update/password', [AdminProfileController::class, 'AdminUpdatePassword'])->name('admin.update.password');

 }); //Admin Middleware to protect routes that are only for admins
// User All Routes


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $user = User::find(Auth::user()->id);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/edit', [IndexController::class, 'UserProfileEdit'])->name('user.profile.edit');
Route::get('/user/password/', [IndexController::class, 'UserPassword'])->name('user.password');

Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');


Route::prefix('brand')->group(function(){

    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');


    

});

// Admin Category All routes

Route::prefix('category')->group(function(){

    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

    // admin Sub Category All Routes

    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update/{id}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');


    // Admin Sub Sub Categories All Routes

    Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);

    Route::post('/sub/sub/store' ,[SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

    Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

    Route::post('/sub/sub/update/{id}' ,[SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');

});

// Admin Products All Routes

Route::prefix('product')->group(function(){

    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('store.product');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage.product');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    Route::post('/data/update/{id}', [ProductController::class, 'UpdateProduct'])->name('product.update');
    Route::get('/delete/{id}', [ProductController::class, 'DeleteProduct'])->name('product.delete');

    Route::post('/image/update/', [ProductController::class, 'MultiImageUpdate'])->name('update.product_image');
    Route::post('/image/thumbnail/update/{id}', [ProductController::class, 'ThumbnailImageUpdate'])->name('update.product_thumbnail');
    Route::get('/multiimage/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimage_delete');
    Route::get('/inactive/{id}', [ProductController::class, 'InactiveProduct'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ActiveProduct'])->name('product.active');
    
    
});

Route::prefix('slider')->group(function(){

    Route::get('/view', [SliderController::class, 'ViewSlider'])->name('view.slider');
    Route::post('/store', [SliderController::class, 'StoreSlider'])->name('store.slider');
    Route::get('/edit/{id}', [SliderController::class, 'EditSlider'])->name('edit.slider');
    Route::post('/edit/{id}', [SliderController::class, 'UpdateSlider'])->name('update.slider');
    Route::get('/delete/{id}', [SliderController::class, 'DeleteSlider'])->name('delete.slider');

    Route::get('/inactive/{id}', [SliderController::class, 'InactiveSlider'])->name('inactive.slider');
    Route::get('/active/{id}', [SliderController::class, 'ActiveSlider'])->name('active.slider');
    
});

// Admin Coupons All Routes
Route::prefix('coupons')->group(function(){

    Route::get('/manage', [CouponController::class, 'ViewCoupon'])->name('manage.coupon');
    Route::post('/store', [CouponController::class, 'StoreCoupon'])->name('store.coupon');
    Route::get('/edit/{id}', [CouponController::class, 'EditCoupon'])->name('edit.coupon');
    Route::post('/update/{id}', [CouponController::class, 'UpdateCoupon'])->name('update.coupon');
    Route::get('/delete/{id}', [CouponController::class, 'DeleteCoupon'])->name('delete.coupon');
   
    
});

// shipping All routes 

Route::prefix('shipping')->group(function(){
// Division
    Route::get('/division/view', [ShippingAreaController::class, 'ViewDivision'])->name('manage.division');
    Route::post('/division/store', [ShippingAreaController::class, 'StoreDivision'])->name('store.division');
    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'EditDivision'])->name('edit.division');
    Route::post('/division/update/{id}', [ShippingAreaController::class, 'UpdateDivision'])->name('update.division');
    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DeleteDivision'])->name('delete.division');

// District 
    Route::get('/district/view', [ShippingAreaController::class, 'ViewDistrict'])->name('manage.district');
    Route::post('/district/store', [ShippingAreaController::class, 'StoreDistrict'])->name('store.district');
    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'EditDistrict'])->name('edit.district');
    Route::post('/district/update/{id}', [ShippingAreaController::class, 'UpdateDistrict'])->name('update.district');
    Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DeleteDistrict'])->name('delete.district');

// State 

    Route::get('/state/view', [ShippingAreaController::class, 'ViewState'])->name('manage.state');
    Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('store.state');
    Route::get('/state/edit/{id}', [ShippingAreaController::class, 'EditState'])->name('edit.state');
    Route::post('/state/update/{id}', [ShippingAreaController::class, 'UpdateState'])->name('update.state');
    Route::get('/state/delete/{id}', [ShippingAreaController::class, 'DeleteState'])->name('delete.state');

   
   
    
});
    // Front end All Routes /////////////////////////////////////

    // Multi language all routes 




    Route::get('/language/spanish', [LanguageController::class, 'Spanish'])->name('spanish.language');

    Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');





// FrontEnd Route Product Details

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'DetailsProduct']);

// FrontEnd Product Tags Pages
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// Subcategory Frontend WISE Data
Route::get('subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Subsubcategory Frontend WISE Data
Route::get('subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubsubCatWiseProduct']);


// Product View Modal with AJAX

Route::get('/produc/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Add to Cart Store Data

Route::post('/cart/data/store/{id}',[CartController::class, 'AddToCart']);

// Mini Cart Get Data
Route::get('/product/mini/cart',[CartController::class, 'AddMiniCart']);


// Mini Cart Remove Data

Route::get('/minicart/product-remove/{rowId}',[CartController::class, 'RemoveMiniCart']);

// Add To Wishlist Button

Route::post('/add/to/wishlist/{product_id}',[WishlistController::class, 'AddToWishlist']);


Route::group(['prefix'=>'user', 'middleware' =>['user','auth'],'namespace' =>'User'], function(){

        // Wishlist Routes

        Route::get('/wishlist',[WishlistController::class, 'ViewWishlist'])->name('wishlist');

        // Get wishlist Product
        Route::get('/get-wishlist-product',[WishlistController::class, 'GetWishlistProduct']);

        // wishlist Remove
        Route::get('wishlist-remove/{id}',[WishlistController::class, 'RemoveWishlistProduct']);

        // Stripe 

        Route::post('stripe/order',[StripeController::class, 'StripeOrder'])->name('stripe.order');

        // cash

        Route::post('cash/order',[CashController::class, 'CashOrder'])->name('cash.order');

        // My Profile View Orders

        Route::get('/orders',[AllUserController::class, 'MyOrders'])->name('user.orders');

        Route::get('/details-order/{orderId}',[AllUserController::class, 'DetailsOrder']);

        // invoice download

        Route::get('/invoice_download/{order_id}',[AllUserController::class, 'InvoiceDownload']);

        // Route to send the return order reason To database Return Order

        Route::post('/return/order/{order_id}',[AllUserController::class, 'ReturnOrder'])->name('return-order');

        // Return Order List

        Route::get('/return/orders/list',[AllUserController::class, 'ReturnedOrderList'])->name('returned.orders.list');

        // cancelled order list

        Route::get('/cancelled/orders/list',[AllUserController::class, 'CancelledOrderList'])->name('cancelled.orders.list');





       
        
});




// My Cart Routes All Routes

Route::get('/mycart',[CartPageController::class, 'MyCart'])->name('mycart');

Route::get('/user/get-cart-product',[CartPageController::class, 'GetCartProduct']);

Route::get('/user/cart-remove/{rowId}',[CartPageController::class, 'RemoveCartProduct']);

Route::get('/cart-increment/{rowId}',[CartPageController::class, 'IncrementCart']);

Route::get('/cart-decrement/{rowId}',[CartPageController::class, 'DecrementCart']);



// Frontend Coupon 


Route::post('/coupon-apply',[CartController::class, 'ApplyCoupon']);


Route::get('/coupon-calculation',[CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove',[CartController::class, 'RemoveCoupon']);

// Checkout Routes

Route::get('/checkout',[CartController::class, 'CreateCheckout'])->name('checkout');

// ajax select after you selected another one


Route::get('/district-get/ajax/{division_id}',[Checkoutcontroller::class, 'DistrictGetAjax']);

Route::get('/state-get/ajax/{district_id}',[Checkoutcontroller::class, 'StateGetAjax']);
// 

// Send the Checkout payment and whole form 


Route::post('/store/checkout',[Checkoutcontroller::class, 'StoreCheckout'])->name('store.checkout');

// Admin Order 

Route::prefix('orders')->group(function(){

    Route::get('/order/details/{order_id}', [OrderController::class, 'OrdersDetails'])->name('order.details');

    Route::get('/pending', [OrderController::class, 'PendingOrders'])->name('pending.orders');

    Route::get('/confirmed', [OrderController::class, 'ConfirmedOrders'])->name('confirmed.orders');

    Route::get('/processing', [OrderController::class, 'ProcessingOrders'])->name('processing.orders');

    Route::get('/picked', [OrderController::class, 'PickedOrders'])->name('picked.orders');

    Route::get('/shipped', [OrderController::class, 'ShippedOrders'])->name('shipped.orders');

    Route::get('/delivered', [OrderController::class, 'DeliveredOrders'])->name('delivered.orders');

    Route::get('/canceled', [OrderController::class, 'CanceledOrders'])->name('canceled.orders');

    Route::get('/invoice/dowload/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');

    
    // Update Status Orders 

    Route::get('/pending/confirmed/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirmed');

    Route::get('/confirmed/processing/{order_id}', [OrderController::class, 'ConfirmedToProcessing'])->name('confirmed-processed');

    Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processed-picked');

    Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked-shipped');

    Route::get('shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped-delivered');

    Route::get('delivered/canceled{order_id}', [OrderController::class, 'DeliveredToCanceled'])->name('delivered-canceled');

   
   
    
});

// Admin Reports Routes


Route::prefix('reports')->group(function(){

    Route::get('/view', [ReportController::class, 'ViewReport'])->name('all-reports');

    Route::post('/search/by/date', [ReportController::class, 'ReportSearchByDate'])->name('search-by-date');

    Route::post('/search/by/month', [ReportController::class, 'ReportSearchByMonth'])->name('search-by-month');

    Route::post('/search/by/year', [ReportController::class, 'ReportSearchByYear'])->name('search-by-year');

});

// Admin Get All Users

Route::prefix('alluser')->group(function(){

    Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');

   

});

Route::prefix('blog')->group(function(){

    Route::get('/category', [BlogController::class, 'BlogCategory'])->name('blog-category');

    Route::post('/category/store', [BlogController::class, 'StoreBlogCategory'])->name('blog-category-store');

    Route::get('/category/edit/{id}', [BlogController::class, 'EditBlogCategory'])->name('blog-category-edit');

    Route::post('/category/update/{id}', [BlogController::class, 'UpdateBlogCategory'])->name('blog-category-update');

    Route::get('/category/delete/{id}', [BlogController::class, 'DeleteBlogCategory'])->name('blog-category-delete');

    //Admin View Blog Post Routes

    Route::get('/add/post', [BlogController::class, 'AddPost'])->name('add-post');

    Route::get('/view/post', [BlogController::class, 'ViewPost'])->name('view-post');

    Route::post('/store/post', [BlogController::class, 'StorePost'])->name('store-post');


});

// FrontEnd Blog Show Routes


Route::get('/blog', [HomeBlogController::class, 'BlogPosts'])->name('home-blog');

Route::get('/post/details/{id}', [HomeBlogController::class, 'BlogPostDetails'])->name('details-blog');

Route::get('blog/category/post/{category_id}', [HomeBlogController::class, 'HomeBlogCatPost']);


// Site Setting Routes



Route::prefix('setting')->group(function(){


Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site-setting');

Route::post('/site/update/{id}', [SiteSettingController::class, 'UpdateSiteSetting'])->name('update-site-setting');





});