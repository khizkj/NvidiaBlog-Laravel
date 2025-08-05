<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class Blogpolicy
{
   public function edit(User $user, Blog $blog){
    return $blog->user_id === $user->id;
   }
}
