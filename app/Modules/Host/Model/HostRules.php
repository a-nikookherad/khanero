<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Rules\Model\Rule;

class HostRules extends Model
{
    protected $table = 'host_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['host_id', 'rule_id'];

    public function getRules() {
        return $this->hasOne(Rule::class, 'id', 'rule_id');
    }

}
