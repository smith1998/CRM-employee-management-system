<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasAdvancedFilter;
    use SoftDeletes;
    use HasFactory;

    public $table = 'employees';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'first_name',
        'last_name',
        'company.name',
        'email_address',
        'phone_number',
    ];

    protected $filterable = [
        'id',
        'first_name',
        'last_name',
        'company.name',
        'email_address',
        'phone_number',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email_address',
        'phone_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
