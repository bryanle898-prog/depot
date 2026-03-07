<?php
/**
 * Plugin Name: Bistrot du Port — Admin
 * Description: Gestion des 6 cartes menus et du diaporama de plats
 * Version: 1.0
 * Author: Le Bistrot du Port
 */

if (!defined('ABSPATH')) exit;

// ── MENU ADMIN WORDPRESS ──────────────────────────────────────────────────────
add_action('admin_menu', function () {
    add_menu_page(
        'Bistrot du Port',
        'Bistrot du Port',
        'manage_options',
        'bistrot-admin',
        'bistrot_render_page',
        'dashicons-store',
        30
    );
});

// ── CHARGEMENT DES SCRIPTS MEDIA ─────────────────────────────────────────────
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'toplevel_page_bistrot-admin') return;
    wp_enqueue_media();
});

// ── PAGE ADMIN ────────────────────────────────────────────────────────────────
function bistrot_render_page() {
    $slots  = get_option('bistrot_slots',  array_fill(0, 6, null));
    $slides = get_option('bistrot_slides', []);
    ?>
    <div class="wrap">
        <h1 style="font-family:Georgia,serif;margin-bottom:1.5rem;">🍽️ Bistrot du Port — Gestion du site</h1>

        <?php if (isset($_GET['saved'])) : ?>
            <div class="notice notice-success is-dismissible"><p>✅ Modifications enregistrées et publiées !</p></div>
        <?php endif; ?>

        <!-- ONGLETS -->
        <nav class="nav-tab-wrapper" style="margin-bottom:2rem;">
            <a href="#tab-menus"    class="nav-tab nav-tab-active" onclick="showTab('menus',this)">6 Cartes Menus</a>
            <a href="#tab-slides"   class="nav-tab"                onclick="showTab('slides',this)">Diaporama Plats</a>
        </nav>

        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <?php wp_nonce_field('bistrot_save', 'bistrot_nonce'); ?>
            <input type="hidden" name="action" value="bistrot_save">

            <!-- ── TAB : 6 CARTES ── -->
            <div id="tab-menus" class="bistrot-tab">
                <p style="color:#666;margin-bottom:1.5rem;">Cliquez sur <strong>Choisir une image</strong> pour chaque emplacement. 6 cartes maximum.</p>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;max-width:900px;">
                    <?php for ($i = 0; $i < 6; $i++) :
                        $slot = isset($slots[$i]) ? $slots[$i] : null;
                        $url  = $slot ? $slot['url']  : '';
                        $id   = $slot ? $slot['id']   : '';
                        $name = $slot ? $slot['name'] : '';
                    ?>
                    <div style="background:#f9f9f9;border:1px solid #ddd;padding:1rem;border-radius:4px;">
                        <div style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.08em;color:#888;margin-bottom:.8rem;">Carte <?= $i + 1 ?></div>
                        <?php if ($url) : ?>
                            <img src="<?= esc_url($url) ?>" style="width:100%;aspect-ratio:3/4;object-fit:cover;display:block;margin-bottom:.8rem;border-radius:2px;">
                        <?php else : ?>
                            <div style="width:100%;aspect-ratio:3/4;background:#eee;display:flex;align-items:center;justify-content:center;margin-bottom:.8rem;border-radius:2px;color:#bbb;font-size:.85rem;">Vide</div>
                        <?php endif; ?>
                        <input type="hidden" name="slots[<?= $i ?>][id]"   value="<?= esc_attr($id) ?>"   class="slot-id-<?= $i ?>">
                        <input type="hidden" name="slots[<?= $i ?>][url]"  value="<?= esc_attr($url) ?>"  class="slot-url-<?= $i ?>">
                        <input type="hidden" name="slots[<?= $i ?>][name]" value="<?= esc_attr($name) ?>" class="slot-name-<?= $i ?>">
                        <div style="display:flex;gap:.5rem;">
                            <button type="button" class="button button-secondary bistrot-media-btn" data-slot="<?= $i ?>" style="flex:1;">
                                <?= $url ? '🔄 Remplacer' : '+ Choisir' ?>
                            </button>
                            <?php if ($url) : ?>
                            <button type="button" class="button bistrot-clear-btn" data-slot="<?= $i ?>" style="color:#c00;">✕</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- ── TAB : DIAPORAMA ── -->
            <div id="tab-slides" class="bistrot-tab" style="display:none;">
                <p style="color:#666;margin-bottom:1.5rem;">Ajoutez des photos de plats pour le diaporama (défilement toutes les 8 secondes).</p>
                <button type="button" class="button button-primary" id="bistrot-add-slide" style="margin-bottom:1.5rem;">+ Ajouter des photos</button>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem;max-width:900px;" id="slides-container">
                    <?php foreach ($slides as $idx => $slide) : ?>
                    <div class="slide-item" data-idx="<?= $idx ?>" style="position:relative;background:#f9f9f9;border:1px solid #ddd;border-radius:4px;overflow:hidden;">
                        <img src="<?= esc_url($slide['url']) ?>" style="width:100%;aspect-ratio:16/9;object-fit:cover;display:block;">
                        <div style="padding:.5rem;font-size:.72rem;color:#666;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= esc_html($slide['name']) ?></div>
                        <button type="button" class="bistrot-remove-slide" data-idx="<?= $idx ?>" style="position:absolute;top:.3rem;right:.3rem;background:rgba(200,0,0,.85);color:#fff;border:none;border-radius:2px;width:22px;height:22px;cursor:pointer;font-size:1rem;line-height:1;">✕</button>
                        <input type="hidden" name="slides[<?= $idx ?>][id]"   value="<?= esc_attr($slide['id']) ?>">
                        <input type="hidden" name="slides[<?= $idx ?>][url]"  value="<?= esc_attr($slide['url']) ?>">
                        <input type="hidden" name="slides[<?= $idx ?>][name]" value="<?= esc_attr($slide['name']) ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <div id="no-slides" style="<?= count($slides) ? 'display:none' : '' ?>;color:#999;font-style:italic;margin-top:1rem;">Aucune photo ajoutée.</div>
            </div>

            <div style="margin-top:2.5rem;">
                <?php submit_button('💾 Enregistrer & publier', 'primary large'); ?>
            </div>
        </form>
    </div>

    <script>
    jQuery(function($) {

        // ── Onglets ──
        window.showTab = function(name, el) {
            $('.bistrot-tab').hide();
            $('#tab-' + name).show();
            $('.nav-tab').removeClass('nav-tab-active');
            $(el).addClass('nav-tab-active');
            return false;
        };

        // ── Médiathèque : cartes ──
        var mediaUploader;
        $(document).on('click', '.bistrot-media-btn', function() {
            var slot = $(this).data('slot');
            var btn  = $(this);
            var uploader = wp.media({
                title: 'Choisir une image',
                button: { text: 'Utiliser cette image' },
                multiple: false
            });
            uploader.on('select', function() {
                var att = uploader.state().get('selection').first().toJSON();
                $('.slot-id-'   + slot).val(att.id);
                $('.slot-url-'  + slot).val(att.url);
                $('.slot-name-' + slot).val(att.title);
                // Afficher l'aperçu sans recharger
                var container = btn.closest('div[style]');
                container.find('img').remove();
                container.find('div[style*="aspect-ratio"]').remove();
                $('<img>').attr('src', att.url).css({width:'100%','aspect-ratio':'3/4','object-fit':'cover',display:'block','margin-bottom':'.8rem','border-radius':'2px'}).prependTo(container);
                btn.text('🔄 Remplacer');
            });
            uploader.open();
        });

        // ── Vider une carte ──
        $(document).on('click', '.bistrot-clear-btn', function() {
            var slot = $(this).data('slot');
            $('.slot-id-'   + slot).val('');
            $('.slot-url-'  + slot).val('');
            $('.slot-name-' + slot).val('');
            $(this).closest('div[style]').find('img').remove();
        });

        // ── Médiathèque : diaporama ──
        var slideUploader;
        $('#bistrot-add-slide').on('click', function() {
            slideUploader = wp.media({
                title: 'Ajouter des photos au diaporama',
                button: { text: 'Ajouter' },
                multiple: true
            });
            slideUploader.on('select', function() {
                var container = $('#slides-container');
                var selection = slideUploader.state().get('selection');
                $('#no-slides').hide();
                selection.each(function(att) {
                    var idx = container.children('.slide-item').length;
                    container.append(
                        '<div class="slide-item" data-idx="' + idx + '" style="position:relative;background:#f9f9f9;border:1px solid #ddd;border-radius:4px;overflow:hidden;">' +
                        '<img src="' + att.get('url') + '" style="width:100%;aspect-ratio:16/9;object-fit:cover;display:block;">' +
                        '<div style="padding:.5rem;font-size:.72rem;color:#666;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' + att.get('title') + '</div>' +
                        '<button type="button" class="bistrot-remove-slide" data-idx="' + idx + '" style="position:absolute;top:.3rem;right:.3rem;background:rgba(200,0,0,.85);color:#fff;border:none;border-radius:2px;width:22px;height:22px;cursor:pointer;font-size:1rem;line-height:1;">✕</button>' +
                        '<input type="hidden" name="slides[' + idx + '][id]"   value="' + att.get('id')    + '">' +
                        '<input type="hidden" name="slides[' + idx + '][url]"  value="' + att.get('url')   + '">' +
                        '<input type="hidden" name="slides[' + idx + '][name]" value="' + att.get('title') + '">' +
                        '</div>'
                    );
                });
            });
            slideUploader.open();
        });

        // ── Supprimer slide ──
        $(document).on('click', '.bistrot-remove-slide', function() {
            $(this).closest('.slide-item').remove();
            if ($('#slides-container .slide-item').length === 0) $('#no-slides').show();
        });
    });
    </script>
    <?php
}

// ── SAUVEGARDE ───────────────────────────────────────────────────────────────
add_action('admin_post_bistrot_save', function () {
    if (!check_admin_referer('bistrot_save', 'bistrot_nonce')) wp_die('Sécurité : token invalide');
    if (!current_user_can('manage_options')) wp_die('Accès refusé');

    $raw_slots = isset($_POST['slots']) ? $_POST['slots'] : [];
    $slots = [];
    for ($i = 0; $i < 6; $i++) {
        $url = isset($raw_slots[$i]['url']) ? sanitize_url($raw_slots[$i]['url']) : '';
        $slots[$i] = $url ? [
            'id'   => intval($raw_slots[$i]['id'] ?? 0),
            'url'  => $url,
            'name' => sanitize_text_field($raw_slots[$i]['name'] ?? ''),
            'date' => current_time('d/m/Y'),
        ] : null;
    }

    $raw_slides = isset($_POST['slides']) ? $_POST['slides'] : [];
    $slides = [];
    foreach ($raw_slides as $s) {
        $url = isset($s['url']) ? sanitize_url($s['url']) : '';
        if ($url) {
            $slides[] = [
                'id'   => intval($s['id'] ?? 0),
                'url'  => $url,
                'name' => sanitize_text_field($s['name'] ?? ''),
            ];
        }
    }

    update_option('bistrot_slots',  $slots);
    update_option('bistrot_slides', $slides);

    wp_redirect(admin_url('admin.php?page=bistrot-admin&saved=1'));
    exit;
});

// ── API REST (lecture par le site HTML) ──────────────────────────────────────
add_action('rest_api_init', function () {
    register_rest_route('bistrot/v1', '/data', [
        'methods'             => 'GET',
        'callback'            => function () {
            return rest_ensure_response([
                'slots'  => get_option('bistrot_slots',  array_fill(0, 6, null)),
                'slides' => get_option('bistrot_slides', []),
            ]);
        },
        'permission_callback' => '__return_true',
    ]);
});
