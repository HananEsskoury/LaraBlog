<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';
    
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip',
        'user_agent',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    // Mapping des sujets pour l'affichage
    public function getSubjectLabelAttribute()
    {
        $subjects = [
            'question'      => 'Question générale',
            'collaboration' => 'Collaboration / Partenariat',
            'author'        => 'Devenir auteur',
            'bug'           => 'Signalement technique',
            'other'         => 'Autre',
        ];
        
        return $subjects[$this->subject] ?? $this->subject;
    }

    // Scope pour les messages non lus
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope pour les messages lus
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }
}