<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $fillable = ['title', 'description', 'price', 'payment_status'];

    //checking if paid
    public function getPaidAttribute() {
    	if ($this->payment_status == 'Invalid') {
    		return false;
    	}
    	return true;
    }
}
