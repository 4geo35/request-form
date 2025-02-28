<?php

namespace GIS\RequestForm\Models;

use GIS\RequestForm\Interfaces\CallRequestRecordModelInterface;
use GIS\RequestForm\Traits\ShouldRequestForm;
use Illuminate\Database\Eloquent\Model;

class CallRequestRecord extends Model implements CallRequestRecordModelInterface
{
    use ShouldRequestForm;

    protected $fillable = [
        "name",
        "phone",
    ];
}
