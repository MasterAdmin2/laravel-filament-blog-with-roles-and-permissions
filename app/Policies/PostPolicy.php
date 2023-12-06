<?php

    namespace App\Policies;

    use App\Models\Post;
    use App\Models\User;

    class PostPolicy
    {
        /**
         * Determine whether the user can view any models.
         */
        public function viewAny(User $user)
        {
            if ($user->hasPermissionTo('post view')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can view the model.
         */
        public function view(User $user, Post $post)
        {
            if ($user->hasPermissionTo('post view')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can create models.
         */
        public function create(User $user)
        {
            if ($user->hasPermissionTo('post view')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can update the model.
         */
        public function update(User $user, Post $post)
        {
            if ($user->hasPermissionTo('post view')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can delete the model.
         */
        public function delete(User $user, Post $post)
        {
            if ($user->hasPermissionTo('post view')) {
                return true;
            }
            return false;
        }
    }
