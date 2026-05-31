@extends('layouts.app')

@section('title', 'Contact — LaraBlog')

@push('styles')
<style>
    .contact-hero {
        position: relative;
        min-height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }
    .contact-hero-bg { position: absolute; inset: 0; z-index: 0; }
    .contact-hero-bg img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
    .contact-hero-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(30,20,12,.65) 0%, rgba(30,20,12,.82) 100%);
    }
    .contact-hero-content {
        position: relative;
        z-index: 2;
        padding: 80px 32px;
        max-width: 800px;
        margin: 0 auto;
    }
    .contact-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(192,98,58,.18);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(192,98,58,.45);
        color: #f0a080;
        font-family: var(--sans);
        font-size: .7rem;
        letter-spacing: .22em;
        text-transform: uppercase;
        padding: 6px 20px;
        border-radius: 100px;
        margin-bottom: 28px;
    }
    .contact-hero-title {
        font-family: var(--serif);
        font-size: clamp(2.6rem, 6vw, 4.2rem);
        font-weight: 400;
        color: #fff;
        margin-bottom: 16px;
        line-height: 1.1;
    }
    .contact-hero-title em { color: #f0d4c4; font-style: italic; }
    .contact-hero-desc {
        font-family: var(--sans);
        font-size: .95rem;
        font-weight: 300;
        color: rgba(255,255,255,.68);
        max-width: 560px;
        margin: 0 auto;
        line-height: 1.85;
    }
    .breadcrumb {
        padding: 22px 0 14px;
        font-family: var(--sans);
        font-size: .72rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
    }
    .breadcrumb a { color: var(--muted); transition: color .2s; }
    .breadcrumb a:hover { color: var(--terracotta); }
    .breadcrumb span { color: var(--terracotta); }
    .breadcrumb i { font-size: 7px; margin: 0 8px; vertical-align: 1px; }
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 64px;
        margin: 56px 0 72px;
        align-items: start;
    }
    .contact-info-title {
        font-family: var(--serif);
        font-size: 2rem;
        font-weight: 400;
        color: var(--ink);
        margin-bottom: 14px;
        line-height: 1.2;
    }
    .contact-info-title em { color: var(--terracotta); font-style: italic; }
    .contact-info-lead {
        font-family: var(--sans);
        font-size: .88rem;
        color: var(--muted);
        line-height: 1.8;
        margin-bottom: 36px;
    }
    .info-cards { display: flex; flex-direction: column; gap: 18px; margin-bottom: 40px; }
    .info-card {
        display: flex;
        align-items: flex-start;
        gap: 18px;
        padding: 20px 22px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 8px;
        transition: transform .25s, box-shadow .25s, border-color .25s;
    }
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 32px rgba(42,32,24,.08);
        border-color: #f0d4c4;
    }
    .info-icon {
        width: 46px;
        height: 46px;
        background: var(--warm-off);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--terracotta);
        font-size: 1.15rem;
        flex-shrink: 0;
    }
    .info-content h3 {
        font-family: var(--serif);
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--ink);
    }
    .info-content p {
        font-family: var(--sans);
        font-size: .83rem;
        font-weight: 300;
        color: var(--muted);
        line-height: 1.65;
    }
    .info-content a { color: var(--terracotta); transition: color .2s; }
    .info-content a:hover { color: var(--terra-dark); text-decoration: underline; }
    .info-sub { font-size: .75rem !important; margin-top: 3px; }
    .social-contact { padding-top: 20px; border-top: 1px solid var(--border); }
    .social-contact h3 {
        font-family: var(--serif);
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 14px;
        color: var(--ink);
    }
    .social-icons { display: flex; gap: 12px; }
    .social-icons a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--warm-off);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: .95rem;
        transition: all .22s;
    }
    .social-icons a:hover {
        background: var(--terracotta);
        border-color: var(--terracotta);
        color: #fff;
        transform: translateY(-2px);
    }
    .contact-form-wrapper {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 38px 40px;
        box-shadow: 0 4px 24px rgba(42,32,24,.05);
    }
    .form-title {
        font-family: var(--serif);
        font-size: 1.75rem;
        font-weight: 400;
        color: var(--ink);
        margin-bottom: 10px;
    }
    .form-title em { color: var(--terracotta); font-style: italic; }
    .form-subtitle {
        font-family: var(--sans);
        font-size: .83rem;
        font-weight: 300;
        color: var(--muted);
        margin-bottom: 28px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--border);
    }
    .alert-success {
        background: #edf7f2;
        color: #3d8b5e;
        border: 1px solid rgba(61,139,94,.25);
        border-radius: 8px;
        padding: 13px 18px;
        margin-bottom: 22px;
        font-family: var(--sans);
        font-size: .85rem;
        font-weight: 400;
    }
    .alert-error {
        background: #fdf0f0;
        color: #b83a3a;
        border: 1px solid rgba(184,58,58,.2);
        border-radius: 8px;
        padding: 13px 18px;
        margin-bottom: 22px;
        font-family: var(--sans);
        font-size: .85rem;
        font-weight: 400;
    }
    .field-error {
        font-family: var(--sans);
        color: #b83a3a;
        font-size: .72rem;
        margin-top: 5px;
        display: block;
    }
    .form-group { margin-bottom: 22px; }
    .form-group label {
        display: block;
        font-family: var(--sans);
        font-size: .68rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        font-weight: 500;
        color: var(--muted);
        margin-bottom: 7px;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 11px 15px;
        border: 1.5px solid var(--border);
        border-radius: 7px;
        font-size: .9rem;
        font-family: var(--sans);
        font-weight: 300;
        background: var(--cream);
        color: var(--ink);
        transition: border-color .2s, background .2s;
        outline: none;
        appearance: none;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--terracotta);
        background: #fff;
    }
    .form-group textarea { resize: vertical; min-height: 130px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px 28px;
        background: var(--terracotta);
        color: #fff;
        border: none;
        border-radius: 6px;
        font-family: var(--sans);
        font-size: .75rem;
        font-weight: 500;
        letter-spacing: .18em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background .25s, transform .2s;
        margin-top: 8px;
    }
    .btn-submit:hover { background: var(--terra-dark); transform: translateY(-2px); }
    .map-section { margin: 0 0 64px; }
    .map-section-header {
        display: flex;
        align-items: baseline;
        gap: 20px;
        margin-bottom: 28px;
    }
    .map-section-title {
        font-family: var(--serif);
        font-size: 2rem;
        font-weight: 400;
        color: var(--ink);
        white-space: nowrap;
    }
    .map-section-line { flex: 1; height: 1px; background: var(--border); margin-bottom: 4px; }
    .map-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border);
        height: 320px;
    }
    .map-container iframe {
        width: 100%;
        height: 100%;
        filter: grayscale(.15) contrast(1.05);
        display: block;
    }
    .faq-section {
        padding: 64px 0;
        border-top: 1px solid var(--border);
        margin-bottom: 48px;
    }
    .faq-section-header {
        display: flex;
        align-items: baseline;
        gap: 20px;
        margin-bottom: 40px;
    }
    .faq-section-title {
        font-family: var(--serif);
        font-size: 2rem;
        font-weight: 400;
        color: var(--ink);
        white-space: nowrap;
    }
    .faq-section-line { flex: 1; height: 1px; background: var(--border); margin-bottom: 4px; }
    .faq-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 28px;
    }
    .faq-item {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 26px 28px;
        transition: transform .25s, box-shadow .25s;
    }
    .faq-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(42,32,24,.07);
    }
    .faq-item h3 {
        font-family: var(--serif);
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--ink);
    }
    .faq-item p {
        font-family: var(--sans);
        font-size: .83rem;
        font-weight: 300;
        color: var(--muted);
        line-height: 1.75;
    }
    .ct-container {
        max-width: 1160px;
        margin: 0 auto;
        padding: 0 32px;
    }
    @media (max-width: 900px) { .contact-grid { grid-template-columns: 1fr; gap: 44px; } }
    @media (max-width: 640px) {
        .ct-container { padding: 0 20px; }
        .contact-form-wrapper { padding: 24px 20px; }
        .form-row { grid-template-columns: 1fr; gap: 0; }
        .contact-hero { min-height: 380px; }
        .contact-hero-title { font-size: 2.4rem; }
        .faq-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<section class="contact-hero">
    <div class="contact-hero-bg">
        <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=1600&q=80" alt="Contact">
    </div>
    <div class="contact-hero-content">
        <div class="contact-hero-badge">
            <i class="fas fa-envelope"></i> Contactez-nous
        </div>
        <h1 class="contact-hero-title">
            Parlons<br><em>ensemble</em>
        </h1>
        <p class="contact-hero-desc">
            Une question, une collaboration, ou simplement un bonjour — nous serions ravis d'avoir de vos nouvelles.
        </p>
    </div>
</section>

<div class="ct-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right"></i>
        <span>Contact</span>
    </div>

    <div class="contact-grid">
        <div>
            <h2 class="contact-info-title">Entrons en <em>contact</em></h2>
            <p class="contact-info-lead">
                Nous répondons à tous les messages dans les 24 à 48 heures ouvrées. Que vous soyez auteur, lecteur ou partenaire, nous sommes à votre écoute.
            </p>
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="info-content">
                        <h3>Notre adresse</h3>
                        <p>123 Rue des Écrivains, 75001 Paris, France</p>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p><a href="mailto:contact@larablog.com">contact@larablog.com</a></p>
                        <p class="info-sub">Collaborations : <a href="mailto:partners@larablog.com">partners@larablog.com</a></p>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p><a href="tel:+33123456789">+33 (0)1 23 45 67 89</a></p>
                        <p class="info-sub">Lun–Ven, 9h–18h</p>
                    </div>
                </div>
            </div>
            <div class="social-contact">
                <h3>Suivez-nous</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>

        <div class="contact-form-wrapper">
            <h2 class="form-title">Envoyez-nous un <em>message</em></h2>
            <p class="form-subtitle">Nous vous répondrons dans les plus brefs délais</p>

            @if(session('contact_success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('contact_success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nom complet *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Jean Dupont" required>
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required>
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Sujet *</label>
                    <select id="subject" name="subject" required>
                        <option value="">— Sélectionnez un sujet —</option>
                        <option value="question" {{ old('subject') == 'question' ? 'selected' : '' }}>Question générale</option>
                        <option value="collaboration" {{ old('subject') == 'collaboration' ? 'selected' : '' }}>Collaboration / Partenariat</option>
                        <option value="bug" {{ old('subject') == 'bug' ? 'selected' : '' }}>Signalement technique</option>
                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('subject')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" placeholder="Votre message…" required>{{ old('message') }}</textarea>
                    @error('message')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>

    <div class="map-section">
        <div class="map-section-header">
            <h2 class="map-section-title">Nous trouver</h2>
            <div class="map-section-line"></div>
        </div>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9913846455476!2d2.3409784157517917!3d48.86111577928747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C%20France!5e0!3m2!1sfr!2sfr!4v1620000000000!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <div class="faq-section">
        <div class="faq-section-header">
            <h2 class="faq-section-title">Questions fréquentes</h2>
            <div class="faq-section-line"></div>
        </div>
        <div class="faq-grid">
            <div class="faq-item">
                <h3>Comment devenir auteur ?</h3>
                <p>Créez un compte, puis contactez-nous via ce formulaire en précisant votre domaine d'expertise. Notre équipe éditoriale vous répondra sous 48h.</p>
            </div>
            <div class="faq-item">
                <h3>Puis-je proposer une collaboration ?</h3>
                <p>Absolument. Sélectionnez "Collaboration / Partenariat" dans le menu déroulant et décrivez votre projet. Nous étudions toutes les propositions sérieuses.</p>
            </div>
            <div class="faq-item">
                <h3>Combien de temps pour une réponse ?</h3>
                <p>Nous traitons tous les messages dans un délai de 24 à 48 heures ouvrées. Les demandes urgentes peuvent être envoyées directement par email.</p>
            </div>
            <div class="faq-item">
                <h3>Comment signaler un problème ?</h3>
                <p>Utilisez le sujet "Signalement technique" pour tout bug ou dysfonctionnement. Précisez votre navigateur et les étapes pour reproduire le problème.</p>
            </div>
        </div>
    </div>
</div>
@endsection