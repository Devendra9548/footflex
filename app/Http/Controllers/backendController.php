<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\AdminInfo;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogSeo;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\category_blog_seo;
use App\Models\GlobalSeo;
use App\Models\PageSeo;
use App\Models\customer;
use App\Models\Order;
use App\Models\Contact;
use Intervention\Image\Facades\Image;

class backendController extends Controller
{
    function login(Request $req){
        if(Cookie::has('pswd')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
    }
    function checklogin(Request $req){
        
        $dbuser =  AdminInfo::first();
        $dbusername = $dbuser->username;
        $dbemail = $dbuser->email;
        $dbpswd = $dbuser->password;

        $email = $req->input('email');
        $mdpswd = $req->input('pswd');
        $pswd = md5($mdpswd);

        if(($dbusername == $email || $dbemail == $email) && $dbpswd == $pswd){
             
        $cookie = Cookie::make('name', $dbusername);
        Cookie::queue($cookie);
        $cookieemail = Cookie::make('email', $dbemail);
        Cookie::queue($cookieemail);
        $cookie1 = Cookie::make('pswd', $dbpswd);
        Cookie::queue($cookie1);
        return true;
        }
        else{
         return false;
        }
    }
    function logout(Request $req){
        if(Cookie::has('pswd'))
        {
           $ckname = Cookie::forget('name');
           Cookie::queue($ckname);

           $ckemail = Cookie::forget('email');
           Cookie::queue($ckemail);

           $ckpswd = Cookie::forget('pswd');
           Cookie::queue($ckpswd);

           return redirect('admin');
        }
    }
    function dashboard(Request $req){
          if(Cookie::has('pswd')){
            $customers = customer::all();
            $customer = count($customers);
            $orders = Order::all();
            $order = count($orders);
            $totals=0;
            foreach($orders as $orders){
              $totals = $totals+$orders->amount;
            }
            $total = $totals;
            return view('admin.dashboard',['customer'=>$customer,'amount'=>$total,'order'=>$order]);
          }
          else{
            return redirect('admin');
          }
    }

    function allContacts(Request $req){
      if(Cookie::has('pswd')){
        $dbs = Contact::all();
        return view('admin.contacts.all-contacts',['members'=>$dbs]);
      }
      else{
        return redirect('admin');
      }
    }

    function allblogs(Request $req){
      $search = $req['search'] ?? "";
      if(Cookie::has('pswd')){
        if($search != ''){
          $dbs = DB::table('blogs as b')
          ->select('b.id', 'b.title', 'bc.bcname', 'b.description', 'b.file', 'b.slug')
          ->join('blogs_categories as bc', 'b.category', '=', 'bc.id')
          ->where('b.title', 'LIKE', '%' . $search . '%')
          ->orWhere('bc.bcname', 'LIKE', '%' . $search . '%')
          ->get();
        }
        else{
        $dbs = DB::table('blogs as b')
        ->select('b.id', 'b.title', 'bc.bcname', 'b.description', 'b.file', 'b.slug')
        ->join('blogs_categories as bc', 'b.category', '=', 'bc.id')
        ->get();
        }
        $members = DB::table('blogs as b')
        ->select('b.id', 'b.title', 'bc.bcname', 'b.description', 'b.file', 'b.slug')
        ->join('blogs_categories as bc', 'b.category', '=', 'bc.id')
        ->get();
        return view('admin.blogs.all-blogs',['blog'=>$dbs,'members'=>$members,'search'=>$search]);
      }else{
        return redirect('admin'); 
      }
    }
    function addblog(){
      if(Cookie::has('pswd')){
        $dbs = BlogCategory::all();
        return view('admin.blogs.add-blog',['members'=>$dbs]);
      }
      else{
        return redirect('admin');
      }
    }

 
    function wpaddblog(Request $req){
      if(Cookie::has('pswd')){
        $dbs = new Blog(); 
        $cname = $req->input('title');
        $origname = '';
        if ($req->hasFile('file')) 
        {
        $image = $req->file('file');
        $name = $image->getClientOriginalName();
        $t=time();
        $d=date("Y-m-d",$t);
        $origname = $d."-".$t."-".$name;
        
        $customFolderPath = public_path('blogs');
        if (!file_exists($customFolderPath)) 
        {
        mkdir($customFolderPath, 0755, true);
        } 
        $image->move($customFolderPath, $origname);

        $imagePath = public_path('blogs/' . $origname);
        $imagess = Image::make($imagePath);
        $thumbnail = $imagess->resize(244, 300);
        $thumbnailPath = public_path('blogs-thumb/' . $origname);
        $thumbnail->save($thumbnailPath);
        
        $imagePath = public_path('blogs/' . $origname);
        $imagess = Image::make($imagePath);
        $thumbnail = $imagess->resize(100, 123);
        $thumbnailPath = public_path('recent-blogs-thumb/' . $origname);
        $thumbnail->save($thumbnailPath);
  
        $name = $req->file('file')->getClientOriginalName();
        $origname = $d."-".$t."-".$name;
        }
         
        if($cname){
          $dbs->title = $cname;
          $dbs->description = $req->input('description');
          $dbs->file = $origname;
          $dbs->category = $req->input('category');
          $slug = $req->input('slug');
          $dbs->slug = $slug;
          $result = $dbs->save();
          if($result){
            $blogseo = BlogSeo::create(['canonical'=>$slug,'file'=>$origname,'blogid'=>$dbs->id]);
            $blogseo->id;
            return True;
          }
          else{
            return False;
          }
        }
        else{
          return False;
         }
        }
        else{
          return redirect('admin');
        }
    }

    function editblog($id){
      if(Cookie::has('pswd')){
      $dbs = Blog::find($id);
      $allcats = BlogCategory::all();
      $cats = BlogCategory::all();
      return view('admin.blogs.edit-blog',['members'=>$dbs, 'allcats'=>$allcats, 'cats'=>$cats]);
    }
    else{
      return redirect('admin');
    }
    }

    function UpdateBlog(Request $req)
    {
      if(Cookie::has('pswd')){
      $origname='';
      $dbs = Blog::find($req->id);
  
      if (!$dbs) {
        // Handle product not found error
        return redirect()->back()->with('error', 'Blog not found.');
      }

      
      $slug = $req->slug;
      $dbs->slug = $slug;
    
        // Check if a new image is uploaded for updating
      if ($req->hasFile('file')) {
        $image = $req->file('file');
        $name = $image->getClientOriginalName();
        $t=time();
        $d=date("Y-m-d",$t);
        $origname = $d."-".$t."-".$name;
        $customFolderPath = public_path('blogs');
        $image->move($customFolderPath, $origname);
        $dbs->file = $origname;
        
        $imagePath = public_path('blogs/' . $origname);
        $imagess = Image::make($imagePath);
        $thumbnail = $imagess->resize(244, 300);
        $thumbnailPath = public_path('blogs-thumb/' . $origname);
        $thumbnail->save($thumbnailPath);
        
        $imagePath = public_path('blogs/' . $origname);
        $imagess = Image::make($imagePath);
        $thumbnail = $imagess->resize(100, 123);
        $thumbnailPath = public_path('recent-blogs-thumb/' . $origname);
        $thumbnail->save($thumbnailPath);

        $blogseo = BlogSeo::find($dbs->id);
        $blogseo->update(['file'=>$origname]);
        $blogseo->id;
      }
      
        
      $blogseo = BlogSeo::find($dbs->id);
      $blogseo->update(['canonical'=>$slug]);
      $blogseo->id;

      $dbs->title = $req->title;
      $dbs->description = $req->description;
      $dbs->category = $req->category;
      $result = $dbs->save();
      if($result){
      return true;
      }
      else{
        return false;
      }
    }
    else{
      return redirect('admin');
    }
    }
  
    function DeleteBlog($id){
      if(Cookie::has('pswd')){
      $dbseo = BlogSeo::find($id);
      if($dbseo){
        $dbseo->delete();
      }

      $dbs = Blog::find($id);
      if($dbs){
      $dbs->delete();
      return true;
      }
    }
    else{
      return redirect('admin');
    }
  }
  

    function allcategories(){
      if(Cookie::has('pswd')){
      $dbs = BlogCategory::all();
      $member = BlogCategory::all();
      return view('admin.blogs-categories.all-categories',['blogcategory'=>$dbs, 'members'=>$member]);
      }
      else{
        return redirect('admin');
      }
    }

    function editblogcategories($id){
      if(Cookie::has('pswd')){
      $dbs = BlogCategory::find($id);
      $cats = BlogCategory::all();
      return view('admin.blogs-categories.edit-blog-categories',['members'=>$dbs,'cats'=>$cats]);
    }
    else{
      return redirect('admin');
    }
    }

    
  
    function addcategory(){
      if(Cookie::has('pswd')){
        $dbs = BlogCategory::all();
        return view('admin.blogs-categories.add-category',['members'=>$dbs]);
      }
        else{
          return redirect('admin');
        }
    }

    function wpaddcategory(Request $req){
      if(Cookie::has('pswd')){
        $dbs = new BlogCategory(); 
        $cname = $req->input('bcname');
        $origname = '';
        if ($req->hasFile('bcfile')) 
        {
        $image = $req->file('bcfile');
        $name = $image->getClientOriginalName();
        $t=time();
        $d=date("Y-m-d",$t);
        $origname = $d."-".$t."-".$name;
        
        $customFolderPath = public_path('blogs');
        if (!file_exists($customFolderPath)) 
        {
        mkdir($customFolderPath, 0755, true);
        } 
        $image->move($customFolderPath, $origname);
  
        $name = $req->file('bcfile')->getClientOriginalName();
        $origname = $d."-".$t."-".$name;
        }
  
        if($cname){
          $dbs->bcname = $cname;
          $dbs->bcdescription = $req->input('bcdescription');
          $dbs->bcfile = $origname;
          $dbs->bccategory = $req->input('bccategory');
          $slug = $req->input('bcslug');
          $dbs->bcslug = $slug;
          $result = $dbs->save();
          if($result){
            $blogseo = category_blog_seo::create(['canonical'=>$slug,'file'=>$origname,'blogid'=>$dbs->id]);
            $blogseo->id;
            return True;
          }
          else{
            return False;
          }
                    
        }
        else{
            return False;
         }
        }
        else{
          return redirect('admin');
        }
    }

  
    function UpdateBlogCategory(Request $req)
  {
    if(Cookie::has('pswd')){
    $origname='';
    $dbs = BlogCategory::find($req->id);

    if (!$dbs) {
      // Handle product not found error
      return redirect()->back()->with('error', 'Blog not found.');
    }

    $slug = $req->bcslug;
    $dbs->bcslug = $slug;
  
      // Check if a new image is uploaded for updating
    if ($req->hasFile('bcfile')) {
      $image = $req->file('bcfile');
      $name = $image->getClientOriginalName();
      $t=time();
      $d=date("Y-m-d",$t);
      $origname = $d."-".$t."-".$name;
      $customFolderPath = public_path('blogs');
      $image->move($customFolderPath, $origname);
      $dbs->bcfile = $origname;
      
      $blogseo = category_blog_seo::find($dbs->id);
      $blogseo->update(['file'=>$origname]);
      $blogseo->id;
    }
       
    $blogseo = category_blog_seo::find($dbs->id);
    $blogseo->update(['canonical'=>$slug]);
    $blogseo->id;

    $dbs->bcname = $req->bcname;
    
    $dbs->bcdescription = $req->bcdescription;
    $dbs->bccategory = $req->bccategory;
    $result = $dbs->save();
    if($result){
    return true;
    }
    else{
      return false;
    }
  }
  else{
    return redirect('admin');
  }
  }

  function DeleteBlogCategory($id){
    if(Cookie::has('pswd')){
    
    $dbseo = category_blog_seo::find($id);
      if($dbseo){
        $dbseo->delete();
     }

    $dbs = BlogCategory::find($id);
    if($dbs){
    $dbs->delete();
    return true;
    }
  }
  else{
    return redirect('admin');
  }
}

  function postseo($id){
    if(Cookie::has('pswd')){
    $dbs = BlogSeo::find($id);
    return view('admin.seo',['blogid'=>$id,'members'=>$dbs]);
  }
  else{
    return redirect('admin');
  }
  }

  function wpaddpostseo(Request $req){
    if(Cookie::has('pswd')){
    $dbs = BlogSeo::find($req->blogid);
    if (!$dbs) {
      // Handle product not found error
      return redirect()->back()->with('error', 'Blog not found.');
    }
    
    $dbs->title = $req->title;
    $dbs->description = $req->description;
    $dbs->keywords = $req->keywords;
    $dbs->author = $req->author;
    $dbs->smarkup = $req->smarkup;
    $result = $dbs->save();
    if($result){
    return true;
    }
    else{
      return false;
    } 
  }
  else{
    return redirect('admin');
  }
  }

  function postcatseo($id){
    if(Cookie::has('pswd')){
    $dbs = category_blog_seo::find($id);
    return view('admin.cat-seo',['blogid'=>$id,'members'=>$dbs]);
  }
  else{
    return redirect('admin');
  }
  }

  function wpaddpostcatseo(Request $req){
    if(Cookie::has('pswd')){
    $dbs = category_blog_seo::find($req->blogid);
    if (!$dbs) {
      // Handle product not found error
      return redirect()->back()->with('error', 'Blog Category not found.');
    }
    
    $dbs->title = $req->title;
    $dbs->description = $req->description;
    $dbs->keywords = $req->keywords;
    $dbs->author = $req->author;
    $dbs->smarkup = $req->smarkup;
    $result = $dbs->save();
    if($result){
    return true;
    }
    else{
      return false;
    } 
  }
  else{
    return redirect('admin');
  }
  }

  function globalseo(){
    if(Cookie::has('pswd')){
        $gseo = GlobalSeo::find(1);
        return view('admin.globalseo',['gseo'=>$gseo]);
    }
    else{
        return redirect('admin');
    }
  }

  function wpglobalseo(Request $req){
    if(Cookie::has('pswd')){
    $gseo = GlobalSeo::find(1);
    $gseo->sitename = $req->sitename;
    $gseo->facebook = $req->facebook;
    $gseo->youtube = $req->youtube;
    $gseo->instagram = $req->instagram;
    $gseo->twitter = $req->twitter;
    $gseo->linkedin = $req->linkedin;
    $gseo->whatsapp = $req->whatsapp;
    $gseo->pinterest = $req->pinterest;
    $gseo->globalheader = $req->globalheader;
    $gseo->gfbs = $req->gfbs;
    $gseo->gfas = $req->gfas;
    $result = $gseo->save();
    return $result;
  }
  else{
    return redirect('admin');
  }
  }

  function admininfo(Request $req){
    if(Cookie::has('pswd')){
    $admin = AdminInfo::first();
    return view('admin.admin-info',['admin'=>$admin]);
  }
  else{
    return redirect('admin');
  }
  }

  function wpadmininfo(Request $req){
    if(Cookie::has('pswd')){
    $admin = AdminInfo::find($req->id);
    $adminseo = GlobalSeo::find($req->id);

    if($adminseo){
      $data = GlobalSeo::find($req->id);
      $data->ownername = $req->username;
      $data->save();

      $admin->username = $req->username;
      $admin->password = md5($req->password);
      $admin->save();
      return true;
    }
    else{
      $data = new GlobalSeo();
      $data->ownername = $req->username;
      $data->save();
      $admin->username = $req->username;
      $admin->password = md5($req->password);
      $admin->save();
      return true;
    }
  }
  else{
    return redirect('admin');
  }
  }

  function pageseo(){
    if(Cookie::has('pswd')){
    $data = PageSeo::all();
    return view('admin.pageseo',['data'=>$data]);
     }
    else{
      return redirect('admin');
    }
  }

  function getpage(){
    if(Cookie::has('pswd')){
    return view('admin.pages.add-page');
  }
  else{
    return redirect('admin');
  }
  }

  function addpage(Request $req){
    if(Cookie::has('pswd')){
    $dbs = new PageSeo();
    $dbs->pagename = $req->pagename;
    $dbs->slug = $req->slug;
    $result = $dbs->save();
    if($result){
      return true;
    }
    else{
      return false;
    }
  }
  else{
    return redirect('admin');
  }

  }

  function geteditpage($id){
    if(Cookie::has('pswd')){
    $data = PageSeo::find($id);
    return view('admin.pages.page-seo-form',['members'=>$data]);
  }
  else{
    return redirect('admin');
  }
  }

  function updatepageseo(Request $req){
    if(Cookie::has('pswd')){
    $origname='';
    $dbs = PageSeo::find($req->id);
    
    if (!$dbs) {
      // Handle product not found error
      return redirect()->back()->with('error', 'Page not found.');
    }
  
      // Check if a new image is uploaded for updating
    if ($req->hasFile('file')) {
      $image = $req->file('file');
      $name = $image->getClientOriginalName();
      $t=time();
      $d=date("Y-m-d",$t);
      $origname = $d."-".$t."-".$name;
      $customFolderPath = public_path('pages');
      $image->move($customFolderPath, $origname);
      $dbs->file = $origname;
    }
       
    
    $dbs->pagename = $req->pagename;
    $dbs->slug = $req->slug;
    $dbs->title = $req->title;
    $dbs->description = $req->description;
    $dbs->keywords = $req->keywords;
    $dbs->author = $req->author;
    $dbs->smarkup = $req->smarkup;
    $result = $dbs->save();
    if($result){
    return true;
    }
    else{
      return false;
    }
  }
  else{
    return redirect('admin');
  }
  }

  function deletepageseo($id){
    if(Cookie::has('pswd')){
    $dbs = PageSeo::find($id);
    if($dbs){
    $dbs->delete();
    return true;
    }
  }
  else{
    return redirect('admin');
  }
  }

  

  // All Product Categories

  function allProductcategories(){
    if(Cookie::has('pswd')){
    $dbs = ProductCategory::all();
    $member = ProductCategory::all();
    return view('admin.product-categories.all-categories',['pcategory'=>$dbs, 'members'=>$member]);
    }
    else{
      return redirect('admin');
    }
  }

  function editProductcategories($id){
    if(Cookie::has('pswd')){
    $dbs = ProductCategory::find($id);
    $cats = ProductCategory::all();
    return view('admin.product-categories.edit-product-categories',['members'=>$dbs,'cats'=>$cats]);
  }
  else{
    return redirect('admin');
  }
  }

  

  function addProductcategory(){
    if(Cookie::has('pswd')){
      $dbs = ProductCategory::all();
      return view('admin.product-categories.add-category',['members'=>$dbs]);
    }
      else{
        return redirect('admin');
      }
  }

  function wpaddProductcategory(Request $req){
    if(Cookie::has('pswd')){
      $dbs = new ProductCategory(); 
      $cname = $req->input('category_name');
      $origname = '';
      if ($req->hasFile('image')) 
      {
      $image = $req->file('image');
      $name = $image->getClientOriginalName();
      $t=time();
      $d=date("Y-m-d",$t);
      $origname = $d."-".$t."-".$name;
      
      $customFolderPath = public_path('products');
      if (!file_exists($customFolderPath)) 
      {
      mkdir($customFolderPath, 0755, true);
      } 
      $image->move($customFolderPath, $origname);

      $name = $req->file('image')->getClientOriginalName();
      $origname = $d."-".$t."-".$name;
      }

      if($cname){
        $dbs->category_name = $cname;
        $dbs->image = $origname;
        $dbs->p_category = $req->input('p_category');
        $slug = $req->input('slug');
        $dbs->slug = $slug;
        $result = $dbs->save();
        return true;
      }
      else{
          return False;
       }
      }
      else{
        return redirect('admin');
      }
  }


  function UpdateProductCategory(Request $req)
{
  if(Cookie::has('pswd')){
  $origname='';
  $dbs = ProductCategory::find($req->id);

  if (!$dbs) {
    // Handle product not found error
    return redirect()->back()->with('error', 'Blog not found.');
  }

  $slug = $req->slug;
  $dbs->slug = $slug;

    // Check if a new image is uploaded for updating
  if ($req->hasFile('image')) {
    $image = $req->file('image');
    $name = $image->getClientOriginalName();
    $t=time();
    $d=date("Y-m-d",$t);
    $origname = $d."-".$t."-".$name;
    $customFolderPath = public_path('products');
    $image->move($customFolderPath, $origname);
    $dbs->image = $origname;
  }

  $dbs->category_name = $req->category_name;
  $dbs->p_category = $req->p_category;
  $result = $dbs->save();
  if($result){
  return true;
  }
  else{
    return false;
  }
}
else{
  return redirect('admin');
}
}

function DeleteProductCategory($id){
  if(Cookie::has('pswd')){
  
  $dbs = ProductCategory::find($id);
  if($dbs){
  $dbs->delete();
  return true;
  }
}
else{
  return redirect('admin');
}
}

// Add New Product

function allproducts(Request $req){
  $search = $req['search'] ?? "";
  if(Cookie::has('pswd')){
    if($search != ''){
      $dbs = Product::get();
    }
    else{
      $dbs = Product::get(); 
    }
    return view('admin.products.all-products',['product'=>$dbs,'search'=>$search]);
  }else{
    return redirect('admin'); 
  }
}
function addproduct(){
  if(Cookie::has('pswd')){
    $dbs = ProductCategory::all();
    return view('admin.products.add-product',['members'=>$dbs]);
  }
  else{
    return redirect('admin');
  }
}

function wpaddproduct(Request $req){
  if(Cookie::has('pswd')){
    $dbs = new Product(); 
    $cname = $req->input('p_name');
    $pimagemain = '';
    $pmainimg = '';
    $gimg = array();
    $gimg1 = '';
    $gimg2 = '';
    $gimg3 = '';
    $gimg4 = '';
    $curlfirst = '';
    $curlsecond = '';
    $curlthird = '';
    $curlfourth = '';
    $firstgallery = '';
    $secondgallery = '';
    $thirdgallery = '';
    
    
    // Product Feature Image

    if ($req->hasFile('file')) 
    {
    $image = $req->file('file');
    $name = $image->getClientOriginalName();
    $t=time();
    $d=date("Y-m-d",$t);
    $pimagemain = $d."-".$t."-".$name;
    
    $customFolderPath = public_path('products');
    if (!file_exists($customFolderPath)) 
    {
    mkdir($customFolderPath, 0755, true);
    } 

    $image->move($customFolderPath, $pimagemain);
    $imagePath = public_path('products/' . $pimagemain);
    $imagess = Image::make($imagePath);
    $thumbnail = $imagess->resize(244, 300);
    $thumbnailPath = public_path('products-thumb/' . $pimagemain);
    $thumbnail->save($thumbnailPath);
    
    $imagePath = public_path('products/' . $pimagemain);
    $imagess = Image::make($imagePath);
    $thumbnail = $imagess->resize(100, 123);
    $thumbnailPath = public_path('recent-products-thumb/' . $pimagemain);
    $thumbnail->save($thumbnailPath);

    $name = $req->file('file')->getClientOriginalName();
    $pmainimg = $d."-".$t."-".$name;
    $gimg[] = $pmainimg;
    }

    // Galler Images

    $datasarray = array("f1-g1","f1-g2","f1-g3","f1-g4");

    foreach ($datasarray as $data) {
    if ($req->hasFile($data)) 
    {
    $image = $req->file($data);
    $name = $image->getClientOriginalName();
    $t=time();
    $d=date("Y-m-d",$t);
    $pimagemain = '';
    $pimagemain = $d."-".$t."-".$name;
    
    $customFolderPath = public_path('products');
    if (!file_exists($customFolderPath)) 
    {
    mkdir($customFolderPath, 0755, true);
    } 

    $image->move($customFolderPath, $pimagemain);
    $imagePath = public_path('products/' . $pimagemain);
    $imagess = Image::make($imagePath);
    $thumbnail = $imagess->resize(244, 300);
    $thumbnailPath = public_path('products-thumb/' . $pimagemain);
    $thumbnail->save($thumbnailPath);
    
    $imagePath = public_path('products/' . $pimagemain);
    $imagess = Image::make($imagePath);
    $thumbnail = $imagess->resize(100, 123);
    $thumbnailPath = public_path('recent-products-thumb/' . $pimagemain);
    $thumbnail->save($thumbnailPath);

    $name = $req->file($data)->getClientOriginalName();
    $pimagemain = $d."-".$t."-".$name;
    $gimg[] = $pimagemain;
    }
  }
if (isset($gimg[0])) {
  $curlfirst = json_encode($gimg);
}
  //  First Gallery Image

  if ($req->hasFile('file1')){ 
  
    $customFolderPath = public_path('products');
    $uploadedFileNames = [];
  
      // Create the directory if it doesn't exist
      if (!file_exists($customFolderPath)) {
          mkdir($customFolderPath, 0755, true);
      }
  
      // Ensure 'file1' is an array and iterate through each file
      if ($req->hasFile('file1') && is_array($req->file('file1'))) 
      {
        foreach ($req->file('file1') as $file) {
         $name = $file->getClientOriginalName();
         $t = time();
         $d = date("Y-m-d", $t);
         $thirdgallery = '';
         $thirdgallery = $d . "-" . $t . "-" . $name;
         $file->move($customFolderPath, $thirdgallery);
         $uploadedFileNames[] = $thirdgallery;
         // Process the image (resize, create thumbnails, etc.)
         $imagePath = public_path('products/' . $thirdgallery);
         $imagess = \Image::make($imagePath);
         // Example: Resize to 348x196
          $thumbnail = $imagess->resize(244, 300);
          $thumbnailPath = public_path('products-thumb/' . $thirdgallery);
          $thumbnail->save($thumbnailPath);
  
          // Example: Resize to 160x90
          $imagess = \Image::make($imagePath);
          $thumbnail = $imagess->resize(100, 123);
          $thumbnailPath = public_path('recent-products-thumb/' . $thirdgallery);
          $thumbnail->save($thumbnailPath);
         }
      }
      $firstgallery = json_encode($uploadedFileNames);
    }


  //  Second Gallery Image

  if ($req->hasFile('file2')){ 
  
    $customFolderPath = public_path('products');
    $uploadedFileNames = [];
  
      // Create the directory if it doesn't exist
      if (!file_exists($customFolderPath)) {
          mkdir($customFolderPath, 0755, true);
      }
  
      // Ensure 'file2' is an array and iterate through each file
      if ($req->hasFile('file2') && is_array($req->file('file2'))) 
      {
        foreach ($req->file('file2') as $file) {
         $name = $file->getClientOriginalName();
         $t = time();
         $d = date("Y-m-d", $t);
         $thirdgallery = '';
         $thirdgallery = $d . "-" . $t . "-" . $name;
         $file->move($customFolderPath, $thirdgallery);
         $uploadedFileNames[] = $thirdgallery;
         // Process the image (resize, create thumbnails, etc.)
         $imagePath = public_path('products/' . $thirdgallery);
         $imagess = \Image::make($imagePath);
         // Example: Resize to 348x196
          $thumbnail = $imagess->resize(244, 300);
          $thumbnailPath = public_path('products-thumb/' . $thirdgallery);
          $thumbnail->save($thumbnailPath);
  
          // Example: Resize to 160x90
          $imagess = \Image::make($imagePath);
          $thumbnail = $imagess->resize(100, 123);
          $thumbnailPath = public_path('recent-products-thumb/' . $thirdgallery);
          $thumbnail->save($thumbnailPath);
         }
      }
      
      $secondgallery = json_encode($uploadedFileNames);
    }

  //  Third Gallery Image

  if ($req->hasFile('file3')){ 
  
  $customFolderPath = public_path('products');
  $uploadedFileNames = [];

    // Create the directory if it doesn't exist
    if (!file_exists($customFolderPath)) {
        mkdir($customFolderPath, 0755, true);
    }

    // Ensure 'file3' is an array and iterate through each file
    if ($req->hasFile('file3') && is_array($req->file('file3'))) 
    {
      foreach ($req->file('file3') as $file) {
       $name = $file->getClientOriginalName();
       $t = time();
       $d = date("Y-m-d", $t);
       $thirdgallery = $d . "-" . $t . "-" . $name;
       $file->move($customFolderPath, $thirdgallery);
       $uploadedFileNames[] = $thirdgallery;
       // Process the image (resize, create thumbnails, etc.)
       $imagePath = public_path('products/' . $thirdgallery);
       $imagess = \Image::make($imagePath);
       // Example: Resize to 348x196
        $thumbnail = $imagess->resize(244, 300);
        $thumbnailPath = public_path('products-thumb/' . $thirdgallery);
        $thumbnail->save($thumbnailPath);

        // Example: Resize to 160x90
        $imagess = \Image::make($imagePath);
        $thumbnail = $imagess->resize(100, 123);
        $thumbnailPath = public_path('recent-products-thumb/' . $thirdgallery);
        $thumbnail->save($thumbnailPath);
       }
    }
    $thirdgallery = '';
    $thirdgallery = json_encode($uploadedFileNames);
  }

  

  // Main Code Here
    if($cname){
      $dbs->p_name = $cname;
      $dbs->description = $req->input('description');
      $dbs->p_image = $curlfirst;
      $dbs->p_image_first = $firstgallery;
      $dbs->p_image_second = $secondgallery;
      $dbs->p_image_third = $thirdgallery;
      $dbs->category_id = $req->input('category_id');
      $dbs->p_price = $req->input('p_price');
      $dbs->r_price = $req->input('r_price');
      $dbs->sizes = $req->input('sizes');
      $slug = $req->input('slug');
      $dbs->slug = $slug;
      $result = $dbs->save();
      return true;
    }
    else{
      return False;
     }
    }
    else{
      return redirect('admin');
    }
}

function editproduct($id){
  if(Cookie::has('pswd')){
  $dbs = Product::find($id);
  $allcats = ProductCategory::all();
  $cats = ProductCategory::all();
  return view('admin.products.edit-product',['members'=>$dbs, 'allcats'=>$allcats, 'cats'=>$cats]);
}
else{
  return redirect('admin');
}
}

function Updateproduct(Request $req)
{
  if(Cookie::has('pswd'))
{
    $origname='';
    $dbs = Product::find($req->id);
    $cname = $req->input('p_name');
    $pimagemain = '';
    $pmainimg = '';
    $cgimg = $req->input('cp_image');
    $gimg = array();
    $gimg1 = '';
    $gimg2 = '';
    $gimg3 = '';
    $gimg4 = '';
    $curlfirst = '';
    $curlsecond = '';
    $curlthird = '';
    $curlfourth = '';
    $firstgallery = $req->input('cfirstgallery');
    $secondgallery = $req->input('csecondgallery');
    $lastthirdgallery = $req->input('cthirdgallery');

  if (!$dbs) {
    // Handle product not found error
    return redirect()->back()->with('error', 'Blog not found.');
  }
 // Product Feature Image

 if ($req->hasFile('file')) 
 {
 $image = $req->file('file');
 $name = $image->getClientOriginalName();
 $t=time();
 $d=date("Y-m-d",$t);
 $pimagemain = $d."-".$t."-".$name;
 
 $customFolderPath = public_path('products');
 if (!file_exists($customFolderPath)) 
 {
 mkdir($customFolderPath, 0755, true);
 } 

 $image->move($customFolderPath, $pimagemain);
 $imagePath = public_path('products/' . $pimagemain);
 $imagess = Image::make($imagePath);
 $thumbnail = $imagess->resize(244, 300);
 $thumbnailPath = public_path('products-thumb/' . $pimagemain);
 $thumbnail->save($thumbnailPath);
 
 $imagePath = public_path('products/' . $pimagemain);
 $imagess = Image::make($imagePath);
 $thumbnail = $imagess->resize(100, 123);
 $thumbnailPath = public_path('recent-products-thumb/' . $pimagemain);
 $thumbnail->save($thumbnailPath);

 $name = $req->file('file')->getClientOriginalName();
 $pmainimg = $d."-".$t."-".$name;
 $gimg[] = $pmainimg;
 }
 else{
  $gimg[] = $req->input('cfile1');
 }

 // Galler Images

 $datasarray = array("f1_g1","f1_g2","f1_g3","f1_g4");

 foreach ($datasarray as $data) {
 if ($req->hasFile($data)) 
 {
 $image = $req->file($data);
 $name = $image->getClientOriginalName();
 $t=time();
 $d=date("Y-m-d",$t);
 $pimagemain = '';
 $pimagemain = $d."-".$t."-".$name;
 
 $customFolderPath = public_path('products');
 if (!file_exists($customFolderPath)) 
 {
 mkdir($customFolderPath, 0755, true);
 } 

 $image->move($customFolderPath, $pimagemain);
 $imagePath = public_path('products/' . $pimagemain);
 $imagess = Image::make($imagePath);
 $thumbnail = $imagess->resize(244, 300);
 $thumbnailPath = public_path('products-thumb/' . $pimagemain);
 $thumbnail->save($thumbnailPath);
 
 $imagePath = public_path('products/' . $pimagemain);
 $imagess = Image::make($imagePath);
 $thumbnail = $imagess->resize(100, 123);
 $thumbnailPath = public_path('recent-products-thumb/' . $pimagemain);
 $thumbnail->save($thumbnailPath);

 $name = $req->file($data)->getClientOriginalName();
 $pimagemain = $d."-".$t."-".$name;
 $gimg[] = $pimagemain;
 }
}
if (isset($gimg[1])) {
$curlfirst = json_encode($gimg);
}
//  First Gallery Image

if ($req->hasFile('file1')){ 

 $customFolderPath = public_path('products');
 $uploadedFileNames = [];

   // Create the directory if it doesn't exist
   if (!file_exists($customFolderPath)) {
       mkdir($customFolderPath, 0755, true);
   }

   // Ensure 'file1' is an array and iterate through each file
   if ($req->hasFile('file1') && is_array($req->file('file1'))) 
   {
     foreach ($req->file('file1') as $file) {
      $name = $file->getClientOriginalName();
      $t = time();
      $d = date("Y-m-d", $t);
      $thirdgallery = '';
      $thirdgallery = $d . "-" . $t . "-" . $name;
      $file->move($customFolderPath, $thirdgallery);
      $uploadedFileNames[] = $thirdgallery;
      // Process the image (resize, create thumbnails, etc.)
      $imagePath = public_path('products/' . $thirdgallery);
      $imagess = \Image::make($imagePath);
      // Example: Resize to 348x196
       $thumbnail = $imagess->resize(244, 300);
       $thumbnailPath = public_path('products-thumb/' . $thirdgallery);
       $thumbnail->save($thumbnailPath);

       // Example: Resize to 160x90
       $imagess = \Image::make($imagePath);
       $thumbnail = $imagess->resize(100, 123);
       $thumbnailPath = public_path('recent-products-thumb/' . $thirdgallery);
       $thumbnail->save($thumbnailPath);
      }
   }
   $firstgallery = '';
   $firstgallery = json_encode($uploadedFileNames);
 }


//  Second Gallery Image

if ($req->hasFile('file2')){ 

 $customFolderPath = public_path('products');
 $uploadedFileNames = [];

   // Create the directory if it doesn't exist
   if (!file_exists($customFolderPath)) {
       mkdir($customFolderPath, 0755, true);
   }

   // Ensure 'file2' is an array and iterate through each file
   if ($req->hasFile('file2') && is_array($req->file('file2'))) 
   {
     foreach ($req->file('file2') as $file) {
      $name = $file->getClientOriginalName();
      $t = time();
      $d = date("Y-m-d", $t);
      $thirdgallery = '';
      $thirdgallery = $d . "-" . $t . "-" . $name;
      $file->move($customFolderPath, $thirdgallery);
      $uploadedFileNames[] = $thirdgallery;
      // Process the image (resize, create thumbnails, etc.)
      $imagePath = public_path('products/' . $thirdgallery);
      $imagess = \Image::make($imagePath);
      // Example: Resize to 348x196
       $thumbnail = $imagess->resize(244, 300);
       $thumbnailPath = public_path('products-thumb/' . $thirdgallery);
       $thumbnail->save($thumbnailPath);

       // Example: Resize to 160x90
       $imagess = \Image::make($imagePath);
       $thumbnail = $imagess->resize(100, 123);
       $thumbnailPath = public_path('recent-products-thumb/' . $thirdgallery);
       $thumbnail->save($thumbnailPath);
      }
   }
   $secondgallery = '';
   $secondgallery = json_encode($uploadedFileNames);
 }

//  Third Gallery Image

if ($req->hasFile('file3')){ 

unset($uploadedFileNames);
$customFolderPath = public_path('products');
$uploadedFileNames = [];

 // Create the directory if it doesn't exist
 if (!file_exists($customFolderPath)) {
     mkdir($customFolderPath, 0755, true);
 }

 // Ensure 'file3' is an array and iterate through each file
 if ($req->hasFile('file3') && is_array($req->file('file3'))) 
 {
   $thirdgallery = '';
   foreach ($req->file('file3') as $file) {
    $name = $file->getClientOriginalName();
    $t = time();
    $d = date("Y-m-d", $t);
    $thirdgallery = $d . "-" . $t . "-" . $name;
    $file->move($customFolderPath, $thirdgallery);
    $uploadedFileNames[] = $thirdgallery;
    // Process the image (resize, create thumbnails, etc.)
    $imagePath = public_path('products/' . $thirdgallery);
    $imagess = \Image::make($imagePath);
    // Example: Resize to 348x196
     $thumbnail = $imagess->resize(244, 300);
     $thumbnailPath = public_path('products-thumb/' . $thirdgallery);
     $thumbnail->save($thumbnailPath);

     // Example: Resize to 160x90
     $imagess = \Image::make($imagePath);
     $thumbnail = $imagess->resize(100, 123);
     $thumbnailPath = public_path('recent-products-thumb/' . $thirdgallery);
     $thumbnail->save($thumbnailPath);
    }
 }
 $lastthirdgallery = '';
 $lastthirdgallery = json_encode($uploadedFileNames);
}



// Main Code Here
 if($cname){
   $dbs->p_name = $cname;
   $dbs->description = $req->input('description');
   if (isset($gimg[1]) && isset($gimg[2]) && isset($gimg[3])) {
    $dbs->p_image = $curlfirst;
   }
   else{
    $dbs->p_image = $cgimg;
   }
   $dbs->p_image_first = $firstgallery;
   $dbs->p_image_second = $secondgallery;
   $dbs->p_image_third = $lastthirdgallery;
   $dbs->category_id = $req->input('category_id');
   $dbs->p_price = $req->input('p_price');
   $dbs->r_price = $req->input('r_price');
   if($req->input('sizes')){
   $dbs->sizes = $req->input('sizes');
   }
   $slug = $req->input('slug');
   $dbs->slug = $slug;
   $result = $dbs->save();
   return true;
 }
 else{
   return False;
  }
 }
 else{
   return redirect('admin');
 }
}

function Deleteproduct($id){
  if(Cookie::has('pswd')){
  $dbs = Product::find($id);
  if($dbs){
  $dbs->delete();
  return true;
  }
}
else{
  return redirect('admin');
}
}

function allorders(){
  if(Cookie::has('pswd')){
        $orders = DB::table('orders')
        ->select('orders.orderid as orderid', 'customers.username as username', 'orders.amount', 'orders.status', 'orders.created_at')
        ->join('customers', 'orders.userid', '=', 'customers.id')
        ->orderBy('orders.created_at', 'desc')
        ->get();

        return view('admin.orders.all-orders',['orders'=>$orders]);
  }
  else{
    return redirect('admin');
  }
}

function singleorder($id){
  if(Cookie::has('pswd'))
  {
    $orderid = Order::where('orderid', $id)->get();
    $pageseo = PageSeo::where('slug', 'login')->get();
    $homepageseo = PageSeo::where('slug', 'login')->get();
    $gseo = GlobalSeo::find(1);
    return view('admin.orders.vieworder',['pageseo'=>$pageseo,'gseo'=>$gseo,'homepageseo'=>$homepageseo, 'orders'=>$orderid]);
  }
  else{
    return redirect('admin');
  }
}

function updatesingleorder(Request $req){
  if(Cookie::has('pswd'))
  {
    $order = Order::where('orderid', $req->userid)->first();
    if ($order) {
        $order->status = $req->input('status');
        $order->save();
        return true;
    } else {
        return false; 
    }
  }
  else{
    return redirect('admin');
  }

}

function Deleteorders($id){
  if(Cookie::has('pswd')){
      $order = Order::where('orderid', $id)->first();
      if($order){
        $order->delete();
        return true;
      }
  } 
  else{
    return redirect('admin');
  }
}

function allcustomers(){
  if(Cookie::has('pswd')){
    $customers = customer::all();
    return view('admin.orders.all-customers',['customers'=>$customers]);
}
else{
return redirect('admin');
}
}

function DeleteCustomer($id){
  if(Cookie::has('pswd')){
    $order = customer::where('id', $id)->first();
    if($order){
      $order->delete();
      return true;
    }
} 

else{
  return redirect('admin');
}
}

function DeleteContact($id){
  if(Cookie::has('pswd')){
    $order = Contact::where('id', $id)->first();
    if($order){
      $order->delete();
      return true;
    }
} 

else{
  return redirect('admin');
}
}

}