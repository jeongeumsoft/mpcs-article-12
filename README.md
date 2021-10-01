# Mpcs Core Extention : Article

## config > mpcs.php 에 vendor 추가

```
    // 디폴트: App
    'model_vendors' => [
        'Mpcs\Core' => [
            'User', 'Config', 'Permission', 'Role', 'OperationLog', 'AccessibleIp'
        ],
        ## 아래 내용 추가
        'Exit11\Article' => [
            'Article', 'ArticleCategory'
        ],
    ],
```

## config > filesystem.php 에 upload, temp 폴더 추가

```
    'upload' => [
                'driver' => 'local',
                'root' => storage_path('app/public/uploads'),
                'url' => env('APP_URL') . '/storage/uploads',
                'visibility' => 'public',
            ],

    'temp' => [
        'driver' => 'local',
        'root' => storage_path('app/temps'),
        'visibility' => 'public',
    ],
```
