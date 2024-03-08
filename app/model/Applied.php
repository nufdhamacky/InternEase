<?php

class Applied extends Model {
    protected $table = 'applied';

    public function hasApplied($userId, $adId) {
        $result = $this->where('user_id', $userId)->where('ad_id', $adId);
        return !empty($result);
    }
}