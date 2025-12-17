<?php
/**
 * Handler AJAX para processar formulário CTA
 */
add_action('wp_ajax_process_cta_form', 'codix_process_cta_form_ajax');
add_action('wp_ajax_nopriv_process_cta_form', 'codix_process_cta_form_ajax');

function codix_process_cta_form_ajax() {
    // Verificar nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cta_form_ajax_nonce')) {
        wp_send_json_error(array(
            'message' => 'Token de segurança inválido. Recarregue a página e tente novamente.'
        ));
    }
    
    // Validar e sanitizar dados
    $nome = sanitize_text_field($_POST['nome'] ?? '');
    $telefone = sanitize_text_field($_POST['telefone'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $method = sanitize_text_field($_POST['method'] ?? '');
    
    // Validação básica
    if (empty($nome) || empty($telefone) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        wp_send_json_error(array(
            'message' => 'Por favor, preencha todos os campos corretamente.'
        ));
    }
    
    // Formatar telefone
    $telefone_clean = preg_replace('/[^\d]/', '', $telefone);
    
    // Salvar no banco (CPT Leads)
    $lead_id = wp_insert_post([
        'post_title'  => $nome . ' - ' . date('d/m/Y H:i'),
        'post_type'   => 'lead',
        'post_status' => 'publish',
        'meta_input'  => [
            '_lead_nome'       => $nome,
            '_lead_telefone'   => $telefone,
            '_lead_email'      => $email,
            '_lead_method'     => $method,
            '_lead_ip'         => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            '_lead_data'       => current_time('mysql'),
            '_lead_page_url'   => wp_get_referer() ?: home_url(),
            '_lead_page_title' => 'Formulário CTA',
            '_lead_contacted'  => '0'
        ],
    ]);
    
    if (is_wp_error($lead_id)) {
        wp_send_json_error(array(
            'message' => 'Erro ao salvar os dados. Tente novamente.'
        ));
    }
    
    // Preparar resposta - estrutura simplificada
    $response = array(
        'lead_id' => $lead_id,
        'method'  => $method,
        'success' => true
    );
    
    // Processar de acordo com o método
    if ($method === 'email') {
        // Enviar email
        $email_sent = codix_send_cta_email($nome, $telefone, $email);
        
        if ($email_sent) {
            update_post_meta($lead_id, '_lead_email_sent', current_time('mysql'));
            $response['message'] = 'Dados enviados por e-mail com sucesso! Entraremos em contato em breve.';
        } else {
            $response['message'] = 'Dados recebidos com sucesso! Houve um problema ao enviar o e-mail, mas nossa equipe já foi notificada.';
        }
    }
    
    if ($method === 'whatsapp') {
        // Gerar URL do WhatsApp
        $whatsapp_number = '5551992659289'; // Número do cliente
        $message = rawurlencode(
            "Olá! Meu nome é {$nome}\n" .
            "Telefone: {$telefone}\n" .
            "Email: {$email}\n\n" .
            "Gostaria de mais informações sobre seus serviços!"
        );
        
        $whatsapp_url = "https://wa.me/{$whatsapp_number}?text={$message}";
        $response['whatsapp_url'] = $whatsapp_url;
        $response['message'] = 'Dados enviados com sucesso! Redirecionando para o WhatsApp...';
    }
    
    // Enviar resposta CORRETA - não aninhar em 'data'
    wp_send_json_success($response);
}

/**
 * Função corrigida para enviar email - sem erros críticos
 */
function codix_send_cta_email($nome, $telefone, $email) {
    $to = get_option('admin_email');
    
    if (empty($to)) {
        $to = 'contato@artklim.com.br'; // Use um email do seu domínio
    }
    
    $subject = 'Novo Lead - ' . get_bloginfo('name');
    
    // IMPORTANTE: Use um email do seu domínio como remetente
    $from_email = 'contato@artklim.com.br'; // Ou outro email @artklim.com.br
    $from_name = get_bloginfo('name');
    
    // Configurar filtros para alterar remetente
    add_filter('wp_mail_from', function() use ($from_email) {
        return $from_email;
    });
    
    add_filter('wp_mail_from_name', function() use ($from_name) {
        return $from_name;
    });
    
    // Corpo do email melhor formatado
    $current_page = get_the_title() ?: 'Formulário CTA';
    $current_url = get_permalink() ?: home_url();
    
    $body = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #f8f9fa; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; border-bottom: 3px solid #0073aa; }
            .content { background: white; padding: 30px; border: 1px solid #dee2e6; border-top: none; border-radius: 0 0 8px 8px; }
            .lead-info { margin: 20px 0; }
            .lead-item { margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
            .lead-item:last-child { border-bottom: none; }
            .label { font-weight: bold; color: #0073aa; min-width: 100px; display: inline-block; }
            .actions { background: #e7f3ff; padding: 20px; border-radius: 8px; margin: 25px 0; border-left: 4px solid #0073aa; }
            .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6; font-size: 12px; color: #6c757d; text-align: center; }
        </style>
    </head>
    <body>
        <div class="header">
            <h2 style="margin: 0; color: #0073aa;">📋 Novo Lead Recebido</h2>
            <p style="margin: 5px 0 0; color: #6c757d;">' . get_bloginfo('name') . ' - ' . date('d/m/Y H:i') . '</p>
        </div>
        
        <div class="content">
            <div class="lead-info">
                <h3 style="margin-top: 0; color: #343a40;">Informações do Cliente</h3>
                
                <div class="lead-item">
                    <span class="label">Nome:</span>
                    <span>' . esc_html($nome) . '</span>
                </div>
                
                <div class="lead-item">
                    <span class="label">Telefone:</span>
                    <span>' . esc_html($telefone) . '</span>
                </div>
                
                <div class="lead-item">
                    <span class="label">E-mail:</span>
                    <span>' . esc_html($email) . '</span>
                </div>
                
                <div class="lead-item">
                    <span class="label">Método:</span>
                    <span><strong>📧 E-mail</strong></span>
                </div>
                
                <div class="lead-item">
                    <span class="label">Data/Hora:</span>
                    <span>' . date('d/m/Y H:i') . '</span>
                </div>
                
                <div class="lead-item">
                    <span class="label">Página:</span>
                    <span>' . esc_html($current_page) . '<br>
                    <small>' . esc_html($current_url) . '</small></span>
                </div>
                
                <div class="lead-item">
                    <span class="label">IP:</span>
                    <span>' . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . '</span>
                </div>
            </div>
            
            <div class="actions">
                <h4 style="margin-top: 0; color: #0073aa;">📞 Ações Recomendadas</h4>
                <p>Entre em contato com o cliente o mais breve possível para melhor conversão.</p>
                
                <p style="margin-bottom: 5px;">
                    <strong>E-mail para resposta:</strong> 
                    <a href="mailto:' . esc_attr($email) . '" style="color: #0073aa;">' . esc_html($email) . '</a>
                </p>
                
                <p style="margin: 0;">
                    <strong>Telefone para WhatsApp:</strong> 
                    ' . esc_html($telefone) . '
                </p>
            </div>
            
            <div class="footer">
                <p style="margin: 0;">
                    <em>Este e-mail foi gerado automaticamente pelo sistema de leads do site ' . get_bloginfo('name') . '.</em><br>
                    <em>O lead foi salvo no painel administrativo do WordPress para acompanhamento.</em>
                </p>
            </div>
        </div>
    </body>
    </html>';
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $nome . ' <' . $email . '>',
        'X-Mailer: PHP/' . phpversion()
    );
    
    $sent = wp_mail($to, $subject, $body, $headers);
    
    // Remover filtros
    remove_filter('wp_mail_from', function() use ($from_email) {
        return $from_email;
    });
    
    remove_filter('wp_mail_from_name', function() use ($from_name) {
        return $from_name;
    });
    
    error_log($sent ? '✅ Email enviado para: ' . $to : '❌ Falha ao enviar email para: ' . $to);
    
    return $sent;
}

/**
 * Adicionar script AJAX no admin para debug
 */
add_action('admin_footer', 'codix_debug_ajax_script');
function codix_debug_ajax_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Debug: testar AJAX endpoint
        console.log('URL AJAX:', '<?php echo admin_url("admin-ajax.php"); ?>');
    });
    </script>
    <?php
}

/**
 * Adicionar menu de estatísticas de leads
 */
add_action('admin_menu', 'codix_add_leads_stats_menu');
function codix_add_leads_stats_menu() {
    add_submenu_page(
        'edit.php?post_type=lead',
        'Estatísticas de Leads',
        'Estatísticas',
        'manage_options',
        'leads-stats',
        'codix_leads_stats_page'
    );
}

function codix_leads_stats_page() {
    global $wpdb;
    
    // Estatísticas básicas
    $total_leads = wp_count_posts('lead')->publish;
    $whatsapp_leads = $wpdb->get_var(
        "SELECT COUNT(*) FROM {$wpdb->postmeta} pm 
        LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID 
        WHERE pm.meta_key = '_lead_method' 
        AND pm.meta_value = 'whatsapp' 
        AND p.post_status = 'publish'"
    );
    $email_leads = $wpdb->get_var(
        "SELECT COUNT(*) FROM {$wpdb->postmeta} pm 
        LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID 
        WHERE pm.meta_key = '_lead_method' 
        AND pm.meta_value = 'email' 
        AND p.post_status = 'publish'"
    );
    
    // Leads por dia (últimos 30 dias)
    $leads_by_day = $wpdb->get_results(
        "SELECT DATE(p.post_date) as date, COUNT(*) as count 
        FROM {$wpdb->posts} p 
        WHERE p.post_type = 'lead' 
        AND p.post_status = 'publish' 
        AND p.post_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) 
        GROUP BY DATE(p.post_date) 
        ORDER BY date DESC"
    );
    
    ?>
    <div class="wrap">
        <h1>Estatísticas de Leads</h1>
        
        <div class="card" style="max-width: 800px; margin: 20px 0;">
            <div class="card-body">
                <h2>Visão Geral</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 0;">
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #0073aa;">
                        <h3 style="margin-top: 0; color: #0073aa;">Total de Leads</h3>
                        <p style="font-size: 32px; font-weight: bold; margin: 10px 0;"><?php echo $total_leads; ?></p>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #25D366;">
                        <h3 style="margin-top: 0; color: #25D366;">Por WhatsApp</h3>
                        <p style="font-size: 32px; font-weight: bold; margin: 10px 0;"><?php echo $whatsapp_leads; ?></p>
                        <p style="margin: 0; color: #666;">
                            <?php echo $total_leads > 0 ? round(($whatsapp_leads / $total_leads) * 100, 1) : 0; ?>%
                        </p>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #dc3545;">
                        <h3 style="margin-top: 0; color: #dc3545;">Por E-mail</h3>
                        <p style="font-size: 32px; font-weight: bold; margin: 10px 0;"><?php echo $email_leads; ?></p>
                        <p style="margin: 0; color: #666;">
                            <?php echo $total_leads > 0 ? round(($email_leads / $total_leads) * 100, 1) : 0; ?>%
                        </p>
                    </div>
                </div>
                
                <h3>Leads nos Últimos 30 Dias</h3>
                <div style="background: white; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin: 20px 0;">
                    <?php if ($leads_by_day): ?>
                        <table class="wp-list-table widefat fixed striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Leads</th>
                                    <th>Grafíco</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($leads_by_day as $day): ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y', strtotime($day->date)); ?></td>
                                        <td><?php echo $day->count; ?></td>
                                        <td>
                                            <div style="background: #0073aa; height: 20px; width: <?php echo min($day->count * 20, 300); ?>px; border-radius: 3px;"></div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Nenhum lead nos últimos 30 dias.</p>
                    <?php endif; ?>
                </div>
                
                <h3>Exportar Dados</h3>
                <p>
                    <a href="<?php echo admin_url('admin-post.php?action=export_leads_csv'); ?>" class="button button-primary">
                        📥 Exportar Leads (CSV)
                    </a>
                    <a href="<?php echo admin_url('admin-post.php?action=export_leads_excel'); ?>" class="button button-secondary">
                        📊 Exportar Leads (Excel)
                    </a>
                </p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Handler para exportar leads em CSV
 */
add_action('admin_post_export_leads_csv', 'codix_export_leads_csv');
function codix_export_leads_csv() {
    if (!current_user_can('manage_options')) {
        wp_die('Acesso negado.');
    }
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="leads-' . date('Y-m-d') . '.csv"');
    
    $output = fopen('php://output', 'w');
    
    // Cabeçalhos
    fputcsv($output, array(
        'ID', 'Nome', 'E-mail', 'Telefone', 'Método', 
        'Data/Hora', 'IP', 'Página', 'Contatado', 'Observações'
    ));
    
    // Buscar todos os leads
    $args = array(
        'post_type' => 'lead',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    $leads = new WP_Query($args);
    
    while ($leads->have_posts()) {
        $leads->the_post();
        $post_id = get_the_ID();
        
        fputcsv($output, array(
            $post_id,
            get_post_meta($post_id, '_lead_nome', true),
            get_post_meta($post_id, '_lead_email', true),
            get_post_meta($post_id, '_lead_telefone', true),
            get_post_meta($post_id, '_lead_method', true),
            get_post_meta($post_id, '_lead_data', true),
            get_post_meta($post_id, '_lead_ip', true),
            get_post_meta($post_id, '_lead_page_url', true),
            get_post_meta($post_id, '_lead_contacted', true) ? 'Sim' : 'Não',
            get_post_meta($post_id, '_lead_notes', true)
        ));
    }
    
    fclose($output);
    exit;
}

