# Mpcs Core Extention : Article

## Composer Repository 추가

```
### composer-dev.json
{
    "require": {
        "mpcs/article": "dev-develop"
    },

    "repositories": [
        {
            "name": "mpcs/article",
            "type": "path",
            "url": "packages/mpcs/article"
        }
    ]

}


### composer.json

    "repositories": [
        {
            "name": "mpcs/article",
            "type": "vcs",
            "url": "git@github.com:mpcs/mpcs-article.git"
        }
    ]

```

## install

```

### 패키지 개발 설치시

git clone https://github.com/mpcs/mpcs-article.git .\packages\mpcs\article
env COMPOSER=composer-dev.json composer require mpcs/article --dev

### 프로젝트 설치시

composer require mpcs/article

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
