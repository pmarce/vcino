<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
    public function typeProperty()
    {
        return $this->belongsTo('App\TypeProperty');
    }
	
    public function situacionHabitacionals()
    {
        return $this->belongsTo('App\ModelsSupport\SituacionHabitacional','situacion_habitacionals_id');
    }
	
	public function internetservice()
    {
        return $this->belongsTo('App\ModelsSupport\Internetservice');
    }
	
	public function waterservice()
    {
        return $this->belongsTo('App\ModelsSupport\Waterservice');
    }
	
	public function tvservice()
    {
        return $this->belongsTo('App\ModelsSupport\Tvservice');
    }
	
	public function phoneservice()
    {
        return $this->belongsTo('App\ModelsSupport\PhoneService');
    }
	
	public function electricservice()
    {
        return $this->belongsTo('App\ModelsSupport\Electricservice');
	}
    
    public function contact()
    {
        return $this->hasMany('App\Contact','property_id');
    }
	
	public function accountsreceivable()
    {
        return $this->hasMany('App\Accountsreceivable');
    }
	
	public function sendalertpayments()
	{
		return $this->hasMany('App\Sendalertpayments');
	}
	
	public function collections()
    {
        return $this->hasMany('App\Collection');
    }
	
	public function taskrequest()
    {
        return $this->hasMany('App\TaskRequest');
    }
	
	public function taskreservation()
    {
        return $this->hasMany('App\TaskReservation');
    }
	
	public function usermobile()
    {
        return $this->belongsTo('App\UserMobile');
    }
}
