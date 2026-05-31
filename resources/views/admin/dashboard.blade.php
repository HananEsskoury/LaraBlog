<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

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
.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px; }
.stat-card {
    background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 24px;
    position: relative; overflow: hidden; transition: box-shadow .2s, transform .2s;
}
.stat-card:hover { box-shadow: 0 8px 24px rgba(42,32,24,.09); transform: translateY(-2px); }
.stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; }
.stat-card.c-terra::before { background: var(--terracotta); }
.stat-card.c-green::before { background: var(--green); }
.stat-card.c-yellow::before { background: var(--yellow); }
.stat-card.c-blue::before  { background: var(--blue); }
.stat-label { font-size: 11px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: var(--muted); margin-bottom: 10px; }
.stat-value { font-family: var(--sans); font-size: 2.6rem; font-weight: 400; color: var(--ink); line-height: 1; }
.stat-card.c-terra .stat-value { color: var(--terracotta); }
.stat-card.c-green  .stat-value { color: var(--green); }
.stat-card.c-yellow .stat-value { color: var(--yellow); }
.stat-card.c-blue   .stat-value { color: var(--blue); }
.stat-sub { font-size: 11px; color: var(--muted); margin-top: 6px; font-weight: 300; }

/* ── CONTENT LAYOUT ── */
.content-layout { display: grid; grid-template-columns: 1fr 260px; gap: 24px; }

/* ── ARTICLES PANEL ── */
.articles-panel { background: #fff; border: 1px solid var(--border); border-radius: 14px; overflow: hidden; }
.panel-header {
    padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center;
    justify-content: space-between; background: var(--warm-off); flex-wrap: wrap; gap: 12px;
}
.panel-title { font-family: var(--serif); font-size: 1.3rem; font-weight: 400; color: var(--ink); }

/* Article items */
.article-item { padding: 20px 24px; border-bottom: 1px solid #f7f3ee; transition: background .15s; }
.article-item:hover { background: var(--cream); }
.article-item:last-child { border-bottom: none; }
.article-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 6px; }
.article-title {
    font-family: var(--serif); font-size: 1.1rem; font-weight: 400; color: var(--ink);
    text-decoration: none; line-height: 1.3; transition: color .15s; background: none;
    border: none; cursor: pointer; text-align: left; padding: 0;
}
.article-title:hover { color: var(--terracotta); }
.badge { font-size: 10px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; padding: 3px 10px; border-radius: 20px; white-space: nowrap; flex-shrink: 0; }
.badge-approved { background: var(--green-bg);  color: var(--green); }
.badge-pending  { background: var(--yellow-bg); color: var(--yellow); }
.badge-rejected { background: var(--red-bg);    color: var(--red); }
.article-meta { font-size: 11px; color: var(--muted); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; font-weight: 300; }
.cat-pill {
    background: var(--terra-light); color: var(--terra-dark); padding: 2px 8px; border-radius: 4px;
    font-size: 10px; font-weight: 600; letter-spacing: .05em; text-transform: uppercase;
}
.article-excerpt { font-size: 12px; color: var(--muted); margin-bottom: 14px; line-height: 1.6; font-weight: 300; }
.article-footer { display: flex; align-items: center; justify-content: space-between; }
.author-info { display: flex; align-items: center; gap: 8px; }
.author-avatar {
    width: 26px; height: 26px; border-radius: 50%; background: var(--terracotta);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 600; color: #fff; font-family: var(--sans);
}
.author-name { font-size: 12px; color: var(--muted); font-weight: 400; }
.action-btns { display: flex; gap: 8px; align-items: center; }
.btn-approve, .btn-reject, .btn-read {
    padding: 6px 16px; border-radius: 6px; font-size: 11px; font-weight: 600;
    letter-spacing: .06em; text-transform: uppercase; cursor: pointer;
    border: 1.5px solid transparent; transition: all .18s; font-family: var(--sans);
}
.btn-approve { background: var(--green-bg); color: var(--green); border-color: rgba(61,139,94,.2); }
.btn-approve:hover { background: var(--green); color: #fff; }
.btn-reject  { background: var(--red-bg);   color: var(--red);   border-color: rgba(184,58,58,.2); }
.btn-reject:hover  { background: var(--red);   color: #fff; }
.btn-read { background: var(--blue-bg); color: var(--blue); border-color: rgba(42,92,138,.2); display: inline-flex; align-items: center; gap: 5px; }
.btn-read:hover { background: var(--blue); color: #fff; }

/* ── PAGINATION ── */
.voir-plus-wrap {
    padding: 16px 24px; border-top: 1px solid #f7f3ee;
    display: flex; justify-content: center; align-items: center;
    gap: 12px; background: var(--warm-off);
}
.btn-voir {
    display: inline-flex; align-items: center; gap: 6px; padding: 8px 22px;
    border-radius: 8px; font-size: 12px; font-weight: 500; letter-spacing: .06em;
    text-transform: uppercase; cursor: pointer; border: 1.5px solid var(--border);
    background: #fff; color: var(--muted); font-family: var(--sans); transition: all .2s;
}
.btn-voir:hover { border-color: var(--terracotta); color: var(--terracotta); background: var(--terra-light); }
.btn-voir svg { width: 13px; height: 13px; }
.page-indicator {
    font-size: 11px; color: var(--muted); font-weight: 300;
    padding: 4px 12px; background: var(--warm-deep); border-radius: 20px;
}

.empty-state { text-align: center; padding: 60px 24px; color: var(--muted); font-size: 13px; font-weight: 300; }
.empty-state-icon { font-family: var(--serif); font-size: 2.5rem; color: var(--border); margin-bottom: 12px; }

/* ── ASIDE ── */
.aside { display: flex; flex-direction: column; gap: 20px; }
.side-card { background: #fff; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
.side-card-header {
    padding: 14px 18px; background: var(--warm-off); border-bottom: 1px solid var(--border);
    font-family: var(--serif); font-size: .95rem; font-weight: 400; color: var(--ink);
}
.side-card-body { padding: 16px 18px; }
.author-row { display: flex; align-items: center; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f7f3ee; }
.author-row:last-child { border-bottom: none; }
.author-left { display: flex; align-items: center; gap: 10px; }
.author-big-avatar {
    width: 34px; height: 34px; border-radius: 50%; background: var(--terracotta);
    display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: #fff;
}
.author-full-name { font-size: 13px; font-weight: 500; color: var(--ink); }
.author-role { font-size: 11px; color: var(--muted); font-weight: 300; }
.author-count { font-family: var(--serif); font-size: 1.2rem; color: var(--terracotta); }
.cat-row { display: flex; align-items: center; justify-content: space-between; padding: 7px 0; border-bottom: 1px solid #f7f3ee; }
.cat-row:last-child { border-bottom: none; }
.cat-left { display: flex; align-items: center; gap: 8px; }
.cat-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
.cat-name { font-size: 12px; color: var(--ink); }
.cat-count { font-family: var(--serif); font-size: 1.1rem; color: var(--muted); }
.wf-row { display: flex; align-items: center; gap: 10px; padding: 7px 0; font-size: 12px; color: var(--muted); font-weight: 300; border-bottom: 1px solid #f7f3ee; }
.wf-row:last-child { border-bottom: none; }
.wf-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

/* ── ARTICLE READER MODAL ── */
#articleModal {
    display: none; position: fixed; inset: 0; background: rgba(42,32,24,.6);
    backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center; padding: 24px;
}
#articleModal.open { display: flex; }
.article-modal-box {
    background: var(--cream); border-radius: 16px; width: 760px; max-width: 100%; max-height: 90vh;
    display: flex; flex-direction: column; box-shadow: 0 24px 80px rgba(0,0,0,.3);
    overflow: hidden; animation: modalIn .25s cubic-bezier(.16,1,.3,1);
}
@keyframes modalIn {
    from { opacity: 0; transform: scale(.96) translateY(10px); }
    to   { opacity: 1; transform: scale(1)  translateY(0); }
}
.article-modal-bar {
    padding: 16px 24px; background: var(--ink); display: flex;
    align-items: center; justify-content: space-between; flex-shrink: 0;
}
.article-modal-bar-left { display: flex; align-items: center; gap: 10px; }
.modal-bar-label { font-size: 10px; font-weight: 600; letter-spacing: .15em; text-transform: uppercase; color: rgba(255,255,255,.4); }
.modal-bar-status { font-size: 10px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; padding: 3px 10px; border-radius: 20px; }
.modal-bar-status.pending  { background: var(--yellow-bg); color: var(--yellow); }
.modal-bar-status.approved { background: var(--green-bg);  color: var(--green); }
.modal-bar-status.rejected { background: var(--red-bg);    color: var(--red); }
.btn-modal-close {
    width: 30px; height: 30px; border-radius: 50%; border: none;
    background: rgba(255,255,255,.1); color: rgba(255,255,255,.7); cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; transition: background .15s, color .15s; line-height: 1;
}
.btn-modal-close:hover { background: rgba(255,255,255,.2); color: #fff; }
.article-modal-hero { flex-shrink: 0; height: 200px; background: var(--warm-deep); overflow: hidden; position: relative; }
.article-modal-hero img { width: 100%; height: 100%; object-fit: cover; display: block; }
.article-modal-hero-placeholder {
    width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
    font-family: var(--serif); font-size: 4rem; color: var(--border);
    background: linear-gradient(135deg, var(--warm-off) 0%, var(--warm-deep) 100%);
}
.article-modal-body { overflow-y: auto; padding: 32px 40px; flex: 1; }
.article-modal-body::-webkit-scrollbar { width: 5px; }
.article-modal-body::-webkit-scrollbar-track { background: var(--warm-off); }
.article-modal-body::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
.modal-meta-row { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
.modal-cat-pill { background: var(--terra-light); color: var(--terra-dark); padding: 3px 10px; border-radius: 4px; font-size: 10px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
.modal-date, .modal-views { font-size: 11px; color: var(--muted); font-weight: 300; }
.modal-title { font-family: var(--serif); font-size: 2rem; font-weight: 400; color: var(--ink); line-height: 1.2; margin-bottom: 12px; letter-spacing: -.2px; }
.modal-author-row { display: flex; align-items: center; gap: 10px; padding: 12px 0 20px; border-bottom: 1px solid var(--border); margin-bottom: 24px; }
.modal-author-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--terracotta); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: #fff; }
.modal-author-name { font-size: 13px; font-weight: 500; color: var(--ink); }
.modal-author-label { font-size: 11px; color: var(--muted); font-weight: 300; }
.modal-description { font-family: var(--serif); font-size: 1.15rem; font-weight: 400; color: var(--muted); font-style: italic; line-height: 1.7; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--border); }
.modal-content { font-size: 14px; color: var(--ink); line-height: 1.85; font-weight: 300; }
.modal-content p { margin-bottom: 1em; }
.modal-content h2, .modal-content h3 { font-family: var(--serif); font-weight: 400; color: var(--ink); margin: 1.5em 0 .5em; }
.modal-content img { max-width: 100%; border-radius: 8px; margin: 1em 0; }
.modal-content blockquote { border-left: 3px solid var(--terracotta); padding-left: 16px; margin: 1em 0; color: var(--muted); font-style: italic; }
.article-modal-footer {
    flex-shrink: 0; padding: 16px 40px; border-top: 1px solid var(--border);
    background: var(--warm-off); display: flex; align-items: center;
    justify-content: space-between; gap: 12px;
}
.modal-footer-info { font-size: 12px; color: var(--muted); font-weight: 300; font-style: italic; }
.modal-footer-actions { display: flex; gap: 10px; }
.btn-modal-approve, .btn-modal-reject, .btn-modal-close-action {
    padding: 9px 22px; border-radius: 8px; font-size: 12px; font-weight: 600;
    letter-spacing: .07em; text-transform: uppercase; cursor: pointer;
    border: 1.5px solid transparent; transition: all .18s;
    font-family: var(--sans); display: inline-flex; align-items: center; gap: 6px;
}
.btn-modal-approve { background: var(--green); color: #fff; border-color: var(--green); }
.btn-modal-approve:hover { background: #2e7049; border-color: #2e7049; box-shadow: 0 4px 14px rgba(61,139,94,.3); }
.btn-modal-reject { background: var(--red-bg); color: var(--red); border-color: rgba(184,58,58,.25); }
.btn-modal-reject:hover { background: var(--red); color: #fff; }
.btn-modal-close-action { background: transparent; color: var(--muted); border-color: var(--border); }
.btn-modal-close-action:hover { background: var(--warm-deep); color: var(--ink); }

@media (max-width: 1100px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .content-layout { grid-template-columns: 1fr; }
    .header-nav { display: none; }
}
@media (max-width: 768px) {
    .main { padding: 24px 16px; }
    .stats-grid { grid-template-columns: 1fr; }
    .header-nav { display: none; }
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
        <a href="{{ route('admin.dashboard') }}" class="drawer-item active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Articles
        </a>
        <a href="{{ route('admin.categories') }}" class="drawer-item">
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

        <span class="drawer-label">Filtres articles</span>
        <a href="{{ route('admin.dashboard') }}" class="drawer-item">
            Tous <span class="n-badge muted">{{ ($stats['approved'] ?? 0) + ($stats['pending'] ?? 0) + ($stats['rejected'] ?? 0) }}</span>
        </a>
        <a href="{{ route('admin.dashboard', ['filter' => 'approved']) }}" class="drawer-item">
            Publiés <span class="n-badge ok">{{ $stats['approved'] ?? 0 }}</span>
        </a>
        <a href="{{ route('admin.dashboard', ['filter' => 'pending']) }}" class="drawer-item">
            En révision <span class="n-badge warn">{{ $stats['pending'] ?? 0 }}</span>
        </a>
        <a href="{{ route('admin.dashboard', ['filter' => 'rejected']) }}" class="drawer-item">
            Refusés <span class="n-badge" style="background:rgba(184,58,58,.15);color:#b83a3a;">{{ $stats['rejected'] ?? 0 }}</span>
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
     MAIN CONTENT
════════════════════════════════════════════ --}}
<div class="admin-shell">
    <main class="main">

        <div class="page-header">
            <h1>Tableau de <em>bord</em></h1>
            <p>Gérez les articles, auteurs et catégories de votre plateforme.</p>
        </div>

        {{-- TABS --}}
        <div class="tabs">
            <a href="{{ route('admin.dashboard') }}" class="tab {{ !request('filter') ? 'active' : '' }}">Articles</a>
            <a href="{{ route('admin.categories') }}" class="tab">Catégories</a>
            <a href="{{ route('admin.auteurs') }}" class="tab">Auteurs</a>
            <a href="{{ route('admin.statistiques') }}" class="tab">Statistiques</a>
            <a href="{{ route('admin.contact.messages') }}" class="tab">
                Messages
                @if(isset($stats['unread_messages']) && $stats['unread_messages'] > 0)
                    <span class="tab-badge">{{ $stats['unread_messages'] }}</span>
                @endif
            </a>
        </div>

        {{-- STATS --}}
        <div class="stats-grid">
            <div class="stat-card c-green">
                <div class="stat-label">Articles publiés</div>
                <div class="stat-value">{{ $stats['approved'] ?? 0 }}</div>
                <div class="stat-sub">Articles approuvés</div>
            </div>
            <div class="stat-card c-yellow">
                <div class="stat-label">En révision</div>
                <div class="stat-value">{{ $stats['pending'] ?? 0 }}</div>
                <div class="stat-sub">En attente de validation</div>
            </div>
            <div class="stat-card c-terra">
                <div class="stat-label">Auteurs actifs</div>
                <div class="stat-value">{{ $stats['authors'] ?? 0 }}</div>
                <div class="stat-sub">Sur la plateforme</div>
            </div>
            <div class="stat-card c-blue">
                <div class="stat-label">Lectures totales</div>
                <div class="stat-value">{{ number_format($stats['total_views'] ?? 0) }}</div>
                <div class="stat-sub">Tous articles confondus</div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="content-layout">

            {{-- ARTICLES PANEL --}}
            <div class="articles-panel">
                <div class="panel-header">
                    <span class="panel-title">
                        Tous les articles
                        @if($search)
                            — <span style="font-size:.85rem;color:var(--terracotta);">{{ $posts->count() }} résultat(s) pour "{{ $search }}"</span>
                        @endif
                    </span>

                    {{-- Barre de recherche --}}
                    <form method="GET" action="{{ route('admin.dashboard') }}"
                          style="display:flex;align-items:center;gap:0;flex:1;max-width:280px;">
                        @if(request('filter'))
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endif
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                               placeholder="Titre, auteur…"
                               style="flex:1;padding:7px 12px;border:1.5px solid var(--border);border-right:none;
                                      border-radius:6px 0 0 6px;font-family:var(--sans);font-size:12px;
                                      color:var(--ink);background:var(--cream);outline:none;"
                               onfocus="this.style.borderColor='var(--terracotta)'"
                               onblur="this.style.borderColor='var(--border)'">
                        <button type="submit"
                               style="padding:7px 12px;background:var(--terracotta);color:#fff;
                                      border:1.5px solid var(--terracotta);border-radius:0 6px 6px 0;cursor:pointer;display:flex;align-items:center;"
                               onmouseover="this.style.background='var(--terra-dark)'"
                               onmouseout="this.style.background='var(--terracotta)'">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                            </svg>
                        </button>
                        @if($search)
                            <a href="{{ route('admin.dashboard', array_filter(['filter' => request('filter')])) }}"
                               style="margin-left:8px;font-size:11px;color:var(--muted);white-space:nowrap;">✕ effacer</a>
                        @endif
                    </form>
                </div>

                {{-- ════ LISTE DES ARTICLES ════ --}}
                <div id="articlesList">
                    @forelse($posts as $i => $post)
                    <div class="article-item" data-index="{{ $i }}">
                        <div class="article-top">
                            <button type="button" class="article-title" onclick="openArticleModal({{ $post->id }})">
                                {{ $post->title }}
                            </button>
                            <span class="badge badge-{{ $post->status }}">
                                @if($post->status === 'approved') Publié
                                @elseif($post->status === 'pending') En révision
                                @elseif($post->status === 'rejected') Refusé
                                @endif
                            </span>
                        </div>

                        <div class="article-meta">
                            <span>{{ $post->created_at->format('d M Y') }}</span>
                            @if($post->categorie)
                                <span class="cat-pill">{{ $post->categorie->name }}</span>
                            @endif
                            <span>{{ number_format($post->vues) }} lectures</span>
                        </div>

                        <p class="article-excerpt">{{ Str::limit($post->description, 120) }}</p>

                        <div class="article-footer">
                            <div class="author-info">
                                <div class="author-avatar">{{ strtoupper(substr($post->user->name ?? '?', 0, 2)) }}</div>
                                <span class="author-name">{{ $post->user->name ?? 'Inconnu' }}</span>
                            </div>
                            <div class="action-btns">
                                <button type="button" class="btn-read" onclick="openArticleModal({{ $post->id }})">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lire
                                </button>
                                @if($post->status === 'pending')
                                    <form method="POST" action="{{ route('admin.approve', $post->id) }}" style="display:inline;">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn-approve">✓ Approuver</button>
                                    </form>
                                    <button type="button" class="btn-reject" onclick="openRejectModal({{ $post->id }})">
                                        ✕ Rejeter
                                    </button>
                                @elseif($post->status === 'approved')
                                    <span style="font-size:11px;color:var(--green);">✓ Publié</span>
                                @elseif($post->status === 'rejected')
                                    <span style="font-size:11px;color:var(--red);">✕ Refusé</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">✦</div>
                        Aucun article trouvé.
                    </div>
                    @endforelse
                </div>

                {{-- ════ PAGINATION 4 PAR 4 ════ --}}
                @if($posts->count() > 4)
                <div class="voir-plus-wrap" id="voirPlusWrap">
                    <button class="btn-voir" id="btnVoirMoins" onclick="paginer('prev')" style="display:none;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                        </svg>
                        Voir moins
                    </button>
                    <span class="page-indicator" id="pageIndicator"></span>
                    <button class="btn-voir" id="btnVoirPlus" onclick="paginer('next')">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        Voir plus
                    </button>
                </div>
                @endif

            </div>

            {{-- ASIDE (RIGHT PANEL) --}}
            <div class="aside">

                <div class="side-card">
                    <div class="side-card-header">Meilleurs auteurs</div>
                    <div class="side-card-body">
                        @foreach($topAuthors as $author)
                        <div class="author-row">
                            <div class="author-left">
                                <div class="author-big-avatar">{{ strtoupper(substr($author->name, 0, 2)) }}</div>
                                <div>
                                    <div class="author-full-name">{{ $author->name }}</div>
                                    <div class="author-role">{{ $author->bio ? Str::limit($author->bio, 20) : 'Auteur' }}</div>
                                </div>
                            </div>
                            <span class="author-count">{{ $author->posts_count }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="side-card">
                    <div class="side-card-header">Catégories</div>
                    <div class="side-card-body">
                        @php $colors = ['#c0623a','#3d8b5e','#b07d2a','#2a5c8a','#7a5c8a']; @endphp
                        @foreach($categories as $i => $cat)
                        <div class="cat-row">
                            <div class="cat-left">
                                <div class="cat-dot" style="background:{{ $colors[$i % count($colors)] }};"></div>
                                <span class="cat-name">{{ $cat->name }}</span>
                            </div>
                            <span class="cat-count">{{ $cat->posts_count }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="side-card">
                    <div class="side-card-header">Workflow de publication</div>
                    <div class="side-card-body">
                        <div class="wf-row"><div class="wf-dot" style="background:var(--yellow);"></div> Soumis pour révision</div>
                        <div class="wf-row"><div class="wf-dot" style="background:var(--blue);"></div> En cours de révision</div>
                        <div class="wf-row"><div class="wf-dot" style="background:var(--green);"></div> Publié</div>
                        <div class="wf-row"><div class="wf-dot" style="background:var(--red);"></div> Rejeté</div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

{{-- ══════════════════════════════════════════
     ARTICLE READER MODAL
══════════════════════════════════════════ --}}
<div id="articleModal" aria-modal="true" role="dialog" aria-labelledby="modalTitle">
    <div class="article-modal-box">
        <div class="article-modal-bar">
            <div class="article-modal-bar-left">
                <span class="modal-bar-label">Lecture de l'article</span>
                <span class="modal-bar-status" id="modalStatusBadge"></span>
            </div>
            <button class="btn-modal-close" onclick="closeArticleModal()" title="Fermer">×</button>
        </div>
        <div class="article-modal-hero" id="modalHero">
            <div class="article-modal-hero-placeholder" id="modalHeroPlaceholder">✦</div>
        </div>
        <div class="article-modal-body">
            <div class="modal-meta-row">
                <span class="modal-cat-pill" id="modalCategory"></span>
                <span class="modal-date" id="modalDate"></span>
                <span class="modal-views" id="modalViews"></span>
            </div>
            <h2 class="modal-title" id="modalTitle"></h2>
            <div class="modal-author-row">
                <div class="modal-author-avatar" id="modalAuthorAvatar"></div>
                <div>
                    <div class="modal-author-name" id="modalAuthorName"></div>
                    <div class="modal-author-label">Auteur</div>
                </div>
            </div>
            <p class="modal-description" id="modalDescription"></p>
            <div class="modal-content" id="modalContent"></div>
        </div>
        <div class="article-modal-footer">
            <span class="modal-footer-info" id="modalFooterInfo">Lisez l'article avant de prendre une décision.</span>
            <div class="modal-footer-actions" id="modalFooterActions"></div>
        </div>
    </div>
</div>

{{-- MODAL REJET --}}
<div id="rejectModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:3000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:14px;padding:32px;width:460px;max-width:90vw;box-shadow:0 16px 48px rgba(0,0,0,.2);">
        <h3 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:8px;">Raison du refus</h3>
        <p style="font-size:12px;color:var(--muted);margin-bottom:20px;font-weight:300;">Cette raison sera envoyée à l'auteur par notification.</p>
        <form method="POST" id="rejectForm">
            @csrf @method('PATCH')
            <textarea name="reason" placeholder="Expliquez pourquoi cet article est refusé…"
                style="width:100%;height:120px;padding:12px;border:1.5px solid var(--border);border-radius:8px;
                       font-family:var(--sans);font-size:13px;font-weight:300;color:var(--ink);
                       resize:vertical;outline:none;background:var(--cream);"
                onfocus="this.style.borderColor='var(--terracotta)'"
                onblur="this.style.borderColor='var(--border)'"></textarea>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:16px;">
                <button type="button" onclick="closeRejectModal()"
                    style="padding:8px 20px;border-radius:7px;border:1.5px solid var(--border);
                           background:transparent;color:var(--muted);font-family:var(--sans);font-size:12px;font-weight:500;cursor:pointer;">
                    Annuler
                </button>
                <button type="submit"
                    style="padding:8px 20px;border-radius:7px;border:none;background:var(--red);
                           color:#fff;font-family:var(--sans);font-size:12px;font-weight:600;letter-spacing:.05em;cursor:pointer;">
                    Confirmer le refus
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ════════════════════════════════════════════
     JAVASCRIPT
════════════════════════════════════════════ --}}
<script>
const POSTS_DATA = {
    @foreach($posts as $post)
    {{ $post->id }}: {
        id:          {{ $post->id }},
        title:       @json($post->title),
        description: @json($post->description ?? ''),
        content:     @json($post->content ?? $post->body ?? ''),
        status:      @json($post->status),
        date:        @json($post->created_at->format('d M Y')),
        views:       {{ $post->vues }},
        category:    @json($post->categorie->name ?? null),
        author:      @json($post->user->name ?? 'Inconnu'),
        image:       @json($post->image ?? null),
        approveUrl:  "{{ route('admin.approve', $post->id) }}",
        rejectUrl:   "/admin/posts/{{ $post->id }}/reject",
    },
    @endforeach
};

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
    if (e.key === 'Escape') { closeDrawer(); closeArticleModal(); closeRejectModal(); }
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

// ── PAGINATION ───────────────────────────────────────────────────────────────
const ITEMS_PER_PAGE = 4;
let visibleCount = ITEMS_PER_PAGE;

function renderPage() {
    const items = document.querySelectorAll('#articlesList .article-item');
    const total = items.length;
    if (total === 0) return;

    items.forEach(function(el, i) {
        el.style.display = i < visibleCount ? '' : 'none';
    });

    const btnMoins  = document.getElementById('btnVoirMoins');
    const btnPlus   = document.getElementById('btnVoirPlus');
    const indicator = document.getElementById('pageIndicator');

    if (btnMoins) btnMoins.style.display = visibleCount > ITEMS_PER_PAGE ? 'inline-flex' : 'none';
    if (btnPlus)  btnPlus.style.display  = visibleCount < total ? 'inline-flex' : 'none';

    if (indicator) {
        const showing = Math.min(visibleCount, total);
        indicator.textContent = '1–' + showing + ' sur ' + total;
        indicator.style.display = total > ITEMS_PER_PAGE ? '' : 'none';
    }
}

function paginer(direction) {
    const items = document.querySelectorAll('#articlesList .article-item');
    const total = items.length;

    if (direction === 'next') {
        visibleCount = Math.min(visibleCount + ITEMS_PER_PAGE, total);
    } else if (direction === 'prev') {
        visibleCount = Math.max(visibleCount - ITEMS_PER_PAGE, ITEMS_PER_PAGE);
    }

    renderPage();
    document.querySelector('.articles-panel').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// ── ARTICLE READER MODAL ─────────────────────────────────────────────────────
function openArticleModal(postId) {
    const post = POSTS_DATA[postId];
    if (!post) return;
    const modal = document.getElementById('articleModal');

    const badge  = document.getElementById('modalStatusBadge');
    const labels = { approved: 'Publié', pending: 'En révision', rejected: 'Refusé' };
    badge.textContent = labels[post.status] || post.status;
    badge.className   = 'modal-bar-status ' + post.status;

    const heroEl      = document.getElementById('modalHero');
    const placeholder = document.getElementById('modalHeroPlaceholder');
    const oldImg      = heroEl.querySelector('img');
    if (oldImg) oldImg.remove();
    if (post.image) {
        placeholder.style.display = 'none';
        const img = document.createElement('img');
        img.src     = '/img/' + post.image;
        img.alt     = post.title;
        img.onerror = function() { placeholder.style.display = 'flex'; img.remove(); };
        heroEl.appendChild(img);
    } else {
        placeholder.style.display = 'flex';
    }

    document.getElementById('modalCategory').textContent    = post.category || '';
    document.getElementById('modalCategory').style.display  = post.category ? '' : 'none';
    document.getElementById('modalDate').textContent        = post.date;
    document.getElementById('modalViews').textContent       = post.views.toLocaleString('fr-FR') + ' lectures';
    document.getElementById('modalTitle').textContent       = post.title;
    document.getElementById('modalAuthorName').textContent  = post.author;
    document.getElementById('modalAuthorAvatar').textContent = post.author.substring(0, 2).toUpperCase();
    document.getElementById('modalDescription').textContent = post.description;

    const contentEl = document.getElementById('modalContent');
    contentEl.innerHTML = post.content
        ? post.content
        : '<p style="color:var(--muted);font-style:italic;">Contenu non disponible.</p>';

    const actionsEl  = document.getElementById('modalFooterActions');
    const footerInfo = document.getElementById('modalFooterInfo');
    actionsEl.innerHTML = '';

    const closeBtn       = document.createElement('button');
    closeBtn.className   = 'btn-modal-close-action';
    closeBtn.textContent = 'Fermer';
    closeBtn.onclick     = closeArticleModal;

    if (post.status === 'pending') {
        footerInfo.textContent = "Lisez l'article avant de prendre une décision.";

        const approveBtn     = document.createElement('button');
        approveBtn.className = 'btn-modal-approve';
        approveBtn.innerHTML = '<svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Approuver';
        approveBtn.onclick   = function() {
            closeArticleModal();
            const form     = document.createElement('form');
            form.method    = 'POST';
            form.action    = post.approveUrl;
            form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="PATCH">';
            document.body.appendChild(form);
            form.submit();
        };

        const rejectBtn     = document.createElement('button');
        rejectBtn.className = 'btn-modal-reject';
        rejectBtn.innerHTML = '<svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg> Rejeter';
        rejectBtn.onclick   = function() { closeArticleModal(); openRejectModal(post.id); };

        actionsEl.appendChild(closeBtn);
        actionsEl.appendChild(rejectBtn);
        actionsEl.appendChild(approveBtn);
    } else {
        const statusText = { approved: '✓ Cet article est publié.', rejected: '✕ Cet article a été refusé.' };
        footerInfo.textContent = statusText[post.status] || '';
        actionsEl.appendChild(closeBtn);
    }

    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeArticleModal() {
    document.getElementById('articleModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.getElementById('articleModal').addEventListener('click', function(e) {
    if (e.target === this) closeArticleModal();
});

// ── REJECT MODAL ─────────────────────────────────────────────────────────────
function openRejectModal(postId) {
    const modal = document.getElementById('rejectModal');
    const form  = document.getElementById('rejectForm');
    form.action = '/admin/posts/' + postId + '/reject';
    modal.style.display = 'flex';
}
function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
}
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});

// ── INIT ──────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', renderPage);
</script>
</body>
</html>