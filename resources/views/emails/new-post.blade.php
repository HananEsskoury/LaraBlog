<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background:#f9f9f9; padding:2rem; color:#2c2c2c; }
        .card { background:white; border-radius:12px; padding:2rem; max-width:500px; margin:0 auto; box-shadow:0 4px 16px rgba(0,0,0,.08); }
        .logo { font-size:1.5rem; font-weight:bold; color:#7a9e7e; margin-bottom:1.5rem; }
        h2 { font-size:1.4rem; margin-bottom:0.5rem; }
        p { color:#888; font-size:0.9rem; line-height:1.6; margin-bottom:1.5rem; }
        .btn { display:inline-block; background:#7a9e7e; color:white; padding:0.75rem 1.5rem; border-radius:30px; text-decoration:none; font-size:0.85rem; }
        .footer { margin-top:2rem; font-size:0.75rem; color:#aaa; text-align:center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">LaraBlog</div>
        <h2>{{ $post->title }}</h2>
        <p>Un nouvel article vient d'être publié sur LaraBlog par <strong>{{ $post->user->name }}</strong>.</p>
        <a href="{{ url('/fullpost/' . $post->id) }}" class="btn">Lire l'article</a>
        <div class="footer">Vous recevez cet email car vous êtes abonné(e) à LaraBlog.</div>
    </div>
</body>
</html>