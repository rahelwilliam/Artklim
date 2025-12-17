<?php
/**
 * Bloco CTA com Formulário de Contato - VERSÃO AJAX
 */

// Dados do ACF
$bg_color = get_field('cor_do_bloco');
$id = get_field('identificacao_do_bloco');
$tipo_conteudo = get_field('tipo_de_conteudo');
$tipo_fundo = ($tipo_conteudo == 'local') ? get_field('tipo_de_fundo') : get_field('tipo_de_fundo', 'option');
$imagem = ($tipo_conteudo == 'local') ? get_field('imagem_para_o_fundo') : get_field('imagem_para_o_fundo', 'option');
$video = ($tipo_conteudo == 'local') ? get_field('video_para_o_fundo') : get_field('video_para_o_fundo', 'option');

// Textos
$titulo = ($tipo_conteudo == 'local') ? get_field('titulo_para_o_cta') : get_field('titulo_para_o_cta', 'option');
$texto = ($tipo_conteudo == 'local') ? get_field('texto_para_o_cta') : get_field('texto_para_o_cta', 'option');

// Extrair parte em strong do título
preg_match('/<strong>(.*?)<\/strong>/', $titulo, $matches);
$titulo_bold = $matches[1] ?? $titulo;
$titulo_resto = preg_replace('/<strong>.*?<\/strong>/', '', $titulo);

// Gerar ID único para o formulário
$form_id = 'cta-form-' . uniqid();

// Obter nonce para AJAX
$ajax_nonce = wp_create_nonce('cta_form_ajax_nonce');
?>

<!-- section -->
<section data-id="card3" <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> 
          class="section section-cta section-cta-form tc-light section-x <?php echo ($bg_color) ? $bg_color : 'bg-dark'; ?>">
    <div class="container">
        <div class="row gutter-vr-30px align-items-center justify-content-between">
            <div class="col-lg-7 text-center text-lg-left">
                <div class="cta-text cta-text-s3 mb-4 mb-lg-0">
                    <h2>
                        <strong><?php echo wp_strip_all_tags($titulo_bold); ?></strong>
                        <?php echo wp_strip_all_tags($titulo_resto); ?>
                        <?php if($texto): ?>
                            <span class="d-block mt-2"><?php echo wp_strip_all_tags($texto); ?></span>
                        <?php endif; ?>
                    </h2>
                </div>
            </div>
            
            <div class="col-lg-5" id="<?php echo $form_id; ?>-container">
                <div class="cta-form-card">
                    <h3 class="h5 mb-4 color-primary">Fale Conosco</h3>
                    
                    <div id="form-message-<?php echo $form_id; ?>" class="form-message" style="display: none;"></div>
                    
                    <form id="<?php echo $form_id; ?>" method="POST" data-nonce="<?php echo $ajax_nonce; ?>">
                        <div class="form-group">
                            <input type="text" 
                                   name="nome" 
                                   class="form-cta-input" 
                                   placeholder="Seu nome completo *" 
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <input type="tel" 
                                   name="telefone" 
                                   class="form-cta-input" 
                                   placeholder="(11) 99999-9999 *" 
                                   oninput="formatarTelefone(this)"
                                   maxlength="15"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <input type="email" 
                                   name="email" 
                                   class="form-cta-input" 
                                   placeholder="seu@email.com *" 
                                   required>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="button" 
                                    onclick="submitCtaForm('whatsapp', '<?php echo $form_id; ?>')" 
                                    class="btn-cta-whatsapp"
                                    id="whatsapp_btn_<?php echo $form_id; ?>">
                                <span class="btn-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                    </svg>
                                    Enviar por WhatsApp
                                </span>
                            </button>
                            
                            <button type="button" 
                                    onclick="submitCtaForm('email', '<?php echo $form_id; ?>')" 
                                    class="btn-cta-email"
                                    id="email_btn_<?php echo $form_id; ?>">
                                <span class="btn-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                    </svg>
                                    Enviar por E-mail
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: -2px;">
                                <path d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm-.5 5a.5.5 0 0 1 1 0v2a.5.5 0 0 1-1 0V5zm1.5 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            Seus dados estão protegidos
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .container -->

    <!-- bg -->
    <?php if($tipo_fundo == 'video' && $video) { ?>
        <video autoplay loop muted poster="<?php echo $imagem['url']; ?>" class="bg_video">
            <source src="<?php echo $video['url']; ?>" type="video/webm">
            <source src="<?php echo $video['url']; ?>" type="video/mp4">
        </video>
    <?php } else if($imagem) { ?>
        <div class="bg-image bg-fixed overlay-theme-dark overlay-opacity-60">
            <img src="<?php echo $imagem['url']; ?>" alt="<?php echo $imagem['alt']; ?>" loading="lazy" class="scroll-image">
        </div>
    <?php } ?>
    <!-- .bg -->
</section>
<!-- .section -->

<style>
/* Estilos do formulário CTA */
.cta-form-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.cta-form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

.form-cta-input {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.875rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 1rem;
    box-sizing: border-box;
}

.form-cta-input:focus {
    outline: none;
    border-color: #0073aa;
    box-shadow: 0 0 0 3px rgba(0, 115, 170, 0.25);
}

.form-cta-input::placeholder {
    color: #6c757d;
    opacity: 0.8;
}

.btn-cta-whatsapp {
    background: linear-gradient(135deg, #25D366, #128C7E);
    border: none;
    color: white;
    padding: 0.875rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    font-size: 1rem;
}

.btn-cta-whatsapp:hover:not(:disabled) {
    background: linear-gradient(135deg, #128C7E, #075E54);
    transform: translateY(-2px);
}

.btn-cta-email {
    background: linear-gradient(135deg, #0073aa, #005a87);
    border: none;
    color: white;
    padding: 0.875rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    font-size: 1rem;
}

.btn-cta-email:hover:not(:disabled) {
    background: linear-gradient(135deg, #005a87, #004466);
    transform: translateY(-2px);
}

.btn-cta-disabled {
    opacity: 0.7;
    cursor: not-allowed !important;
}

.form-message {
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    border-left: 4px solid transparent;
    display: none;
}

.form-message.success {
    background: rgba(40, 167, 69, 0.1);
    color: #155724;
    border-left-color: #28a745;
    display: block;
}

.form-message.error {
    background: rgba(220, 53, 69, 0.1);
    color: #721c24;
    border-left-color: #dc3545;
    display: block;
}

.spinner-cta {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin-cta 0.8s linear infinite;
    margin-right: 8px;
}

@keyframes spin-cta {
    to { transform: rotate(360deg); }
}

.field-error {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: -0.5rem;
    margin-bottom: 1rem;
}

/* Responsividade */
@media (max-width: 991.98px) {
    .cta-form-card {
        margin-top: 2rem;
    }
}

@media (max-width: 575.98px) {
    .cta-form-card {
        padding: 1.5rem !important;
    }
}

/* Adicione ao CSS do bloco */
.form-message {
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    border-left: 4px solid transparent;
    display: none;
    align-items: center;
}

.form-message.success {
    background: rgba(40, 167, 69, 0.1);
    color: #155724;
    border-left-color: #28a745;
    display: flex;
}

.form-message.error {
    background: rgba(220, 53, 69, 0.1);
    color: #721c24;
    border-left-color: #dc3545;
    display: flex;
}

.form-message svg {
    flex-shrink: 0;
    margin-right: 10px;
}

.form-message div {
    flex-grow: 1;
}
</style>

<script>
// Função para formatar telefone
function formatarTelefone(input) {
    let value = input.value.replace(/\D/g, '');
    
    if (value.length > 10) {
        value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
    } else if (value.length > 6) {
        value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
    } else if (value.length > 2) {
        value = value.replace(/^(\d{2})(\d{0,5}).*/, '($1) $2');
    } else if (value.length > 0) {
        value = value.replace(/^(\d*)/, '($1');
    }
    
    input.value = value;
}

// Função para validar formulário
function validateForm(form) {
    const nome = form.querySelector('input[name="nome"]').value.trim();
    const telefone = form.querySelector('input[name="telefone"]').value.trim();
    const email = form.querySelector('input[name="email"]').value.trim();
    
    let isValid = true;
    
    // Limpar erros anteriores
    const errorElements = form.querySelectorAll('.field-error');
    errorElements.forEach(el => el.remove());
    
    // Validar nome
    if (!nome) {
        showFieldError(form.querySelector('input[name="nome"]'), 'Por favor, informe seu nome');
        isValid = false;
    }
    
    // Validar telefone
    if (!telefone) {
        showFieldError(form.querySelector('input[name="telefone"]'), 'Por favor, informe seu telefone');
        isValid = false;
    } else if (telefone.replace(/\D/g, '').length < 10) {
        showFieldError(form.querySelector('input[name="telefone"]'), 'Telefone inválido');
        isValid = false;
    }
    
    // Validar email
    if (!email) {
        showFieldError(form.querySelector('input[name="email"]'), 'Por favor, informe seu e-mail');
        isValid = false;
    } else if (!isValidEmail(email)) {
        showFieldError(form.querySelector('input[name="email"]'), 'E-mail inválido');
        isValid = false;
    }
    
    return isValid;
}

// Função para mostrar erro em campo específico
function showFieldError(input, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    
    input.parentNode.appendChild(errorDiv);
    input.style.borderColor = '#dc3545';
}

// Função para validar email
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Função principal para submeter o formulário
function submitCtaForm(method, formId) {
    const form = document.getElementById(formId);
    const messageDiv = document.getElementById('form-message-' + formId);
    const whatsappBtn = document.getElementById('whatsapp_btn_' + formId);
    const emailBtn = document.getElementById('email_btn_' + formId);
    
    // Limpar mensagens anteriores
    messageDiv.className = 'form-message';
    messageDiv.style.display = 'none';
    messageDiv.textContent = '';
    
    // Validar formulário
    if (!validateForm(form)) {
        return false;
    }
    
    // Obter dados do formulário
    const formData = new FormData(form);
    formData.append('method', method);
    formData.append('action', 'process_cta_form');
    formData.append('nonce', form.dataset.nonce);
    
    // Mostrar loading
    showLoading(whatsappBtn, 'Enviando...');
    showLoading(emailBtn, 'Enviando...');
    whatsappBtn.disabled = true;
    emailBtn.disabled = true;
    whatsappBtn.classList.add('btn-cta-disabled');
    emailBtn.classList.add('btn-cta-disabled');
    
    // Enviar via AJAX
    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta AJAX completa:', data);
        
        // A resposta vem em data.data, não em data.data.data
        const responseData = data.data || data;
        
        if (responseData.success || data.success) {
            // Sucesso
            const successMessage = responseData.message || 'Dados enviados com sucesso!';
            
            messageDiv.className = 'form-message success';
            messageDiv.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: -3px; margin-right: 8px;"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>' + successMessage;
            messageDiv.style.display = 'block';
            
            // Limpar formulário
            form.reset();
            
            // Se for WhatsApp, abrir em nova aba
            if (method === 'whatsapp' && responseData.whatsapp_url) {
                setTimeout(() => {
                    console.log('Abrindo WhatsApp:', responseData.whatsapp_url);
                    window.open(responseData.whatsapp_url, '_blank', 'noopener,noreferrer');
                }, 1500);
            }
        } else {
            // Erro
            const errorMessage = responseData.message || 'Erro ao enviar formulário. Tente novamente.';
            
            messageDiv.className = 'form-message error';
            messageDiv.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: -3px; margin-right: 8px;"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>' + errorMessage;
            messageDiv.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Erro AJAX:', error);
        messageDiv.className = 'form-message error';
        messageDiv.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: -3px; margin-right: 8px;"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>Erro de conexão. Tente novamente.';
        messageDiv.style.display = 'block';
    })
    .finally(() => {
        // Restaurar botões
        restoreButton(whatsappBtn, 'Enviar por WhatsApp');
        restoreButton(emailBtn, 'Enviar por E-mail');
        whatsappBtn.disabled = false;
        emailBtn.disabled = false;
        whatsappBtn.classList.remove('btn-cta-disabled');
        emailBtn.classList.remove('btn-cta-disabled');
    });
    
    return false;
}

// Função para mostrar loading
function showLoading(button, text) {
    const btnText = button.querySelector('.btn-text');
    if (btnText) {
        btnText.innerHTML = '<span class="spinner-cta"></span>' + text;
    }
}

// Função para restaurar botão
function restoreButton(button, text) {
    const btnText = button.querySelector('.btn-text');
    if (btnText) {
        if (button.classList.contains('btn-cta-whatsapp')) {
            btnText.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>' + text;
        } else {
            btnText.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg>' + text;
        }
    }
}
</script>