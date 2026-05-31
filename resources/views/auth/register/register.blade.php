<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LaraBlog – Inscription</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --cream:      #faf6f1;
      --warm-off:   #f3ebe0;
      --terracotta: #c0623a;
      --terra-dark: #9e4b28;
      --terra-light:#f0d4c4;
      --ink:        #2a2018;
      --muted:      #7a6a58;
      --border:     #e2d8cc;
      --serif:      'Cormorant Garamond', Georgia, serif;
      --sans:       'Jost', sans-serif;
    }

    body {
      font-family: var(--sans);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--cream);
    }

    .card {
      display: grid;
      grid-template-columns: 1fr 1fr;
      width: min(900px, 96vw);
      min-height: 520px;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 24px 60px rgba(42,32,24,.14);
      animation: fadeUp .55s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .left {
      background: #fff;
      padding: 48px 52px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      border-right: 1px solid var(--border);
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .brand-icon { width: 32px; height: 32px; color: var(--terracotta); }

    .brand-name {
      font-family: var(--serif);
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--ink);
      letter-spacing: -.3px;
    }
    .brand-name em { font-style: italic; color: var(--terracotta); }

    .form-section { flex: 1; display: flex; flex-direction: column; justify-content: center; }

    h1 {
      font-family: var(--serif);
      font-weight: 400;
      font-size: 2.2rem;
      color: var(--ink);
      margin-bottom: 32px;
      letter-spacing: -.3px;
      line-height: 1.15;
    }
    h1 em { color: var(--terracotta); font-style: italic; }

    .field { margin-bottom: 16px; }

    .field input,
    .field textarea {
      width: 100%;
      padding: 13px 16px;
      border: 1.5px solid var(--border);
      border-radius: 8px;
      font-family: var(--sans);
      font-size: .95rem;
      color: var(--ink);
      background: var(--cream);
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    .field textarea {
      resize: vertical;
    }

    .field input::placeholder,
    .field textarea::placeholder { color: var(--muted); }

    .field input:focus,
    .field textarea:focus {
      border-color: var(--terracotta);
      box-shadow: 0 0 0 3px rgba(192,98,58,.12);
      background: #fff;
    }

    /* File input */
    .field input[type="file"] {
      padding: 10px 16px;
      cursor: pointer;
      color: var(--muted);
      font-size: .85rem;
    }
    .field input[type="file"]::-webkit-file-upload-button {
      padding: 6px 14px;
      border: 1.5px solid var(--border);
      border-radius: 6px;
      background: var(--warm-off);
      color: var(--ink);
      font-family: var(--sans);
      font-size: .8rem;
      font-weight: 500;
      cursor: pointer;
      transition: background .2s, border-color .2s;
    }
    .field input[type="file"]::-webkit-file-upload-button:hover {
      background: var(--terra-light);
      border-color: var(--terracotta);
    }

    .error-msg {
      font-size: .78rem;
      color: #b83a3a;
      margin-top: 5px;
      font-weight: 300;
    }

    /* Checkbox */
    .checkbox-field {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .checkbox-field input[type="checkbox"] {
      width: 18px;
      height: 18px;
      accent-color: var(--terracotta);
      cursor: pointer;
    }

    .checkbox-field label {
      margin: 0;
      font-size: .9rem;
      color: var(--ink);
      cursor: pointer;
      user-select: none;
      font-weight: 300;
    }

    .btn-register {
      width: 100%;
      padding: 13px;
      margin-top: 4px;
      background: var(--ink);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-family: var(--sans);
      font-size: .85rem;
      font-weight: 600;
      letter-spacing: .12em;
      text-transform: uppercase;
      cursor: pointer;
      transition: background .2s, transform .12s, box-shadow .2s;
      box-shadow: 0 4px 16px rgba(42,32,24,.2);
    }

    .btn-register:hover {
      background: var(--terracotta);
      box-shadow: 0 6px 22px rgba(192,98,58,.3);
      transform: translateY(-1px);
    }
    .btn-register:active { transform: translateY(0); }

    .login-link {
      font-size: .86rem;
      color: var(--muted);
      font-weight: 300;
    }
    .login-link a {
      color: var(--terracotta);
      text-decoration: none;
      font-weight: 500;
    }
    .login-link a:hover { text-decoration: underline; }

    /* RIGHT panel */
    .right { position: relative; overflow: hidden; background: var(--ink); }

    .right img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      opacity: .75;
      transition: transform 6s ease, opacity .3s;
    }

    .card:hover .right img { transform: scale(1.04); opacity: .85; }

    .right::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(192,98,58,.25) 0%, rgba(42,32,24,.4) 100%);
      pointer-events: none;
    }

    .right-overlay {
      position: absolute;
      bottom: 40px;
      left: 36px;
      right: 36px;
      z-index: 1;
    }
    .right-overlay-title {
      font-family: var(--serif);
      font-size: 2rem;
      font-weight: 400;
      color: #fff;
      line-height: 1.2;
      margin-bottom: 8px;
    }
    .right-overlay-title em { color: var(--terra-light); font-style: italic; }
    .right-overlay-sub {
      font-size: 12px;
      color: rgba(255,255,255,.55);
      font-weight: 300;
      letter-spacing: .04em;
    }

    @media (max-width: 620px) {
      .card { grid-template-columns: 1fr; }
      .right { display: none; }
      .left { padding: 36px 28px; }
    }
  </style>
</head>
<body>

<div class="card">

  <!-- LEFT -->
  <div class="left">

    <div class="brand">
      <svg class="brand-icon" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/>
        <line x1="16" y1="8" x2="2" y2="22"/>
        <line x1="17.5" y1="15" x2="9" y2="15"/>
      </svg>
      <span class="brand-name">Lara<em>Blog</em></span>
    </div>

    <div class="form-section">
      <h1>S'ins<em>crire</em></h1>

      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        {{-- Avatar --}}
        <div class="field">
          <input id="avatar" type="file" name="avatar" accept="image/*"/>
          @error('avatar')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Bio --}}
        <div class="field">
          <textarea id="bio" name="bio" placeholder="Parlez-nous de vous…" rows="3">{{ old('bio') }}</textarea>
          @error('bio')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Name --}}
        <div class="field">
          <input id="name" type="text" name="name"
            placeholder="Nom complet"
            value="{{ old('name') }}"
            required autofocus autocomplete="name"/>
          @error('name')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Email --}}
        <div class="field">
          <input id="email" type="email" name="email"
            placeholder="Adresse email"
            value="{{ old('email') }}"
            required autocomplete="username"/>
          @error('email')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Password --}}
        <div class="field">
          <input id="password" type="password" name="password"
            placeholder="Mot de passe"
            required autocomplete="new-password"/>
          @error('password')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Confirm Password --}}
        <div class="field">
          <input id="password_confirmation" type="password" name="password_confirmation"
            placeholder="Confirmer le mot de passe"
            required autocomplete="new-password"/>
          @error('password_confirmation')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Checkbox Auteur --}}
        <div class="checkbox-field">
          <input id="is_auteur" type="checkbox" name="is_auteur" value="1"/>
          <label for="is_auteur">Je veux m'inscrire comme auteur</label>
        </div>
        @error('is_auteur')<p class="error-msg">{{ $message }}</p>@enderror

        <button type="submit" class="btn-register">Créer mon compte</button>

      </form>
    </div>

    <p class="login-link">
      Déjà un compte ?
      <a href="{{ route('login') }}">Se connecter ici</a>
    </p>

  </div>

  <!-- RIGHT -->
  <div class="right">
    <img src="bloglaravel.jpg" alt="LaraBlog"/>
    <div class="right-overlay">
      <div class="right-overlay-title">Rejoignez<br>Lara<em>Blog</em></div>
      <div class="right-overlay-sub">Écriture · Partage · Découverte</div>
    </div>
  </div>

</div>

</body>
</html>