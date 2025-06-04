<?php


class QLQC_LINK_TO_QRCODE
{
    public function __construct()
    {
        add_filter('the_content', [$this, 'link_to_qrcode']);
    }
    function link_to_qrcode($content)
    {
        if (!is_singular()) {
            return $content;
        }

        $post_type = get_post_type();

        $allowed_post_types = apply_filters('qlqc_allowed_post_types', ['post', 'page']);

        if (!in_array($post_type, $allowed_post_types)) {
            return $content;
        }

        $url = "https://quickchart.io/qr?";
        $post_url = get_permalink();
        $margin = apply_filters('qlqc_qrcode_margin', 0);
        $size = apply_filters('qlqc_qrcode_size', 150);
        $dark = apply_filters('qlqc_qrcode_dark', '000');
        $light = apply_filters('qlqc_qrcode_light', 'fff');
        $params = [
            'text' => $post_url,
            "margin" => 0,
            "size" => $size,
            "dark" => $dark,
            "light" => $light
        ];
        $qr_url = $url . http_build_query($params);
        // $qr_url = "https://quickchart.io/qr?text={$post_url}";

        // ******************
        $position = apply_filters('qlqc_qrcode_position', 'right');
        $border_color = apply_filters('qlqc_qrcode_border_color', '000');
        ob_start();
        ?>
        <span style="position: fixed; bottom:20px;<?php echo esc_html($position); ?>:20px;" class="qlqc-qrcode_container">
            <span
                style="display: flex; flex-direction: column; align-items: center; justify-content: center; border:2px solid #<?php echo esc_html($border_color); ?>; padding:10px; border-radius: 10px;">
                <span>Scan me</span>
                <img src="<?php echo esc_url($qr_url); ?>" />
            </span>
        </span>
        <?php
        $qr_html = ob_get_clean();

        return $qr_html . $content;
    }
}

