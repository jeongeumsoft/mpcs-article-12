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
