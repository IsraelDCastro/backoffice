��    F      L  a   |         1        3  n   H  �   �  g   P  j   �  #   #     G     X  5   s  �   �  �   0	  #   �	      �	  l   �	     i
  T   z
  ;   �
       Y     S   n  #   �     �             I   ;  6   �  5   �  4   �     '     >  Q   X  R   �     �  [     a   t  ^   �  �   5  ;   �  ^     .   e  +   �  0   �  q   �  s   c     �     �          1     E     a  !        �     �     �  9   �  =   4  ^   r  0   �       w   !  W   �  P   �  8   B  Q   {  *   �  %   �  #     1   B  1  t  5   �     �  l   �  �   i  o     l   �  '   �          2  B   M  �   �  �      -   �  4     }   8     �  a   �  9   4     n  f   w  Z   �  %   9     _     g  	   u  ?     -   �  )   �  &        >     K  ;   T  H   �     �  M   �  R   /   V   �   �   �   6   ^!  V   �!     �!     	"  &   &"  _   M"  f   �"     #     2#     O#     f#     y#     ~#     �#     �#     �#     �#  ,   �#  .   �#  U   $  &   b$     �$  m   �$  P   %  I   Y%  *   �%  J   �%     &     9&  #   W&  +   {&     !           4         :   0   '   >             &       9   E                 3                2   F   A   +                      
      8   6   "      =      $   	       D             @   *   ,   7   1       %   5      .             ?                      <      ;       /   #          B           C          )       (   -                                  Clean up WordPress website HTTPS insecure content Fix insecure content If you know of a way to detect HTTPS on your server, please <a href="%s" target="_blank">tell me about it</a>. It looks like your server is behind Amazon CloudFront, not configured to send HTTP_X_FORWARDED_PROTO. The recommended setting for HTTPS detection is %s. It looks like your server is behind a reverse proxy. The recommended setting for HTTPS detection is %s. It looks like your server uses Cloudflare Flexible SSL. The recommended setting for HTTPS detection is %s. Multisite network settings updated. Running tests... SSL Insecure Content Fixer SSL Insecure Content Fixer multisite network settings SSL Insecure Content Fixer requires <a target="_blank" href="%1$s">PCRE</a> version %2$s or higher; your website has PCRE version %3$s SSL Insecure Content Fixer requires these missing PHP extensions. Please contact your website host to have these extensions installed. SSL Insecure Content Fixer settings SSL Insecure Content Fixer tests Select the level of fixing. Try the Simple level first, it has the least impact on your website performance. Tests completed. These settings affect all sites on this network that have not been set individually. This page checks to see whether WordPress can detect HTTPS. WebAware Your server can detect HTTPS normally. The recommended setting for HTTPS detection is %s. Your server cannot detect HTTPS. The recommended setting for HTTPS detection is %s. Your server environment shows this: fix level settingsCapture fix level settingsCapture All fix level settingsContent fix level settingsEverything on the page, from the header to the footer: fix level settingsEverything that Content does, plus: fix level settingsEverything that Simple does, plus: fix level settingsNo insecure content will be fixed fix level settingsOff fix level settingsSimple fix level settingsThe biggest potential to break things, but sometimes necessary fix level settingsThe fastest method with the least impact on website performance fix level settingsWidgets fix level settingscapture the whole page and fix scripts, stylesheets, and other resources fix level settingsdata returned from <code>wp_upload_dir()</code> (e.g. for some CAPTCHA images) fix level settingsexcludes AJAX calls, which can cause compatibility and performance problems fix level settingsimages and other media loaded by calling <code>wp_get_attachment_image()</code>, <code>wp_get_attachment_image_src()</code>, etc. fix level settingsimages loaded by the plugin Image Widget fix level settingsincludes AJAX calls, which can cause compatibility and performance problems fix level settingsresources in "Text" widgets fix level settingsresources in any widgets fix level settingsresources in the page content fix level settingsscripts registered using <code>wp_register_script()</code> or <code>wp_enqueue_script()</code> fix level settingsstylesheets registered using <code>wp_register_style()</code> or <code>wp_enqueue_style()</code> https://shop.webaware.com.au/ https://ssl.webaware.net.au/ menu linkSSL Insecure Content menu linkSSL Tests plugin details linksDonate plugin details linksGet help plugin details linksInstructions plugin details linksRating plugin details linksSettings plugin details linksTranslate plugin fix settingsFixes for specific plugins and themes plugin fix settingsSelect only the fixes your website needs. plugin fix settingsWooCommerce  + Google Chrome HTTP_HTTPS bug (fixed in WooCommerce v2.3.13) proxy settings* detected as recommended setting proxy settingsHTTPS detection proxy settingsHTTP_CF_VISITOR (Cloudflare Flexible SSL); deprecated, since Cloudflare sends HTTP_X_FORWARDED_PROTO now proxy settingsHTTP_CLOUDFRONT_FORWARDED_PROTO (Amazon CloudFront HTTPS cached content) proxy settingsHTTP_X_FORWARDED_PROTO (e.g. load balancer, reverse proxy, NginX) proxy settingsHTTP_X_FORWARDED_SSL (e.g. reverse proxy) proxy settingsSelect how WordPress should detect that a page is loaded via HTTPS proxy settingsstandard WordPress function proxy settingsunable to detect HTTPS settings errorFix level is invalid settings errorHTTPS detection setting is invalid PO-Revision-Date: 2017-02-01 09:21:26+0000
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: GlotPress/2.4.0-alpha
Language: es
Project-Id-Version: Plugins - SSL Insecure Content Fixer - Stable (latest release)
 Limpia tu sitio WordPress de contenido HTTPS inseguro Soluciona el contenido inseguro Si sabes un modo de detectar HTTPS en tu servidor, por favor, <a href="%s" target="_blank">cuéntanoslo</a>. Parece que tu servidor está tras Amazon CloudFront, y no está configurado para enviar HTTP_X_FORWARDED_PROTO. El ajustes recomendado para la detección HTTPS es %s. Parece que tu servidor está detrás de un proxy inverso. El ajuste recomendado para la detección HTTPS es %s. Parece que tu servidor usa SSL flexible de CloudFlare. El ajuste recomendado para la detección HTTPS es %s. Ajustes de red multisitio actualizados. Ejecutando comprobaciones… SSL Insecure Content Fixer Ajustes de solución de contenido inseguro SSL para red multisitio SSL Insecure Content Fixer requiere la <a target="_blank" href="%1$s">PCRE</a> versión %2$s o superior; tu web tiene la versión %3$s de PCRE  SSL Insecure Content Fixer requiere estas extensiones PHP y no están disponibles. Por favor, contacta con el proveedor de alojamiento de tu web para que instale estas extensiones. Ajustes de solución a contenido inseguro SSL Comprobaciones de solución a contenido inseguro SSL Elige el nivel de solución. Primero prueba el nivel sencillo, que es el que menos impacto tiene en el rendimiento de tu web. Comprobaciones completadas. Estos ajustes afectan a todos los sitios de esta red que no se hayan configurado individualmente. Esta página comprueba si WordPress puede detectar HTTPS. WebAware Tu servidor puede detectar HTTPS con normalidad. El ajuste recomendado para la detección HTTPS es %s. Tu servidor no pudo detectar HTTPS. El ajustes recomendado para la detección HTTPS es %s. Tu entorno del servidor muestra esto: Captura Capturar todo Contenido Todo en la página, desde la cabecera hasta el pié de página: Todo lo que hace el nivel de contenido, más: Todo lo que hace el nivel sencillo, más: No hay contenido inseguro que arreglar Desconectado Sencillo El mayor potencial para romper algo, pero a veces necesario El método más rápido con el menor impacto en el rendimiento de la web Widgets captura toda la página y soluciona scripts, hojas de estilo y otros recursos datos devueltos por <code>wp_upload_dir()</code> (p.ej. algunas imágenes CAPTCHA) excluye llamadas AJAX, lo que puede provocar problemas de compatibilidad y rendimiento imágenes y otros medos cargados llamando a <code>wp_get_attachment_image()</code>, <code>wp_get_attachment_image_src()</code>, etc. imágenes cargadas desde el plugin de widget de imagen incluye llamadas AJAX, lo que puede provocar problemas de compatibilidad y rendimiento recursos en widgets de texto recursos en cualquier widget recursos en el contenido de la página scripts registrados usando <code>wp_register_script()</code> o <code>wp_enqueue_script()</code> hojas de estilos registradas usando <code>wp_register_style()</code> o <code>wp_enqueue_style()</code> https://shop.webaware.com.au/ https://ssl.webaware.net.au/ Contenido inseguro SSL Comprobaciones SSL Dona Obtén ayuda Instrucciones Valora Ajustes Traduce Soluciones para plugins y temas específicos Elige solo las soluciones que necesite tu web. WooCommerce  + fallo de Google Chrome HTTP_HTTPS (solucionado en WooCommerce v2.3.13) * detectado como el ajuste recomendado Detección HTTPS HTTP_CF_VISITOR (SSL flexible de Cloudflare); obsoleto, ya que Cloudflare envía ahora HTTP_X_FORWARDED_PROTO HTTP_CLOUDFRONT_FORWARDED_PROTO (Contenido en caché en Amazon CloudFront HTTPS) HTTP_X_FORWARDED_PROTO (p.ej. balanceador de carga, proxy inverso, NginX) HTTP_X_FORWARDED_SSL (p.ej. proxy inverso) Elige cómo debe WordPress detectar si una página se carga mediante HTTPS función estándar de WordPress no fue posible detectar HTTPS El nivel de solución no es válido El ajuste de detección HTTPS no es válido 