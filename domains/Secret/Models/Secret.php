<?php

namespace Domains\Secret\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'secrets';

    protected $fillable = [
        'project',
        'service',
        'link',
        'username',
        'password',
        'is_active',
        'additional_information',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'secret_user');
    }
}
