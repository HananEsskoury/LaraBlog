
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<style>
:root {
    --cream:      #faf6f1;
    --warm-off:   #f3ebe0;
    --warm-deep:  #ede0cc;
    --terracotta: #c0623a;
    --terra-dark: #9e4b28;
    --terra-light:#f0d4c4;
    --ink:        #2a2018;
    --muted:      #7a6a58;
    --border:     #e2d8cc;
    --serif:      'Cormorant Garamond', Georgia, serif;
    --sans:       'Jost', sans-serif;
    --green:      #3d8b5e;
    --green-bg:   #edf7f2;
    --yellow:     #b07d2a;
    --yellow-bg:  #fdf6e3;
    --red:        #b83a3a;
    --red-bg:     #fdf0f0;
    --blue:       #2a5c8a;
    --blue-bg:    #edf3fa;
    --header-h:   60px;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--sans); background: var(--cream); color: var(--ink); }

/* ══════════════════════════════════════════
   HEADER
══════════════════════════════════════════ */
.admin-header {
    background: #2a2018;
    border-bottom: 1px solid rgba(255,255,255,.07);
    position: sticky;
    top: 0;
    z-index: 200;
    height: var(--header-h);
}
.header-inner {
    max-width: 1600px;
    margin: 0 auto;
    padding: 0 20px;
    height: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
}
.hamburger {
    background: none; border: none; cursor: pointer;
    color: rgba(255,255,255,.6); padding: 6px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s; flex-shrink: 0;
}
.hamburger:hover { background: rgba(255,255,255,.07); }
.header-logo-wrap {
    display: flex; align-items: center; height: 42px;
    text-decoration: none; flex-shrink: 0;
}
.header-logo-wrap svg { height: 42px; width: auto; }
.admin-badge {
    font-size: 10px; font-weight: 600; letter-spacing: .12em;
    text-transform: uppercase; background: rgba(192,98,58,.18);
    border: 1px solid rgba(192,98,58,.35); color: #f0d4c4;
    padding: 3px 10px; border-radius: 20px; font-family: var(--sans);
    white-space: nowrap; flex-shrink: 0;
}
.header-nav {
    display: flex; align-items: center; gap: 2px; margin: 0 auto;
}
.header-nav-link {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 400;
    color: rgba(255,255,255,.55); text-decoration: none; border: none;
    background: transparent; transition: all .18s; letter-spacing: .02em; white-space: nowrap;
}
.header-nav-link:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
.header-nav-link.active { background: rgba(255,255,255,.1); color: rgba(255,255,255,.95); }
.header-nav-link svg { width: 15px; height: 15px; flex-shrink: 0; }
.header-sep { width: 1px; height: 22px; background: rgba(255,255,255,.1); flex-shrink: 0; }
.notif-wrap { position: relative; flex-shrink: 0; }
.notif-btn {
    background: none; border: none; cursor: pointer; position: relative;
    width: 36px; height: 36px; border-radius: 8px; display: flex;
    align-items: center; justify-content: center; color: rgba(255,255,255,.5); transition: all .18s;
}
.notif-btn:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
.notif-btn svg { width: 18px; height: 18px; }
.notif-badge-dot {
    position: absolute; top: 4px; right: 4px; background: #c0623a; color: #fff;
    border-radius: 50%; width: 16px; height: 16px; font-size: 9px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; line-height: 1;
    border: 2px solid #2a2018;
}
.notif-dropdown {
    display: none; position: absolute; right: 0; top: calc(100% + 10px);
    width: 320px; background: #fff; border-radius: 14px; border: 1px solid var(--border);
    box-shadow: 0 12px 32px rgba(0,0,0,.2); z-index: 999; overflow: hidden;
}
.notif-header {
    padding: 14px 18px; border-bottom: 1px solid #f0ebe3;
    display: flex; justify-content: space-between; align-items: center; background: var(--warm-off);
}
.notif-header-title { font-family: var(--serif); font-size: 1rem; font-weight: 600; color: var(--ink); }
.notif-mark-all {
    font-size: 11px; color: var(--terracotta); font-weight: 500; text-decoration: none;
    padding: 4px 10px; border-radius: 20px; transition: background .2s; font-family: var(--sans);
}
.notif-mark-all:hover { background: var(--terra-light); }
.notif-item {
    display: block; padding: 13px 18px; font-size: 13px; text-decoration: none;
    color: var(--ink); border-bottom: 1px solid #f7f3ee; transition: background .15s;
    line-height: 1.4; font-weight: 300;
}
.notif-item:hover { background: var(--cream); }
.notif-item.unread { background: #fdf6e3; }
.notif-item.unread-blue { background: #f3ebe0; }
.notif-item.unread-blue:hover { background: #ede0cc; }
.notif-time { font-size: 11px; color: var(--muted); margin-top: 4px; display: block; }
.notif-empty { padding: 24px; text-align: center; color: var(--muted); font-size: 13px; font-weight: 300; }
.profile-btn {
    display: inline-flex; align-items: center; gap: 8px; padding: 5px 12px 5px 6px;
    border-radius: 9px; border: 1px solid rgba(255,255,255,.1); background: rgba(255,255,255,.05);
    cursor: pointer; font-size: 13px; font-weight: 400; color: rgba(255,255,255,.75);
    transition: all .18s; font-family: var(--sans); letter-spacing: .02em; flex-shrink: 0;
}
.profile-btn:hover { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.18); color: #fff; }
.profile-avatar { width: 28px; height: 28px; border-radius: 7px; object-fit: cover; }
.profile-avatar-placeholder {
    width: 28px; height: 28px; border-radius: 7px; background: var(--terracotta); color: #fff;
    font-size: 11px; font-weight: 700; display: flex; align-items: center; justify-content: center;
}
.profile-dropdown {
    display: none; position: absolute; right: 0; top: calc(100% + 8px); width: 180px;
    background: #fff; border-radius: 12px; border: 1px solid var(--border);
    box-shadow: 0 8px 24px rgba(42,32,24,.2); z-index: 999; overflow: hidden; padding: 6px;
}
.profile-drop-link {
    display: block; padding: 8px 12px; font-size: 13px; color: var(--ink); text-decoration: none;
    border-radius: 7px; transition: background .15s; font-family: var(--sans); font-weight: 400;
    border: none; background: none; width: 100%; text-align: left; cursor: pointer;
}
.profile-drop-link:hover { background: var(--warm-off); }
.profile-drop-link.danger { color: var(--red); }
.profile-drop-link.danger:hover { background: var(--red-bg); }

/* ── DRAWER ── */
.drawer-overlay {
    display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5);
    z-index: 300; backdrop-filter: blur(2px);
}
.drawer-overlay.open { display: block; }
.drawer {
    position: fixed; top: 0; left: 0; bottom: 0; width: 260px;
    background: var(--ink); z-index: 400; transform: translateX(-100%);
    transition: transform .25s cubic-bezier(.16,1,.3,1); display: flex;
    flex-direction: column; overflow-y: auto;
}
.drawer.open { transform: translateX(0); }
.drawer-header {
    padding: 16px 20px; border-bottom: 1px solid rgba(255,255,255,.08);
    display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;
}
.drawer-logo {
    font-family: var(--serif); font-size: 1.3rem; font-weight: 600;
    color: #f0d4c4; text-decoration: none; letter-spacing: -.3px;
}
.drawer-logo em { font-style: italic; color: var(--terracotta); }
.drawer-close {
    background: none; border: none; cursor: pointer; color: rgba(255,255,255,.5);
    padding: 6px; border-radius: 7px; display: flex; align-items: center; transition: background .2s;
}
.drawer-close:hover { background: rgba(255,255,255,.08); color: rgba(255,255,255,.9); }
.drawer-body { padding: 12px 16px; flex: 1; }
.drawer-label {
    font-size: 9.5px; font-weight: 600; letter-spacing: .18em; text-transform: uppercase;
    color: rgba(255,255,255,.22); padding: 14px 12px 5px; display: block;
}
.drawer-item {
    display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px;
    font-size: 12.5px; font-weight: 400; color: rgba(255,255,255,.55); text-decoration: none;
    transition: all .18s; border: none; background: transparent; cursor: pointer;
    font-family: var(--sans); width: 100%; text-align: left;
}
.drawer-item:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
.drawer-item.active { background: var(--terracotta); color: #fff; font-weight: 500; }
.drawer-item svg { width: 15px; height: 15px; flex-shrink: 0; }
.drawer-item .n-badge { margin-left: auto; font-size: 10px; font-weight: 600; padding: 2px 7px; border-radius: 20px; }
.n-badge.warn  { background: var(--yellow-bg); color: var(--yellow); }
.n-badge.ok    { background: var(--green-bg);  color: var(--green); }
.n-badge.muted { background: rgba(255,255,255,.1); color: rgba(255,255,255,.35); }
.drawer-footer {
    padding: 16px; border-top: 1px solid rgba(255,255,255,.08); flex-shrink: 0;
    display: flex; align-items: center; gap: 10px;
}
.drawer-footer-avatar {
    width: 36px; height: 36px; border-radius: 8px; background: var(--terracotta); color: #fff;
    display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; flex-shrink: 0;
}
.drawer-footer-name { font-size: 13px; font-weight: 500; color: rgba(255,255,255,.85); }
.drawer-footer-email { font-size: 11px; color: rgba(255,255,255,.35); }

/* ── MAIN LAYOUT ── */
.admin-shell { display: flex; min-height: calc(100vh - var(--header-h)); }
.main {
    flex: 1;
    padding: 0;
    overflow-y: auto;
    min-height: calc(100vh - var(--header-h));
    position: relative;
}

/* ── PAGE WITH BACKGROUND ── */
.page-with-bg {
    position: relative;
    min-height: calc(100vh - var(--header-h));
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 24px;
}
.bg {
    position: absolute;
    inset: 0;
    background-image: url('{{ asset('covers/collage.jpg') }}');
    background-size: cover;
    background-position: center;
    z-index: 0;
    animation: kenburns 14s ease-in-out infinite alternate;
    will-change: transform;
}
@keyframes kenburns {
    0%   { transform: scale(1)    translate(0px, 0px);   }
    25%  { transform: scale(1.1)  translate(-18px,-10px); }
    50%  { transform: scale(1.15) translate(12px, 14px);  }
    75%  { transform: scale(1.08) translate(-10px,18px);  }
    100% { transform: scale(1)    translate(0px, 0px);   }
}
.bg-overlay {
    position: absolute;
    inset: 0;
    background: rgba(42, 32, 24, 0.65);
    z-index: 1;
}

/* ── FORM CARD ── */
.form-container {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 720px;
    margin: 0 auto;
}
.form-card {
    background: rgba(250, 246, 241, 0.97);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(2px);
}
.form-card-header {
    padding: 28px 36px;
    border-bottom: 1px solid var(--border);
    background: var(--warm-off);
}
.form-card-header h1 {
    font-family: var(--serif);
    font-size: 2.2rem;
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 8px;
}
.form-card-header h1 em { color: var(--terracotta); font-style: italic; }
.form-card-header p {
    font-size: 14px;
    color: var(--muted);
    font-weight: 300;
}
.form-card-body { padding: 36px; }

.form-group { margin-bottom: 24px; }
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 24px;
}
label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 8px;
}
input[type="text"],
select,
textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: var(--sans);
    font-size: 14px;
    color: var(--ink);
    background: #fff;
    transition: border-color .18s;
    outline: none;
}
input[type="text"]:focus,
select:focus,
textarea:focus { border-color: var(--terracotta); background: #fff; }
input[type="text"]::placeholder,
textarea::placeholder { color: var(--muted); }
textarea { resize: vertical; min-height: 200px; line-height: 1.7; }

select {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%237a6a58'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 14px;
    padding-right: 36px;
}

.field-error {
    font-size: 11px;
    color: var(--red);
    margin-top: 6px;
}

/* File Upload */
.file-upload-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: var(--warm-off);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    color: var(--ink);
    cursor: pointer;
    transition: all .18s;
}
.file-upload-label:hover { background: var(--warm-deep); border-color: var(--terracotta); }
.file-upload-label svg { width: 14px; height: 14px; }
.file-name-display {
    font-size: 12px;
    color: var(--muted);
    margin-top: 8px;
    font-weight: 300;
}
.field-hint {
    font-size: 11px;
    color: var(--muted);
    margin-top: 4px;
    font-weight: 300;
}
input[type="file"] { display: none; }

/* Submit Button */
.btn-submit {
    width: 100%;
    padding: 14px 20px;
    background: var(--terracotta);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background .18s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-submit:hover { background: var(--terra-dark); }
.btn-submit svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;
    font-size: 12px;
    color: rgba(255,255,255,.7);
    text-decoration: none;
    transition: color .18s;
}
.back-link:hover { color: #fff; }
.back-link svg { width: 14px; height: 14px; }

.alert-error {
    background: var(--red-bg);
    border: 1px solid var(--red);
    border-radius: 10px;
    padding: 12px 18px;
    margin-bottom: 20px;
    font-size: 13px;
    color: var(--red);
}

@media (max-width: 768px) {
    .main { padding: 0; }
    .page-with-bg { padding: 20px 16px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
    .form-card-header, .form-card-body { padding: 20px; }
    .form-card-header h1 { font-size: 1.6rem; }
}
</style>

{{-- HEADER --}}
<header class="admin-header">
    <div class="header-inner">
        <button class="hamburger" onclick="openDrawer()" type="button" aria-label="Menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <a href="{{ route('admin.dashboard') }}" class="header-logo-wrap" aria-label="LaraBlog">
            <svg viewBox="0 0 680 220" xmlns="http://www.w3.org/2000/svg">
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M130,110 Q115,105 100,115 Q88,122 80,118"/>
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M115,108 Q108,96 112,85"/>
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M102,113 Q94,108 90,98"/>
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M88,116 Q78,112 72,118 Q66,124 60,120"/>
              <ellipse cx="112" cy="82"  rx="9" ry="5" transform="rotate(-40 112 82)"  fill="rgba(255,255,255,0.55)" opacity="0.85"/>
              <ellipse cx="90"  cy="96"  rx="8" ry="4" transform="rotate(-20 90 96)"   fill="rgba(255,255,255,0.55)" opacity="0.85"/>
              <ellipse cx="63"  cy="118" rx="9" ry="4" transform="rotate(15 63 118)"   fill="rgba(255,255,255,0.55)" opacity="0.85"/>
              <ellipse cx="73"  cy="112" rx="7" ry="3.5" transform="rotate(-10 73 112)" fill="rgba(255,255,255,0.45)" opacity="0.7"/>
              <circle cx="104" cy="117" r="3"   fill="#c0623a" opacity="0.9"/>
              <circle cx="97"  cy="120" r="2.5" fill="#c0623a" opacity="0.8"/>
              <circle cx="83"  cy="121" r="3"   fill="#c0623a" opacity="0.9"/>
              <g transform="translate(120,102)">
                <circle cx="0"   cy="-7"   r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="6.6" cy="-2.2" r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="4.1" cy="5.7"  r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="-4.1" cy="5.7" r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="-6.6" cy="-2.2" r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="0" cy="0" r="2.5" fill="#fff" opacity="0.95"/>
                <circle cx="0" cy="0" r="1.2" fill="#e8a0b0"/>
              </g>
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M550,110 Q565,105 580,115 Q592,122 600,118"/>
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M565,108 Q572,96 568,85"/>
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M578,113 Q586,108 590,98"/>
              <path stroke="rgba(255,255,255,0.5)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M592,116 Q602,112 608,118 Q614,124 620,120"/>
              <ellipse cx="568" cy="82"  rx="9" ry="5" transform="rotate(40 568 82)"   fill="rgba(255,255,255,0.55)" opacity="0.85"/>
              <ellipse cx="590" cy="96"  rx="8" ry="4" transform="rotate(20 590 96)"   fill="rgba(255,255,255,0.55)" opacity="0.85"/>
              <ellipse cx="617" cy="118" rx="9" ry="4" transform="rotate(-15 617 118)" fill="rgba(255,255,255,0.55)" opacity="0.85"/>
              <ellipse cx="607" cy="112" rx="7" ry="3.5" transform="rotate(10 607 112)" fill="rgba(255,255,255,0.45)" opacity="0.7"/>
              <circle cx="576" cy="117" r="3"   fill="#c0623a" opacity="0.9"/>
              <circle cx="583" cy="120" r="2.5" fill="#c0623a" opacity="0.8"/>
              <circle cx="597" cy="121" r="3"   fill="#c0623a" opacity="0.9"/>
              <g transform="translate(560,102)">
                <circle cx="0"   cy="-7"   r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="6.6" cy="-2.2" r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="4.1" cy="5.7"  r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="-4.1" cy="5.7" r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="-6.6" cy="-2.2" r="3.5" fill="#e8a0b0" opacity="0.9"/>
                <circle cx="0" cy="0" r="2.5" fill="#fff" opacity="0.95"/>
                <circle cx="0" cy="0" r="1.2" fill="#e8a0b0"/>
              </g>
              <text x="340" y="68" text-anchor="middle" font-family="Georgia, serif" font-size="13" fill="#c0623a">THE</text>
              <text x="340" y="135" text-anchor="middle" font-family="Georgia, serif" font-size="62" font-weight="700" fill="#c0623a" letter-spacing="4">Lara<tspan font-style="italic">Blog</tspan></text>
              <defs>
                <mask id="hgaps" maskUnits="userSpaceOnUse">
                  <rect x="0" y="0" width="680" height="220" fill="white"/>
                  <rect x="317" y="54" width="43" height="19" fill="black" rx="2"/>
                  <rect x="171" y="76" width="338" height="75" fill="black" rx="2"/>
                  <rect x="234" y="146" width="212" height="19" fill="black" rx="2"/>
                </mask>
              </defs>
              <line x1="175" y1="155" x2="276" y2="155" stroke="rgba(255,255,255,0.25)" stroke-width="0.8" mask="url(#hgaps)"/>
              <text x="340" y="160" text-anchor="middle" font-family="Georgia, serif" font-size="12" fill="rgba(255,255,255,0.35)">— BLOG LITTÉRAIRE —</text>
              <line x1="404" y1="155" x2="505" y2="155" stroke="rgba(255,255,255,0.25)" stroke-width="0.8" mask="url(#hgaps)"/>
            </svg>
        </a>

        <span class="admin-badge">Auteur</span>

        <nav class="header-nav">
            <a href="{{ route('home') }}" class="header-nav-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Accueil
            </a>
            <a href="{{ route('blog') }}" class="header-nav-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Blog
            </a>
            <a href="{{ route('authors.all') }}" class="header-nav-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Auteurs
            </a>
        </nav>

        <div class="header-sep"></div>

        <div class="notif-wrap">
            <button class="notif-btn" onclick="toggleNotifs()" type="button">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="notif-badge-dot">{{ auth()->user()->unreadNotifications->count() }}</span>
                @endif
            </button>
            <div class="notif-dropdown" id="notifDropdown">
                <div class="notif-header">
                    <span class="notif-header-title">Notifications</span>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <a href="{{ route('notifications.readAll') }}" class="notif-mark-all">Tout marquer lu</a>
                    @endif
                </div>
                @forelse(auth()->user()->notifications->take(8) as $notif)
                    @if(isset($notif->data['reactor_name']))
                        <a href="{{ route('fullpost', $notif->data['post_id']) }}" onclick="markRead('{{ $notif->id }}')" class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                            {{ $notif->data['emoji'] }} <strong>{{ $notif->data['reactor_name'] }}</strong> a réagi à <em>{{ $notif->data['post_title'] }}</em>
                            <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                        </a>
                    @elseif(isset($notif->data['commenter']))
                        <a href="{{ route('fullpost', $notif->data['post_id']) }}" onclick="markRead('{{ $notif->id }}')" class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                            💬 <strong>{{ $notif->data['commenter'] }}</strong> a commenté <em>{{ $notif->data['post_title'] }}</em>
                            <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                        </a>
                    @elseif(isset($notif->data['author_name']))
                        <a href="{{ route('fullpost', $notif->data['post_id']) }}" onclick="markRead('{{ $notif->id }}')" class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                            📝 <strong>{{ $notif->data['author_name'] }}</strong> a publié <em>{{ $notif->data['post_title'] }}</em>
                            <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                        </a>
                    @elseif(isset($notif->data['message']))
                        <a href="{{ $notif->data['url'] ?? '#' }}" onclick="markRead('{{ $notif->id }}')" class="notif-item {{ $notif->read_at ? '' : 'unread' }}">
                            🔔 {{ $notif->data['message'] }}
                            <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                        </a>
                    @endif
                @empty
                    <div class="notif-empty">Aucune notification</div>
                @endforelse
            </div>
        </div>

        <div class="notif-wrap" style="position:relative;">
            <button class="profile-btn" onclick="toggleProfile()" type="button">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('img/' . Auth::user()->avatar) }}" alt="avatar" class="profile-avatar">
                @else
                    <div class="profile-avatar-placeholder">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                @endif
                {{ Auth::user()->name }}
                <svg style="width:11px;height:11px;color:rgba(255,255,255,.35);margin-left:2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="profile-dropdown" id="profileDropdown">
                <a href="{{ route('auteur.profile', auth()->id()) }}" class="profile-drop-link">👤 Mon profil</a>
                <a href="{{ route('profile.edit') }}" class="profile-drop-link">⚙️ Paramètres</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="profile-drop-link danger">🚪 Déconnexion</button>
                </form>
            </div>
        </div>
    </div>
</header>

{{-- DRAWER SIDEBAR --}}
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
    <div class="drawer-header">
        <a href="{{ route('auteur.dashboard') }}" class="drawer-logo">Lara<em>Blog</em></a>
        <button class="drawer-close" onclick="closeDrawer()" type="button">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <div class="drawer-body">
        <span class="drawer-label">Navigation</span>
        <a href="{{ route('home') }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Accueil
        </a>
        <a href="{{ route('auteur.dashboard') }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Dashboard
        </a>
        <a href="{{ route('auteur.addpost') }}" class="drawer-item active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Nouvel article
        </a>
        <span class="drawer-label">Mes articles</span>
        <a href="{{ route('auteur.dashboard') }}" class="drawer-item">Tous</a>
        <span class="drawer-label">Compte</span>
        <a href="{{ route('auteur.profile', auth()->id()) }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Mon profil
        </a>
        <a href="{{ route('profile.edit') }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Paramètres
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="drawer-item" style="color:rgba(192,98,58,.8);">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Déconnexion
            </button>
        </form>
    </div>
    <div class="drawer-footer">
        @if(Auth::user()->avatar)
            <img src="{{ asset('img/' . Auth::user()->avatar) }}" style="width:36px;height:36px;border-radius:8px;object-fit:cover;">
        @else
            <div class="drawer-footer-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        @endif
        <div>
            <div class="drawer-footer-name">{{ Auth::user()->name }}</div>
            <div class="drawer-footer-email">{{ Auth::user()->email }}</div>
        </div>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="admin-shell">
    <main class="main">
        <div class="page-with-bg">
            <div class="bg"></div>
            <div class="bg-overlay"></div>

            <div class="form-container">
                <a href="{{ route('auteur.dashboard') }}" class="back-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour au dashboard
                </a>

                <div class="form-card">
                    <div class="form-card-header">
                        <h1>Nouvel <em>article</em></h1>
                        <p>Rédigez votre contenu et soumettez-le à la validation de l'admin.</p>
                    </div>

                    <div class="form-card-body">
                        @if(session('error'))
                            <div class="alert-error">⚠️ {{ session('error') }}</div>
                        @endif

                        <form action="{{ route('auteur.createpost') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" name="title" placeholder="Titre de votre article…" value="{{ old('title') }}" required>
                                @error('title')<p class="field-error">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select name="categorie_id" required>
                                        <option value="" disabled {{ old('categorie_id') ? '' : 'selected' }}>— Choisir —</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('categorie_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categorie_id')<p class="field-error">{{ $message }}</p>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Image à la une</label>
                                    <label for="imageInput" class="file-upload-label">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                        Choisir
                                    </label>
                                    <input type="file" id="imageInput" name="image" accept="image/*" onchange="updateFileName(this)">
                                    <p class="file-name-display" id="fileNameDisplay">Aucun fichier</p>
                                    <p class="field-hint">PNG, JPG, WEBP — 5MB max</p>
                                    @error('image')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Contenu</label>
                                <textarea name="description" placeholder="Écrivez votre contenu ici…" required>{{ old('description') }}</textarea>
                                @error('description')<p class="field-error">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit" class="btn-submit">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="15" height="15">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Soumettre l'article
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function updateFileName(input) {
    const display = document.getElementById('fileNameDisplay');
    display.textContent = input.files.length ? input.files[0].name : 'Aucun fichier';
}

function toggleNotifs() {
    const d = document.getElementById('notifDropdown');
    const p = document.getElementById('profileDropdown');
    if (p) p.style.display = 'none';
    if (d) d.style.display = d.style.display === 'block' ? 'none' : 'block';
}
function toggleProfile() {
    const p = document.getElementById('profileDropdown');
    const d = document.getElementById('notifDropdown');
    if (d) d.style.display = 'none';
    if (p) p.style.display = p.style.display === 'block' ? 'none' : 'block';
}
function markRead(id) {
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
    });
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.notif-wrap')) {
        const nd = document.getElementById('notifDropdown');
        const pd = document.getElementById('profileDropdown');
        if (nd) nd.style.display = 'none';
        if (pd) pd.style.display = 'none';
    }
});

function openDrawer() {
    document.getElementById('drawer').classList.add('open');
    document.getElementById('drawerOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDrawer() {
    document.getElementById('drawer').classList.remove('open');
    document.getElementById('drawerOverlay').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeDrawer(); }
});
</script>

</body>
</html>
