<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'short_description',
        'content',
        'thumbnail',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('created_at');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withTimestamps();
    }
     public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return Storage::url($this->thumbnail);
        }
        return 'https://via.placeholder.com/400x300?text=No+Image';
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($course) {
            // Delete thumbnail when course is deleted
            if ($course->thumbnail) {
                Storage::delete($course->thumbnail);
            }
        });
    }
}
