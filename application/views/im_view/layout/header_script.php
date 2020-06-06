<script src="<?php echo base_url("assets/im/newTheme/assets/js/vendors/jquery.min.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/vendors/vendors.js?v=").$var ?>"></script>
<!-- Local Revolution tools-->
<!-- Only for local and can be removed on server-->

<script src="<?php echo base_url("assets/im/newTheme/assets/js/custom.js?v=").$var ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/jquery.playSound.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/toastr.min.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/anchorme.min.js?v=").$var ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/magicsuggest.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/moment.min.js?v=").$var ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/socket.io.js?v=").$var ?>"></script>


<script src="<?php echo base_url("assets/im/newTheme/assets/js/jwt-decode.min.js?v=").$var ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/clamp.min.js?v=").$var ?>"></script>


<script>
    var baseUrl="<?php echo base_url() ?>";
    function isUnicode(str) {
        let textareavalue = str; //Getting input value
        let arabic = /[\u0600-\u06FF]/g; //setting arabic unicode
        let hebrew = /[\u0590-\u05FF]/g;
        let match = textareavalue.match(arabic) || textareavalue.match(hebrew);
        let spacesMatch = textareavalue.match(new RegExp(" ", 'g'));
        let allcount = textareavalue.length;
        let farsicount = match ? match.length : 0;
        let spacesCount = spacesMatch ? spacesMatch.length : 0;
        let Englishcount = allcount - farsicount - spacesCount;

        return farsicount > Englishcount;
    }

    function escapeHtml(string) {
        var htmlEscapes = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#x27;',
            '/': '&#x2F;'
        };

        // Regex containing the keys listed immediately above.
        var htmlEscaper = /[&<>"'\/]/g;

        // Escape a string for HTML interpolation.
        return ('' + string).replace(htmlEscaper, function(match) {
            return htmlEscapes[match];
        });
    }
    function decodeHTML  (html) {
        var txt = document.createElement('textarea');
        txt.innerHTML = html;
        return txt.value;
    };
    (function ($) {
        $.fn.serializeFormJSON = function () {

            let o = {};
            let a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    })(jQuery);
</script>



<script>
    let $buoop = {
        notify:{e:-1,f:-1,o:-1,s:-1,c:-1},
        insecure:true,
        api:5,
        text:"Your browser, {brow_name}, is too old for Chat manager: <a{up_but}>update</a>.",
        style: "top",
        container: document.body,
        jsshowurl: "//browser-update.org/update.show.min.js",
        l: false,
    };
    function $buo_f(){
        let e = document.createElement("script");
        e.src = "//browser-update.org/update.min.js";
        document.body.appendChild(e);
    };
    try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
    catch(e){window.attachEvent("onload", $buo_f)}
</script>
