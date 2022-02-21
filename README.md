# Mpcs Core Extention : Article

## Composer Repository 추가

```
### composer-dev.json
{
    "require": {
        "exit11/article": "dev-develop"
    },

    "repositories": [
        {
            "name": "exit11/article",
            "type": "path",
            "url": "packages/exit11/article"
        }
    ]

}


### composer.json

    "repositories": [
        {
            "name": "exit11/article",
            "type": "vcs",
            "url": "git@github.com:exit11/mpcs-article.git"
        }
    ]

```

## install

```

### 패키지 개발 설치시

git clone https://github.com/exit11/mpcs-article.git .\packages\exit11\article
env COMPOSER=composer-dev.json composer require exit11/article --dev

### 프로젝트 설치시

composer require exit11/article

### 설치 후 실행
php .\artisan mpcs-article:install
php .\artisan config:cache
php .\artisan migrate

```

## seed

```
php .\artisan mpcs-article:seed

```

## config > filesystem.php 에 upload 폴더 추가

```
    'upload' => [
        'driver' => 'local',
        'root' => storage_path('app/public/uploads'),
        'url' => env('APP_URL') . '/storage/uploads',
        'visibility' => 'public',
    ],

```
