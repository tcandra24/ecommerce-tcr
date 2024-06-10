<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $appends = ['status_class'];

    protected $fillable = [
        'invoice',
        'customer_id',
        'weight',
        'name',
        'phone',
        'city_id',
        'province_id',
        'address',
        'status',
        'grand_total',
        'snap_token'
    ];

    public function getStatusClassAttribute()
    {
        return $this->getStatusClass($this->status);
    }

    /**
     * order
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * customer
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault();
    }

    /**
     * city
     *
     * @return void
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id')->withDefault();
    }

    /**
     * province
     *
     * @return void
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id')->withDefault();
    }

    private function getStatusClass($status)
    {
        switch ($status) {
            case 'failed':
                return 'failed';
                break;
            case 'expired':
                return 'cancelled';
                break;
            case 'success':
                return 'completed';
                break;
            case 'pending':
                return 'pending';
                break;
            default:
                return '';
                break;
        }
    }
}
