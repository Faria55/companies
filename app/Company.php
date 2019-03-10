<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'logo', 'website', 'company_id',
    ];


    /**
     * Get the employees that belong to company.
     */
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}
