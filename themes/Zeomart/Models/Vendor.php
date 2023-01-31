<?php

namespace Themes\Zeomart\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Modules\Review\Models\Review;

class Vendor extends \Modules\Vendor\Models\Vendor
{

    public function title(): Attribute
    {
        return Attribute::make(get: function () {
                return $this->display_name;
            });
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getReviewEnable()
    {
        return setting_item("zeomart_vendor_enable_review", 1);
    }

    public function getReviewApproved()
    {
        return setting_item("zeomart_vendor_review_approved", 1);
    }

    public function getReviewNumberPerPage()
    {
        return setting_item("zeomart_vendor_review_number_per_page", 5);
    }

    public static function getReviewStats()
    {
        return [];
    }

    public function review_list()
    {
        return $this->hasMany(Review::class, 'object_id')->where('object_model', $this->type)->where("status", "approved");
    }

    public function getScoreReview()
    {
        $product_id = $this->id;
        $list_score = Cache::rememberForever('review_' . $this->type . '_' . $product_id, function () use ($product_id) {
            $dataReview = Review::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $product_id)->where('object_model', $this->type)->where("status", "approved")->first();
            $score_total = !empty($dataReview->score_total) ? number_format($dataReview->score_total, 1) : 0;
            return ['score_total' => $score_total, 'total_review' => !empty($dataReview->total_review) ? $dataReview->total_review : 0, 'review_text' => $score_total ? Review::getDisplayTextScoreByLever(round($score_total)) : __("Not rate"),];
        });

        return $list_score;
    }

}
