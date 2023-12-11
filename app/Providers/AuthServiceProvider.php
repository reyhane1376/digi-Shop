<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Content\Post;
use App\Policies\PostPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-post', function(User $user, Post $post) {
        //     return $user->id === $post->author_id;
        // });
        Gate::define('update-post', [PostPolicy::class, 'update']);

    }
}
