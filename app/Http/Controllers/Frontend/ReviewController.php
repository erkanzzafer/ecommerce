<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\ProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ImageUploadTrait;
 
   public function index(ProductReviewDataTable $dataTable){

        return $dataTable->render("frontend.dashboard.review.index");
   }

    public function create(Request $request)
    {

        $checkReviewExist = ProductReview::where(["product_id" => $request->product_id,'user_id' => auth()->user()->id])->first();
        if(!empty($checkReviewExist)){
            toastr('Bildirim kaydedilmiş', 'error', 'Bilgi');
            return redirect()->back();
        }

        $request->validate([
            'rating'  => 'required',
            'review'  => 'required|max:200',
            'image.*' => 'image'
        ]);

        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads');

        $productReview = new ProductReview();
        $productReview->product_id = $request->product_id;
        $productReview->vendor_id = $request->vendor_id;
        $productReview->user_id = auth()->user()->id;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->status = 0;
        $productReview->save();

        if (!empty($imagePaths)) {
            foreach ($imagePaths as $path) {
                $reviewGallery = new ProductReviewGallery();
                $reviewGallery->product_review_id = $productReview->id;
                $reviewGallery->image = $path;
                $reviewGallery->save();
            }
        }
        toastr('Bildirim başarıyla gönderildi', 'success', 'Başarılı');
        return redirect()->back();
    }


}
