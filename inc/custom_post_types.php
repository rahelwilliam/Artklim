<?php
// Register Custom Post Type
function register_custom_post_types() {
	/**
     * Post Type: Galeria
     */
    $labels = array(
        'name'                => __( 'Galeria', 'codix' ),
        'singular_name'       => __( 'Galeria', 'codix' ),
        'all_items'           => __( 'Toda a Galeria', 'codix' ),
        'add_new'             => __( 'Adicionar Nova Galeria', 'codix' ),
        'add_new_item'        => __( 'Adicionar Nova Galeria', 'codix' ),
    );
    $rewrite = array(
        'slug'                => 'galeria',
        'with_front'          => true
    );
    $args = array(
        'label'               => __( 'Galeria', 'codix' ),
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_rest'        => false,
        'rest_base'           => '',
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'capability_type'     => 'post',
        'menu_position'       => 5,
        'map_meta_cap'        => true,
        'hierarchical'        => false,
        'rewrite'             => $rewrite,
        'query_var'           => true,
        'menu_icon'           => 'dashicons-image-filter',
        'supports'            => array( 'title', 'editor','thumbnail' ),
    );
    register_post_type( 'galeria', $args );

    // flush_rewrite_rules();

    /**
     * Post Type: Documentação
     */
    $labels = array(
        'name' => _x('Documentações', 'nome do post no geral', 'codix'),
        'singular_name' => _x('Documentação', 'nome do post no singular', 'codix'),
        'menu_name' => _x('Documentação', 'nome do post no menu', 'codix'),
        'add_new' => __('Adicionar nova', 'codix'),
        'add_new_item' => __('Adicionar nova documentação', 'codix'),
        'new_item' => __('Nova documentação', 'codix'),
        'edit_item' => __('Editar documentação', 'codix'),
        'view_item' => __('Ver documentação', 'codix'),
        'all_items' => __('Documentações', 'codix')
    );
    $rewrite = array(
        'slug'                => 'docs'
    );
    $args = array(
        'label'               => __( 'Documentação', 'codix' ),
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_rest'        => true,
        'exclude_from_search' => true,
        'capatibility_type'     => 'post',
        'menu_position'       => 6,
        'hierarchical'        => false,
        'rewrite'             => $rewrite,
        'query_var'           => true,
        'menu_icon'           => 'dashicons-info',
        'supports'            => array( 'title', 'editor','thumbnail', 'excerpt' ),
        'has_archive'           => true
    );
    register_post_type( 'docs', $args );

    // flush_rewrite_rules();
}
add_action( 'init', 'register_custom_post_types' );



/**
 * Registrar Custom Post Type para Leads
 */
add_action('init', 'codix_register_lead_cpt');
function codix_register_lead_cpt() {
    $labels = array(
        'name'               => 'Leads',
        'singular_name'      => 'Lead',
        'menu_name'          => 'Leads',
        'name_admin_bar'     => 'Lead',
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo Lead',
        'new_item'           => 'Novo Lead',
        'edit_item'          => 'Editar Lead',
        'view_item'          => 'Ver Lead',
        'all_items'          => 'Todos os Leads',
        'search_items'       => 'Buscar Leads',
        'parent_item_colon'  => 'Lead Pai:',
        'not_found'          => 'Nenhum lead encontrado.',
        'not_found_in_trash' => 'Nenhum lead na lixeira.'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => false, // Não é público
        'publicly_queryable'  => false, // Não pode ser consultado publicamente
        'show_ui'            => true, // Mostrar no admin
        'show_in_menu'       => true, // Mostrar no menu admin
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-id', // Ícone
        'supports'           => array('title', 'custom-fields'),
        'show_in_rest'       => false,
    );

    register_post_type('lead', $args);
}

/**
 * Adicionar colunas personalizadas na listagem de Leads
 */
add_filter('manage_lead_posts_columns', 'codix_lead_columns');
function codix_lead_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'Nome';
    $new_columns['lead_email'] = 'E-mail';
    $new_columns['lead_phone'] = 'Telefone';
    $new_columns['lead_method'] = 'Método';
    $new_columns['lead_date'] = 'Data/Hora';
    $new_columns['lead_status'] = 'Status';
    return $new_columns;
}

/**
 * Popular as colunas personalizadas
 */
add_action('manage_lead_posts_custom_column', 'codix_lead_custom_column', 10, 2);
function codix_lead_custom_column($column, $post_id) {
    switch ($column) {
        case 'lead_email':
            echo get_post_meta($post_id, '_lead_email', true);
            break;
        case 'lead_phone':
            echo get_post_meta($post_id, '_lead_telefone', true);
            break;
        case 'lead_method':
            $method = get_post_meta($post_id, '_lead_method', true);
            $badge = ($method == 'whatsapp') ? 
                '<span class="badge bg-success">WhatsApp</span>' : 
                '<span class="badge bg-primary">E-mail</span>';
            echo $badge;
            break;
        case 'lead_date':
            echo get_post_meta($post_id, '_lead_data', true);
            break;
        case 'lead_status':
            $contacted = get_post_meta($post_id, '_lead_contacted', true);
            $status = $contacted ? 
                '<span class="badge bg-success">Contatado</span>' : 
                '<span class="badge bg-warning">Pendente</span>';
            echo $status;
            break;
    }
}

/**
 * Tornar colunas ordenáveis
 */
add_filter('manage_edit-lead_sortable_columns', 'codix_lead_sortable_columns');
function codix_lead_sortable_columns($columns) {
    $columns['lead_date'] = 'lead_date';
    $columns['lead_status'] = 'lead_status';
    return $columns;
}

/**
 * Adicionar filtros por método e status
 */
add_action('restrict_manage_posts', 'codix_lead_admin_filters');
function codix_lead_admin_filters($post_type) {
    if ('lead' !== $post_type) {
        return;
    }
    
    // Filtro por método
    $methods = array('whatsapp' => 'WhatsApp', 'email' => 'E-mail');
    $current_method = isset($_GET['lead_method']) ? $_GET['lead_method'] : '';
    ?>
    <select name="lead_method">
        <option value="">Todos os métodos</option>
        <?php foreach ($methods as $value => $label): ?>
            <option value="<?php echo $value; ?>" <?php selected($current_method, $value); ?>>
                <?php echo $label; ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <?php
    // Filtro por status
    $statuses = array('contacted' => 'Contatado', 'pending' => 'Pendente');
    $current_status = isset($_GET['lead_status']) ? $_GET['lead_status'] : '';
    ?>
    <select name="lead_status">
        <option value="">Todos os status</option>
        <?php foreach ($statuses as $value => $label): ?>
            <option value="<?php echo $value; ?>" <?php selected($current_status, $value); ?>>
                <?php echo $label; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php
}

/**
 * Filtrar posts pela query
 */
add_filter('parse_query', 'codix_lead_admin_filter_query');
function codix_lead_admin_filter_query($query) {
    global $pagenow;
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    
    if (is_admin() && $pagenow == 'edit.php' && $post_type == 'lead' && $query->is_main_query()) {
        
        // Filtrar por método
        if (isset($_GET['lead_method']) && $_GET['lead_method'] != '') {
            $meta_query = $query->get('meta_query');
            if (!is_array($meta_query)) {
                $meta_query = array();
            }
            $meta_query[] = array(
                'key' => '_lead_method',
                'value' => $_GET['lead_method'],
                'compare' => '='
            );
            $query->set('meta_query', $meta_query);
        }
        
        // Filtrar por status
        if (isset($_GET['lead_status']) && $_GET['lead_status'] != '') {
            $meta_query = $query->get('meta_query');
            if (!is_array($meta_query)) {
                $meta_query = array();
            }
            
            if ($_GET['lead_status'] == 'contacted') {
                $meta_query[] = array(
                    'key' => '_lead_contacted',
                    'value' => '1',
                    'compare' => '='
                );
            } else {
                $meta_query[] = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_lead_contacted',
                        'compare' => 'NOT EXISTS'
                    ),
                    array(
                        'key' => '_lead_contacted',
                        'value' => '0',
                        'compare' => '='
                    )
                );
            }
            $query->set('meta_query', $meta_query);
        }
    }
}

/**
 * Adicionar meta boxes para detalhes do lead
 */
add_action('add_meta_boxes', 'codix_lead_meta_boxes');
function codix_lead_meta_boxes() {
    add_meta_box(
        'lead_details',
        'Detalhes do Lead',
        'codix_lead_details_meta_box',
        'lead',
        'normal',
        'high'
    );
    
    add_meta_box(
        'lead_actions',
        'Ações',
        'codix_lead_actions_meta_box',
        'lead',
        'side',
        'high'
    );
}

function codix_lead_details_meta_box($post) {
    wp_nonce_field('save_lead_details', 'lead_nonce');
    
    $nome = get_post_meta($post->ID, '_lead_nome', true);
    $email = get_post_meta($post->ID, '_lead_email', true);
    $telefone = get_post_meta($post->ID, '_lead_telefone', true);
    $method = get_post_meta($post->ID, '_lead_method', true);
    $data = get_post_meta($post->ID, '_lead_data', true);
    $ip = get_post_meta($post->ID, '_lead_ip', true);
    $page_url = get_post_meta($post->ID, '_lead_page_url', true);
    $page_title = get_post_meta($post->ID, '_lead_page_title', true);
    $contacted = get_post_meta($post->ID, '_lead_contacted', true);
    $contacted_by = get_post_meta($post->ID, '_lead_contacted_by', true);
    $contacted_date = get_post_meta($post->ID, '_lead_contacted_date', true);
    $notes = get_post_meta($post->ID, '_lead_notes', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th style="width: 150px;">Nome:</th>
            <td><strong><?php echo esc_html($nome); ?></strong></td>
        </tr>
        <tr>
            <th>E-mail:</th>
            <td>
                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                <button type="button" class="button button-small copy-email" data-email="<?php echo esc_attr($email); ?>" style="margin-left: 10px;">
                    Copiar
                </button>
            </td>
        </tr>
        <tr>
            <th>Telefone:</th>
            <td>
                <?php echo esc_html($telefone); ?>
                <?php if ($method == 'whatsapp'): ?>
                    <a href="https://wa.me/55<?php echo preg_replace('/[^\d]/', '', $telefone); ?>" target="_blank" class="button button-small" style="margin-left: 10px;">
                        WhatsApp
                    </a>
                <?php endif; ?>
                <button type="button" class="button button-small copy-phone" data-phone="<?php echo esc_attr($telefone); ?>" style="margin-left: 10px;">
                    Copiar
                </button>
            </td>
        </tr>
        <tr>
            <th>Método:</th>
            <td>
                <?php if ($method == 'whatsapp'): ?>
                    <span class="badge bg-success">WhatsApp</span>
                <?php else: ?>
                    <span class="badge bg-primary">E-mail</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Data/Hora:</th>
            <td><?php echo esc_html($data); ?></td>
        </tr>
        <tr>
            <th>IP:</th>
            <td><?php echo esc_html($ip); ?></td>
        </tr>
        <tr>
            <th>Página:</th>
            <td>
                <?php if ($page_url): ?>
                    <a href="<?php echo esc_url($page_url); ?>" target="_blank"><?php echo esc_html($page_title); ?></a>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                <label>
                    <input type="checkbox" name="lead_contacted" value="1" <?php checked($contacted, '1'); ?>>
                    Lead contatado
                </label>
            </td>
        </tr>
        <tr>
            <th>Contatado por:</th>
            <td>
                <input type="text" name="lead_contacted_by" value="<?php echo esc_attr($contacted_by); ?>" class="regular-text" placeholder="Nome do atendente">
            </td>
        </tr>
        <tr>
            <th>Data do contato:</th>
            <td>
                <input type="datetime-local" name="lead_contacted_date" value="<?php echo esc_attr($contacted_date); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th>Observações:</th>
            <td>
                <textarea name="lead_notes" rows="4" class="large-text"><?php echo esc_textarea($notes); ?></textarea>
            </td>
        </tr>
    </table>
    
    <script>
    jQuery(document).ready(function($) {
        $('.copy-email').click(function() {
            var email = $(this).data('email');
            navigator.clipboard.writeText(email).then(function() {
                alert('E-mail copiado: ' + email);
            });
        });
        
        $('.copy-phone').click(function() {
            var phone = $(this).data('phone');
            navigator.clipboard.writeText(phone).then(function() {
                alert('Telefone copiado: ' + phone);
            });
        });
    });
    </script>
    <?php
}

function codix_lead_actions_meta_box($post) {
    $email = get_post_meta($post->ID, '_lead_email', true);
    $telefone = get_post_meta($post->ID, '_lead_telefone', true);
    $method = get_post_meta($post->ID, '_lead_method', true);
    ?>
    
    <p>
        <a href="mailto:<?php echo esc_attr($email); ?>" class="button button-primary button-large" style="width: 100%; text-align: center; margin-bottom: 5px;">
            <span class="dashicons dashicons-email"></span> Enviar E-mail
        </a>
    </p>
    
    <?php if ($method == 'whatsapp'): ?>
    <p>
        <a href="https://wa.me/55<?php echo preg_replace('/[^\d]/', '', $telefone); ?>" target="_blank" class="button button-success button-large" style="width: 100%; text-align: center; margin-bottom: 5px; background-color: #25D366; border-color: #25D366;">
            <span class="dashicons dashicons-whatsapp"></span> WhatsApp
        </a>
    </p>
    <?php endif; ?>
    
    <p>
        <button type="button" id="delete-lead" class="button button-link-delete" style="color: #d63638; width: 100%; text-align: center;">
            <span class="dashicons dashicons-trash"></span> Excluir Lead
        </button>
    </p>
    
    <script>
    jQuery(document).ready(function($) {
        $('#delete-lead').click(function() {
            if (confirm('Tem certeza que deseja excluir este lead?')) {
                $('#post #delete-action .submitdelete').click();
            }
        });
    });
    </script>
    <?php
}

/**
 * Salvar meta boxes
 */
add_action('save_post_lead', 'codix_save_lead_details');
function codix_save_lead_details($post_id) {
    if (!isset($_POST['lead_nonce']) || !wp_verify_nonce($_POST['lead_nonce'], 'save_lead_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Salvar campos
    $fields = array(
        'lead_contacted' => '_lead_contacted',
        'lead_contacted_by' => '_lead_contacted_by',
        'lead_contacted_date' => '_lead_contacted_date',
        'lead_notes' => '_lead_notes'
    );
    
    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, $meta_key);
        }
    }
    
    // Se foi marcado como contatado, adiciona data atual se não houver
    if (isset($_POST['lead_contacted']) && $_POST['lead_contacted'] == '1') {
        $contacted_date = get_post_meta($post_id, '_lead_contacted_date', true);
        if (empty($contacted_date)) {
            update_post_meta($post_id, '_lead_contacted_date', current_time('mysql'));
        }
        if (empty(get_post_meta($post_id, '_lead_contacted_by', true))) {
            $current_user = wp_get_current_user();
            update_post_meta($post_id, '_lead_contacted_by', $current_user->display_name);
        }
    }
}