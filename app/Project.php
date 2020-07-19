<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tests\Feature\ActivityFredTest;

class Project extends Model
{

    protected  $guarded = [];
    public function path(){
        return "/projects/{$this->id}";
    }
    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){
    return $this->hasMany(Task::class);
    }
    /**
    *Add task to project
     *
     * @param  string $body
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));


    }
    public function recordActivity($description){
        $this->activity()->create(['description'=>$description]);

    }
    public function activity(){
        return   $this->hasMany(Activity::class)->latest();
    }
}
