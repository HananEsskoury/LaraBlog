<style>
    :root {
        --cream: #faf6f1;
        --warm-off: #f3ebe0;
        --terracotta: #c0623a;
        --terra-dark: #9e4b28;
        --ink: #2a2018;
        --muted: #7a6a58;
        --border: #e2d8cc;
        --serif: 'Cormorant Garamond', Georgia, serif;
        --sans: 'Jost', sans-serif;
        --content-width: 1290px;
        --edge-padding: 3rem;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { background: var(--cream); color: var(--ink); font-family: var(--sans); font-weight: 300; line-height: 1.7; }
    a { text-decoration: none; color: inherit; }
    img { display: block; width: 100%; object-fit: cover; }

    .container { max-width: var(--content-width); margin: 0 auto; padding: 0 var(--edge-padding); }

    /* ── HEADER ── */
    header { position: sticky; top: 0; z-index: 100; background: var(--cream); border-bottom: 1px solid var(--border); box-shadow: 0 2px 12px rgba(42,32,24,.06); }
    .navbar { display: flex; align-items: center; gap: 2rem; padding: 18px 0; }
    .logo { font-family: var(--serif); font-size: 1.65rem; font-weight: 600; color: var(--terracotta); letter-spacing: -0.5px; margin-right: auto; text-decoration: none; }
    .logo em { font-style: italic; }
    .nav-links { display: flex; align-items: center; gap: 2rem; }
    .nav-links a { font-size: .78rem; letter-spacing: .12em; text-transform: uppercase; color: var(--muted); transition: color .2s; text-decoration: none; }
    .nav-links a:hover, .nav-links a.active { color: var(--terracotta); }

    /* Avatar dropdown */
    .avatar-dropdown { position: relative; display: inline-block; }
    .avatar-trigger { display: flex; flex-direction: column; align-items: center; cursor: pointer; gap: 2px; }
    .avatar-trigger img, .avatar-initials { width: 36px; height: 36px; border-radius: 50%; border: 2px solid var(--terracotta); }
    .avatar-initials { background: var(--terracotta); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 500; font-size: 13px; }
    .avatar-trigger span { font-size: 10px; color: var(--muted); letter-spacing: .05em; }
    #avatarDropdown { display: none; position: absolute; right: 0; top: calc(100% + 8px); background: #fff; border-radius: 10px; box-shadow: 0 8px 32px rgba(42,32,24,.12); min-width: 150px; z-index: 999; overflow: hidden; }
    #avatarDropdown a { display: block; padding: 12px 16px; font-size: .8rem; color: var(--ink); border-bottom: 1px solid var(--border); text-decoration: none; }
    #avatarDropdown a:hover { background: var(--warm-off); }
    #avatarDropdown form button { width: 100%; text-align: left; padding: 12px 16px; font-size: .8rem; color: #c0392b; background: none; border: none; cursor: pointer; font-family: var(--sans); }
    #avatarDropdown form button:hover { background: #fff5f5; }

    /* Notifications */
    #notifWrap { position: relative; display: inline-block; }
    .notif-btn { background: none; border: none; cursor: pointer; position: relative; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; color: var(--muted); border-radius: 8px; transition: background .2s; }
    .notif-btn:hover { background: var(--warm-off); }
    .notif-badge { position: absolute; top: 4px; right: 4px; background: #ef4444; color: #fff; border-radius: 50%; width: 16px; height: 16px; font-size: 9px; font-weight: 700; display: flex; align-items: center; justify-content: center; border: 2px solid var(--cream); }
    #notifDropdown { display: none; position: absolute; right: 0; top: calc(100% + 10px); width: 300px; background: #fff; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 12px 32px rgba(42,32,24,.12); z-index: 999; overflow: hidden; }
    .notif-header { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
    .notif-header-title { font-family: var(--serif); font-size: 14px; font-weight: 600; color: var(--ink); }
    .notif-mark-all { font-size: 11px; color: var(--terracotta); text-decoration: none; }
    .notif-item { display: block; padding: 12px 16px; font-size: 13px; text-decoration: none; color: var(--ink); border-bottom: 1px solid #f9f9f9; }
    .notif-item.unread { background: #f0f9ff; }
    .notif-time { display: block; font-size: 11px; color: #aaa; margin-top: 3px; }
    .notif-empty { padding: 24px; text-align: center; color: #aaa; font-size: 13px; }

    /* FOOTER */
    footer { background: var(--ink); color: rgba(255,255,255,.55); padding: 64px 0 32px; margin-top: 48px; }
    .footer-content { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
    .footer-column h3 { font-family: var(--serif); font-size: 1.1rem; font-weight: 400; color: #fff; margin-bottom: 16px; }
    .footer-column p { font-size: .83rem; line-height: 1.8; }
    .footer-links { list-style: none; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a { font-size: .83rem; transition: color .2s; text-decoration: none; color: rgba(255,255,255,.55); }
    .footer-links a:hover { color: var(--terracotta); }
    .social-links { display: flex; gap: 14px; margin-top: 20px; }
    .social-links a { width: 34px; height: 34px; border-radius: 50%; border: 1px solid rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: .8rem; color: rgba(255,255,255,.55); transition: background .2s, color .2s, border-color .2s; text-decoration: none; }
    .social-links a:hover { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }
    .copyright { border-top: 1px solid rgba(255,255,255,.1); padding-top: 24px; font-size: .75rem; letter-spacing: .06em; text-align: center; }
    .footer-cats { display: flex; flex-wrap: wrap; gap: 8px; list-style: none; }
    .footer-cat-tag { padding: 6px 14px; border: 1px solid rgba(255,255,255,.2); border-radius: 100px; font-size: .72rem; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.55); transition: all .2s; text-decoration: none; display: inline-block; }
    .footer-cat-tag:hover { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }

    @media (max-width: 768px) {
        .footer-content { grid-template-columns: 1fr; }
        :root { --edge-padding: 1.5rem; }
        .nav-links { gap: 1rem; flex-wrap: wrap; }
    }
    /* Logo styles */
.logo {
    display: inline-block;
    text-decoration: none;
    line-height: 1;
    transition: opacity 0.2s ease;
}

.logo:hover {
    opacity: 0.85;
}

.logo svg {
    max-width: 240px;
    height: auto;
    display: block;
}

@media (max-width: 768px) {
    .logo svg {
        max-width: 180px;
    }
}

@media (max-width: 480px) {
    .logo svg {
        max-width: 140px;
    }
}

/* Version footer */
.footer-logo .logo svg {
    max-width: 180px;
}

@media (max-width: 768px) {
    .footer-logo .logo svg {
        max-width: 140px;
    }
}
</style>