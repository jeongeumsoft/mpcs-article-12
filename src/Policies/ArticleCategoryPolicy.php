<?php

namespace Exit11\Article\Policies;

use Mpcs\Core\Models\User;
use Exit11\Article\Models\ArticleCategory as Model;
use Illuminate\Auth\Access\HandlesAuthorization;
use Mpcs\Core\Facades\Core;

class ArticleCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Policy 필터
     * @param  {object} $user user
     * @param  {string} $ability ability
     * @return {boolean} true(모든 권한 허용), false(모든 권한 허용안함), null(policy 권한 확인 진행)
     * @lastmodifiedDate 2020.02.13
     * @issue [[#redmine_issue_id]]
     */
    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any temps.
     *
     * @param  \Mpcs\Core\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // 
    }

    /**
     * Determine whether the user can view the temp.
     *
     * @param  \Mpcs\Core\Models\User  $user
     * @param  \App\Temp  $temp
     * @return mixed
     */
    public function view(User $user, Model $model)
    {
        //
    }

    /**
     * Determine whether the user can create temps.
     *
     * @param  \Mpcs\Core\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $isAllow = $user->cans(['article.categories.create']);
        return Core::responsePolicy($isAllow);
    }

    /**
     * Determine whether the user can update the temp.
     *
     * @param  \Mpcs\Core\Models\User  $user
     * @param  \App\Temp  $temp
     * @return mixed
     */
    public function update(User $user, Model $model)
    {
        $isAllow = $user->cans(['article.categories.update']);
        return Core::responsePolicy($isAllow);
    }

    /**
     * Determine whether the user can delete the temp.
     *
     * @param  \Mpcs\Core\Models\User  $user
     * @param  \App\Temp  $temp
     * @return mixed
     */
    public function delete(User $user, Model $model)
    {
        $isAllow = $user->cans(['article.categories.deleted']);
        return Core::responsePolicy($isAllow);
    }

    /**
     * Determine whether the user can permanently delete the temp.
     *
     * @param  \Mpcs\Core\Models\User  $user
     * @param  \App\Temp  $temp
     * @return mixed
     */
    public function forceDelete(User $user, Model $model)
    {
    }
}
