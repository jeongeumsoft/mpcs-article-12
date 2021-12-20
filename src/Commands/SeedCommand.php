<?php

namespace Exit11\Article\Commands;

use Illuminate\Console\Command;

class SeedCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpcs-article:seed';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $confirmMessage = 'Article DB가 초기화되어, 유실될 수 있습니다. 설치를 계속 진행하시겠습니까?';
        $confirmMessage .= PHP_EOL . '(리소스는 덮어쓰기 됩니다.)';

        if (!app()->environment(['production'])) {
            if ($this->confirm($confirmMessage)) {
                $this->call('db:seed', ['--class' => "Exit11\Article\Seeds\ArticleTableSeeder"]);
                $this->call('db:seed', ['--class' => "Exit11\Article\Seeds\PopupTableSeeder"]);
            }
        } else {
            $this->error('운영환경에서는 실행할 수 없습니다.');
            exit();
        }
    }
}
