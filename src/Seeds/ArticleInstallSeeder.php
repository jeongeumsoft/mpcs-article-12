<?php

namespace Exit11\Article\Seeds;

use Illuminate\Database\Seeder;

use Mpcs\Core\Models\Permission;

class ArticleInstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 권한 생성
        Permission::insertOrIgnore([
            [
                'name'        => 'Article-manage',
                'slug'        => 'article.manage',
                'description' => 'Article 관리',
                'is_visible'  => 1,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s"),
            ],
            [
                'name'        => 'Article-List',
                'slug'        => 'article.list',
                'description' => 'Article 목록',
                'is_visible'  => 1,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s"),
            ],
            [
                'name'        => 'Article-View',
                'slug'        => 'article.view',
                'description' => 'Article 보기',
                'is_visible'  => 1,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s"),
            ],
            [
                'name'        => 'Article-Edit',
                'slug'        => 'article.edit',
                'description' => 'Article 편집',
                'is_visible'  => 1,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s"),
            ],
            [
                'name'        => 'Article-Create',
                'slug'        => 'article.create',
                'description' => 'Article 생성',
                'is_visible'  => 1,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s"),
            ],
            [
                'name'        => 'Article-delete',
                'slug'        => 'article.delete',
                'description' => 'Article 삭제',
                'is_visible'  => 1,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
