<?php

use App\Models\User\User;
use Illuminate\Database\Schema\Blueprint;
use LaravelSupports\Database\Migrations\AlterMigration;

return new class extends AlterMigration {

    public function getTable(): string
    {
        return 'cards';
    }

    protected function defaultUpTemplate(Blueprint $table): void
    {
        $table->foreignIdFor(User::class)->nullable()->change();
    }
};
