<?php

namespace App\Repositories\Concretes\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Traits\EloquentCrudTrait;

class UserEloquent implements BaseRepositoryInterface, UserInterface
{

    use EloquentCrudTrait;
    protected $model;

    /**
     * @param $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getReferralLink($code): string
    {
        return route('register', ['ref' => $code]);
    }

    public function getReferralsUserByReferrerId($referrerId) {
        return $this->model->where('referrer_id' , $referrerId)->select('name' , 'email' , 'phone')->get();
    }

}
