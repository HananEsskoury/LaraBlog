
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
   HEADER (identique au dashboard)
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
    flex: 1; padding: 36px 40px; background: var(--cream);
    overflow-y: auto; min-height: calc(100vh - var(--header-h));
}

/* ── PAGE HEADER ── */
.page-header { margin-bottom: 32px; }
.page-header h1 {
    font-family: var(--serif); font-size: 2.2rem; font-weight: 400;
    color: var(--ink); line-height: 1.15; letter-spacing: -.3px;
}
.page-header h1 em { color: var(--terracotta); font-style: italic; }
.page-header p { font-size: 13px; color: var(--muted); margin-top: 6px; font-weight: 300; }

/* ── TABS ── */
.tabs {
    display: flex; gap: 4px; margin-bottom: 28px; background: var(--warm-off);
    border: 1px solid var(--border); border-radius: 10px; padding: 4px; width: fit-content;
}
.tab {
    padding: 8px 20px; border-radius: 7px; font-size: 12px; font-weight: 500;
    letter-spacing: .06em; text-transform: uppercase; cursor: pointer; border: none;
    background: transparent; color: var(--muted); text-decoration: none; transition: all .2s;
    font-family: var(--sans); display: flex; align-items: center; gap: 6px;
}
.tab.active { background: var(--ink); color: #fff; }
.tab:hover:not(.active) { background: var(--warm-deep); color: var(--ink); }
.tab-badge {
    font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 20px;
    background: var(--terracotta); color: #fff; line-height: 1.4;
}

/* ── STATS GRID ── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 32px;
}
.stat-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    transition: box-shadow .2s, transform .2s;
}
.stat-card:hover { box-shadow: 0 8px 24px rgba(42,32,24,.09); transform: translateY(-2px); }
.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
}
.stat-card.c-terra::before { background: var(--terracotta); }
.stat-card.c-green::before { background: var(--green); }
.stat-card.c-blue::before  { background: var(--blue); }
.stat-label {
    font-size: 11px;
    font-weight: 500;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 10px;
}
.stat-value {
    font-family: var(--sans);
    font-size: 2.6rem;
    font-weight: 400;
    color: var(--ink);
    line-height: 1;
}
.stat-card.c-terra .stat-value { color: var(--terracotta); }
.stat-card.c-green  .stat-value { color: var(--green); }
.stat-card.c-blue   .stat-value { color: var(--blue); }
.stat-sub { font-size: 11px; color: var(--muted); margin-top: 6px; font-weight: 300; }

/* ── FORM CARD ── */
.form-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 24px;
}
.form-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    background: var(--warm-off);
    font-family: var(--serif);
    font-size: 1.2rem;
    font-weight: 400;
    color: var(--ink);
}
.form-card-body { padding: 20px 24px; }

.form-row {
    display: flex;
    gap: 12px;
    align-items: flex-end;
    flex-wrap: wrap;
}
.form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
    flex: 1;
    min-width: 160px;
}
.form-group label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
}
.form-input {
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 13px;
    font-family: var(--sans);
    outline: none;
    transition: border-color .2s;
    color: var(--ink);
    background: var(--cream);
    width: 100%;
}
.form-input:focus { border-color: var(--terracotta); background: #fff; }
.form-input::placeholder { color: var(--muted); }

.file-label {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 14px;
    border: 1.5px dashed var(--border);
    border-radius: 8px;
    cursor: pointer;
    font-size: 12px;
    color: var(--muted);
    background: var(--cream);
    transition: border-color .2s, background .2s;
    white-space: nowrap;
}
.file-label:hover { border-color: var(--terracotta); background: #fff; color: var(--terracotta); }
.file-label input[type="file"] { display: none; }
.file-label span { overflow: hidden; text-overflow: ellipsis; max-width: 150px; }

.btn-add {
    padding: 10px 22px;
    background: var(--ink);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background .2s;
    white-space: nowrap;
    font-family: var(--sans);
    height: 42px;
}
.btn-add:hover { background: var(--terracotta); }

/* ── TABLE PANEL ── */
.table-panel {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
}
.panel-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--warm-off);
    flex-wrap: wrap;
}
.panel-title {
    font-family: var(--serif);
    font-size: 1.3rem;
    font-weight: 400;
    color: var(--ink);
}
.badge-count {
    background: var(--terra-light);
    color: var(--terra-dark);
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .05em;
}

.alert-success {
    background: var(--green-bg);
    color: var(--green);
    border: 1px solid rgba(61,139,94,.25);
    border-radius: 10px;
    padding: 12px 18px;
    margin-bottom: 20px;
    font-size: 13px;
}
.alert-error {
    background: var(--red-bg);
    color: var(--red);
    border: 1px solid rgba(184,58,58,.2);
    border-radius: 10px;
    padding: 12px 18px;
    margin-bottom: 20px;
    font-size: 13px;
}

table { width: 100%; border-collapse: collapse; }
thead tr { background: var(--warm-off); }
th {
    padding: 12px 20px;
    text-align: left;
    font-size: 10px;
    color: var(--muted);
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    border-bottom: 1px solid var(--border);
    font-family: var(--sans);
}
td {
    padding: 14px 20px;
    font-size: 13px;
    color: var(--ink);
    border-bottom: 1px solid #f7f3ee;
    font-family: var(--sans);
    vertical-align: middle;
}
tr:last-child td { border-bottom: none; }
tbody tr:hover td { background: var(--cream); }

.cat-thumb {
    width: 44px;
    height: 44px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid var(--border);
    display: block;
}
.cat-thumb-placeholder {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    background: var(--warm-off);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--border);
    font-size: 18px;
}
.cat-name-cell {
    font-weight: 600;
    color: var(--ink);
    font-family: var(--serif);
    font-size: 1rem;
}
.slug-cell {
    font-size: 11px;
    color: var(--muted);
    font-family: monospace;
    background: var(--warm-off);
    padding: 3px 9px;
    border-radius: 5px;
    border: 1px solid var(--border);
    display: inline-block;
}

.btn-edit {
    padding: 6px 14px;
    background: var(--warm-off);
    color: var(--ink);
    border: 1.5px solid var(--border);
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .18s;
    font-family: var(--sans);
    text-decoration: none;
    display: inline-block;
    margin-right: 8px;
}
.btn-edit:hover { background: var(--warm-deep); border-color: var(--terracotta); color: var(--terracotta); }

.btn-delete {
    padding: 6px 14px;
    background: var(--red-bg);
    color: var(--red);
    border: 1.5px solid rgba(184,58,58,.2);
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .18s;
    font-family: var(--sans);
}
.btn-delete:hover { background: var(--red); color: #fff; border-color: var(--red); }

.empty-state {
    text-align: center;
    padding: 60px 24px;
    color: var(--muted);
    font-size: 13px;
    font-weight: 300;
}
.empty-state-icon {
    font-family: var(--serif);
    font-size: 2.5rem;
    color: var(--border);
    margin-bottom: 12px;
}

/* MODAL */
.modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(3px);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 2000;
}
.modal-overlay.open { display: flex; }
.modal-container {
    background: #fff;
    border-radius: 16px;
    width: 90%;
    max-width: 550px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    animation: modalIn .2s ease;
}
@keyframes modalIn {
    from { opacity: 0; transform: scale(.96) translateY(10px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}
.modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--warm-off);
    border-radius: 16px 16px 0 0;
}
.modal-header h3 {
    font-family: var(--serif);
    font-size: 1.3rem;
    font-weight: 400;
    color: var(--ink);
    margin: 0;
}
.modal-close {
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: var(--muted);
    transition: color 0.2s;
    line-height: 1;
}
.modal-close:hover { color: var(--terracotta); }
.modal-body { padding: 24px; display: flex; flex-direction: column; gap: 16px; }
.modal-footer {
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    background: var(--cream);
}
.btn-secondary {
    padding: 8px 20px;
    background: var(--warm-off);
    color: var(--ink);
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    font-family: var(--sans);
}
.btn-secondary:hover { background: var(--border); }
.btn-primary {
    padding: 8px 20px;
    background: var(--terracotta);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
    font-family: var(--sans);
}
.btn-primary:hover { background: var(--terra-dark); }
.current-image {
    margin-top: 5px;
    padding: 8px;
    background: var(--cream);
    border-radius: 8px;
    display: inline-block;
}
.current-image img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

@media (max-width: 1100px) {
    .header-nav { display: none; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .admin-shell { flex-direction: column; }
    .main { padding: 24px 16px; }
    .stats-grid { grid-template-columns: 1fr; }
    .header-nav { display: none; }
    .form-row { flex-direction: column; }
    .table-panel { overflow-x: auto; }
    table { min-width: 700px; }
}
</style>

{{-- ════════════════════════════════════════════
     HEADER
════════════════════════════════════════════ --}}
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

        <span class="admin-badge">Admin</span>

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
                <a href="{{ route('profile.show') }}" class="profile-drop-link">👤 Mon profil</a>
                <a href="{{ route('profile.edit') }}" class="profile-drop-link">⚙️ Paramètres</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="profile-drop-link danger">🚪 Déconnexion</button>
                </form>
            </div>
        </div>

    </div>
</header>

{{-- ════════════════════════════════════════════
     DRAWER SIDEBAR
════════════════════════════════════════════ --}}
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
    <div class="drawer-header">
        <a href="{{ route('admin.dashboard') }}" class="drawer-logo">Lara<em>Blog</em></a>
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
        <a href="{{ route('admin.dashboard') }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
             Articles
        </a>
        <a href="{{ route('admin.categories') }}" class="drawer-item active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
            Catégories
        </a>
        <a href="{{ route('admin.auteurs') }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Auteurs
        </a>
        <a href="{{ route('admin.statistiques') }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Statistiques
        </a>
        <a href="{{ route('admin.contact.messages') }}" class="drawer-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Messages
            @if(isset($stats['unread_messages']) && $stats['unread_messages'] > 0)
                <span class="n-badge" style="background:var(--terracotta);color:#fff;margin-left:auto;">{{ $stats['unread_messages'] }}</span>
            @endif
        </a>

        <span class="drawer-label">Compte</span>
        <a href="{{ route('profile.show') }}" class="drawer-item">
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

{{-- ════════════════════════════════════════════
     MAIN CONTENT - GESTION DES CATÉGORIES
════════════════════════════════════════════ --}}
<div class="admin-shell">
    <main class="main">

        <div class="page-header">
            <h1>Gestion des <em>catégories</em></h1>
            <p>Créez, modifiez et supprimez les catégories de la plateforme.</p>
        </div>

        {{-- TABS --}}
        <div class="tabs">
            <a href="{{ route('admin.dashboard') }}" class="tab">Articles</a>
            <a href="{{ route('admin.categories') }}" class="tab active">Catégories</a>
            <a href="{{ route('admin.auteurs') }}" class="tab">Auteurs</a>
            <a href="{{ route('admin.statistiques') }}" class="tab">Statistiques</a>
            <a href="{{ route('admin.contact.messages') }}" class="tab">
                Messages
                @if(isset($stats['unread_messages']) && $stats['unread_messages'] > 0)
                    <span class="tab-badge">{{ $stats['unread_messages'] }}</span>
                @endif
            </a>
        </div>

        {{-- STATS CATÉGORIES --}}
        <div class="stats-grid">
            <div class="stat-card c-terra">
                <div class="stat-label">Total catégories</div>
                <div class="stat-value">{{ $categories->count() }}</div>
                <div class="stat-sub">sur la plateforme</div>
            </div>
            <div class="stat-card c-green">
                <div class="stat-label">Articles par catégorie</div>
                <div class="stat-value">{{ $categories->count() ? round($categories->avg('posts_count'), 1) : 0 }}</div>
                <div class="stat-sub">moyenne par catégorie</div>
            </div>
            <div class="stat-card c-blue">
                <div class="stat-label">Total articles</div>
                <div class="stat-value">{{ $categories->sum('posts_count') }}</div>
                <div class="stat-sub">toutes catégories confondues</div>
            </div>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">✕ {{ $errors->first() }}</div>
        @endif

        {{-- FORMULAIRE AJOUT --}}
        <div class="form-card">
            <div class="form-card-header">Ajouter une catégorie</div>
            <div class="form-card-body">
                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom *</label>
                            <input class="form-input" type="text" name="name"
                                   placeholder="ex: Technologie"
                                   value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input class="form-input" type="text" name="description"
                                   placeholder="Courte description (optionnel)"
                                   value="{{ old('description') }}">
                        </div>
                        <div class="form-group" style="flex:0 0 auto;">
                            <label>Image</label>
                            <label class="file-label" id="fileLabel">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span id="fileName">Choisir une image</span>
                                <input type="file" name="image" accept="image/*" onchange="updateFileName(this)">
                            </label>
                        </div>
                        <button class="btn-add" type="submit">+ Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- LISTE DES CATÉGORIES --}}
        <div class="table-panel">
            <div class="panel-header">
                <span class="panel-title">Toutes les catégories</span>
                <span class="badge-count">{{ $categories->count() }}</span>
            </div>

            @if($categories->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">✦</div>
                    Aucune catégorie pour l'instant.
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Articles</th>
                                <th>Créée le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                            <tr>
                                <td>
                                    @if($cat->image)
                                        <img src="{{ asset('img/' . $cat->image) }}"
                                             alt="{{ $cat->name }}"
                                             class="cat-thumb">
                                    @else
                                        <div class="cat-thumb-placeholder">✦</div>
                                    @endif
                                </td>
                                <td><span class="cat-name-cell">{{ $cat->name }}</span></td>
                                <td><span class="slug-cell">{{ $cat->slug }}</span></td>
                                <td style="color:var(--muted);">{{ $cat->description ?: '—' }}</td>
                                <td><span class="badge-count">{{ $cat->posts_count }}</span></td>
                                <td style="font-size:11px; color:var(--muted);">{{ $cat->created_at->format('d M Y') }}</td>
                                <td>
                                    <div style="display: flex; gap: 6px; flex-wrap: nowrap; white-space: nowrap;">
                                        <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn-edit">
                                            ✏️ Modifier
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.categories.delete', $cat->id) }}"
                                              onsubmit="return confirm('Supprimer « {{ $cat->name }} » ?')"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-delete" type="submit">🗑️ Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </main>
</div>

{{-- MODAL DE MODIFICATION --}}
@if(isset($categorie))
<div class="modal-overlay open" id="editModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3>Modifier la catégorie</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.categories.update', $categorie->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>Nom *</label>
                    <input class="form-input" type="text" name="name" value="{{ old('name', $categorie->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input class="form-input" type="text" name="description" value="{{ old('description', $categorie->description) }}">
                </div>
                <div class="form-group">
                    <label>Image actuelle</label>
                    @if($categorie->image)
                        <div class="current-image">
                            <img src="{{ asset('img/' . $categorie->image) }}" alt="{{ $categorie->name }}">
                            <p style="font-size: 11px; margin-top: 5px; color:var(--muted);">{{ $categorie->image }}</p>
                        </div>
                    @else
                        <p style="font-size: 12px; color:var(--muted);">Aucune image</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nouvelle image (optionnel)</label>
                    <label class="file-label">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span id="editFileName">Choisir une image</span>
                        <input type="file" name="image" accept="image/*" onchange="updateEditFileName(this)">
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
function updateFileName(input) {
    const label = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = 'Choisir une image';
    }
}

function closeModal() {
    const modal = document.getElementById('editModal');
    if (modal) modal.classList.remove('open');
}

function updateEditFileName(input) {
    const label = document.getElementById('editFileName');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = 'Choisir une image';
    }
}

// Fermer le modal en cliquant en dehors
document.addEventListener('click', function(e) {
    const modal = document.getElementById('editModal');
    if (modal && modal.classList.contains('open') && e.target === modal) {
        closeModal();
    }
});

// ── HEADER DROPDOWNS ─────────────────────────────────────────────────────────
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

// ── DRAWER ───────────────────────────────────────────────────────────────────
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
    if (e.key === 'Escape') { closeDrawer(); closeModal(); }
});
</script>

</body>
</html>
