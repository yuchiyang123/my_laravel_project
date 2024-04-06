<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ConvertPasswordsToHash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passwords:convert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert all passwords in the database to hash';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 检索所有用户记录
        $users = User::all();

        // 遍历每个用户记录并更新密码为哈希值
        foreach ($users as $user) {
            // 检查密码是否已经是哈希值
            if (!Hash::needsRehash($user->password)) {
                continue; // 如果密码已经是哈希值，则跳过
            }

            // 将密码字段更新为哈希值
            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('All passwords have been converted to hash.');

        return 0;
    }
}
