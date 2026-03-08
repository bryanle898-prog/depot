<?php
require_once __DIR__ . "/wp-load.php";
$bistrot_slots  = get_option("bistrot_slots",  array_fill(0, 6, null));
$bistrot_slides = get_option("bistrot_slides", []);
$bistrot_hero   = get_option("bistrot_hero",   "");
$bistrot_img_ambiance = get_option("bistrot_img_ambiance", "");
$bistrot_img_infos    = get_option("bistrot_img_infos",    "");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Le Bistrot du Port — Restaurant à Port-Camargue, terrasse ombragée face aux voiliers. Parrillada de poissons, bouillabaisse, entrecôte XL. 13 Quai Lapeyrouse, Le Grau-du-Roi. Tél : 04 66 53 09 03.">
  <meta property="og:title" content="Le Bistrot du Port — Restaurant Port-Camargue">
  <meta property="og:description" content="Terrasse face aux voiliers, cuisine méditerranéenne, parrillada et spécialités de la mer.">
  <meta property="og:type" content="restaurant">
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"Restaurant","name":"Le Bistrot du Port","telephone":"+33466530903","address":{"@type":"PostalAddress","streetAddress":"13 Quai Lapeyrouse","addressLocality":"Le Grau-du-Roi","postalCode":"30240","addressCountry":"FR"},"servesCuisine":["Méditerranéenne","Fruits de mer"],"priceRange":"€€"}</script>
<title>Le Bistrot du Port — Restaurant Port-Camargue, Le Grau-du-Roi</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&family=DM+Sans:wght@300;400&display=swap" rel="stylesheet">
<style>
  :root {
    --sand: #E8DCC8;
    --warm-white: #F7F2EA;
    --salt: #FAFAF8;
    --deep-sea: #1A3040;
    --sea: #2B5672;
    --flamingo: #C4614A;
    --gold: #B8913A;
    --reed: #7A6E5A;
    --light-reed: #BFB9AB;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  html { scroll-behavior: smooth; }

  body {
    background: var(--warm-white);
    color: var(--deep-sea);
    font-family: 'DM Sans', sans-serif;
    overflow-x: hidden;
  }

  /* ─── HERO ─── */
  .hero {
    min-height: 100vh;
    background: var(--deep-sea);
    position: relative;
    display: flex;
    flex-direction: column;
    overflow: hidden;
  }

  .hero-bg {
    position: absolute; inset: 0;
    <?php if ($bistrot_hero): ?>
    background:
      linear-gradient(160deg, rgba(13,30,42,0.78) 0%, rgba(26,48,64,0.50) 45%, rgba(30,61,80,0.32) 100%),
      url('<?php echo esc_url($bistrot_hero); ?>') center/cover no-repeat;
    <?php else: ?>
    background: linear-gradient(160deg, rgba(13,30,42,0.92) 0%, rgba(26,48,64,0.80) 45%, rgba(30,61,80,0.65) 100%);
    <?php endif; ?>
  }

  .hero-waves {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 200px;
    opacity: 0.15;
  }

  /* Texture overlay */
  .hero::after {
    content: '';
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4'%3E%3Crect width='1' height='1' fill='%23ffffff' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
  }

  nav {
    position: relative;
    z-index: 10;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem 4rem;
  }

  .nav-logo {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 1.4rem;
    color: var(--sand);
    letter-spacing: 0.02em;
  }

  .nav-links {
    display: flex;
    gap: 2.5rem;
    list-style: none;
  }

  .nav-links a {
    color: var(--light-reed);
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 300;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    transition: color 0.3s;
  }

  .nav-links a:hover { color: var(--sand); }

  .hero-content {
    position: relative;
    z-index: 5;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 0 4rem 6rem;
    max-width: 900px;
  }

  .hero-tag {
    font-size: 0.72rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--flamingo);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .hero-tag::before {
    content: '';
    display: block;
    width: 40px; height: 1px;
    background: var(--flamingo);
  }

  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(3.5rem, 7vw, 6.5rem);
    line-height: 1.05;
    color: var(--sand);
    margin-bottom: 1.5rem;
    text-shadow: 0 2px 20px rgba(0,0,0,0.7), 0 1px 4px rgba(0,0,0,0.9);
  }

  .hero-title em {
    font-style: italic;
    color: var(--warm-white);
  }

  .hero-sub {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem;
    font-weight: 300;
    color: #f0ece4;
    max-width: 480px;
    line-height: 1.7;
    margin-bottom: 3rem;
    text-shadow: 0 1px 8px rgba(0,0,0,0.8);
  }

  .hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: transparent;
    border: 1px solid var(--flamingo);
    color: var(--flamingo);
    text-decoration: none;
    font-size: 0.78rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    padding: 1rem 2.5rem;
    transition: all 0.3s;
    width: fit-content;
  }

  .hero-cta:hover {
    background: var(--flamingo);
    color: white;
  }

  .hero-scroll {
    position: absolute;
    right: 4rem; bottom: 4rem;
    z-index: 10;
    writing-mode: vertical-lr;
    font-size: 0.65rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--reed);
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .hero-scroll::after {
    content: '';
    display: block;
    width: 1px; height: 60px;
    background: var(--reed);
    animation: scrollLine 2s ease-in-out infinite;
  }

  @keyframes scrollLine {
    0%,100% { transform: scaleY(1); opacity: 1; }
    50% { transform: scaleY(0.5); opacity: 0.4; }
  }

  /* ─── SECTION BASE ─── */
  section { padding: 7rem 4rem; }

  .section-eyebrow {
    font-size: 0.68rem;
    letter-spacing: 0.35em;
    text-transform: uppercase;
    color: var(--flamingo);
    margin-bottom: 1.2rem;
    display: flex; align-items: center; gap: 1rem;
  }

  .section-eyebrow::before {
    content: '';
    display: block;
    width: 30px; height: 1px;
    background: var(--flamingo);
  }

  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4vw, 3.2rem);
    line-height: 1.15;
    color: var(--deep-sea);
    margin-bottom: 1.5rem;
  }

  /* ─── AMBIANCE ─── */
  .ambiance {
    background: var(--salt);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6rem;
    align-items: center;
  }

  .ambiance-text p {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.15rem;
    line-height: 1.85;
    color: var(--reed);
    margin-bottom: 1.2rem;
  }

  .ambiance-visual {
    position: relative;
  }

  .ambiance-img-main {
    width: 100%;
    aspect-ratio: 4/5;
    background: linear-gradient(135deg, #2B5672 0%, #1A3040 60%, #0D1E2A 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
  }

  .ambiance-img-main svg {
    opacity: 0.25;
    width: 60%;
  }

  .ambiance-img-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #2B5672 0%, #1A3040 60%, #0D1E2A 100%);
  }

  .ambiance-img-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .ambiance-caption {
    position: absolute;
    bottom: -1.5rem; left: -2rem;
    background: var(--flamingo);
    color: white;
    padding: 1.2rem 2rem;
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 1rem;
  }

  /* ─── MENUS ─── */
  .menus-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.9rem;
  }

  .menu-card {
    position: relative;
    aspect-ratio: 3/4;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    overflow: hidden;
    cursor: pointer;
    transition: all 0.4s;
    group: true;
  }

  .menu-card:hover {
    border-color: rgba(196,97,74,0.5);
    transform: translateY(-4px);
  }

  .menu-card img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s;
  }

  .menu-card:hover img { transform: scale(1.03); }

  .menu-card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,20,30,0.88) 0%, transparent 55%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 1.5rem;
    opacity: 1;
  }

  .menu-card-label {
    color: white;
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    margin-bottom: 0.3rem;
    text-shadow: 0 1px 4px rgba(0,0,0,0.6);
  }

  .menu-card-hint {
    color: rgba(255,255,255,0.5);
    font-size: 0.65rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    opacity: 0;
    transform: translateY(4px);
    transition: all 0.3s;
  }

  .menu-card:hover .menu-card-hint {
    opacity: 1;
    transform: translateY(0);
  }

  .menu-card-date {
    color: var(--light-reed);
    font-size: 0.75rem;
    letter-spacing: 0.1em;
  }

  /* Placeholder card */
  .menu-card-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    color: rgba(255,255,255,0.2);
    font-size: 0.75rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
  }

  .menu-card-placeholder svg { opacity: 0.3; }

  /* ─── INFOS ─── */
  .infos {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6rem;
    background: var(--warm-white);
    align-items: start;
  }

  .infos-block { margin-bottom: 2.5rem; }

  .infos-block h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    margin-bottom: 0.8rem;
    color: var(--deep-sea);
    letter-spacing: 0.05em;
  }

  .infos-block p, .infos-block a {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.1rem;
    color: var(--reed);
    line-height: 1.8;
    text-decoration: none;
    display: block;
  }

  .infos-block a:hover { color: var(--flamingo); }

  .map-placeholder {
    width: 100%;
    aspect-ratio: 4/3;
    overflow: hidden;
    position: relative;
  }
  .map-placeholder iframe {
    width: 100%;
    height: 100%;
    border: none;
    display: block;
  }

  /* ─── FOOTER ─── */
  footer {
    background: var(--deep-sea);
    padding: 3rem 4rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid rgba(255,255,255,0.06);
  }

  .footer-logo {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 1.2rem;
    color: var(--sand);
  }

  .footer-copy {
    font-size: 0.72rem;
    color: var(--reed);
    letter-spacing: 0.1em;
  }

  /* ─── MODAL LIGHTBOX ─── */
  .modal-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(10,20,28,0.95);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 2rem;
  }

  .modal-overlay.open { display: flex; }

  .modal-inner {
    max-width: 700px;
    max-height: 90vh;
    position: relative;
  }

  .modal-inner img {
    max-width: 100%;
    max-height: 85vh;
    object-fit: contain;
    display: block;
    border: 1px solid rgba(255,255,255,0.08);
  }

  .modal-close {
    position: absolute;
    top: -3rem; right: 0;
    background: none;
    border: none;
    color: var(--light-reed);
    font-size: 1.5rem;
    cursor: pointer;
    letter-spacing: 0.1em;
    font-family: 'DM Sans', sans-serif;
  }

  /* ─── ADMIN PANEL ─── */
    /* ─── LOGIN MODAL ─── */
  .login-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(10,20,28,0.97);
    z-index: 1100;
    align-items: center;
    justify-content: center;
  }
  .login-overlay.open { display: flex; }
  .login-box {
    background: var(--deep-sea);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 3rem;
    width: 100%;
    max-width: 380px;
  }
  .login-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    color: var(--sand);
    margin-bottom: 0.5rem;
  }
  .login-subtitle {
    font-size: 0.75rem;
    letter-spacing: 0.1em;
    color: var(--reed);
    margin-bottom: 2rem;
  }
  .login-field {
    margin-bottom: 1.2rem;
  }
  .login-field label {
    display: block;
    font-size: 0.7rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--light-reed);
    margin-bottom: 0.5rem;
  }
  .login-field input {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.12);
    color: var(--sand);
    padding: 0.8rem 1rem;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    outline: none;
    transition: border-color 0.2s;
  }
  .login-field input:focus { border-color: var(--flamingo); }
  .login-error {
    color: #e74c3c;
    font-size: 0.78rem;
    margin-bottom: 1rem;
    display: none;
  }
  .login-error.show { display: block; }
  .btn-login {
    width: 100%;
    background: var(--flamingo);
    color: white;
    border: none;
    padding: 0.9rem;
    cursor: pointer;
    font-size: 0.78rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    font-family: 'DM Sans', sans-serif;
    transition: background 0.3s;
    margin-top: 0.5rem;
  }
  .btn-login:hover { background: #a84f3a; }
  .login-cancel {
    display: block;
    text-align: center;
    margin-top: 1rem;
    font-size: 0.72rem;
    color: var(--reed);
    cursor: pointer;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    background: none;
    border: none;
    width: 100%;
    font-family: 'DM Sans', sans-serif;
  }
  .login-cancel:hover { color: var(--light-reed); }

  /* ─── FUSION MENUS + GALERIE ─── */
  .fusion-section {
    background: var(--deep-sea);
    padding: 5rem 4rem;
  }
  .fusion-inner {
    display: grid;
    grid-template-columns: 1fr 1px 1fr;
    gap: 0 4rem;
    align-items: stretch;
    max-width: 1400px;
    margin: 0 auto;
  }
  .fusion-divider {
    background: linear-gradient(to bottom, transparent, rgba(201,169,110,0.25) 30%, rgba(201,169,110,0.25) 70%, transparent);
    align-self: stretch;
  }
  .fusion-col-header {
    margin-bottom: 2.5rem;
  }
  .fusion-section .section-title   { color: var(--sand); }
  .fusion-section .section-eyebrow { color: var(--flamingo); }

  /* Carousel (dans fusion) */
  .fusion-carousel-col {
    display: flex;
    flex-direction: column;
  }
  .carousel-wrap {
    position: relative;
    overflow: hidden;
    user-select: none;
    border: 1px solid rgba(255,255,255,0.06);
    flex: 1;
  }
  .carousel-track {
    display: flex;
    height: 100%;
    transition: transform 0.7s cubic-bezier(.77,0,.175,1);
  }
  .carousel-slide {
    flex: 0 0 100%;
    box-sizing: border-box;
    min-height: 0;
  }
  .carousel-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: opacity 0.5s;
  }
  .carousel-empty {
    text-align: center;
    padding: 4rem 2rem;
    color: rgba(255,255,255,0.2);
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.1rem;
    font-style: italic;
    aspect-ratio: 4/3;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .carousel-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    margin-top: 1.25rem;
  }
  .carousel-btn {
    background: none;
    border: 1px solid rgba(255,255,255,0.2);
    color: var(--light-reed);
    width: 42px; height: 42px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .carousel-btn:hover {
    border-color: var(--flamingo);
    color: var(--flamingo);
  }
  .carousel-dots {
    display: flex;
    gap: 0.5rem;
    align-items: center;
  }
  .carousel-dot {
    width: 6px; height: 6px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    cursor: pointer;
    border: none;
    transition: all 0.3s;
    padding: 0;
  }
  .carousel-dot.active {
    background: var(--flamingo);
    width: 20px;
    border-radius: 3px;
  }
  .carousel-counter {
    font-size: 0.72rem;
    letter-spacing: 0.15em;
    color: var(--reed);
    min-width: 50px;
    text-align: center;
  }
  @media (max-width: 900px) {
    .fusion-inner {
      grid-template-columns: 1fr;
    }
    .fusion-divider { display: none; }
    .fusion-section { padding: 4rem 1.5rem; }
  }

  /* ─── ADMIN TABS ─── */
  .admin-tabs {
    display: flex;
    gap: 0;
    margin-bottom: 2.5rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  .admin-tab {
    background: none;
    border: none;
    color: var(--reed);
    padding: 0.8rem 2rem;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.78rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    transition: all 0.2s;
    border-bottom: 2px solid transparent;
    margin-bottom: -1px;
  }
  .admin-tab.active {
    color: var(--sand);
    border-bottom-color: var(--flamingo);
  }
  .admin-tab-content { display: none; }
  .admin-tab-content.active { display: block; }

  /* ─── SLOT CARDS (6 fixed) ─── */
  .menus-grid-6 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
  }
  @media (max-width: 768px) {
    .menus-grid-6 { grid-template-columns: repeat(2, 1fr); }
    .slideshow-section { padding: 4rem 1.5rem; }
  }
  @media (max-width: 400px) {
    .menus-grid-6 { grid-template-columns: 1fr; }
  }
  .slot-card-admin {
    position: relative;
    background: rgba(255,255,255,0.04);
    border: 1px dashed rgba(255,255,255,0.15);
    aspect-ratio: 3/4;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.3s;
  }
  .slot-card-admin.filled {
    border-style: solid;
    border-color: rgba(255,255,255,0.08);
  }
  .slot-card-admin:hover { border-color: var(--flamingo); }
  .slot-card-admin img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
  }
  .slot-card-admin .slot-empty {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    height: 100%;
    color: rgba(255,255,255,0.2);
    gap: 0.8rem;
    font-size: 0.72rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
  }
  .slot-card-admin .slot-num {
    position: absolute; top: 0.6rem; left: 0.8rem;
    font-size: 0.65rem; color: rgba(255,255,255,0.25);
    letter-spacing: 0.1em;
  }
  .slot-card-admin .slot-del {
    position: absolute; top: 0.5rem; right: 0.5rem;
    background: rgba(231,76,60,0.8);
    color: white; border: none;
    width: 26px; height: 26px;
    cursor: pointer; font-size: 0.9rem;
    display: flex; align-items: center; justify-content: center;
    border-radius: 2px;
    opacity: 0; transition: opacity 0.2s;
  }
  .slot-card-admin.filled:hover .slot-del { opacity: 1; }
  .hidden-input { display: none; }
</style>
</head>
<body>

<!-- ─── HERO ─── -->
<section class="hero" id="accueil">
  <div class="hero-bg"></div>
  <svg class="hero-waves" viewBox="0 0 1440 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
    <path d="M0,100 C360,160 720,40 1080,100 C1260,130 1380,90 1440,80 L1440,200 L0,200Z" fill="#2B5672"/>
    <path d="M0,130 C300,80 700,150 1100,120 C1300,105 1400,135 1440,140 L1440,200 L0,200Z" fill="#1A3040" opacity="0.7"/>
  </svg>

  <nav>
    <div class="nav-logo">Le Bistrot du Port</div>
    <ul class="nav-links">
      <li><a href="#accueil">Accueil</a></li>
      <li><a href="#ambiance">L'Adresse</a></li>
      <li><a href="#galerie">Galerie</a></li>
      <li><a href="#menus">Nos Menus</a></li>
      <li><a href="#infos">Infos</a></li>
      <li><a href="https://www.facebook.com/p/Le-Bistrot-du-Port-100063733831736/?locale=fr_FR" target="_blank" rel="noopener" title="Facebook" style="display:flex;align-items:center;"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a></li>
      <li><a href="https://www.instagram.com/lebistrotduportportcamargue/" target="_blank" rel="noopener" title="Instagram" style="display:flex;align-items:center;"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></a></li>
    </ul>
    <a href="tel:+33466530903" style="font-family:'DM Sans',sans-serif;font-size:0.72rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--flamingo);border:1px solid var(--flamingo);padding:0.6rem 1.4rem;text-decoration:none;transition:all 0.3s;white-space:nowrap;" onmouseover="this.style.background='#C4614A';this.style.color='white'" onmouseout="this.style.background='transparent';this.style.color='var(--flamingo)'">Réserver</a>
  </nav>

  <div class="hero-content">
    <div class="hero-tag">Port de Camargue · 13 Quai Lapeyrouse</div>
    <h1 class="hero-title">Le goût<br>de <em>la mer</em><br>et des marais</h1>
    <p class="hero-sub">Sur le port, face aux voiliers, une table qui célèbre les saveurs de la Méditerranée et de la Camargue.</p>
    <a href="#menus" class="hero-cta">Découvrir nos menus</a>
  </div>

  <div class="hero-scroll">Défiler</div>
</section>

<!-- ─── AMBIANCE ─── -->
<section class="ambiance" id="ambiance">
  <div class="ambiance-text">
    <div class="section-eyebrow">L'Adresse</div>
    <h2 class="section-title">Un bistrot ancré dans son territoire</h2>
    <p>Au cœur du <strong>premier port de plaisance d'Europe</strong>, entre les étangs et la Méditerranée, notre cuisine célèbre les trésors d'un terroir unique — parrillada de poissons, rouille de poulpe, gardiane de taureau et tellines fraîches.</p>
    <p>Terrasse ombragée face aux voiliers l'été, véranda chauffée face au port l'hiver — chaque assiette est une invitation à ralentir, à sentir le vent du large, à retrouver le goût vrai des choses simples et belles.</p>
    
    <!-- Structured Information -->
    <div style="margin-top: 3rem; padding: 2rem; background: rgba(184,145,58,0.08); border-left: 3px solid var(--gold);">
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin-bottom: 0;">
        <div>
          <div style="font-family:'Playfair Display',serif; font-size: 0.9rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--gold); margin-bottom: 1rem;">📍 Où nous trouver</div>
          <p style="font-size: 0.95rem; line-height: 1.8; color: var(--deep-sea);">
            <strong>Le Bistrot du Port</strong><br>
            13 Quai Lapeyrouse<br>
            Port de Camargue<br>
            30240 Le Grau-du-Roi<br>
            <span style="font-size: 0.9rem; color: var(--reed);">Gard, Occitanie</span>
          </p>
        </div>
        <div>
          <div style="font-family:'Playfair Display',serif; font-size: 0.9rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--gold); margin-bottom: 1rem;">📞 Nous contacter</div>
          <p style="font-size: 0.95rem; line-height: 1.8; color: var(--deep-sea);">
            <a href="tel:+33466530903" style="color: var(--flamingo); text-decoration: none; font-weight: 500;">04 66 53 09 03</a><br>
            <span style="font-size: 0.85rem; color: var(--reed);">Réservation conseillée</span><br><br>
            <a href="#contact" style="color: var(--sea); text-decoration: underline; font-size: 0.9rem;">✉️ Nous écrire</a>
          </p>
        </div>
      </div>
      
      <!-- Features Grid -->
      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(184,145,58,0.2);">
        <div style="text-align: center;">
          <div style="font-size: 1.8rem; margin-bottom: 0.5rem;">☀️</div>
          <div style="font-family:'Playfair Display',serif; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.5rem;">Terrasse</div>
          <p style="font-size: 0.85rem; color: var(--reed); line-height: 1.5;">Vue port, ombragée, face aux voiliers</p>
        </div>
        <div style="text-align: center;">
          <div style="font-size: 1.8rem; margin-bottom: 0.5rem;">🔥</div>
          <div style="font-family:'Playfair Display',serif; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.5rem;">Véranda</div>
          <p style="font-size: 0.85rem; color: var(--reed); line-height: 1.5;">Chauffée & climatisée toute l'année</p>
        </div>
        <div style="text-align: center;">
          <div style="font-size: 1.8rem; margin-bottom: 0.5rem;">🌊</div>
          <div style="font-family:'Playfair Display',serif; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.5rem;">Ambiance</div>
          <p style="font-size: 0.85rem; color: var(--reed); line-height: 1.5;">Entre port et nature, chic & détendu</p>
        </div>
      </div>
    </div>
  </div>
  <div class="ambiance-visual">
    <div class="ambiance-img-main"><?php if ($bistrot_img_ambiance): ?><img src="<?php echo esc_url($bistrot_img_ambiance); ?>" alt="Terrasse face aux voiliers" loading="lazy"><?php else: ?><div class="ambiance-img-placeholder"></div><?php endif; ?></div>
    <div class="ambiance-caption">Terrasse face aux voiliers</div>
  </div>
</section>

<!-- ─── MENUS + GALERIE (section fusionnée) ─── -->
<section class="fusion-section" id="menus">
  <div class="fusion-inner">

    <!-- Gauche : Cartes & Menus -->
    <div class="fusion-cards-col">
      <div class="fusion-col-header">
        <div class="section-eyebrow">Carte &amp; Menus</div>
        <h2 class="section-title">Nos suggestions du moment</h2>
      </div>
      <div class="menus-grid" id="menus-grid">
        <!-- Rempli par JS -->
      </div>
    </div>

    <!-- Séparateur vertical -->
    <div class="fusion-divider"></div>

    <!-- Droite : Galerie photos plats -->
    <div class="fusion-carousel-col">
      <div class="fusion-col-header">
        <div class="section-eyebrow">Nos plats</div>
        <h2 class="section-title">Une cuisine qui se regarde</h2>
      </div>
      <div class="carousel-wrap" id="carousel-wrap">
        <div class="carousel-track" id="carousel-track">
          <div class="carousel-empty">Aucune photo pour le moment</div>
        </div>
      </div>
      <div class="carousel-controls">
        <button class="carousel-btn" id="carousel-prev" onclick="carouselPrev()">←</button>
        <div class="carousel-dots" id="carousel-dots"></div>
        <span class="carousel-counter" id="carousel-counter"></span>
        <button class="carousel-btn" id="carousel-next" onclick="carouselNext()">→</button>
      </div>
    </div>

  </div>
</section>

<!-- ─── INFOS ─── -->
<section class="infos" id="infos">
  <div>
    <div class="section-eyebrow">Informations</div>
    <h2 class="section-title">Nous trouver</h2>

    <div class="infos-block">
      <h3>Adresse</h3>
      <p>13 Quai Lapeyrouse<br>Port de Camargue<br>30240 Le Grau-du-Roi</p>
    </div>

    <div class="infos-block">
      <h3>Horaires</h3>
      <p>Du 15 jan. au 22 déc. — sauf mercredi<br>(7j/7 en juillet &amp; août)<br>12h00 – 14h30 · 19h00 – 22h00</p>
    </div>


    <div style="margin-top:2rem;max-width:55%;position:relative;overflow:hidden;">
      <?php if ($bistrot_img_infos): ?><img src="<?php echo esc_url($bistrot_img_infos); ?>" alt="Le Bistrot du Port" loading="lazy" style="width:100%;display:block;"><?php else: ?><div style="width:100%;aspect-ratio:4/3;background:rgba(26,48,64,0.1);display:flex;align-items:center;justify-content:center;color:rgba(26,48,64,0.2);font-family:Cormorant Garamond,serif;font-style:italic;">Photo à venir</div><?php endif; ?>
      <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(26,48,64,0.85),transparent);padding:0.8rem 1rem;font-family:'Playfair Display',serif;font-style:italic;color:#E8DCC8;font-size:0.85rem;">Notre équipe vous accueille</div>
    </div>
    <div class="infos-block">
      <h3>Réservations</h3>
      <a href="tel:+33466530903">04 66 53 09 03</a>
      <a href="/cdn-cgi/l/email-protection#39555c5b504a4d4b564d5d4c49564b4d795e54585055175a5654"><span class="__cf_email__" data-cfemail="9cf0f9fef5efe8eef3e8f8e9ecf3eee8dcfbf1fdf5f0b2fff3f1">[email&#160;protected]</span></a>
    </div>
  </div>

  <div class="map-placeholder">
  <iframe
    src="https://maps.google.com/maps?q=43.52007,4.13473&z=16&output=embed"
    allowfullscreen
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    title="Le Bistrot du Port — 13 Quai Lapeyrouse, Port Camargue">
  </iframe>
</div>
</section>

<!-- ─── FOOTER ─── -->

<section style="background:var(--warm-white);padding:5rem 4rem;border-top:1px solid rgba(26,48,64,0.08);">
  <div class="section-eyebrow">Tripadvisor · 594 avis</div>
  <h2 class="section-title" style="margin-bottom:3rem;">Ils nous font confiance</h2>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:2rem;max-width:1100px;">
    <div style="background:var(--salt);padding:2rem;border-left:2px solid var(--flamingo);">
      <div style="color:#B8913A;margin-bottom:0.8rem;">★★★★★</div>
      <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:var(--reed);line-height:1.7;font-style:italic;">"Accueil excellent par du personnel très compétent. Les plats sont élaborés avec des produits frais et copieux. Clients depuis 2008, cette table est toujours à retenir."</p>
      <div style="margin-top:1rem;font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--light-reed);">— Tripadvisor</div>
    </div>
    <div style="background:var(--salt);padding:2rem;border-left:2px solid var(--flamingo);">
      <div style="color:#B8913A;margin-bottom:0.8rem;">★★★★★</div>
      <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:var(--reed);line-height:1.7;font-style:italic;">"Bel endroit au bord de l'eau, serveurs très sympathiques. Très bien mangé à l'ombre des arbres. Une très bonne adresse que nous allons garder."</p>
      <div style="margin-top:1rem;font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--light-reed);">— Tripadvisor</div>
    </div>
    <div style="background:var(--salt);padding:2rem;border-left:2px solid var(--flamingo);">
      <div style="color:#B8913A;margin-bottom:0.8rem;">★★★★★</div>
      <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:var(--reed);line-height:1.7;font-style:italic;">"Les meilleures parilladas du Grau-du-Roi. Staff au top, souriant et efficace. Une valeur sûre de Port Camargue."</p>
      <div style="margin-top:1rem;font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--light-reed);">— Tripadvisor</div>
    </div>
    <div style="background:var(--salt);padding:2rem;border-left:2px solid var(--flamingo);">
      <div style="color:#B8913A;margin-bottom:0.8rem;">★★★★★</div>
      <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:var(--reed);line-height:1.7;font-style:italic;">"Service parfait, cuisine variée, l'adresse absolument à faire à Port Camargue. Un endroit très agréable qui sent bon la détente."</p>
      <div style="margin-top:1rem;font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--light-reed);">— Tripadvisor</div>
    </div>
  </div>
  <a href="https://www.tripadvisor.fr/Restaurant_Review-g608789-d3382808-Reviews-Le_Bistrot_du_Port-Port_Camargue_Le_Grau_du_Roi_Gard_Occitanie.html" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:0.8rem;margin-top:2.5rem;color:var(--flamingo);text-decoration:none;font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;border-bottom:1px solid var(--flamingo);padding-bottom:0.2rem;">Voir les 594 avis sur Tripadvisor</a>
</section><footer style="flex-wrap:wrap;">
  <div class="footer-logo">Le Bistrot du Port</div>
  <div style="display:flex;align-items:center;gap:1.5rem;">
    <a href="https://www.facebook.com/p/Le-Bistrot-du-Port-100063733831736/?locale=fr_FR" target="_blank" rel="noopener" style="color:var(--light-reed);text-decoration:none;display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;letter-spacing:0.1em;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>Facebook
    </a>
    <a href="https://www.instagram.com/lebistrotduportportcamargue/" target="_blank" rel="noopener" style="color:var(--light-reed);text-decoration:none;display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;letter-spacing:0.1em;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>Instagram
    </a>
  </div>
  <div class="footer-copy">13 Quai Lapeyrouse · Port de Camargue · 04 66 53 09 03 · © 2025</div>
</footer>

<!-- ─── ADMIN TOGGLE ─── -->



<!-- ─── ADMIN PANEL ─── -->


  <!-- TAB: SLIDESHOW -->
  
  </div>
</div>

<!-- ─── MODAL LIGHTBOX ─── -->
<div class="modal-overlay" id="modal" onclick="closeModal()">
  <div class="modal-inner" onclick="event.stopPropagation()">
    <button class="modal-close" onclick="closeModal()">✕ Fermer</button>
    <img id="modal-img" src="" alt="Menu">
  </div>
</div>

<!-- ─── TOAST ─── -->
<div class="toast" id="toast"></div>

<script>

let slots  = Array(6).fill(null);
let slides = [];
let slideshowIndex = 0;
let slideshowTimer = null;

// ── CARTES MENUS (6 slots) ──
function renderPublicMenus() {
  const grid = document.getElementById('menus-grid');
  const filled = slots.filter(Boolean);
  if (filled.length === 0) {
    grid.innerHTML = `<div class="menu-card menu-card-placeholder" style="grid-column:1/-1;padding:4rem;border:1px dashed rgba(255,255,255,0.1);">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="1"/><path d="M3 9h18M9 21V9"/></svg>
      <span style="letter-spacing:.15em;text-transform:uppercase;">Aucun menu publié pour le moment</span>
    </div>`;
    return;
  }
  grid.innerHTML = slots.map((s, i) => {
    if (!s) return '';
    return `<div class="menu-card" onclick="openModal('${s.id}')">
      <img src="${s.url || s.dataUrl || ''}" alt="${s.name}" loading="lazy">
      <div class="menu-card-overlay">
        <div class="menu-card-label">${s.name}</div>
        <div class="menu-card-hint">Cliquer pour agrandir</div>
      </div>
    </div>`;
  }).join('');
}

// ── CARROUSEL ──
function renderSlideshow() {
  const track   = document.getElementById('carousel-track');
  const dotsEl  = document.getElementById('carousel-dots');
  const counter = document.getElementById('carousel-counter');
  clearInterval(slideshowTimer);

  if (!slides || slides.length === 0) {
    track.innerHTML = '<div class="carousel-empty">Aucune photo pour le moment</div>';
    dotsEl.innerHTML = '';
    counter.textContent = '';
    return;
  }

  track.innerHTML = slides.map((s, i) =>
    `<div class="carousel-slide${i === 0 ? ' active' : ''}">
      <img src="${s.url || s.dataUrl || ''}" alt="${s.name}" loading="lazy">
    </div>`
  ).join('');

  dotsEl.innerHTML = slides.map((_, i) =>
    `<button class="carousel-dot${i === 0 ? ' active' : ''}" onclick="goToSlide(${i})"></button>`
  ).join('');

  slideshowIndex = 0;
  updateCarousel();

  if (slides.length > 1) {
    slideshowTimer = setInterval(() => carouselNext(), 8000);
  }
}

function updateCarousel() {
  const track   = document.getElementById('carousel-track');
  const dotsEl  = document.getElementById('carousel-dots');
  const counter = document.getElementById('carousel-counter');
  const allSlides = track ? track.querySelectorAll('.carousel-slide') : [];
  if (!allSlides.length) return;

  track.style.transform = `translateX(-${slideshowIndex * 100}%)`;

  allSlides.forEach((s, i) => s.classList.toggle('active', i === slideshowIndex));
  if (dotsEl) dotsEl.querySelectorAll('.carousel-dot').forEach((d, i) => d.classList.toggle('active', i === slideshowIndex));
  if (counter && slides.length > 0) counter.textContent = (slideshowIndex + 1) + ' / ' + slides.length;
}

function goToSlide(idx) {
  slideshowIndex = Math.max(0, Math.min(idx, slides.length - 1));
  updateCarousel();
  clearInterval(slideshowTimer);
  if (slides.length > 1) slideshowTimer = setInterval(() => carouselNext(), 8000);
}

function carouselNext() { goToSlide((slideshowIndex + 1) % slides.length); }
function carouselPrev() { goToSlide((slideshowIndex - 1 + slides.length) % slides.length); }

// Swipe tactile
(function() {
  var startX = 0;
  var wrap = document.getElementById('carousel-wrap');
  if (!wrap) return;
  wrap.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, {passive:true});
  wrap.addEventListener('touchend',   e => {
    var dx = e.changedTouches[0].clientX - startX;
    if (Math.abs(dx) > 40) dx < 0 ? carouselNext() : carouselPrev();
  }, {passive:true});
})();

window.addEventListener('resize', updateCarousel);

// ── LIGHTBOX ──
function openModal(id) {
  const s = slots.find(s => s && s.id == id);
  if (!s) return;
  document.getElementById('modal-img').src = s.url || s.dataUrl || '';
  document.getElementById('modal').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeModal() {
  document.getElementById('modal').classList.remove('open');
  document.body.style.overflow = '';
}

// Données chargées directement depuis WordPress (pas de fetch nécessaire)
slots  = <?php echo json_encode($bistrot_slots); ?> || Array(6).fill(null);
slides = <?php echo json_encode($bistrot_slides); ?> || [];
renderPublicMenus();
renderSlideshow();
</script>
</body>
</html>