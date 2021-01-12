<?php

namespace App\Http\Controllers\Web\Main;

use App\Http\Controllers\Controller;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\AboutUs;
use App\Models\Advisors;
use App\Models\AdvisorsRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\ContactUs;
use App\Models\HomePage;
use App\Models\Image;
use App\Models\Page;
use App\Models\Settings;
use App\Models\Subject;
use App\Models\SubjectComments;
use App\Models\Transaction;
use App\User;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{

    public function index(Request $request)
    {
        $Users = User::get();

        $Blogs = Blog::get();
        if (Blog::count() >= 8) {
            $Blogs = Blog::all()->random(8);
        }


        $Advantages = json_decode(AboutUs::first()->advantages, true);
        if (!is_array($Advantages) && !is_object($Advantages)) {
            $Advantages = [];
        }


        $SelectedComments = Comment::where('publication', 'on')->get();

        $MainImage = Image::where('type', 'HomePage')->first();


        $Services = json_decode(HomePage::first()->services, true);
        if (!is_array($Services) && !is_object($Services)) {
            $Services = [];
        }


        $Guidences = json_decode(HomePage::first()->guidences, true);
        if (!is_array($Guidences) && !is_object($Guidences)) {
            $Guidences = [];
        }


        $Footer = json_decode(HomePage::first()->footer, true);
        if (!isset($Footer['trust'])) {
            $Footer['trust']['items'] = [];
        }

        if (!isset($Footer['social_media'])) {
            $Footer['social_media'] = [];
        }
        // dd($Footer);


        return view('Web.Main.home', compact(['Users', 'Advantages', 'Blogs', 'Services', 'Guidences', 'SelectedComments', 'MainImage', 'Footer']));
    }


    public function Pages($slug)
    {
        $page = Page::where(['slug' => $slug])->first();
        if ($page) {
            return view('Web.Page.index', ['page' => $page]);
        }
        return back();
    }

    public function Blogs($title = null)
    {
        $RandomBlogs = [];
        if (Blog::count() >= 3) {
            $RandomBlogs = Blog::all()->random(3);
        }
        $Blogs = null;
        if ($title) {
            $Blogs = Blog::where('categories', 'like', "%$title%")->get();
        } else {
            $Blogs = Blog::get();
        }
        return view('Web.Main.Blogs', compact(['Blogs', 'RandomBlogs']));
    }

    public function BlogSearch(Request $request)
    {
        $value = $request->value;
        $Blogs = Blog::where('title', 'like', "%$value%")->get();
        return view('Web.Main.Partial.BlogCard', compact('Blogs'))->render();
    }


    public function Blog($id)
    {
        $RandomBlogs = Blog::all()->random(4);
        $Blog = Blog::find($id);
        $SelectedCat = explode(',', $Blog->categories);
        $Keywords = explode(',', $Blog->keywords);
        return view('Web.Main.Blog', compact(['Blog', 'RandomBlogs', 'SelectedCat', 'Keywords']));
    }

    public function CategoryBlogs($title)
    {
        $Category = new Category();
        $CategoryBlogs = $Category->Blogs($title);
        $RandomBlogs = [];
        if (Blog::count() >= 3) {
            $RandomBlogs = Blog::all()->random(3);
        }
        return view('Web.Main.CategoryBlogs', compact(['CategoryBlogs', 'RandomBlogs', 'title']));
    }



    public function Category()
    {
        $Category = Category::get();
        return view('Web.Main.Category', compact('Category'));
    }




    public function PsychologyCategoryList()
    {
        return view('Web.Main.PsychologyCategoryList');
    }




    public function CategoryList($id)
    {
        $CurrentCategory = Category::find($id);
        $Subjects = $CurrentCategory->GetSubjects($CurrentCategory->title);
        $RandomSubjects = [];
        if ($Subjects->count() >= 3) {
            $RandomSubjects = $Subjects->random(3);
        }
        return view('Web.Main.CategoryList', compact(['CurrentCategory', 'Subjects', 'RandomSubjects']));
    }




    public function ConsultantList()
    {
        $advisor = Advisors::get();
        return view('Web.Main.ConsultantList', compact('advisor'));
    }

    public function ConsultantListSearch(Request $request)
    {
        $value = $request->value;
        $advisor = Advisors::where('name', 'like', "%$value%")->get();
        $Category = Category::where('title', 'like', $value)->get();

        if ($Category) {
            foreach ($Category as $v) {
                $advs = Advisors::where('category', $v->id)->get();
                if ($advs) {
                    foreach ($advs as $vv) {
                        $advisor[] = $vv;
                    }
                }
            }
        }

        return view('Web.Main.Partial.ConsultantListCard', compact('advisor'))->render();
    }




    // public function SingleDoctor()
    // {
    //     return view('Web.Main.SingleDoctor');
    // }




    public function SubjectOfCategory($CatId, $id)
    {
        $MainCat = Category::find($CatId);
        $CurrentSubject = Subject::find($id);
        $advisor = Advisors::where('category', $MainCat->id)->get();
        return view('Web.Main.SubjectOfCategory', compact(['CurrentSubject', 'MainCat', 'advisor']));
    }




    public function AddSubjectOfCategoryComment(Request $request, $id)
    {
        if ($request->text) {
            if (Auth::user()->id) {
                $UserId = Auth::user()->id;
            } else {
                $UserId = null;
            }
            SubjectComments::create(['user_id' => $UserId, 'subject_id' => $id, 'text' => $request->text]);
            FlashMessage::set('success', 'نظر شما با موفقیت ثبت و پس از تایید منتشر خواهد شد.');
            return back();
        }
        FlashMessage::set('warning', 'مشکلی پیش آمده است.');
        return back();
    }



    public function ProfileMoshaver(Request $request)
    {
        $advisor = Advisors::find($request->id);
        if ($advisor) {
            $education = json_decode($advisor->education);
            if (!is_array($education) && !is_object($education)) {
                $education = [];
            }



            $TimeOfOneCosultation = Settings::first()->time_default;
            if (($advisor->time_of_one_consultation)) {
                $TimeOfOneCosultatio =  $advisor->time_of_one_consultation;
            }
            $Consultations = json_decode($advisor->consultations_times, true);
            $ConsultationsTimes = [];
            if ($Consultations) {
                foreach ($Consultations as $key => $v) {
                    if (!isset($v['Sliced'])) {
                        $v['Sliced'] = [];
                    }
                    $ConsultationsTimes[$key] = $v['Sliced'];
                    ksort($v);
                }
            }
            if ($advisor->vip == '0') {
                if ($ConsultationsTimes) {
                    $ConsultationsTimes = ['online' => $ConsultationsTimes['online']];
                }
            }

            $ConsultationsTimes = view(
                'components.ListTimeReserve.List',
                [
                    'advisor' => $advisor,
                    'ConsultationsTimes' => $ConsultationsTimes,
                    'TimeOfOneCosultation' => $TimeOfOneCosultation
                ]
            )->render();
            return view('Web.Main.ProfileMoshaver', compact(['advisor', 'education', 'ConsultationsTimes', 'TimeOfOneCosultation']));
        } else {
            return back();
        }
    }




    public function Info()
    {
        $AboutUs = AboutUs::first();
        $Advantages = json_decode(AboutUs::first()->advantages, true);
        if (!is_array($Advantages) && !is_object($Advantages)) {
            $Advantages = [];
        }
        $Image = Image::where('type', 'AboutUs')->first();
        return view('Web.Main.About', compact(['AboutUs', 'Image', 'Advantages']));
    }




    public function ContactUs()
    {
        $ContactUs = ContactUs::first();
        return view('Web.Main.ContactUs', compact('ContactUs'));
    }




    public function Assist()
    {
        return view('Web.Main.Assist');
    }




    public function AdvisorRequest()
    {
        return view('Web.Main.AdvisorRequest');
    }




    public function AdvisorRequestPost(Request $request)
    {
        $result = AdvisorsRequest::create((['advisor_form'=> null]));
        $data = $request->all();
        // ImageUploader::upload($request->image, 'Blogs/');
        /**
         * @var Symfony\Component\HttpFoundation\File\UploadedFile
         */
        // dd($request->file('resume'))
        if ($data['resume']) {
            if(is_array($data['resume'])){
                foreach ($data['resume'] as $key => $image) {
                    $data['resume'][$key] = ImageUploader::upload($image, 'AdvisorsRequest/'. $result->id);
                }
            } else{
                ImageUploader::upload($data['resume'], 'AdvisorsRequest/' . $result->id);
            }
        }
        if ($data['madrak_tahsili']) {
            if (is_array($data['madrak_tahsili'])) {
                foreach ($data['madrak_tahsili'] as $key => $image) {
                    $data['madrak_tahsili'][$key] = ImageUploader::upload($image, 'AdvisorsRequest/'. $result->id);
                }
            } else{
                ImageUploader::upload($data['madrak_tahsili'], 'AdvisorsRequest/' . $result->id);
            }
        }
        if ($data['parvane_eshteghal']) {
            if (is_array($data['parvane_eshteghal'])) {
                foreach ($data['parvane_eshteghal'] as $key => $image) {
                    $data['parvane_eshteghal'][$key] = ImageUploader::upload($image, 'AdvisorsRequest/'. $result->id);
                }
            } else{
                ImageUploader::upload($data['parvane_eshteghal'], 'AdvisorsRequest/' . $result->id);
            }
        }
        if ($data['aks']) {
            if (is_array($data['aks'])) {
                foreach ($data['aks'] as $key => $image) {
                    $data['aks'][$key] = ImageUploader::upload($image, 'AdvisorsRequest/' . $result->id);
                }
            } else{
                ImageUploader::upload($data['aks'], 'AdvisorsRequest/' . $result->id);
            }
        }

        $data = json_encode($data , true);
        $result1 = $result->update(['advisor_form' => $data]);
       
        if ($result1) {
            FlashMessage::set('success', 'درخواست با موفقیت ثبت شد.');
        } else{
            File::deleteDirectory(public_path('uploads/AdvisorsRequest'));
            AdvisorsRequest::find($result->id)->delete();
            FlashMessage::set('error', 'مشکلی پیش آمده است.');
        }
        return redirect()->back();
    }




    public function Anonymous()
    {
        $settings = Settings::first();
        if ($settings->type_signUp_users == 'on') {
            return view('Web.Anonymous.Login');
        } else {
            return back();
        }
    }

    public function Checkout($id, $type, $date = null, $key = null)
    {
        if (Auth::guard('web')->user()) {
            return view('Web.Main.Checkout', ['type' => $type, 'id' => $id, 'date' => $date, 'key' => $key]);
        } else {
            return redirect(route('Web.auth.Login', ['advisor' => $id]));
        }
    }
}
