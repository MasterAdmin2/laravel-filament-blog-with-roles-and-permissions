<?php

    namespace App\Policies;

    use App\Models\Category;
    use App\Models\User;

    class CategoryPolicy
    {
        /**
         * Determine whether the user can view any models.
         */
        public function viewAny(User $user): bool
        {
            if ($user->hasPermissionTo('category view')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can view the model.
         */
        public function view(User $user, Category $category): bool
        {
            if ($user->hasPermissionTo('category view')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can create models.
         */
        public function create(User $user): bool
        {
            if ($user->hasPermissionTo('category create')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can update the model.
         */
        public function update(User $user, Category $category): bool
        {
            if ($user->hasPermissionTo('category update')) {
                return true;
            }
            return false;
        }

        /**
         * Determine whether the user can delete the model.
         */
        public function delete(User $user, Category $category): bool
        {
            if ($user->hasPermissionTo('category delete')) {
                return true;
            }
            return false;
        }
    }
