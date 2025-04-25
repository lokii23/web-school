<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'teacher_id'];

    // Relationship to teacher (user)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }
}
