<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Bookmark;
use App\Models\Course;
use App\Models\Enrollment;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courses
 * @method \Illuminate\Database\Eloquent\Relations\HasMany courses()
 * @method bool isInstructor()
 * @method bool isStudent()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }
    
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }
    
    public function isInstructor()
    {
        return $this->role === 'instructor';
    }
    
    public function isStudent()
    {
        return $this->role === 'student';
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    public function bookmarkedCourses()
    {
        return $this->belongsToMany(Course::class, 'bookmarks')->withTimestamps();
    }
}