<?php
/*
Plugin Name: Easy Yandex Share
Plugin URI: https://wordpress.org/plugins/easy-yandex-share/
Description: Share buttons for WordPress from Yandex. 
Version: 1.00
Author: Flector
Author URI: https://profiles.wordpress.org/flector#content-plugins
Text Domain: easy-yandex-share
*/ 

//проверка версии плагина (запуск функции установки новых опций) begin
function yshare_check_version() {
    $yshare_options = get_option('yshare_options');
    if ( $yshare_options['version'] != '1.00' ) {
        yshare_set_new_options();
    }    
}
add_action('plugins_loaded', 'yshare_check_version');
//проверка версии плагина (запуск функции установки новых опций) end

//функция установки новых опций при обновлении плагина у пользователей begin
function yshare_set_new_options() { 
    $yshare_options = get_option('yshare_options');

    //если нет опции при обновлении плагина - записываем ее
    //if (!isset($yshare_options['new_option'])) {$yshare_options['new_option']='value';}
    
    //если необходимо переписать уже записанную опцию при обновлении плагина
    //$yshare_options['old_option'] = 'new_value';
    
    $yshare_options['version'] = '1.00';
    update_option('yshare_options', $yshare_options);
}
//функция установки новых опций при обновлении плагина у пользователей end

//функция установки значений по умолчанию при активации плагина begin
function yshare_init() {
    yshare_setup();
    $lang = get_locale(); 
    $yshare_options = array();
    $yshare_options['version'] = '1.00';
    if ($lang != 'ru_RU') {
        $yshare_options['nets'] = 'facebook,twitter,gplus,tumblr,reddit,pinterest,evernote,pocket,viber,whatsapp,skype,telegram,';
    } else {    
        $yshare_options['nets'] = 'vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,pocket,evernote,viber,whatsapp,skype,telegram,';
    }
    $yshare_options['look'] = 'iconsmenu';
    $yshare_options['limit'] = '8';
    $yshare_options['popup-direction'] = 'bottom';
    $yshare_options['popup-position'] = 'inner';
    $yshare_options['copy'] = 'last';
    $yshare_options['size'] = 'm';
    $yshare_options['direction'] = 'horizontal';
    $yshare_options['lang'] = 'ru';
    if ($lang == 'en_US') {$yshare_options['lang'] = 'en';}
    if ($lang == 'uk') {$yshare_options['lang'] = 'uk';}
    $yshare_options['access-token'] = '';
    $yshare_options['hashtags'] = 'no';
    $yshare_options['htmlbefore'] = __('&lt;h3&gt;Share this:&lt;/h3&gt;', 'easy-yandex-share');
    $yshare_options['htmlafter'] = '';
    $yshare_options['types'] = 'post';
    $yshare_options['excludeids'] = '';
    $yshare_options['mesto'] = 'bottom';
    $yshare_options['priority'] = '9';
    $yshare_options['cdn'] = 'yandex';
   
    add_option('yshare_options', $yshare_options);
}
add_action('activate_easy-yandex-share/easy-yandex-share.php', 'yshare_init');
//функция установки значений по умолчанию при активации плагина end

//функция при деактивации плагина begin
function yshare_on_deactivation() {
	if ( ! current_user_can('activate_plugins') ) return;
}
register_deactivation_hook( __FILE__, 'yshare_on_deactivation' );
//функция при деактивации плагина end

//функция при удалении плагина begin
function yshare_on_uninstall() {
	if ( ! current_user_can('activate_plugins') ) return;
    delete_option('yshare_options');
}
register_uninstall_hook( __FILE__, 'yshare_on_uninstall' );
//функция при удалении плагина end

//загрузка файла локализации плагина begin
function yshare_setup(){
    load_plugin_textdomain('easy-yandex-share');
}
add_action('init', 'yshare_setup');
//загрузка файла локализации плагина end

//добавление ссылки "Настройки" на странице со списком плагинов begin
function yshare_actions($links) {
	return array_merge(array('settings' => '<a href="options-general.php?page=easy-yandex-share.php">' . __('Settings', 'easy-yandex-share') . '</a>'), $links);
}
add_filter('plugin_action_links_' . plugin_basename( __FILE__ ),'yshare_actions');
//добавление ссылки "Настройки" на странице со списком плагинов end

//функция загрузки скриптов и стилей плагина только в админке и только на странице настроек плагина begin
function yshare_files_admin($hook_suffix) {
	$purl = plugins_url('', __FILE__);
    $yshare_options = get_option('yshare_options');
    if ( $hook_suffix == 'settings_page_easy-yandex-share' ) {
        if(!wp_script_is('jquery')) {wp_enqueue_script('jquery');}    
        wp_register_script('yshare-lettering', $purl . '/inc/jquery.lettering.js');  
        wp_enqueue_script('yshare-lettering');
        wp_register_script('yshare-textillate', $purl . '/inc/jquery.textillate.js');
        wp_enqueue_script('yshare-textillate');
        wp_register_style('yshare-animate', $purl . '/inc/animate.min.css');
        wp_enqueue_style('yshare-animate');
        wp_register_script('yshare-script', $purl . '/inc/yshare-script.js', array(), '1.00');  
        wp_enqueue_script('yshare-script');
        wp_register_style('yshare-css', $purl . '/inc/yshare-css.css', array(), '1.00');
        wp_enqueue_style('yshare-css');
        if ($yshare_options['cdn'] == 'yandex') {wp_register_script('yshare-share', '//yastatic.net/share2/share.js', false, null, false);}
        if ($yshare_options['cdn'] == 'jsdelivr') {wp_register_script('yshare-share', 'https://cdn.jsdelivr.net/npm/yandex-share2/share.js', false, null, false);}   
        wp_enqueue_script('yshare-share');
    }
}
add_action('admin_enqueue_scripts', 'yshare_files_admin');
//функция загрузки скриптов и стилей плагина только в админке и только на странице настроек плагина end

//функция загрузки скриптов и стилей плагина на внешней стороне сайта begin
function yshare_files_front() {
    $yshare_options = get_option('yshare_options');
    if ($yshare_options['cdn'] == 'yandex') {wp_register_script('yshare-share', '//yastatic.net/share2/share.js', false, null, false);}
    if ($yshare_options['cdn'] == 'jsdelivr') {wp_register_script('yshare-share', 'https://cdn.jsdelivr.net/npm/yandex-share2/share.js', false, null, false);}   
    wp_enqueue_script('yshare-share');
}    
add_action('wp_enqueue_scripts', 'yshare_files_front');
//функция загрузки скриптов и стилей плагина на внешней стороне сайта end

//добавляем атрибут async скрипту яндекса begin
function yshare_add_async_attribute($tag, $handle) {
    if ( 'yshare-share' !== $handle )
        return $tag;
    return str_replace( ' src', ' async src', $tag );
}
add_filter('script_loader_tag', 'yshare_add_async_attribute', 10, 2);
//добавляем атрибут async скрипту яндекса end

//функция вывода страницы настроек плагина begin
function yshare_options_page() {
$purl = plugins_url('', __FILE__);

if (isset($_POST['submit'])) {
     
//проверка безопасности при сохранении настроек плагина begin       
if ( ! wp_verify_nonce( $_POST['yshare_nonce'], plugin_basename(__FILE__) ) || ! current_user_can('edit_posts') ) {
   wp_die(__( 'Cheatin&#8217; uh?', 'easy-yandex-share' ));
}
//проверка безопасности при сохранении настроек плагина end
        
    //проверяем и сохраняем введенные пользователем данные begin    
    $yshare_options = get_option('yshare_options');
    
    $yshare_options['nets'] = sanitize_text_field($_POST['netsspan']);
    $yshare_options['look'] = sanitize_text_field($_POST['look']);
    $limit = sanitize_text_field($_POST['limit']); 
    if (is_numeric($limit) && (int)$limit>0) {$yshare_options['limit'] = sanitize_text_field($_POST['limit']);}
    $yshare_options['popup-direction'] = sanitize_text_field($_POST['popup-direction']);
    $yshare_options['popup-position'] = sanitize_text_field($_POST['popup-position']);
    $yshare_options['copy'] = sanitize_text_field($_POST['copy']);
    $yshare_options['size'] = sanitize_text_field($_POST['size']);
    $yshare_options['direction'] = sanitize_text_field($_POST['direction']);
    $yshare_options['lang'] = sanitize_text_field($_POST['lang']);
    $yshare_options['access-token'] = sanitize_text_field($_POST['access-token']);
    $yshare_options['hashtags'] = sanitize_text_field($_POST['hashtags']);
    $yshare_options['htmlbefore'] = esc_textarea($_POST['htmlbefore']);
    $yshare_options['htmlafter'] = esc_textarea($_POST['htmlafter']);

    $yshare_options['types'] = '';    
    $checkboxes = isset($_POST['types']) ? $_POST['types'] : array();
    foreach($checkboxes as $value) {$yshare_options['types'] .= $value . ',';}
    $yshare_options['types'] = sanitize_text_field($yshare_options['types']);
    
    $excludeids = sanitize_text_field($_POST['excludeids']);
    $excludeids = preg_replace('/\s+/', '', $excludeids);
    if( preg_match('/^\d+(?:,\d+)*$/', $excludeids) or $excludeids == '' ) {
        $yshare_options['excludeids'] = preg_replace('/\s+/', '', sanitize_text_field($_POST['excludeids']));
    }
    
    $yshare_options['mesto'] = sanitize_text_field($_POST['mesto']);
    $priority = sanitize_text_field($_POST['priority']);
    if (is_numeric($priority)) {$yshare_options['priority'] = sanitize_text_field($_POST['priority']);}
    $yshare_options['cdn'] = sanitize_text_field($_POST['cdn']);
    
    update_option('yshare_options', $yshare_options);
    //проверяем и сохраняем введенные пользователем данные end
}
$yshare_options = get_option('yshare_options');
?>
<?php   if (!empty($_POST) ) :
if ( ! wp_verify_nonce( $_POST['yshare_nonce'], plugin_basename(__FILE__) ) || ! current_user_can('edit_posts') ) {
   wp_die(__( 'Cheatin&#8217; uh?', 'easy-yandex-share' ));
}
?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.', 'easy-yandex-share'); ?></strong></p></div>
<?php endif; ?>

<div class="wrap">
<h2><?php _e('&#171;Easy Yandex Share&#187; Settings', 'easy-yandex-share'); ?></h2>

<div class="metabox-holder" id="poststuff">
<div class="meta-box-sortables">

<?php $lang = get_locale(); ?>
<?php if ($lang == 'ru_RU') { ?>
<div class="postbox">
    <h3 style="border-bottom: 1px solid #EEE;background: #f7f7f7;"><span class="tcode">Вам нравится этот плагин ?</span></h3>
    <div class="inside" style="display: block;margin-right: 12px;">
        <img src="<?php echo $purl . '/img/icon_coffee.png'; ?>" title="Купить мне чашку кофе :)" style=" margin: 5px; float:left;" />
        <p>Привет, меня зовут <strong>Flector</strong>.</p>
        <p>Я потратил много времени на разработку этого плагина.<br />
		Поэтому не откажусь от небольшого пожертвования :)</p>
      <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=41001443750704&quickpay=donate&payment-type-choice=on&default-sum=200&targets=%D0%9D%D0%B0+%D1%80%D0%B0%D0%B7%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%BA%D1%83+WordPress-%D0%BF%D0%BB%D0%B0%D0%B3%D0%B8%D0%BD%D0%BE%D0%B2+(Easy+Yandex+Share).&project-name=&project-site=&button-text=05&successURL=" width="422" height="64"></iframe>
      <p>Или вы можете заказать у меня услуги по WordPress, от мелких правок до создания полноценного сайта.<br />
        Быстро, качественно и дешево. Прайс-лист смотрите по адресу <a target="new" href="https://www.wpuslugi.ru/?from=yshare-plugin">https://www.wpuslugi.ru/</a>.</p>
        <div style="clear:both;"></div>
    </div>
</div>
<?php } else { ?>
<div class="postbox">
    <h3 style="border-bottom: 1px solid #EEE;background: #f7f7f7;"><span class="tcode"><?php _e('Do you like this plugin ?', 'easy-yandex-share'); ?></span></h3>
    <div class="inside" style="display: block;margin-right: 12px;">
        <img src="<?php echo $purl . '/img/icon_coffee.png'; ?>" title="<?php _e('buy me a coffee', 'easy-yandex-share'); ?>" style=" margin: 5px; float:left;" />
        <p><?php _e('Hi! I\'m <strong>Flector</strong>, developer of this plugin.', 'easy-yandex-share'); ?></p>
        <p><?php _e('I\'ve been spending many hours to develop this plugin.', 'easy-yandex-share'); ?> <br />
		<?php _e('If you like and use this plugin, you can <strong>buy me a cup of coffee</strong>.', 'easy-yandex-share'); ?></p>
        <a target="new" href="https://www.paypal.me/flector"><img alt="" src="<?php echo $purl . '/img/donate.gif'; ?>" title="<?php _e('Donate with PayPal', 'easy-yandex-share'); ?>" /></a>
        <div style="clear:both;"></div>
    </div>
</div>
<?php } ?>

<div class="postbox">

    <h3 style="border-bottom: 1px solid #EEE;background: #f7f7f7;"><span class="tcode"><?php _e('Preview', 'easy-yandex-share'); ?></span></h3>
	  <div class="inside" style="display: inline-block;margin-left: 10px;">
 
        <div id="preview">
        <?php yshare_share_block_preview(); ?>
        </div>
        <hr>
        <p style="margin:0;"><?php _e('Save plugin settings to apply the changes.', 'easy-yandex-share'); ?></p>
    
    </div>
</div>

<form action="" method="post">

<div class="postbox">

    <h3 style="border-bottom: 1px solid #EEE;background: #f7f7f7;"><span class="tcode"><?php _e('Main Options', 'easy-yandex-share'); ?></span></h3>
    <div class="inside" style="display: block;">

        <table class="form-table">
        
            <tr>
                <th><?php _e('Networks:', 'easy-yandex-share'); ?></th>
                <td style="padding-top: 20px;">
                   
                  <div class="share__list">
                  
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="collections" />
                    <label for="collections" style="display: inline-block;"><div class="share__icon share__icon_service_collections"></div><?php _e('Yandex.Collections', 'easy-yandex-share'); ?></label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="vkontakte" />
                    <label for="vkontakte" style="display: inline-block;"><div class="share__icon share__icon_service_vkontakte"></div><?php _e('VKontakte', 'easy-yandex-share'); ?></label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="facebook" />
                    <label for="facebook" style="display: inline-block;"><div class="share__icon share__icon_service_facebook"></div>Facebook</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="odnoklassniki" />
                    <label for="odnoklassniki" style="display: inline-block;"><div class="share__icon share__icon_service_odnoklassniki"></div><?php _e('Odnoklassniki', 'easy-yandex-share'); ?></label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="moimir" />
                    <label for="moimir" style="display: inline-block;"><div class="share__icon share__icon_service_moimir"></div><?php _e('Moi Mir', 'easy-yandex-share'); ?></label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="gplus" />
                    <label for="gplus" style="display: inline-block;"><div class="share__icon share__icon_service_gplus"></div>Google+</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="pinterest" />
                    <label for="pinterest" style="display: inline-block;"><div class="share__icon share__icon_service_pinterest"></div>Pinterest</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="twitter" />
                    <label for="twitter" style="display: inline-block;"><div class="share__icon share__icon_service_twitter"></div>Twitter</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="blogger" />
                    <label for="blogger" style="display: inline-block;"><div class="share__icon share__icon_service_blogger"></div>Blogger</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="delicious" />
                    <label for="delicious" style="display: inline-block;"><div class="share__icon share__icon_service_delicious"></div>Delicious</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="digg" />
                    <label for="digg" style="display: inline-block;"><div class="share__icon share__icon_service_digg"></div>Digg</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="reddit" />
                    <label for="reddit" style="display: inline-block;"><div class="share__icon share__icon_service_reddit"></div>Reddit</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="evernote" />
                    <label for="evernote" style="display: inline-block;"><div class="share__icon share__icon_service_evernote"></div>Evernote</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="linkedin" />
                    <label for="linkedin" style="display: inline-block;"><div class="share__icon share__icon_service_linkedin"></div>LinkedIn</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="lj" />
                    <label for="lj" style="display: inline-block;"><div class="share__icon share__icon_service_lj"></div>LiveJournal</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="pocket" />
                    <label for="pocket" style="display: inline-block;"><div class="share__icon share__icon_service_pocket"></div>Pocket</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="qzone" />
                    <label for="qzone" style="display: inline-block;"><div class="share__icon share__icon_service_qzone"></div>Qzone</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="renren" />
                    <label for="renren" style="display: inline-block;"><div class="share__icon share__icon_service_renren"></div>Renren</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="sinaWeibo" />
                    <label for="sinaWeibo" style="display: inline-block;"><div class="share__icon share__icon_service_sinaWeibo"></div>Sina Weibo</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="surfingbird" />
                    <label for="surfingbird" style="display: inline-block;"><div class="share__icon share__icon_service_surfingbird"></div>Surfingbird</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="tencentWeibo" />
                    <label for="tencentWeibo" style="display: inline-block;"><div class="share__icon share__icon_service_tencentWeibo"></div>Tencent Weibo</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="tumblr" />
                    <label for="tumblr" style="display: inline-block;"><div class="share__icon share__icon_service_tumblr"></div>Tumblr</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="viber" />
                    <label for="viber" style="display: inline-block;"><div class="share__icon share__icon_service_viber"></div>Viber</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="whatsapp" />
                    <label for="whatsapp" style="display: inline-block;"><div class="share__icon share__icon_service_whatsapp"></div>WhatsApp</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="skype" />
                    <label for="skype" style="display: inline-block;"><div class="share__icon share__icon_service_skype"></div>Skype</label>
                    </div>
                    
                    <div class="share__list-item">
                    <input type="checkbox" name="networks[]" id="telegram" />
                    <label for="telegram" style="display: inline-block;"><div class="share__icon share__icon_service_telegram"></div>Telegram</label>
                    </div>
                    
                  </div>
                  
                </td>
            </tr>
            <tr>
                <th><?php _e('Order:', 'easy-yandex-share'); ?></th>
                <td>
                   <textarea style="resize: none;" rows="3" cols="62" name="nets" id="nets" disabled="disabled" ><?php echo $yshare_options['nets']; ?></textarea>
                   <input type="text" style="display:none;" name="netsspan" id="netsspan" value="<?php echo $yshare_options['nets']; ?>"/>
                    <br /><small style=""><?php _e('To sort the icons, remove all the checkboxes first, and then select the ones you need in the preferred order.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr>
                <th><?php _e('Appearance:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="look" id="look" style="width: 250px;">
                        <option value="icons" <?php if ($yshare_options['look'] == 'icons') echo 'selected="selected"'; ?>><?php _e('Icons', 'easy-yandex-share'); ?></option>
                        <option value="counters" <?php if ($yshare_options['look'] == 'counters') echo 'selected="selected"'; ?>><?php _e('Counters', 'easy-yandex-share'); ?></option>
                        <option value="iconsmenu" <?php if ($yshare_options['look'] == 'iconsmenu') echo 'selected="selected"'; ?>><?php _e('Icons and menu', 'easy-yandex-share'); ?></option>
                        <option value="countersmenu" <?php if ($yshare_options['look'] == 'countersmenu') echo 'selected="selected"'; ?>><?php _e('Counters and menu', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('&#171;Yandex.Share&#187; block appearance.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr class="iconsmenutr" style="display:none;">
                <th><?php _e('Number of icons:', 'easy-yandex-share'); ?></th>
                <td>
                    <input style="max-width: 50px;" type="number" name="limit" min="1" max="26" step="1" value="<?php echo $yshare_options['limit']; ?>" />
                    <br /><small><?php _e('The number of social networks displayed as icons.<br /> The full list is displayed in a popup when clicking the menu button.', 'easy-yandex-share'); ?> </small>
               </td>
            </tr>
            <tr class="iconsmenutr" style="display:none;">
                <th><?php _e('Popup opening direction:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="popup-direction" style="width: 250px;">
                        <option value="top" <?php if ($yshare_options['popup-direction'] == 'top') echo 'selected="selected"'; ?>><?php _e('Up', 'easy-yandex-share'); ?></option>
                        <option value="bottom" <?php if ($yshare_options['popup-direction'] == 'bottom') echo 'selected="selected"'; ?>><?php _e('Down', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('Popup opening direction when clicking the menu button.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr class="iconsmenutr" style="display:none;">
                <th><?php _e('Popup position:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="popup-position" style="width: 250px;">
                        <option value="inner" <?php if ($yshare_options['popup-position'] == 'inner') echo 'selected="selected"'; ?>><?php _e('Inside the container', 'easy-yandex-share'); ?></option>
                        <option value="outer" <?php if ($yshare_options['popup-position'] == 'outer') echo 'selected="selected"'; ?>><?php _e('Outside the container', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('Popup position relative to the block container.', 'easy-yandex-share'); ?><br />
                    <?php _e('<strong>Outside the container</strong> option might be helpful if specific markup on your site<br/> causes the popup to be truncated by other elements on the page.', 'easy-yandex-share'); ?></small>
                </td>
            </tr>
            <tr class="iconsmenutr" style="display:none;">
                <th><?php _e('Copy link:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="copy" style="width: 250px;">
                        <option value="first" <?php if ($yshare_options['copy'] == 'first') echo 'selected="selected"'; ?>><?php _e('Button above the list', 'easy-yandex-share'); ?></option>
                        <option value="last" <?php if ($yshare_options['copy'] == 'last') echo 'selected="selected"'; ?>><?php _e('Button below the list', 'easy-yandex-share'); ?></option>
                        <option value="hidden" <?php if ($yshare_options['copy'] == 'hidden') echo 'selected="selected"'; ?>><?php _e('Hide the button', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('<strong>Copy link</strong> button position.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr class="iconsmenutr" style="display:none;">
                <td style="margin-top:30px;"></td>
            </tr>
            <tr>
                <th><?php _e('Icons size:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="size" style="width: 250px;">
                        <option value="m" <?php if ($yshare_options['size'] == 'm') echo 'selected="selected"'; ?>><?php _e('Large', 'easy-yandex-share'); ?></option>
                        <option value="s" <?php if ($yshare_options['size'] == 's') echo 'selected="selected"'; ?>><?php _e('Small', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('Social network icons size.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr>
                <th><?php _e('Orientation:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="direction" style="width: 250px;">
                        <option value="horizontal" <?php if ($yshare_options['direction'] == 'horizontal') echo 'selected="selected"'; ?>><?php _e('Horizontal', 'easy-yandex-share'); ?></option>
                        <option value="vertical" <?php if ($yshare_options['direction'] == 'vertical') echo 'selected="selected"'; ?>><?php _e('Vertical', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('Display social network icons list horizontally or vertically.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr>
                <th><?php _e('Language:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="lang" style="width: 250px;">
                        <option value="az" <?php if ($yshare_options['lang'] == 'az') echo 'selected="selected"'; ?>><?php _e('Azerbaijani', 'easy-yandex-share'); ?></option>
                        <option value="be" <?php if ($yshare_options['lang'] == 'be') echo 'selected="selected"'; ?>><?php _e('Belorussian', 'easy-yandex-share'); ?></option>
                        <option value="en" <?php if ($yshare_options['lang'] == 'en') echo 'selected="selected"'; ?>><?php _e('English', 'easy-yandex-share'); ?></option>
                        <option value="hy" <?php if ($yshare_options['lang'] == 'hy') echo 'selected="selected"'; ?>><?php _e('Armenian', 'easy-yandex-share'); ?></option>
                        <option value="ka" <?php if ($yshare_options['lang'] == 'ka') echo 'selected="selected"'; ?>><?php _e('Georgian', 'easy-yandex-share'); ?></option>
                        <option value="kk" <?php if ($yshare_options['lang'] == 'kk') echo 'selected="selected"'; ?>><?php _e('Kazakh', 'easy-yandex-share'); ?></option>
                        <option value="ro" <?php if ($yshare_options['lang'] == 'ro') echo 'selected="selected"'; ?>><?php _e('Romanian', 'easy-yandex-share'); ?></option>
                        <option value="ru" <?php if ($yshare_options['lang'] == 'ru') echo 'selected="selected"'; ?>><?php _e('Russian', 'easy-yandex-share'); ?></option>
                        <option value="tr" <?php if ($yshare_options['lang'] == 'tr') echo 'selected="selected"'; ?>><?php _e('Turkish', 'easy-yandex-share'); ?></option>
                        <option value="tt" <?php if ($yshare_options['lang'] == 'tt') echo 'selected="selected"'; ?>><?php _e('Tatar', 'easy-yandex-share'); ?></option>
                        <option value="uk" <?php if ($yshare_options['lang'] == 'uk') echo 'selected="selected"'; ?>><?php _e('Ukrainian', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('&#171;Yandex.Share&#187; block language. Affects social network icon labels and <strong>Copy link</strong> button.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr>
                <th><?php _e('Block placement:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="mesto" style="width: 250px;">
                        <option value="top" <?php if ($yshare_options['mesto'] == 'top') echo 'selected="selected"'; ?>><?php _e('Before content', 'easy-yandex-share'); ?></option>
                        <option value="bottom" <?php if ($yshare_options['mesto'] == 'bottom') echo 'selected="selected"'; ?>><?php _e('After content', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('Display the block before or after post content.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Update options &raquo;', 'easy-yandex-share'); ?>" />
                </td>
            </tr> 
        </table>
    </div>
</div>

<div class="postbox">

    <h3 style="border-bottom: 1px solid #EEE;background: #f7f7f7;"><span class="tcode"><?php _e('Advanced Options', 'easy-yandex-share'); ?></span></h3>
    <div class="inside" style="display: block;">

        <table class="form-table">
        
                        <tr>
                <th><?php _e('Post Types:', 'easy-yandex-share'); ?></th>
                <td style="padding-top: 20px;">                   
<?php
$registered = get_post_types( array('public'=> true), 'objects' );
$exclude    = array();
$types      = array();

foreach ( $registered as $post ) {
    if ( in_array( $post->name, $exclude ) ) {
        continue;
    }
    $types[ $post->name ] = $post->name;
}

$ysharetype = explode(",", $yshare_options['types']);
$ysharetype = array_diff($ysharetype, array(''));

foreach ( $types  as $post_type ) {
    $obj = get_post_type_object( $post_type );
    ?><label class="types" for="<?php echo $post_type; ?>"><input type="checkbox" value="<?php echo $post_type; ?>" name="types[]" id="<?php echo $post_type; ?>" <?php if (in_array($post_type, $ysharetype)) echo 'checked="checked"'; ?> /><?php echo $obj->labels->name; ?></label><?php 
}
?>
                    <small><?php _e('Post types where &#171;Yandex.Share&#187; block is displayed automatically.', 'easy-yandex-share'); ?><br />
                    </small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Exclude Posts:', 'easy-yandex-share'); ?></th>
                <td>
                    <input type="text" name="excludeids" size="30" style="width: 250px;" value="<?php echo $yshare_options['excludeids']; ?>" />
                    <br /><small><?php _e('Disable the block on posts with the specified <strong>IDs</strong> (comma-separated).', 'easy-yandex-share'); ?></small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Filter Priority:', 'easy-yandex-share'); ?></th>
                <td>
                    <input style="max-width: 70px;" type="number" name="priority" min="-9999" max="9999" step="1" value="<?php echo $yshare_options['priority']; ?>" />
                    <br /><small><?php _e('Priority of the filter displaying the &#171;Yandex.Share&#187; block.', 'easy-yandex-share'); ?><br />
                    <?php _e('<strong>1</strong> - earliest, <strong>9999</strong> - latest.', 'easy-yandex-share'); ?><br />
                    <?php _e('Change the priority if the block is not displayed in the right order.', 'easy-yandex-share'); ?>
                    </small>
               </td>
            </tr>
            <tr>
                <td style="margin-top:30px;"></td>
            </tr>
            <tr>
                <th><?php _e('HTML before the block:', 'easy-yandex-share'); ?></th>
                <td>
                    <textarea rows="3" cols="60" name="htmlbefore" id="htmlbefore"><?php echo stripslashes($yshare_options['htmlbefore']); ?></textarea>
                    <br /><small><?php _e('HTML code before the &#171;Yandex.Share&#187; block.', 'easy-yandex-share'); ?></small>
                </td>
            </tr>
            <tr>
                <th><?php _e('HTML after the block:', 'easy-yandex-share'); ?></th>
                <td>
                    <textarea rows="3" cols="60" name="htmlafter" id="htmlafter"><?php echo stripslashes($yshare_options['htmlafter']); ?></textarea>
                    <br /><small><?php _e('HTML code after the Yandex.Share block.', 'easy-yandex-share'); ?></small>
                </td>
            </tr>
            <tr>
                <td style="margin-top:30px;"></td>
            </tr>
            <tr>
                <th><?php _e('Facebook Access Token:', 'easy-yandex-share'); ?></th>
                <td>
                    <input type="text" name="access-token" size="30" style="width: 250px;" value="<?php echo $yshare_options['access-token']; ?>" />
                    <br /><small><?php _e('Token for removing restrictions on Facebook counter requests.', 'easy-yandex-share'); ?> <br />
                    <?php _e('See the <a target="_blank" href="https://developers.facebook.com/docs/facebook-login/access-tokens">Access Tokens</a> article for more information on getting a token.', 'easy-yandex-share'); ?>
                    </small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Twitter hashtags:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="hashtags" style="width: 250px;">
                        <option value="no" <?php if ($yshare_options['hashtags'] == 'no') echo 'selected="selected"'; ?>><?php _e('Disabled', 'easy-yandex-share'); ?></option>
                        <option value="cats" <?php if ($yshare_options['hashtags'] == 'cats') echo 'selected="selected"'; ?>><?php _e('Categories', 'easy-yandex-share'); ?></option>
                        <option value="tags" <?php if ($yshare_options['hashtags'] == 'tags') echo 'selected="selected"'; ?>><?php _e('Tags', 'easy-yandex-share'); ?></option>
                        <option value="catstags" <?php if ($yshare_options['hashtags'] == 'catstags') echo 'selected="selected"'; ?>><?php _e('Categories and tags', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('Hashtags. Only for Twitter.', 'easy-yandex-share'); ?> </small>
                </td>
            </tr>
            <tr>
                <th><?php _e('CDN:', 'easy-yandex-share'); ?></th>
                <td>
                    <select name="cdn" style="width: 250px;">
                        <option value="yandex" <?php if ($yshare_options['cdn'] == 'yandex') echo 'selected="selected"'; ?>><?php _e('Yandex', 'easy-yandex-share'); ?></option>
                        <option value="jsdelivr" <?php if ($yshare_options['cdn'] == 'jsdelivr') echo 'selected="selected"'; ?>><?php _e('jsDelivr', 'easy-yandex-share'); ?></option>
                    </select>
                    <br /><small><?php _e('CDN hosting for &#171;Yandex.Share&#187; script.', 'easy-yandex-share'); ?> <br />
                    <?php _e('Select jsDelivr if Yandex is blocked in your country (Ukraine, etc.).', 'easy-yandex-share'); ?> <br />
                    </small>
                </td>
            </tr>
            
            <tr>
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Update options &raquo;', 'easy-yandex-share'); ?>" />
                </td>
            </tr> 
        
        </table>
    </div>
</div>      

<div class="postbox" style="margin-bottom:0;">
    <h3 style="border-bottom: 1px solid #EEE;background: #f7f7f7;"><span class="tcode"><?php _e('About', 'easy-yandex-share'); ?></span></h3>
	  <div class="inside" style="padding-bottom:15px;display: block;">
     
      <p><?php _e('If you liked my plugin, please <a target="new" href="https://wordpress.org/plugins/easy-yandex-share/"><strong>rate</strong></a> it.', 'easy-yandex-share'); ?></p>
      <p style="margin-top:20px;margin-bottom:10px;"><?php _e('You may also like my other plugins:', 'easy-yandex-share'); ?></p>
      
      <div class="about">
        <ul>
            <?php if ($lang == 'ru_RU') : ?>
            <li><a target="new" href="https://ru.wordpress.org/plugins/rss-for-yandex-zen/">RSS for Yandex Zen</a> - создание RSS-ленты для сервиса Яндекс.Дзен.</li>
            <li><a target="new" href="https://ru.wordpress.org/plugins/rss-for-yandex-turbo/">RSS for Yandex Turbo</a> - создание RSS-ленты для сервиса Яндекс.Турбо.</li>
            <?php endif; ?>
            <li><a target="new" href="https://wordpress.org/plugins/bbspoiler/">BBSpoiler</a> - <?php _e('this plugin allows you to hide text under the tags [spoiler]your text[/spoiler].', 'easy-yandex-share'); ?></li>
            <li><a target="new" href="https://wordpress.org/plugins/easy-textillate/">Easy Textillate</a> - <?php _e('very beautiful text animations (shortcodes in posts and widgets or PHP code in theme files).', 'easy-yandex-share'); ?> </li>
            <li><a target="new" href="https://wordpress.org/plugins/cool-image-share/">Cool Image Share</a> - <?php _e('this plugin adds social sharing icons to each image in your posts.', 'easy-yandex-share'); ?> </li>
            <li><a target="new" href="https://wordpress.org/plugins/today-yesterday-dates/">Today-Yesterday Dates</a> - <?php _e('this plugin changes the creation dates of posts to relative dates.', 'easy-yandex-share'); ?> </li>
            <li><a target="new" href="https://wordpress.org/plugins/truncate-comments/">Truncate Comments</a> - <?php _e('this plugin uses Javascript to hide long comments (Amazon-style comments).', 'easy-yandex-share'); ?> </li>
            </ul>
      </div>     
    </div>
</div>
<?php wp_nonce_field( plugin_basename(__FILE__), 'yshare_nonce'); ?>
</form>
</div>
</div>
<?php 
}
//функция вывода страницы настроек плагина end

//функция добавления ссылки на страницу настроек плагина в раздел "Настройки" begin
function yshare_menu() {
	add_options_page('Easy Yandex Share', 'Easy Yandex Share', 'manage_options', 'easy-yandex-share.php', 'yshare_options_page');
}
add_action('admin_menu', 'yshare_menu');
//функция добавления ссылки на страницу настроек плагина в раздел "Настройки" end

//функция добавления фильтра с указанным приоритетом begin 
function yshare_add_filter_with_priority() {
    $yshare_options = get_option('yshare_options');
    add_filter( 'the_content', 'yshare_add_share_block', $yshare_options['priority'] );
} 
add_action ('init', 'yshare_add_filter_with_priority');
//функция добавления фильтра с указанным приоритетом end 

//функция автоматического вывода блока яндекс.share в контенте begin
function yshare_add_share_block( $content ) {
    $yshare_options = get_option('yshare_options');
    $types = $yshare_options['types'];
    $types = explode(",", $types);
    $types = array_diff($types, array(''));
    $excludeids = $yshare_options['excludeids'];
    $excludeids = explode(",", $excludeids);
    
    //выходим, если это не страница полной записи 
    if ( ! is_singular() )
        return $content;
    
    //выходим, если это не указанный в настройках тип записей 
    if ( ! in_array( get_post()->post_type, $types ) )
        return $content;
    
    //выходим, если это исключенный в настройках пост
    if ( in_array( get_the_ID(), $excludeids ) )
        return $content;
    
    //выходим, если это rss-лента
    if( is_feed() ) 
        return $content;
    
    //формируем блок согласно настройкам плагина
    $share = html_entity_decode(stripcslashes($yshare_options['htmlbefore']),ENT_QUOTES);
    $share .= '<div class="ya-share2" data-services="';
    $share .= $yshare_options['nets'] . '" ';
    if ( $yshare_options['look'] == 'counters' or $yshare_options['look'] == 'countersmenu') {
        $share .= 'data-counter="" ';
    }    
    if ( $yshare_options['look'] == 'iconsmenu' or $yshare_options['look'] == 'countersmenu') {
        $share .= 'data-limit="'. $yshare_options['limit'] .'" ';
        $share .= 'data-popup-direction="'. $yshare_options['popup-direction'] .'" ';
        $share .= 'data-popup-position="'. $yshare_options['popup-position'] .'" ';
        $share .= 'data-copy="'. $yshare_options['copy'] .'" ';
    }
    $share .= 'data-size="'. $yshare_options['size'] .'" ';
    $share .= 'data-direction="'. $yshare_options['direction'] .'" ';
    $share .= 'data-lang="'. $yshare_options['lang'] .'" ';
    $share .= 'data-access-token="'. $yshare_options['access-token'] .'" ';
    
    if ($yshare_options['hashtags'] != 'no') {
    
        $categories = get_the_category( get_the_ID() );
        $tempcats = array();
        if ( !empty($categories) ) {
            foreach($categories as $cat){
                $tempcats[] = $cat->cat_name;
            }
        }
        $tempcats = implode(',', $tempcats);    
        
        $tags = get_the_tags( get_the_ID() );
        $temptags = array();
        if ( !empty($tags) ) {
            foreach($tags as $tag){
                $temptags[] = $tag->name;
            }
        }
        $temptags = implode(',', $temptags); 
   
        if ($yshare_options['hashtags'] == 'cats') {$temp = $tempcats;}
        if ($yshare_options['hashtags'] == 'tags') {$temp = $temptags;}
        if ($yshare_options['hashtags'] == 'catstags') {$temp = $tempcats . ',' . $temptags;}
        $share .= 'data-hashtags="'. $temp .'" ';
    }
    
    $share .= 'data-url="'. esc_url( get_permalink( get_the_ID() ) ) .'" ';
    $image = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
    if (empty($image)) {$image = yshare_get_first_image();}
    if (!empty($image)) {
        $share .= 'data-image="'. esc_url( $image ) .'" ';
    }
    
    $share .= '></div>';
    $share .= html_entity_decode(stripcslashes($yshare_options['htmlafter']),ENT_QUOTES);
    
    if ( $yshare_options['mesto'] == 'top' ) {$content = $share . $content;}
    if ( $yshare_options['mesto'] == 'bottom' ) {$content = $content . $share;}
    return $content;
}
//функция автоматического вывода блока яндекс.share в контенте and

//получаем ссылку на первую картинку записи begin
function yshare_get_first_image() {
    global $post;
    $first_img = '';
    preg_match_all('/<img[^>]+src=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $post->post_content, $result);     
    $first_img = $result[2][0];
 
    if(empty($first_img)) {
        $first_img = get_site_icon_url();
    }
    return $first_img;
}
//получаем ссылку на первую картинку записи end

//функция вывода блока яндекс.share на странице настройки плагина begin
function yshare_share_block_preview() {
    $yshare_options = get_option('yshare_options');
    
    //формируем блок согласно настройкам плагина
    $share = html_entity_decode(stripcslashes($yshare_options['htmlbefore']),ENT_QUOTES);
    $share .= '<div class="ya-share2" data-services="';
    $share .= $yshare_options['nets'] . '" ';
    if ( $yshare_options['look'] == 'counters' or $yshare_options['look'] == 'countersmenu') {
        $share .= 'data-counter="" ';
    }    
    if ( $yshare_options['look'] == 'iconsmenu' or $yshare_options['look'] == 'countersmenu') {
        $share .= 'data-limit="'. $yshare_options['limit'] .'" ';
        $share .= 'data-popup-direction="'. $yshare_options['popup-direction'] .'" ';
        $share .= 'data-popup-position="'. $yshare_options['popup-position'] .'" ';
        $share .= 'data-copy="'. $yshare_options['copy'] .'" ';
    }
    $share .= 'data-size="'. $yshare_options['size'] .'" ';
    $share .= 'data-direction="'. $yshare_options['direction'] .'" ';
    $share .= 'data-lang="'. $yshare_options['lang'] .'" ';
    $share .= 'data-access-token="'. $yshare_options['access-token'] .'" ';
    $share .= 'data-url="'. esc_url( 'https://wordpress.org/plugins/easy-yandex-share/' ) .'" ';
    $share .= 'data-image="'. esc_url( 'https://ps.w.org/easy-yandex-share/assets/banner-772x250.png' ) .'" ';
    $share .= 'data-title="Easy Yandex Share"';
    
    $share .= '></div>';
    $share .= html_entity_decode(stripcslashes($yshare_options['htmlafter']),ENT_QUOTES);
    
    echo $share;    
}  
//функция вывода блока яндекс.share на странице настройки плагина end  

//исправление косяков стилей различных тем begin
function yshare_print_style() {
?>
<style>
.ya-share2__link{border: none!important;box-shadow:none!important;}
.ya-share2__container {display: inline-block;}
.ya-share2__list{padding: 0!important;margin: 0!important;}
.ya-share2__item {padding: 0!important;background:none!important;}
</style>
<?php } 
add_action('wp_head', 'yshare_print_style');
//исправление косяков стилей различных тем end