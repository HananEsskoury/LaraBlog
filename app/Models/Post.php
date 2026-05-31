<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'status',        
        'slug',
        'vues',
        'user_id',
        'categorie_id',  
        'reviewed_by',   
        'reviewed_at',   
        'rejection_reason', 
    ];

     public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

     public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Relation: post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation: post belongs to a category
    public function categorie()
    {
        return $this->belongsTo(Categorie::class); 
    }

    // Relation: post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reactions()
{
    return $this->hasMany(Reaction::class);
}
public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')
                ->withTimestamps();
}

}