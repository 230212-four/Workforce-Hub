<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'department',
        'role',
        'is_active',
        'preferences',
        'workspace_id',
        'team_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'preferences' => 'array',
        ];
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function createdWorkspaces()
    {
        return $this->hasMany(Workspace::class, 'created_by_user_id');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by_user_id');
    }

    public function assignedTasks()
    {
        return $this->belongsToMany(Task::class, 'task_assignees')->withTimestamps();
    }

    public function notifications()
    {
        return $this->hasMany(SystemNotification::class);
    }
}
