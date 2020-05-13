<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    protected $table = 'report_types';
    protected $fillable = [
    	"id",
    	"name",
        "slug",
        "description",
    ];

    public function reports() {
        return $this->hasMany('App\Models\Report');
    }
    public function getTotalReportsAttribute(){
    	return $this->reports()->count();
    }
}
