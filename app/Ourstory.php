<?php

namespace App;

//use App\Scopes\OurstoryScope;
use Illuminate\Database\Eloquent\Model;

class Ourstory extends Model
{
    protected $fillable = [
        'about',
        'about_bn',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    // protected static function booted()
    // {
    //     static::addGlobalScope(new OurstoryScope);
    // }

    public function isStoryCreated() {
        $isStoryCreated = $this->first();
        if ($isStoryCreated) {
            return true;
        }
        return false;
    }
}
