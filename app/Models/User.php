<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'usertype', 
        'bio', 
        'avatar',
        'is_active'  // ← Ajout de is_active
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',  // ← Ajout du cast pour is_active
        ];
    }

    // Relation: un user a plusieurs posts ✅
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')
                    ->withTimestamps();
    }

    public function hasFavorite($postId)
    {
        return $this->favorites()->where('post_id', $postId)->exists();
    }

    // ═══════════════════════════════════════════════════════════════
    // SCOPES pour filtrer les utilisateurs par statut
    // ═══════════════════════════════════════════════════════════════
    
    /**
     * Scope pour les utilisateurs actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour les utilisateurs inactifs
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope pour les auteurs (usertype = 'auteur')
     */
    public function scopeAuteurs($query)
    {
        return $query->where('usertype', 'auteur');
    }

    /**
     * Scope pour les admins
     */
    public function scopeAdmins($query)
    {
        return $query->where('usertype', 'admin');
    }

    // ═══════════════════════════════════════════════════════════════
    // MÉTHODES UTILES
    // ═══════════════════════════════════════════════════════════════
    
    /**
     * Vérifie si l'utilisateur est un administrateur
     */
    public function isAdmin()
    {
        return $this->usertype === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un auteur
     */
    public function isAuteur()
    {
        return $this->usertype === 'auteur';
    }

    /**
     * Vérifie si le compte est actif
     */
    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * Active le compte
     */
    public function activate()
    {
        $this->update(['is_active' => true]);
    }

    /**
     * Désactive le compte
     */
    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }

    /**
     * Récupère les articles approuvés de l'utilisateur
     */
    public function approvedPosts()
    {
        return $this->posts()->where('status', 'approved');
    }

    /**
     * Récupère les articles en attente de l'utilisateur
     */
    public function pendingPosts()
    {
        return $this->posts()->where('status', 'pending');
    }

    /**
     * Récupère les articles refusés de l'utilisateur
     */
    public function rejectedPosts()
    {
        return $this->posts()->where('status', 'rejected');
    }

    /**
     * Compte les articles publiés
     */
    public function getPublishedPostsCountAttribute()
    {
        return $this->posts()->where('status', 'approved')->count();
    }

    /**
     * Vérifie si l'utilisateur suit un autre utilisateur
     */
    public function isFollowing($userId)
    {
        return $this->following()->where('following_id', $userId)->exists();
    }

    /**
     * Vérifie si l'utilisateur est suivi par un autre utilisateur
     */
    public function isFollowedBy($userId)
    {
        return $this->followers()->where('follower_id', $userId)->exists();
    }
}