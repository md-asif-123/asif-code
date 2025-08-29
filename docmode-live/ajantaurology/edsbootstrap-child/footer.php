<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package edsBootstrap
 */
$edsbootstrap_options = get_theme_mod( 'edsbootstrap_theme_options' );

?>
<script type="text/javascript">
(function() {
    var didInit = false;

    function initMunchkin() {
        if (didInit === false) {
            didInit = true;
            Munchkin.init('329-HDZ-280');
        }
    }
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = '//munchkin.marketo.net/munchkin.js';
    s.onreadystatechange = function() {
        if (this.readyState == 'complete' || this.readyState == 'loaded') {
            initMunchkin();
        }
    };
    s.onload = initMunchkin;
    document.getElementsByTagName('head')[0].appendChild(s);
})();
</script>


<!-- Footer -->
<!-- <div class="row"><div class="help-text"><b>Help:</b><br>Please reach out to <b><a href="mailto:support@docmode.org">support@docmode.org</a></b> or WhatsApp <b>+919082170046</b> if you have any queries</div></div> -->
<footer class="footer section-small">
    <div class="container">
        <?php if ( is_active_sidebar( 'footer' ) ) { ?>
        <div class="row">
            <?php dynamic_sidebar( 'footer' ); ?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12 text-align-center">
                <?php //if (has_custom_logo()) { ?>
                <!-- <div class="logo"> -->
                <?php //the_custom_logo();?>
                <!-- </div> -->
                <?php //}?>

                <!-- /Footer Text -->

                <hr>

                <!-- Copyright -->
                <p class="copyright">
                    <!-- <img src="<?php// echo get_stylesheet_directory_uri();?>/198x61logo.jpg"><br> -->
                    <span>© <?php echo date('Y');?>. DocMode Health Technologies Limited. All rights reserved</span>
                </p>
                <!-- /Copyright -->

                <!-- Footer Social -->
                <?php
				$edsbootstrap_options = get_theme_mod( 'edsbootstrap_theme_options' );
				if ( $edsbootstrap_options['social'] ):
				?>
                <ul class="social-inline">
                    <?php foreach ($edsbootstrap_options['social'] as $key => $social):?>
                    <li><a href="<?php echo esc_url( $social );?>" class="fa fa-fw <?php echo esc_html($key);?>"
                            target="_blank"></a></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
                <!-- /Footer Social -->

            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->

<!-- Scroll To Top -->
<div id="scroll-to-top" class="scroll-to-top">
    <i class="icon fa fa-angle-up"></i>
</div>
<!-- /Scroll To Top -->


<!-- Start of Zendesk Widget script -->
<script>
/*<![CDATA[*/
window.zEmbed || function(e, t) {
    var n, o, d, i, s, a = [],
        r = document.createElement("iframe");
    window.zEmbed = function() {
            a.push(arguments)
        }, window.zE = window.zE || window.zEmbed, r.src = "javascript:false", r.title = "", r.role =
        "presentation", (r.frameElement || r).style.cssText = "display: none", d = document.getElementsByTagName(
            "script"), d = d[d.length - 1], d.parentNode.insertBefore(r, d), i = r.contentWindow, s = i.document;
    try {
        o = s
    } catch (c) {
        n = document.domain, r.src = 'javascript:var d=document.open();d.domain="' + n + '";void(0);', o = s
    }
    o.open()._l = function() {
        var o = this.createElement("script");
        n && (this.domain = n), o.id = "js-iframe-async", o.src = e, this.t = +new Date, this.zendeskHost = t,
            this.zEQueue = a, this.body.appendChild(o)
    }, o.write('<body onload="document._l();">'), o.close()
}("https://assets.zendesk.com/embeddable_framework/main.js", "docmode.zendesk.com"); /*]]>*/
</script>
<!-- End of Zendesk Widget script -->


<?php wp_footer(); ?>
</body>
<script>
//     function getCookie(cname) {
//   let name = cname + "=";
//   let decodedCookie = decodeURIComponent(document.cookie);
//   //console.log( 'saurabh' + decodedCookie)
//   let ca = decodedCookie.split(';');
//   for(let i = 0; i <ca.length; i++) {
//     let c = ca[i];
//     while (c.charAt(0) == ' ') {
//       c = c.substring(1);
//     }
//     if (c.indexOf(name) == 0) {
//       return c.substring(name.length, c.length);
//     }
//   }
//   return "";
// }


// Saurabh Raut
let a = jQuery('li#menu-item-70 a').attr('title');
console.log('saurabh user code : ' + a);
jQuery('#srb-jquery-user-name').val(a);
Cookies.set('wp-user', a);
// jQuery.ajax({
//     type:'GET',
//     url : 'https://switch-to-basalog.learn.docmode.org/api/v1/user_data_username/'+a,
//     dataType: "json",
//     crossDomain: true,

//     success : function (res){
//         console.log(res);
//     }
//  });

// Manisha joshi
// let cookies = 
//         document.cookie
//           .split(';')
//           .map(cookie => cookie.split('='))
//           .reduce((accumulator, [key, value]) => ({ ...accumulator, [key.trim()]: decodeURIComponent(value) }), {});

//          let cookies_data = cookies["edx-user-info"].replace(/[\\""''{}:]+/ig, "")
//          //cookies_data = cookies_data.substring(18).split(' ')[0];

//          console.log("username " + cookies_data);

//          jQuery('#srb-jquery-user-name').val(cookies_data);

//          function submitOnce() {
//           document.getElementById('submit-button').removeAttribute('onclick');
//           document.getElementById('my-form').submit();
// }
</script>
<?php 
    if ($_COOKIE['email_id']){
        $url = "http://learn.docmode.org/api/v1/user_basic_data/".$_COOKIE['email_id'];
        $API_Course_data = wp_remote_retrieve_body ( wp_remote_get( $url ) ) ;
        $JD_API_Course_data = json_decode( $API_Course_data );
        echo "<input type='hidden' id='srb-hdn-fullname' value='".$JD_API_Course_data[0]->value[0]->full_name."'/>";
        echo "<input type='hidden' id='srb-hdn-email' value='".$_COOKIE['email_id']."'/>";           
        
    }
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    let fn = jQuery('#srb-hdn-fullname').val();
    let el = jQuery('#srb-hdn-email').val();
    jQuery('#srb-jquery-full-name').val(fn);
    jQuery('#srb-jquery-emailid').val(el);
});
</script>

</html>