<?php


class Ads extends Model{


    protected $table = 'ads';

    public function fetchAds(){
        return $this->findall();
    }

    public function fetchAdsWithStatus($userId) {
        $ads = $this->findall();

        foreach ($ads as &$ad) {
            $appliedModel = new Applied();
            $wishlistModel = new Wishlist();

            $ad['applied'] = $appliedModel->hasApplied($userId, $ad['id']);
            $ad['wishlist'] = $wishlistModel->isInWishlist($userId, $ad['id']);
        }

        return $ads;
    }
}